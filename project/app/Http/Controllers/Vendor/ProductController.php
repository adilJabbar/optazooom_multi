<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Currency;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Attribute;
use App\Models\AttributeOption;
use Auth;
use DB;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Image;
use Session;
use Validator;

class ProductController extends Controller
{
    public $global_language;

    public function __construct()
    {
        $this->middleware('auth');

        if (Session::has('language'))
        {
            $data = DB::table('languages')->find(Session::get('language'));
            $data_results = file_get_contents(public_path().'/assets/languages/'.$data->file);
            $this->vendor_language = json_decode($data_results);
        }
        else
        {
            $data = DB::table('languages')->where('is_default','=',1)->first();
            $data_results = file_get_contents(public_path().'/assets/languages/'.$data->file);
            $this->vendor_language = json_decode($data_results);

        }

    }

    //*** JSON Request
    public function datatables()
    {
        $user = Auth::user();
        $datas = $user->products()->where('product_type','normal')->orderBy('id','desc')->get();

        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
            ->editColumn('name', function(Product $data) {
                $name = strlen(strip_tags($data->name)) > 50 ? substr(strip_tags($data->name),0,50).'...' : strip_tags($data->name);
                $id = '<small>Product ID: <a href="'.route('front.product', $data->slug).'" target="_blank">'.sprintf("%'.08d",$data->id).'</a></small>';
                return  $name.'<br>'.$id;
            })
            ->editColumn('price', function(Product $data) {
                $sign = Currency::where('is_default','=',1)->first();
                $price = round($data->price * $sign->value , 2);
                $price = $sign->sign.$price ;
                return  $price;
            })
            ->addColumn('status', function(Product $data) {
                $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                $s = $data->status == 1 ? 'selected' : '';
                $ns = $data->status == 0 ? 'selected' : '';
                return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('vendor-prod-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>'.$this->vendor_language->lang713.'</option><<option data-val="0" value="'. route('vendor-prod-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>'.$this->vendor_language->lang714.'</option>/select></div>';
            })
            ->addColumn('action', function(Product $data) {
                return '<div class="action-list"><a href="' . route('vendor-prod-edit',$data->id) . '"> <i class="fas fa-edit"></i>'.$this->vendor_language->lang715.'</a><a href="javascript" class="set-gallery" data-toggle="modal" data-target="#setgallery"><input type="hidden" value="'.$data->id.'"><i class="fas fa-eye"></i> '.$this->vendor_language->lang716.'</a><a href="javascript:;" data-href="' . route('vendor-prod-delete',$data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
            })
            ->rawColumns(['name', 'status', 'action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }


    //*** JSON Request
    public function catalogdatatables()
    {
        $user = Auth::user();
        $datas =  Product::where('product_type','normal')->where('status','=',1)->where('is_catalog','=',1)->orderBy('id','desc')->get();

        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
            ->editColumn('name', function(Product $data) {
                $name = strlen(strip_tags($data->name)) > 50 ? substr(strip_tags($data->name),0,50).'...' : strip_tags($data->name);
                $id = '<small>Product ID: <a href="'.route('front.product', $data->slug).'" target="_blank">'.sprintf("%'.08d",$data->id).'</a></small>';
                return  $name.'<br>'.$id;
            })
            ->editColumn('price', function(Product $data) {
                $sign = Currency::where('is_default','=',1)->first();
                $price = $sign->sign.$data->price;
                return  $price;
            })
            ->addColumn('action', function(Product $data) {
                $user = Auth::user();
                $ck = $user->products()->where('catalog_id','=',$data->id)->count() > 0;
                $catalog = $ck ? '<a href="javascript:;"> Added To Catalog</a>' : '<a href="' . route('vendor-prod-catalog-edit',$data->id) . '"><i class="fas fa-plus"></i> Add To Catalog</a>';
                return '<div class="action-list">'. $catalog .'</div>';
            })
            ->rawColumns(['name', 'status', 'action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }

    //*** GET Request
    public function index()
    {
        return view('vendor.product.index');
    }


    //*** GET Request
    public function catalogs()
    {
        return view('vendor.product.catalogs');
    }

    //*** GET Request
    public function types()
    {
        return view('vendor.product.types');
    }

    //*** GET Request
    public function createPhysical()
    {
        $cats = Category::all();
        $sign = Currency::where('is_default','=',1)->first();
        return view('vendor.product.create.physical',compact('cats','sign'));
    }

    //*** GET Request
    public function createDigital()
    {
        $cats = Category::all();
        $sign = Currency::where('is_default','=',1)->first();
        return view('vendor.product.create.digital',compact('cats','sign'));
    }

    //*** GET Request
    public function createLicense()
    {
        $cats = Category::all();
        $sign = Currency::where('is_default','=',1)->first();
        return view('vendor.product.create.license',compact('cats','sign'));
    }

    //*** GET Request
    public function status($id1,$id2)
    {
        $data = Product::findOrFail($id1);
        $data->status = $id2;
        $data->update();
    }

    //*** POST Request
    public function uploadUpdate(Request $request,$id)
    {
        //--- Validation Section
        $rules = [
            'image' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = Product::findOrFail($id);

        //--- Validation Section Ends
        $image = $request->image;
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name = Str::random(12).'.png';
        $path = 'assets/images/products/'.$image_name;
        file_put_contents($path, $image);
        if($data->photo != null)
        {
            if (file_exists(public_path().'/assets/images/products/'.$data->photo)) {
                unlink(public_path().'/assets/images/products/'.$data->photo);
            }
        }
        $input['photo'] = $image_name;
        $data->update($input);
        if($data->thumbnail != null)
        {
            if (file_exists(public_path().'/assets/images/thumbnails/'.$data->thumbnail)) {
                unlink(public_path().'/assets/images/thumbnails/'.$data->thumbnail);
            }
        }



        $background = Image::canvas(300, 300);
        $resizedImage = Image::make(public_path().'/assets/images/products/'.$data->photo)->resize(300, 300, function ($c) {
            $c->aspectRatio();
            $c->upsize();
        });
        // insert resized image centered into background
        $background->insert($resizedImage, 'center');
        // save or do whatever you like
        $thumbnail = Str::random(12).'.jpg';
        $background->save(public_path().'/assets/images/thumbnails/'.$thumbnail);



        $data->thumbnail  = $thumbnail;
        $data->update();
        return response()->json(['status'=>true,'file_name' => $image_name]);
    }


    //*** POST Request
    public function import(){

        $cats = Category::all();
        $sign = Currency::where('is_default','=',1)->first();
        return view('vendor.product.productcsv',compact('cats','sign'));
    }


    public function importSubmit(Request $request)
    {

//        echo "HERE";exit;

        $user = Auth::user();

//        echo Auth::user()->email;
//        echo "<PRE>";print_r($user);exit;


        if(Auth::user()->email == "ozhilcovision@gmail.com")

        {
            $prods = $user->products()->orderBy('id','desc')->get()->count();

//            echo "<PRE>";print_r($request->all());exit;

//            echo "prods ". $prods;
//            exit;

//            $log = "";
//
            $rules = array(
                'csvfile'      => 'required|mimes:csv,txt',
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }



            $filename = '';
            if ($file = $request->file('csvfile'))
            {
                $extensions = ['csv'];
                if(!in_array($file->getClientOriginalExtension(),$extensions)){
                    return response()->json(array('errors' => ['Image format not supported']));
                }
                $filename = time().'-'.$file->getClientOriginalName();
                $file->move('assets/temp_files',$filename);
            }

            //$filename = $request->file('csvfile')->getClientOriginalName();
            //return response()->json($filename);
            $datas = "";


            $file = fopen(public_path('assets/temp_files/'.$filename),"r");
            $i = 1;
            while (($line = fgetcsv($file)) !== FALSE) {

//                echo "<PRE>";
//                print_r($line);
//                exit;

                if($i != 1)
                {

                    $sku = $line[0];
                    $main_category = $line[1];
                    $sub_category = $line[2];
                    $product_name = $line[3];
                    $product_feature_image = $line[4];
                    $product_description = $line[5];
                    $current_price = $line[6];
                    $previous_price = $line[7];
                    $stock = $line[8];
                    $size = $line[9];
                    $size_quantity = $line[10];
                    $size_extra_price = $line[11];
                    $colors = $line[12];
                    $tags = $line[13];
                    $youtube = $line[14];
                    $policy = $line[15];
                    $meta_tag = $line[16];
                    $meta_description = $line[17];
                    $product_type = $line[18];
                    $affiliate_link = $line[19];
                    $collection = $line[20];
                    $model = $line[21];
                    $upc = $line[22];
                    $part_number = $line[23];
                    $legacy_number = $line[24];
                    $brand = $line[25];
                    $type = $line[26];
                    $use = $line[27];
                    $power = $line[28];
                    $shape = $line[29];
                    $style = $line[30];
                    $diameter = $line[31];
                    $package = $line[32];
                    $screw_diamter = $line[33];
                    $screw_headtype = $line[34];
                    $head_diamter = $line[35];
                    $mateiral = $line[36];






                    if (!Product::where('sku',$sku)->exists()){

                        //--- Validation Section Ends

                        //--- Logic Section
                        $data = new Product;
                        $sign = Currency::where('is_default','=',1)->first();

                        $input['type'] = 'Physical';
                        $input['sku'] = $sku;

                        $input['category_id'] = null;
                        $input['subcategory_id'] = null;
                        $input['childcategory_id'] = null;

                        $mcat = Category::where(DB::raw('lower(name)'), strtolower($main_category));
                        //$mcat = Category::where("name", $main_category);
                        if(!$mcat->exists())
                        {
                            $slug = \Str::slug($main_category);
                            $cat = new Category;
                            $cat->name = $main_category;
                            $cat->slug = $slug;
                            $cat->status = 1;
                            $cat->is_featured = 0;
                            $cat->save();
                            $mcat = Category::where(DB::raw('lower(name)'), strtolower($main_category));
                        }


                        if($mcat->exists()){

                            $input['category_id'] = $mcat->first()->id;

                            $input['photo'] = $product_feature_image;
                            $input['name'] = $product_name;
                            $input['price'] = $current_price;
                            $input['details'] = $product_description;
                            $input['stock'] = $stock != "" ? $stock : 0;
                            $input['slug'] = Str::slug($input['name'],'-').'-'.strtolower($input['sku']);
//                            $input['product_type'] = 'normal';
                            $input['tags'] = $tags;

                            $input['previous_price'] = $previous_price;
                            $input['size'] = $size;
                            $input['size_quantity'] = $size_quantity;
                            $input['size_extra_price'] = $size_extra_price;
                            $input['colors'] = $colors;
                            $input['tags'] = $tags;
                            $input['youtube'] = $youtube;
                            $input['policy'] = $policy;
                            $input['meta_tag'] = $meta_tag;
                            $input['meta_description'] = $meta_description;
                            $input['product_type'] = $product_type;
                            $input['affiliate_link'] = $affiliate_link;
                            $input['collection'] = $collection;
                            $input['model'] = $model;
                            $input['upc'] = $upc;
                            $input['part_number'] = $part_number;
                            $input['legacy_number'] = $legacy_number;
                            $input['brand'] = $brand;
                            $input['type'] = $type;
                            $input['use'] = $use;
                            $input['power'] = $power;
                            $input['shape'] = $shape;
                            $input['style'] = $style;
                            $input['diameter'] = $diameter;
                            $input['package'] = $package;
                            $input['screw_diamter'] = $screw_diamter;
                            $input['screw_headtype'] = $screw_headtype;
                            $input['head_diamter'] = $head_diamter;
                            $input['mateiral'] = $mateiral;

                            $image_url = $product_feature_image;

                            $imagesss = explode(',',$image_url);
                            // echo "---";

                            if(isset($imagesss[0]))
                            {
                                foreach($imagesss as $img_k => $img_v)
                                {
                                    if($img_k == 0)
                                    {
                                        $ch = curl_init();
                                        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
                                        curl_setopt ($ch, CURLOPT_URL, $img_v);
                                        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 20);
                                        curl_setopt ($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                                        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, true);
                                        curl_setopt($ch, CURLOPT_HEADER, true);
                                        curl_setopt($ch, CURLOPT_NOBODY, true);

                                        $content = curl_exec ($ch);

                                        $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

                                        $thumb_url = '';
                                        $img_v = str_replace(' ', '%20', $img_v);


                                        if(strpos($img_v,'png') || strpos($img_v,'jpg') || strpos($img_v,'jpeg'))
                                        {
                                            try {
                                                if (!preg_match("~^(?:f|ht)tps?://~i", $img_v)) {
                                                    $img_v = "https:" . $img_v;
                                                }

                                                $fimg = Image::make($img_v)->resize(800, 800);

                                                $fphoto = Str::random(12).'.jpg';
                                                $fimg->save(public_path().'/assets/images/products/'.$fphoto);
                                                $input['photo']  = $fphoto;
                                                $thumb_url = $img_v;

                                            } catch (\Exception $e) {

                                                $fimg = Image::make(public_path().'/assets/images/noimage.png')->resize(800, 800);

                                                $fphoto = Str::random(12).'.jpg';
                                                $fimg->save(public_path().'/assets/images/products/'.$fphoto);
                                                $input['photo']  = $fphoto;
                                                $thumb_url = public_path().'/assets/images/noimage.png';
                                            }

                                            $timg = Image::make($thumb_url)->resize(285, 285);
                                            $thumbnail = Str::random(12).'.jpg';
                                            $timg->save(public_path().'/assets/images/thumbnails/'.$thumbnail);
                                            $input['thumbnail']  = $thumbnail;
                                        }else{

                                            $input['thumbnail']  = $img_v;
                                        }

                                    }

                                }
                            }


                            $input['price'] = ((float)$input['price'] / (float)$sign->value);


                            $input['previous_price'] = ((int)$input['previous_price'] / $sign->value);
                            $input['user_id'] = $user->id;
                            // Save Data

                            $data->fill($input)->save();

                            $lastid = $data->id;



                            if(isset($imagesss[1]))
                            {

                                foreach($imagesss as $img_kk => $img_vv)
                                {

                                    if($img_k!=0)
                                    {
                                        $img_vv = str_replace(' ', '%20', $img_vv);

                                        $gallery = new Gallery;
                                        $name = Str::random(12).'.jpg';
                                        if (!preg_match("~^(?:f|ht)tps?://~i", $img_vv)) {
                                            $img_vv = "https:" . $img_vv;
                                        }
                                        try {
                                            $img = Image::make($img_vv);

                                            $thumbnail = Str::random(12).'.jpg';
                                            $img->save(public_path().'/assets/images/galleries/'.$name);
                                            $gallery['photo'] = $name;
                                            $gallery['product_id'] = $lastid;
                                            $gallery->save();
                                        } catch (\Exception $e) {
                                        }
                                    }
                                }
                            }



                        }else{
                            $log .= "<br>Row No: ".$i." - No Category Found!<br>";
                        }

                    }
                    else{
                        $log .= "<br>Row No: ".$i." - Duplicate Product Code!<br>";
                    }

                }

                $i++;

            }

            fclose($file);

        }

        else if(Auth::user()->email == "dynamiclabs@gmail.com")

        {
            $prods = $user->products()->orderBy('id','desc')->get()->count();

//            echo "<PRE>";print_r($request->all());exit;

//            echo "prods ". $prods;
//            exit;

//            $log = "";
//
            $rules = array(
                'csvfile'      => 'required|mimes:csv,txt',
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }



            $filename = '';
            if ($file = $request->file('csvfile'))
            {
                $extensions = ['csv'];
                if(!in_array($file->getClientOriginalExtension(),$extensions)){
                    return response()->json(array('errors' => ['Image format not supported']));
                }
                $filename = time().'-'.$file->getClientOriginalName();
                $file->move('assets/temp_files',$filename);
            }

            //$filename = $request->file('csvfile')->getClientOriginalName();
            //return response()->json($filename);
            $datas = "";


            $file = fopen(public_path('assets/temp_files/'.$filename),"r");
            $i = 1;
            while (($line = fgetcsv($file)) !== FALSE) {

//                echo "<PRE>";
//                print_r($line);
//                exit;

                if($i != 1)
                {

                    $sku = $line[0];
                    $main_category = $line[1];
                    $product_name = $line[2];
                    $product_images = $line[3];
                    $product_feature_image = $line[4];
                    $product_description = $line[5];
                    $current_price = $line[6];
                    $stock = $line[7];
                    $product_type = $line[8];
                    $variation_type = $line[9];
                    $variation1 = $line[10];
                    $variation2 = $line[11];
                    $variation3 = $line[12];
                    $tags = $line[13];
                    $product_url = $line[14];


                    if (!Product::where('sku',$sku)->exists()){

                        //--- Validation Section Ends

                        //--- Logic Section
                        $data = new Product;
                        $sign = Currency::where('is_default','=',1)->first();

                        $input['type'] = 'Physical';
                        $input['sku'] = $sku;

                        $input['category_id'] = null;
                        $input['subcategory_id'] = null;
                        $input['childcategory_id'] = null;

                        $mcat = Category::where(DB::raw('lower(name)'), strtolower($main_category));
                        //$mcat = Category::where("name", $main_category);
                        if(!$mcat->exists())
                        {
                            $slug = \Str::slug($main_category);
                            $cat = new Category;
                            $cat->name = $main_category;
                            $cat->slug = $slug;
                            $cat->status = 1;
                            $cat->is_featured = 0;
                            $cat->save();
                            $mcat = Category::where(DB::raw('lower(name)'), strtolower($main_category));
                        }


                        if($mcat->exists()){

                            $input['category_id'] = $mcat->first()->id;

                            $input['photo'] = $product_images;
                            $input['name'] = $product_name;
                            $input['price'] = $current_price;
                            $input['details'] = $product_description;
                            $input['stock'] = $stock != "" ? $stock : 0;
                            $input['slug'] = Str::slug($input['name'],'-').'-'.strtolower($input['sku']);
                            $input['product_type'] = 'normal';
                            $input['tags'] = $tags;
                            $input['tags'] = $product_url;

                            $image_url = $product_images;

                            $imagesss = explode(',',$image_url);
                            // echo "---";

                            if(isset($imagesss[0]))
                            {
                                foreach($imagesss as $img_k => $img_v)
                                {
                                    if($img_k == 0)
                                    {
                                        $ch = curl_init();
                                        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
                                        curl_setopt ($ch, CURLOPT_URL, $img_v);
                                        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 20);
                                        curl_setopt ($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                                        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, true);
                                        curl_setopt($ch, CURLOPT_HEADER, true);
                                        curl_setopt($ch, CURLOPT_NOBODY, true);

                                        $content = curl_exec ($ch);

                                        $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

                                        $thumb_url = '';
                                        $img_v = str_replace(' ', '%20', $img_v);


                                        if(strpos($img_v,'png') || strpos($img_v,'jpg') || strpos($img_v,'jpeg'))
                                        {
                                            try {
                                                if (!preg_match("~^(?:f|ht)tps?://~i", $img_v)) {
                                                    $img_v = "https:" . $img_v;
                                                }

                                                $fimg = Image::make($img_v)->resize(800, 800);

                                                $fphoto = Str::random(12).'.jpg';
                                                $fimg->save(public_path().'/assets/images/products/'.$fphoto);
                                                $input['photo']  = $fphoto;
                                                $thumb_url = $img_v;

                                            } catch (\Exception $e) {

                                                $fimg = Image::make(public_path().'/assets/images/noimage.png')->resize(800, 800);

                                                $fphoto = Str::random(12).'.jpg';
                                                $fimg->save(public_path().'/assets/images/products/'.$fphoto);
                                                $input['photo']  = $fphoto;
                                                $thumb_url = public_path().'/assets/images/noimage.png';
                                            }

                                            $timg = Image::make($thumb_url)->resize(285, 285);
                                            $thumbnail = Str::random(12).'.jpg';
                                            $timg->save(public_path().'/assets/images/thumbnails/'.$thumbnail);
                                            $input['thumbnail']  = $thumbnail;
                                        }else{

                                            $input['thumbnail']  = $img_v;
                                        }

                                    }

                                }
                            }


                            $input['price'] = ((float)$input['price'] / (float)$sign->value);


                            $input['previous_price'] = ((int)$input['previous_price'] / $sign->value);
                            $input['user_id'] = $user->id;
                            // Save Data

                            $data->fill($input)->save();

                            $lastid = $data->id;



                            if(isset($imagesss[1]))
                            {

                                foreach($imagesss as $img_kk => $img_vv)
                                {

                                    if($img_k!=0)
                                    {
                                        $img_vv = str_replace(' ', '%20', $img_vv);

                                        $gallery = new Gallery;
                                        $name = Str::random(12).'.jpg';
                                        if (!preg_match("~^(?:f|ht)tps?://~i", $img_vv)) {
                                            $img_vv = "https:" . $img_vv;
                                        }
                                        try {
                                            $img = Image::make($img_vv);

                                            $thumbnail = Str::random(12).'.jpg';
                                            $img->save(public_path().'/assets/images/galleries/'.$name);
                                            $gallery['photo'] = $name;
                                            $gallery['product_id'] = $lastid;
                                            $gallery->save();
                                        } catch (\Exception $e) {
                                        }
                                    }
                                }
                            }



                        }else{
                            $log .= "<br>Row No: ".$i." - No Category Found!<br>";
                        }

                    }
                    else{
                        $log .= "<br>Row No: ".$i." - Duplicate Product Code!<br>";
                    }

                }

                $i++;

            }

            fclose($file);

        }
        else
        {


            // $package = $user->subscribes()->orderBy('id','desc')->first();
            $prods = $user->products()->orderBy('id','desc')->get()->count();

            // if(!$package){
            //     return response()->json(array('errors' => [ 0 => 'You don\'t have any subscription plan.']));
            // }

            // if($prods < $package->allowed_products || $package->allowed_products == 0) {
            $log = "";
            //--- Validation Section
            $rules = array(
                'csvfile'      => 'required|mimes:csv,txt',
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }

            $filename = '';
            if ($file = $request->file('csvfile'))
            {
                $extensions = ['csv'];
                if(!in_array($file->getClientOriginalExtension(),$extensions)){
                    return response()->json(array('errors' => ['Image format not supported']));
                }
                $filename = time().'-'.$file->getClientOriginalName();
                $file->move('assets/temp_files',$filename);
            }

            //$filename = $request->file('csvfile')->getClientOriginalName();
            //return response()->json($filename);
            $datas = "";

            $file = fopen(public_path('assets/temp_files/'.$filename),"r");
            $i = 1;
            while (($line = fgetcsv($file)) !== FALSE) {

                if($i != 1)
                {

                    if (!Product::where('sku',$line[0])->exists()){

                        //--- Validation Section Ends

                        //--- Logic Section
                        $data = new Product;
                        $sign = Currency::where('is_default','=',1)->first();

                        $input['type'] = 'Physical';
                        $input['sku'] = $line[0];

                        $input['category_id'] = null;
                        $input['subcategory_id'] = null;
                        $input['childcategory_id'] = null;

                        $mcat = Category::where(DB::raw('lower(name)'), strtolower($line[1]));
                        //$mcat = Category::where("name", $line[1]);
                        if(!$mcat->exists())
                        {
                            $slug = \Str::slug($line[1]);
                            $cat = new Category;
                            $cat->name = $line[1];
                            $cat->slug = $slug;
                            $cat->status = 1;
                            $cat->is_featured = 0;
                            $cat->save();
                            $mcat = Category::where(DB::raw('lower(name)'), strtolower($line[1]));
                            // array_splice( $line, 1, 0, $inserted );
                        }



                        if($mcat->exists()){
                            $input['category_id'] = $mcat->first()->id;

                            if($line[2] != ""){
                                $scat = Subcategory::where(DB::raw('lower(name)'), strtolower($line[2]));

                                if($scat->exists()) {
                                    $input['subcategory_id'] = $scat->first()->id;
                                }
                            }

                            $inserted = array( 'xa' );
                            array_splice( $line, 3, 0, $inserted );
                            if($line[3] != ""){
                                $chcat = Childcategory::where(DB::raw('lower(name)'), strtolower($line[3]));

                                if($chcat->exists()) {
                                    $input['childcategory_id'] = $chcat->first()->id;
                                }
                            }

                            $input['photo'] = $line[5];
                            $input['name'] = $line[4];
                            $input['details'] = $line[6];
//                $input['category_id'] = $request->category_id;
//                $input['subcategory_id'] = $request->subcategory_id;
//                $input['childcategory_id'] = $request->childcategory_id;
                            $input['color'] = $line[13];
                            $input['price'] = $line[7];

                            $input['previous_price'] = $line[8] != "" ? $line[8] : null;
                            $input['stock'] =$line[9] != "" ? $line[9] : 0;
                            $input['size'] = $line[10];

                            $input['size_qty'] = $line[11];
                            $input['size_price'] = $line[12];
                            $input['youtube'] = $line[15];
                            $input['policy'] = $line[16];
                            $input['meta_tag'] = $line[17];
                            $input['meta_description'] = $line[18];
                            $input['tags'] = $line[14];
                            $input['product_type'] = 'normal';
                            $input['collection'] = $line[21];

                            if(Auth::user()->email == "dynamiclabs@gmail.com")
                            {
                                if(isset($line[22]))
                                {
                                    $input['quantity'] = $line[22];
                                    $input['fastener_type'] = $line[23];
                                    $input['tip'] = $line[24];
                                    $input['blade'] = $line[25];
                                    $input['sku_diameter_length'] = $line[26];
                                    $input['cleaner_colour'] = $line[27];
                                    $input['cloth_colour'] = $line[28];
                                    $input['pouch_colour'] = $line[29];
                                }



                            }elseif(Auth::user()->email == "ozronsoptical@gmail.com"){

                                $input['strength'] = $line[22];
                                $input['lens'] = $line[23];


                            }else{
                                if(isset($line[22]))
                                {
                                    $input['model'] = $line[22];
                                    $input['upc'] = $line[23];
                                    $input['part_number'] = $line[24];
                                    $input['legacy_number'] = $line[25];
                                    $input['brand'] = $line[26];
                                    $input['typee'] = $line[27];
                                    $input['usee'] = $line[28];
                                    $input['power'] = $line[29];
                                    $input['shape'] = $line[30];
                                    $input['style'] = $line[31];
                                    $input['diameter'] = $line[32];
                                    $input['package'] = $line[33];
                                    $input['screw_diamter'] = $line[34];
                                    $input['screw_length'] = $line[35];
                                    $input['screw_headtype'] = $line[36];
                                    $input['head_diamter'] = $line[37];
                                    $input['mateiral'] = $line[38];
                                }
                            }





                            $input['slug'] = Str::slug($input['name'],'-').'-'.strtolower($input['sku']);

                            $image_url = $line[5];

                            $imagesss = explode(',',$image_url);
                            // echo "---";

                            if(isset($imagesss[0]))
                            {
                                foreach($imagesss as $img_k => $img_v)
                                {
                                    if($img_k == 0)
                                    {
                                        $ch = curl_init();
                                        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
                                        curl_setopt ($ch, CURLOPT_URL, $img_v);
                                        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 20);
                                        curl_setopt ($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                                        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, true);
                                        curl_setopt($ch, CURLOPT_HEADER, true);
                                        curl_setopt($ch, CURLOPT_NOBODY, true);

                                        $content = curl_exec ($ch);

                                        $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

                                        $thumb_url = '';
                                        $img_v = str_replace(' ', '%20', $img_v);


                                        if(strpos($img_v,'png') || strpos($img_v,'jpg') || strpos($img_v,'jpeg'))
                                        {
                                            try {
                                                if (!preg_match("~^(?:f|ht)tps?://~i", $img_v)) {
                                                    $img_v = "https:" . $img_v;
                                                }

                                                $fimg = Image::make($img_v)->resize(800, 800);

                                                $fphoto = Str::random(12).'.jpg';
                                                $fimg->save(public_path().'/assets/images/products/'.$fphoto);
                                                $input['photo']  = $fphoto;
                                                $thumb_url = $img_v;

                                            } catch (\Exception $e) {

                                                $fimg = Image::make(public_path().'/assets/images/noimage.png')->resize(800, 800);

                                                $fphoto = Str::random(12).'.jpg';
                                                $fimg->save(public_path().'/assets/images/products/'.$fphoto);
                                                $input['photo']  = $fphoto;
                                                $thumb_url = public_path().'/assets/images/noimage.png';
                                            }

                                            $timg = Image::make($thumb_url)->resize(285, 285);
                                            $thumbnail = Str::random(12).'.jpg';
                                            $timg->save(public_path().'/assets/images/thumbnails/'.$thumbnail);
                                            $input['thumbnail']  = $thumbnail;
                                        }else{

                                            $input['thumbnail']  = $img_v;
                                        }

                                    }

                                }
                            }



                            // Conert Price According to Currency
                            // if(!empty($input['price']) && !empty($sign->value))
                            // {
                            //   $input['price'] =  (int)$input['price'];
                            //   $sign->value =  (int)$sign->value;
                            // }

                            // if(is_int($input['price']) && is_int($sign->value))
                            // {

                            $input['price'] = ((float)$input['price'] / (float)$sign->value);

                            // }else{
                            //     $input['price'] = 0;
                            // }
                            $input['previous_price'] = ((int)$input['previous_price'] / $sign->value);
                            $input['user_id'] = $user->id;
                            // Save Data

                            $data->fill($input)->save();

                            $lastid = $data->id;



                            if(isset($imagesss[1]))
                            {

                                foreach($imagesss as $img_kk => $img_vv)
                                {

                                    if($img_k!=0)
                                    {
                                        $img_vv = str_replace(' ', '%20', $img_vv);

                                        $gallery = new Gallery;
                                        $name = Str::random(12).'.jpg';
                                        if (!preg_match("~^(?:f|ht)tps?://~i", $img_vv)) {
                                            $img_vv = "https:" . $img_vv;
                                        }
                                        try {
                                            $img = Image::make($img_vv);

                                            $thumbnail = Str::random(12).'.jpg';
                                            $img->save(public_path().'/assets/images/galleries/'.$name);
                                            $gallery['photo'] = $name;
                                            $gallery['product_id'] = $lastid;
                                            $gallery->save();
                                        } catch (\Exception $e) {
                                        }
                                    }
                                }
                            }











                        }else{
                            $log .= "<br>Row No: ".$i." - No Category Found!<br>";
                        }

                    }else{
                        $log .= "<br>Row No: ".$i." - Duplicate Product Code!<br>";
                    }

                }

                $i++;

            }

            fclose($file);

        }

        //--- Redirect Section
        $msg = 'Bulk Product File Imported Successfully.<a href="'.route('admin-prod-index').'">View Product Lists.</a>'.$log;
        return response()->json($msg);

        // }
        // else
        // {
        //     //--- Redirect Section
        //     return response()->json(array('errors' => [ 0 => 'You Can\'t Add More Products.']));

        //     //--- Redirect Section Ends
        // }
    }


    //*** POST Request
    public function store(Request $request)
    {

        $user = Auth::user();
        // $package = $user->subscribes()->orderBy('id','desc')->first();
        $prods = $user->products()->orderBy('id','desc')->get()->count();

        // if(!$package){
        //     return response()->json(array('errors' => [ 0 => 'You don\'t have any subscription plan.']));
        // }

        // if($prods < $package->allowed_products || $package->allowed_products == 0)
        // {

        //--- Validation Section
        $rules = [
            'photo'      => 'required|mimes:jpeg,jpg,png,svg',
            'file'       => 'mimes:zip'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Product;
        $sign = Currency::where('is_default','=',1)->first();
        $input = $request->all();
        // Check File
        if ($file = $request->file('file'))
        {
            $extensions = ['zip'];
            if(!in_array($file->getClientOriginalExtension(),$extensions)){
                return response()->json(array('errors' => ['Image format not supported']));
            }
            $name = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/files',$name);
            $input['file'] = $name;
        }

        if ($file = $request->file('photo'))
        {
            $extensions = ['jpeg','jpg','png','svg'];
            if(!in_array($file->getClientOriginalExtension(),$extensions)){
                return response()->json(array('errors' => ['Image format not supported']));
            }
            $name = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/images/products',$name);
            $input['photo'] = $name;
        }

        // Check Physical
        if($request->type == "Physical")
        {
            //--- Validation Section
            $rules = ['sku'      => 'min:8|unique:products'];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }
            //--- Validation Section Ends

            // Check Condition
            if ($request->product_condition_check == ""){
                $input['product_condition'] = 0;
            }

            // Check Shipping Time
            if ($request->shipping_time_check == ""){
                $input['ship'] = null;
            }

            // Check Size
            if(empty($request->size_check ))
            {
                $input['size'] = null;
                $input['size_qty'] = null;
                $input['size_price'] = null;
            }
            else{
                if(in_array(null, $request->size) || in_array(null, $request->size_qty))
                {
                    $input['size'] = null;
                    $input['size_qty'] = null;
                    $input['size_price'] = null;
                }
                else
                {

                    if(in_array(0,$input['size_qty'])){
                        return response()->json(array('errors' => [0 => 'Size Qty can not be 0.']));
                    }

                    $input['size'] = implode(',', $request->size);
                    $input['size_qty'] = implode(',', $request->size_qty);
                    $size_prices = $request->size_price;
                    $s_price = array();
                    foreach($size_prices as $key => $sPrice){
                        $s_price[$key] = $sPrice / $sign->value;
                    }

                    $input['size_price'] = implode(',', $s_price);
                }
            }

            // Check Whole Sale
            if(empty($request->whole_check ))
            {
                $input['whole_sell_qty'] = null;
                $input['whole_sell_discount'] = null;
            }
            else{
                if(in_array(null, $request->whole_sell_qty) || in_array(null, $request->whole_sell_discount))
                {
                    $input['whole_sell_qty'] = null;
                    $input['whole_sell_discount'] = null;
                }
                else
                {
                    $input['whole_sell_qty'] = implode(',', $request->whole_sell_qty);
                    $input['whole_sell_discount'] = implode(',', $request->whole_sell_discount);
                }
            }


            // Check Color
            if(empty($request->color_check))
            {
                $input['color'] = null;
            }
            else{
                $input['color'] = implode(',', $request->color);
            }

            // Check Measurement
            if ($request->mesasure_check == "")
            {
                $input['measure'] = null;
            }

        }

        // Check Seo
        if (empty($request->seo_check))
        {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;
        }
        else {
            if (!empty($request->meta_tag))
            {
                $input['meta_tag'] = implode(',', $request->meta_tag);
            }
        }

        // Check License

        if($request->type == "License")
        {

            if(in_array(null, $request->license) || in_array(null, $request->license_qty))
            {
                $input['license'] = null;
                $input['license_qty'] = null;
            }
            else
            {
                $input['license'] = implode(',,', $request->license);
                $input['license_qty'] = implode(',', $request->license_qty);
            }

        }

        // Check Features
        if(in_array(null, $request->features) || in_array(null, $request->colors))
        {
            $input['features'] = null;
            $input['colors'] = null;
        }
        else
        {
            $input['features'] = implode(',', str_replace(',',' ',$request->features));
            $input['colors'] = implode(',', str_replace(',',' ',$request->colors));
        }

        //tags
        if (!empty($request->tags))
        {
            $input['tags'] = implode(',', $request->tags);
        }

        // Conert Price According to Currency
        $input['price'] = ($input['price'] / $sign->value);
        $input['previous_price'] = ($input['previous_price'] / $sign->value);
        $input['user_id'] = Auth::user()->id;



        // store filtering attributes for physical product
        $attrArr = [];
        if (!empty($request->category_id)) {
            $catAttrs = Attribute::where('attributable_id', $request->category_id)->where('attributable_type', 'App\Models\Category')->get();
            if (!empty($catAttrs)) {
                foreach ($catAttrs as $key => $catAttr) {
                    $in_name = $catAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArrCategoryPrices = $request["$in_name"."_price"];
                        if(count($attrArrCategoryPrices)>0){
                            foreach($attrArrCategoryPrices as $attrArrCategoryPrice){
                                $attrArr["$in_name"]["prices"][] = ($attrArrCategoryPrice/$sign->value);
                            }
                        }
                        if ($catAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }

        if (!empty($request->subcategory_id)) {
            $subAttrs = Attribute::where('attributable_id', $request->subcategory_id)->where('attributable_type', 'App\Models\Subcategory')->get();
            if (!empty($subAttrs)) {
                foreach ($subAttrs as $key => $subAttr) {
                    $in_name = $subAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArrSubCategoryPrices = $request["$in_name"."_price"];
                        if(count($attrArrSubCategoryPrices)>0){
                            foreach($attrArrSubCategoryPrices as $attrArrSubCategoryPrice){
                                $attrArr["$in_name"]["prices"][] = ($attrArrSubCategoryPrice/$sign->value);
                            }
                        }
                        if ($subAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }
        if (!empty($request->childcategory_id)) {
            $childAttrs = Attribute::where('attributable_id', $request->childcategory_id)->where('attributable_type', 'App\Models\Childcategory')->get();
            if (!empty($childAttrs)) {
                foreach ($childAttrs as $key => $childAttr) {
                    $in_name = $childAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArrChildCategoryPrices = $request["$in_name"."_price"];
                        if(count($attrArrChildCategoryPrices)>0){
                            foreach($attrArrChildCategoryPrices as $attrArrChildCategoryPrice){
                                $attrArr["$in_name"]["prices"][] = ($attrArrChildCategoryPrice/$sign->value);
                            }
                        }
                        if ($childAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }



        if (empty($attrArr)) {
            $input['attributes'] = NULL;
        } else {
            $jsonAttr = json_encode($attrArr);
            $input['attributes'] = $jsonAttr;
        }

        // Save Data
        $data->fill($input)->save();

        // Set SLug

        $prod = Product::find($data->id);
        if($prod->type != 'Physical'){
            $prod->slug = Str::slug($data->name,'-').'-'.strtolower(Str::random(3).$data->id.Str::random(3));
        }
        else {
            $prod->slug = Str::slug($data->name,'-').'-'.strtolower($data->sku);
        }
        // Set Photo
        $resizedImage = Image::make(public_path().'/assets/images/products/'.$prod->photo)->resize(800, null, function ($c) {
            $c->aspectRatio();
        });
        $photo = Str::random(12).'.jpg';
        $resizedImage->save(public_path().'/assets/images/products/'.$photo);


        // Set Thumbnail
        $background = Image::canvas(300, 300);
        $resizedImage = Image::make(public_path().'/assets/images/products/'.$prod->photo)->resize(300, 300, function ($c) {
            $c->aspectRatio();
            $c->upsize();
        });
        // insert resized image centered into background
        $background->insert($resizedImage, 'center');
        // save or do whatever you like
        $thumbnail = Str::random(12).'.jpg';
        $background->save(public_path().'/assets/images/thumbnails/'.$thumbnail);


        $prod->thumbnail  = $thumbnail;
        $prod->photo  = $photo;
        $prod->update();

        // Add To Gallery If any
        $lastid = $data->id;
        if ($files = $request->file('gallery')){
            foreach ($files as  $key => $file){
                $extensions = ['jpeg','jpg','png','svg'];
                if(!in_array($file->getClientOriginalExtension(),$extensions)){
                    return response()->json(array('errors' => ['Image format not supported']));
                }
                if(in_array($key, $request->galval))
                {
                    $gallery = new Gallery;
                    $name = time().str_replace(' ', '', $file->getClientOriginalName());
                    $img = Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $thumbnail = Str::random(12).'.jpg';
                    $img->save(public_path().'/assets/images/galleries/'.$name);
                    $gallery['photo'] = $name;
                    $gallery['product_id'] = $lastid;
                    $gallery->save();
                }
            }
        }
        //logic Section Ends

        //--- Redirect Section
        $msg = 'New Product Added Successfully.<a href="'.route('vendor-prod-index').'">View Product Lists.</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
        // }
        // else
        // {
        // //--- Redirect Section
        // return response()->json(array('errors' => [ 0 => 'You Can\'t Add More Product.']));

        // //--- Redirect Section Ends
        // }

    }

    //*** GET Request
    public function edit($id)
    {
        $cats = Category::all();
        $data = Product::findOrFail($id);
        $sign = Currency::where('is_default','=',1)->first();


        if($data->type == 'Digital')
            return view('vendor.product.edit.digital',compact('cats','data','sign'));
        elseif($data->type == 'License')
            return view('vendor.product.edit.license',compact('cats','data','sign'));
        else
            return view('vendor.product.edit.physical',compact('cats','data','sign'));
    }


    //*** GET Request CATALOG
    public function catalogedit($id)
    {
        $cats = Category::all();
        $data = Product::findOrFail($id);
        $data->slug = Str::random(8);

        $sign = Currency::where('is_default','=',1)->first();


        if($data->type == 'Digital')
            return view('vendor.product.edit.catalog.digital',compact('cats','data','sign'));
        elseif($data->type == 'License')
            return view('vendor.product.edit.catalog.license',compact('cats','data','sign'));
        else
            return view('vendor.product.edit.catalog.physical',compact('cats','data','sign'));
    }

    //*** POST Request
    public function update(Request $request, $id)
    {

        //--- Validation Section
        $rules = [
            'photo'      => 'mimes:jpeg,jpg,png,svg',
            'file'       => 'mimes:zip'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //-- Logic Section
        $data = Product::findOrFail($id);
        $sign = Currency::where('is_default','=',1)->first();
        $input = $request->all();
        if ($file = $request->file('photo'))
        {
            $name = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/images/products',$name);
            if($data->photo != null)
            {
                if (file_exists(public_path().'/assets/images/products/'.$data->photo)) {
                    unlink(public_path().'/assets/images/products/'.$data->photo);
                }
            }
            $input['photo'] = $name;
        }
        //Check Types
        if($request->type_check == 1)
        {
            $input['link'] = null;
        }
        else
        {
            if($data->file!=null){
                if (file_exists(public_path().'/assets/files/'.$data->file)) {
                    unlink(public_path().'/assets/files/'.$data->file);
                }
            }
            $input['file'] = null;
        }


        // Check Physical
        if($data->type == "Physical")
        {

            //--- Validation Section
            $rules = ['sku' => 'min:8|unique:products,sku,'.$id];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }
            //--- Validation Section Ends

            // Check Condition
            if ($request->product_condition_check == ""){
                $input['product_condition'] = 0;
            }

            // Check Shipping Time
            if ($request->shipping_time_check == ""){
                $input['ship'] = null;
            }

            // Check Size

            if(empty($request->size_check ))
            {
                $input['size'] = null;
                $input['size_qty'] = null;
                $input['size_price'] = null;
            }
            else{
                if(in_array(null, $request->size) || in_array(null, $request->size_qty) || in_array(null, $request->size_price))
                {
                    $input['size'] = null;
                    $input['size_qty'] = null;
                    $input['size_price'] = null;
                }
                else
                {

                    if(in_array(0,$input['size_qty'])){
                        return response()->json(array('errors' => [0 => 'Size Qty can not be 0.']));
                    }


                    $input['size'] = implode(',', $request->size);
                    $input['size_qty'] = implode(',', $request->size_qty);
                    $size_prices = $request->size_price;
                    $s_price = array();
                    foreach($size_prices as $key => $sPrice){
                        $s_price[$key] = $sPrice / $sign->value;
                    }

                    $input['size_price'] = implode(',', $s_price);
                }
            }

            // Check Whole Sale
            if(empty($request->whole_check ))
            {
                $input['whole_sell_qty'] = null;
                $input['whole_sell_discount'] = null;
            }
            else{
                if(in_array(null, $request->whole_sell_qty) || in_array(null, $request->whole_sell_discount))
                {
                    $input['whole_sell_qty'] = null;
                    $input['whole_sell_discount'] = null;
                }
                else
                {
                    $input['whole_sell_qty'] = implode(',', $request->whole_sell_qty);
                    $input['whole_sell_discount'] = implode(',', $request->whole_sell_discount);
                }
            }

            // Check Color
            if(empty($request->color_check ))
            {
                $input['color'] = null;
            }
            else{
                if (!empty($request->color))
                {
                    $input['color'] = implode(',', $request->color);
                }
                if (empty($request->color))
                {
                    $input['color'] = null;
                }
            }

            // Check Measure
            if ($request->measure_check == "")
            {
                $input['measure'] = null;
            }
        }


        // Check Seo
        if (empty($request->seo_check))
        {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;
        }
        else {
            if (!empty($request->meta_tag))
            {
                $input['meta_tag'] = implode(',', $request->meta_tag);
            }
        }

        // Check License
        if($data->type == "License")
        {

            if(!in_array(null, $request->license) && !in_array(null, $request->license_qty))
            {
                $input['license'] = implode(',,', $request->license);
                $input['license_qty'] = implode(',', $request->license_qty);
            }
            else
            {
                if(in_array(null, $request->license) || in_array(null, $request->license_qty))
                {
                    $input['license'] = null;
                    $input['license_qty'] = null;
                }
                else
                {
                    $license = explode(',,', $prod->license);
                    $license_qty = explode(',', $prod->license_qty);
                    $input['license'] = implode(',,', $license);
                    $input['license_qty'] = implode(',', $license_qty);
                }
            }

        }
        // Check Features
        if(!in_array(null, $request->features) && !in_array(null, $request->colors))
        {
            $input['features'] = implode(',', str_replace(',',' ',$request->features));
            $input['colors'] = implode(',', str_replace(',',' ',$request->colors));
        }
        else
        {
            if(in_array(null, $request->features) || in_array(null, $request->colors))
            {
                $input['features'] = null;
                $input['colors'] = null;
            }
            else
            {
                $features = explode(',', $data->features);
                $colors = explode(',', $data->colors);
                $input['features'] = implode(',', $features);
                $input['colors'] = implode(',', $colors);
            }
        }

        //Product Tags
        if (!empty($request->tags))
        {
            $input['tags'] = implode(',', $request->tags);
        }
        if (empty($request->tags))
        {
            $input['tags'] = null;
        }

        $input['price'] = $input['price'] / $sign->value;
        $input['previous_price'] = $input['previous_price'] / $sign->value;



        // store filtering attributes for physical product
        $attrArr = [];
        if (!empty($request->category_id)) {
            $catAttrs = Attribute::where('attributable_id', $request->category_id)->where('attributable_type', 'App\Models\Category')->get();
            if (!empty($catAttrs)) {
                foreach ($catAttrs as $key => $catAttr) {
                    $in_name = $catAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArrCategoryPrices = $request["$in_name"."_price"];
                        if(count($attrArrCategoryPrices)>0){
                            foreach($attrArrCategoryPrices as $attrArrCategoryPrice){
                                $attrArr["$in_name"]["prices"][] = ($attrArrCategoryPrice/$sign->value);
                            }
                        }
                        if ($catAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }

        if (!empty($request->subcategory_id)) {
            $subAttrs = Attribute::where('attributable_id', $request->subcategory_id)->where('attributable_type', 'App\Models\Subcategory')->get();
            if (!empty($subAttrs)) {
                foreach ($subAttrs as $key => $subAttr) {
                    $in_name = $subAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArrSubCategoryPrices = $request["$in_name"."_price"];
                        if(count($attrArrSubCategoryPrices)>0){
                            foreach($attrArrSubCategoryPrices as $attrArrSubCategoryPrice){
                                $attrArr["$in_name"]["prices"][] = ($attrArrSubCategoryPrice/$sign->value);
                            }
                        }
                        if ($subAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }
        if (!empty($request->childcategory_id)) {
            $childAttrs = Attribute::where('attributable_id', $request->childcategory_id)->where('attributable_type', 'App\Models\Childcategory')->get();
            if (!empty($childAttrs)) {
                foreach ($childAttrs as $key => $childAttr) {
                    $in_name = $childAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArrChildCategoryPrices = $request["$in_name"."_price"];
                        if(count($attrArrChildCategoryPrices)>0){
                            foreach($attrArrChildCategoryPrices as $attrArrChildCategoryPrice){
                                $attrArr["$in_name"]["prices"][] = ($attrArrChildCategoryPrice/$sign->value);
                            }
                        }
                        if ($childAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }



        if (empty($attrArr)) {
            $input['attributes'] = NULL;
        } else {
            $jsonAttr = json_encode($attrArr);
            $input['attributes'] = $jsonAttr;
        }

        $data->update($input);
        //-- Logic Section Ends

        $prod = Product::find($data->id);

        // Set SLug
        $prod->slug = Str::slug($data->name,'-').'-'.strtolower($data->sku);

        // Set Photo
        $resizedImage = Image::make(public_path().'/assets/images/products/'.$prod->photo)->resize(800, null, function ($c) {
            $c->aspectRatio();
        });
        $photo = Str::random(12).'.jpg';
        $resizedImage->save(public_path().'/assets/images/products/'.$photo);



        // Set Thumbnail

        $background = Image::canvas(300, 300);
        $resizedImage = Image::make(public_path().'/assets/images/products/'.$prod->photo)->resize(300, 300, function ($c) {
            $c->aspectRatio();
            $c->upsize();
        });
        // insert resized image centered into background
        $background->insert($resizedImage, 'center');
        // save or do whatever you like
        $thumbnail = Str::random(12).'.jpg';
        $background->save(public_path().'/assets/images/thumbnails/'.$thumbnail);

        $prod->thumbnail  = $thumbnail;
        $prod->photo  = $photo;
        $prod->update();

        //--- Redirect Section
        $msg = 'Product Updated Successfully.<a href="'.route('vendor-prod-index').'">View Product Lists.</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    //*** POST Request CATALOG
    public function catalogupdate(Request $request, $id)
    {
        $user = Auth::user();
        $package = $user->subscribes()->orderBy('id','desc')->first();

        if(!$package){
            return response()->json(array('errors' => [ 0 => 'You don\'t have any subscription plan.']));
        }

        $prods = $user->products()->orderBy('id','desc')->get()->count();

        if($prods < $package->allowed_products || $package->allowed_products == 0)
        {

            //--- Validation Section
            $rules = [
                'photo'      => 'mimes:jpeg,jpg,png,svg',
                'file'       => 'mimes:zip'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }
            //--- Validation Section Ends


            //--- Logic Section
            $data = new Product;
            $sign = Currency::where('is_default','=',1)->first();
            $input = $request->all();
            // Check File

            if ($file = $request->file('file'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $file->move('assets/files',$name);
                $input['file'] = $name;
            }

            $image_name = '';
            if($request->is_photo == '1')
            {
                if ($file = $request->file('photo'))
                {
                    $name = time().str_replace(' ', '', $file->getClientOriginalName());
                    $file->move('assets/images/products',$name);
                    $image_name = $name;
                }

            }
            else {
                $image_name = $request->image_name;
            }

            $input['photo'] = $image_name;

            // Check Physical
            if($request->type == "Physical")
            {

                //--- Validation Section
                $rules = ['sku'      => 'min:8|unique:products'];

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
                }
                //--- Validation Section Ends


                // Check Condition
                if ($request->product_condition_check == ""){
                    $input['product_condition'] = 0;
                }

                // Check Shipping Time
                if ($request->shipping_time_check == ""){
                    $input['ship'] = null;
                }

                // Check Size
                if(empty($request->size_check ))
                {
                    $input['size'] = null;
                    $input['size_qty'] = null;
                    $input['size_price'] = null;

                }
                else{
                    if(in_array(null, $request->size) || in_array(null, $request->size_qty))
                    {
                        $input['size'] = null;
                        $input['size_qty'] = null;
                        $input['size_price'] = null;
                    }
                    else
                    {

                        if(in_array(0,$input['size_qty'])){
                            return response()->json(array('errors' => [0 => 'Size Qty can not be 0.']));
                        }

                        $input['size'] = implode(',', $request->size);
                        $input['size_qty'] = implode(',', $request->size_qty);
                        $size_prices = $request->size_price;
                        $s_price = array();
                        foreach($size_prices as $key => $sPrice){
                            $s_price[$key] = $sPrice / $sign->value;
                        }

                        $input['size_price'] = implode(',', $s_price);
                    }
                }

                // Check Whole Sale
                if(empty($request->whole_check ))
                {
                    $input['whole_sell_qty'] = null;
                    $input['whole_sell_discount'] = null;
                }
                else{
                    if(in_array(null, $request->whole_sell_qty) || in_array(null, $request->whole_sell_discount))
                    {
                        $input['whole_sell_qty'] = null;
                        $input['whole_sell_discount'] = null;
                    }
                    else
                    {
                        $input['whole_sell_qty'] = implode(',', $request->whole_sell_qty);
                        $input['whole_sell_discount'] = implode(',', $request->whole_sell_discount);
                    }
                }


                // Check Color
                if(empty($request->color_check))
                {
                    $input['color'] = null;
                }
                else{
                    $input['color'] = implode(',', $request->color);
                }

                // Check Measurement
                if ($request->mesasure_check == "")
                {
                    $input['measure'] = null;
                }

            }

            // Check Seo
            if (empty($request->seo_check))
            {
                $input['meta_tag'] = null;
                $input['meta_description'] = null;
            }
            else {
                if (!empty($request->meta_tag))
                {
                    $input['meta_tag'] = implode(',', $request->meta_tag);
                }
            }

            // Check License

            if($request->type == "License")
            {

                if(in_array(null, $request->license) || in_array(null, $request->license_qty))
                {
                    $input['license'] = null;
                    $input['license_qty'] = null;
                }
                else
                {
                    $input['license'] = implode(',,', $request->license);
                    $input['license_qty'] = implode(',', $request->license_qty);
                }

            }

            // Check Features
            if(in_array(null, $request->features) || in_array(null, $request->colors))
            {
                $input['features'] = null;
                $input['colors'] = null;
            }
            else
            {
                $input['features'] = implode(',', str_replace(',',' ',$request->features));
                $input['colors'] = implode(',', str_replace(',',' ',$request->colors));
            }

            //tags
            if (!empty($request->tags))
            {
                $input['tags'] = implode(',', $request->tags);
            }

            // Conert Price According to Currency
            $input['price'] = ($input['price'] / $sign->value);
            $input['previous_price'] = ($input['previous_price'] / $sign->value);
            $input['user_id'] = Auth::user()->id;

            // store filtering attributes for physical product
            $attrArr = [];
            if (!empty($request->category_id)) {
                $catAttrs = Attribute::where('attributable_id', $request->category_id)->where('attributable_type', 'App\Models\Category')->get();
                if (!empty($catAttrs)) {
                    foreach ($catAttrs as $key => $catAttr) {
                        $in_name = $catAttr->input_name;
                        if ($request->has("$in_name")) {
                            $attrArr["$in_name"]["values"] = $request["$in_name"];
                            $attrArr["$in_name"]["prices"] = $request["$in_name"."_price"];
                            if ($catAttr->details_status) {
                                $attrArr["$in_name"]["details_status"] = 1;
                            } else {
                                $attrArr["$in_name"]["details_status"] = 0;
                            }
                        }
                    }
                }
            }

            if (!empty($request->subcategory_id)) {
                $subAttrs = Attribute::where('attributable_id', $request->subcategory_id)->where('attributable_type', 'App\Models\Subcategory')->get();
                if (!empty($subAttrs)) {
                    foreach ($subAttrs as $key => $subAttr) {
                        $in_name = $subAttr->input_name;
                        if ($request->has("$in_name")) {
                            $attrArr["$in_name"]["values"] = $request["$in_name"];
                            $attrArr["$in_name"]["prices"] = $request["$in_name"."_price"];
                            if ($subAttr->details_status) {
                                $attrArr["$in_name"]["details_status"] = 1;
                            } else {
                                $attrArr["$in_name"]["details_status"] = 0;
                            }
                        }
                    }
                }
            }
            if (!empty($request->childcategory_id)) {
                $childAttrs = Attribute::where('attributable_id', $request->childcategory_id)->where('attributable_type', 'App\Models\Childcategory')->get();
                if (!empty($childAttrs)) {
                    foreach ($childAttrs as $key => $childAttr) {
                        $in_name = $childAttr->input_name;
                        if ($request->has("$in_name")) {
                            $attrArr["$in_name"]["values"] = $request["$in_name"];
                            $attrArr["$in_name"]["prices"] = $request["$in_name"."_price"];
                            if ($childAttr->details_status) {
                                $attrArr["$in_name"]["details_status"] = 1;
                            } else {
                                $attrArr["$in_name"]["details_status"] = 0;
                            }
                        }
                    }
                }
            }



            if (empty($attrArr)) {
                $input['attributes'] = NULL;
            } else {
                $jsonAttr = json_encode($attrArr);
                $input['attributes'] = $jsonAttr;
            }

            // Save Data
            $data->fill($input)->save();

            // Set SLug

            $prod = Product::find($data->id);
            if($prod->type != 'Physical'){
                $prod->slug = Str::slug($data->name,'-').'-'.strtolower(Str::random(3).$data->id.Str::random(3));
            }
            else {
                $prod->slug = Str::slug($data->name,'-').'-'.strtolower($data->sku);
            }
            $photo = $prod->photo;

            // Set Photo
            $resizedImage = Image::make(public_path().'/assets/images/products/'.$prod->photo)->resize(800, null, function ($c) {
                $c->aspectRatio();
            });
            $photo = Str::random(12).'.jpg';
            $resizedImage->save(public_path().'/assets/images/products/'.$photo);



            // Set Thumbnail

            $background = Image::canvas(300, 300);
            $resizedImage = Image::make(public_path().'/assets/images/products/'.$prod->photo)->resize(300, 300, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            // insert resized image centered into background
            $background->insert($resizedImage, 'center');
            // save or do whatever you like
            $thumbnail = Str::random(12).'.jpg';
            $background->save(public_path().'/assets/images/thumbnails/'.$thumbnail);


            $prod->thumbnail  = $thumbnail;
            $prod->photo  = $photo;
            $prod->update();

            // Add To Gallery If any
            $lastid = $data->id;
            if ($files = $request->file('gallery')){
                foreach ($files as  $key => $file){
                    if(in_array($key, $request->galval))
                    {
                        $gallery = new Gallery;
                        $name = time().str_replace(' ', '', $file->getClientOriginalName());
                        $img = Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });



                        $thumbnail = Str::random(12).'.jpg';
                        $img->save(public_path().'/assets/images/galleries/'.$name);
                        $gallery['photo'] = $name;
                        $gallery['product_id'] = $lastid;
                        $gallery->save();
                    }
                }
            }
            //logic Section Ends

            //--- Redirect Section
            $msg = 'New Product Added Successfully.<a href="'.route('vendor-prod-index').'">View Product Lists.</a>';
            return response()->json($msg);
            //--- Redirect Section Ends
        }
        else
        {
            //--- Redirect Section
            return response()->json(array('errors' => [ 0 => 'You Can\'t Add More Product.']));

            //--- Redirect Section Ends
        }
    }


    //*** GET Request
    public function destroy($id)
    {

        $data = Product::findOrFail($id);
        if($data->galleries->count() > 0)
        {
            foreach ($data->galleries as $gal) {
                if (file_exists(public_path().'/assets/images/galleries/'.$gal->photo)) {
                    unlink(public_path().'/assets/images/galleries/'.$gal->photo);
                }
                $gal->delete();
            }

        }

        if($data->ratings->count() > 0)
        {
            foreach ($data->ratings  as $gal) {
                $gal->delete();
            }
        }
        if($data->wishlists->count() > 0)
        {
            foreach ($data->wishlists as $gal) {
                $gal->delete();
            }
        }
        if($data->clicks->count() > 0)
        {
            foreach ($data->clicks as $gal) {
                $gal->delete();
            }
        }
        if($data->comments->count() > 0)
        {
            foreach ($data->comments as $gal) {
                if($gal->replies->count() > 0)
                {
                    foreach ($gal->replies as $key) {
                        $key->delete();
                    }
                }
                $gal->delete();
            }
        }

        if (!filter_var($data->photo,FILTER_VALIDATE_URL)){
            if (file_exists(public_path().'/assets/images/products/'.$data->photo)) {
                unlink(public_path().'/assets/images/products/'.$data->photo);
            }
        }

        if (file_exists(public_path().'/assets/images/thumbnails/'.$data->thumbnail) && $data->thumbnail != "") {
            unlink(public_path().'/assets/images/thumbnails/'.$data->thumbnail);
        }
        if($data->file != null){
            if (file_exists(public_path().'/assets/files/'.$data->file)) {
                unlink(public_path().'/assets/files/'.$data->file);
            }
        }
        $data->delete();
        //--- Redirect Section
        $msg = 'Product Deleted Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends

// PRODUCT DELETE ENDS
    }

    public function getAttributes(Request $request) {
        $model = '';
        if ($request->type == 'category') {
            $model = 'App\Models\Category';
        } elseif ($request->type == 'subcategory') {
            $model = 'App\Models\Subcategory';
        } elseif ($request->type == 'childcategory') {
            $model = 'App\Models\Childcategory';
        }

        $attributes = Attribute::where('attributable_id', $request->id)->where('attributable_type', $model)->get();
        $attrOptions = [];
        foreach ($attributes as $key => $attribute) {
            $options = AttributeOption::where('attribute_id', $attribute->id)->get();
            $attrOptions[] = ['attribute' => $attribute, 'options' => $options];
        }
        return response()->json($attrOptions);
    }
}