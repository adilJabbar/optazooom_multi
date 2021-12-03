<?php

namespace App\Http\Controllers\Front;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderTrack;
use App\Models\Pagesetting;
use App\Models\Product;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\VendorOrder;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Redirect;
use Stripe\Error\Card;
use URL;
use Validator;

class StripeController extends Controller
{



    public function __construct()
    {
        //Set Spripe Keys
        $stripe = Generalsetting::findOrFail(1);
        Config::set('services.stripe.key', $stripe->stripe_key);
        Config::set('services.stripe.secret', $stripe->stripe_secret);
    }


    public function store(Request $request){
    
        if($request->pass_check) {
            $users = User::where('email','=',$request->personal_email)->get();
            if(count($users) == 0) {
                if ($request->personal_pass == $request->personal_confirm){
                    $user = new User;
                    $user->name = $request->personal_name; 
                    $user->email = $request->personal_email;   
                    $user->password = bcrypt($request->personal_pass);
                    $token = md5(time().$request->personal_name.$request->personal_email);
                    $user->verification_link = $token;
                    $user->affilate_code = md5($request->name.$request->email);
                    $user->email_verified = 'Yes';
                    $user->save();
                    Auth::guard('web')->login($user);                     
                }else{
                    return redirect()->back()->with('unsuccess',"Confirm Password Doesn't Match.");     
                }
            }
            else {
                return redirect()->back()->with('unsuccess',"This Email Already Exist.");  
            }
        }
        
        if (!Session::has('cart')) {
            return redirect()->route('front.cart')->with('success',"You don't have any product to checkout.");
        }
         // Session::forget('cart');
        $oldCart = Session::get('cart');
          
        $cart = new Cart($oldCart);

    
      
         foreach($cart->items as $c_key =>$c_val)
        {
           
            $userss[] = $c_val['item']->user_id;
            $userss = array_unique($userss);

        }
        $total_users = count($userss);


            
        $oldCart = Session::get('cart');
        $cartt = new Cart($oldCart);


        foreach($cart->items as $c_key =>$c_val)
        {
           
            $userss[] = $c_val['item']->user_id;
            $userss = array_unique($userss);
            
            $id = $c_key;   

             $gs = Generalsetting::findOrFail(1);
        if (Session::has('currency')) 
        {
            $curr = Currency::find(Session::get('currency'));
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
        }
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $a = $cart->removeItem($id);

   
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
                $data[0] = $cart->totalPrice;
                $data[3] = $data[0];
                    $tx = $gs->tax;
                    if($tx != 0)
                    {
                        $tax = ($data[0] / 100) * $tx;
                        $data[3] = $data[0] + $tax;
                    } 

                if($gs->currency_format == 0){
                    $data[0] = $curr->sign.round($data[0] * $curr->value,2);
                    $data[3] = $curr->sign.round($data[3] * $curr->value,2);
            
                }
                else{
                    $data[0] = round($data[0] * $curr->value,2).$curr->sign;
                    $data[3] = round($data[3] * $curr->value,2).$curr->sign;
                }
            
            $data[1] = count($cart->items); 
            // return response()->json($data);  
        } else {
            Session::forget('cart');
            Session::forget('already');
            Session::forget('coupon');
            Session::forget('coupon_total');
            Session::forget('coupon_total1');
            Session::forget('coupon_percentage');

            $data = 0;
            // return response()->json($data); 
        } 




        }
        $i = 0;
         
        // $oldCart = Session::get('cart');
        // $cart = new Cart($oldCart);
      


        $product_detail = array();
        foreach($userss as $us_key => $us_v)
        {
           foreach($cartt->items as $ca_k => $ca_v)
           {
                if($us_v == $ca_v['item']->user_id)
                {
                    // $product_detail[$i][] =$ca_v['item']->user_id;  
                    $product_detail[$i][] =$ca_v['item']->id;  
                    // $product_detail[$i][] =$ca_v['item']->slug;  
                    // $product_detail[$i][] =$ca_v['item']->price;    
                }
                
           }
          
            $i++;
        }


// print_r($product_detail);
    foreach($product_detail as $prod_k => $prod_v)
    {
        // if($prod_k == 1)
        // {
        //     dd($product_detail);    
        // }
        $a = true;
        $b = true;
        $c = true;
        $d = true;
        $e = true;
        $f = true;
        $g = true;
        foreach($prod_v as $p_k => $p_v)
        {

            if(isset($prod_v[0]) && $a)
            {
               $this->add_to_cart_for_multiorder($prod_v[0]);
               $a = false;

            }
            elseif(isset($prod_v[1]) && $b )
            {
                $this->add_to_cart_for_multiorder($prod_v[1]);
                 $b = false;

            }
            elseif(isset($prod_v[2]) && $c )
            {
                $this->add_to_cart_for_multiorder($prod_v[2]);
                 $c = false;
            }
            elseif(isset($prod_v[3]) && $d )
            {
                $this->add_to_cart_for_multiorder($prod_v[3]);
                 $d = false;
            }
            elseif(isset($prod_v[17]) && $e )
            {
                $this->add_to_cart_for_multiorder($prod_v[17]);
                 $e = false;
            } 
            elseif(isset($prod_v[21]) && $f )
            {
                $this->add_to_cart_for_multiorder($prod_v[21]);
                 $f = false;
            }
            elseif(isset($prod_v[25]) && $g )
            {
                $this->add_to_cart_for_multiorder($prod_v[25]);
                 $g = false;
            }else
            {
                 $this->add_to_cart_for_multiorder($prod_v);
            }
        }


    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);

    $item_amount = $cart->totalPrice;
      
    // }
   

            if (Session::has('currency')) 
            {
              $curr = Currency::find(Session::get('currency'));
            }
            else
            {
                $curr = Currency::where('is_default','=',1)->first();
            }

        $settings = Generalsetting::findOrFail(1);
        $order = new Order;
        $success_url = action('Front\PaymentController@payreturn');
        $item_name = $settings->title." Order";
        $item_number = Str::random(10);
        $item_amount = $request->total;
        $item_amount = $cart->totalPrice;

        $item_amount = $item_amount+($request->shipping_cost/$total_users);

      
        // dd($request->all());
        $validator = Validator::make($request->all(),[
                        'cardNumber' => 'required',
                        'cardCVC' => 'required',
                        'month' => 'required',
                        'year' => 'required',
                    ]);

        if ($validator->passes()) {

            $stripe = Stripe::make(Config::get('services.stripe.secret'));
            try{
                $token = $stripe->tokens()->create([
                    'card' =>[
                            'number' => $request->cardNumber,
                            'exp_month' => $request->month,
                            'exp_year' => $request->year,
                            'cvc' => $request->cardCVC,
                        ],
                    ]);
                if (!isset($token['id'])) {
                    return back()->with('error','Token Problem With Your Token.');
                }
                
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => $curr->name,
                    'amount' => $item_amount,
                    'description' => $item_name,
                    ]);

                if ($charge['status'] == 'succeeded') {
                        $whole_discount  = 0;
                        foreach($cart->items as $key => $prod)
                        {
                            if(isset($prod['discount1'])){
                                $whole_discount += $prod['discount1'];
                            }
                            if(!empty($prod['item']['license']) && !empty($prod['item']['license_qty']))
                            {
                                    foreach($prod['item']['license_qty']as $ttl => $dtl)
                                    {
                                        if($dtl != 0)
                                        {
                                            $dtl--;
                                            $produc = Product::findOrFail($prod['item']['id']);
                                            $temp = $produc->license_qty;
                                            $temp[$ttl] = $dtl;
                                            $final = implode(',', $temp);
                                            $produc->license_qty = $final;
                                            $produc->update();
                                            $temp =  $produc->license;
                                            $license = $temp[$ttl];
                                            $oldCart = Session::has('cart') ? Session::get('cart') : null;
                                            $cart = new Cart($oldCart);
                                            $cart->updateLicense($prod['item']['id'],$license);  
                                            Session::put('cart',$cart);
                                            break;
                                        }                    
                                    }
                            }
                        }
                  
        //               try{
        //                 echo "---";
        //                 echo $cart->totalQty;
        //               }catch (Exception $e) {
        //                 dd($e->getMessage());
         
        // }
                    $new_cart = array();
                    $order['user_id'] = $request->user_id;
                    $new_cart['totalQty'] = $cart->totalQty;
                    $new_cart['totalPrice'] = $cart->totalPrice+($request->shipping_cost/$total_users);;
                    $new_cart['items'] = $cart->items;
                    $new_cart = json_encode($new_cart,true);
                    $order['cart'] = $new_cart;
                    $order['totalQty'] = $request->totalQty;
                    $order['pay_amount'] = round($item_amount / $curr->value, 2);
                    $order['method'] = "Stripe";
                    $order['totalQty'] = $request->totalQty;
                    $order['customer_email'] = $request->email;
                    $order['customer_name'] = $request->name;
                    $order['customer_phone'] = $request->phone;
                    $order['order_number'] = $item_number;
                    $order['shipping'] = $request->shipping;
                    $order['pickup_location'] = $request->pickup_location;
                    $order['customer_address'] = $request->address;
                    $order['customer_country'] = $request->customer_country;
                    $order['customer_city'] = $request->city;
                    $order['customer_zip'] = $request->zip;
                    $order['shipping_email'] = $request->shipping_email;
                    $order['shipping_name'] = $request->shipping_name;
                    $order['shipping_phone'] = $request->shipping_phone;
                    $order['shipping_address'] = $request->shipping_address;
                    $order['shipping_country'] = $request->shipping_country;
                    $order['whole_discount'] = $whole_discount;
                    $order['shipping_city'] = $request->shipping_city;
                    $order['shipping_zip'] = $request->shipping_zip;
                    $order['order_note'] = $request->order_notes;
                    $order['coupon_code'] = $request->coupon_code;
                    $order['coupon_discount'] = $request->coupon_discount;
                    $order['payment_status'] = "Completed";
                    $order['txnid'] = $charge['balance_transaction'];
                    $order['charge_id'] = $charge['id'];
                    $order['currency_sign'] = $curr->sign;
                    $order['currency_value'] = $curr->value;
                    $order['shipping_cost'] = $request->shipping_cost/$total_users;
                    $order['packing_cost'] = $request->packing_cost;
                    $order['tax'] = $request->tax;
                    $order['dp'] = $request->dp;
                    $order['vendor_shipping_id'] = $request->vendor_shipping_id;
                    $order['vendor_packing_id'] = $request->vendor_packing_id;
                    
                    if($order['dp'] == 1)
                    {
                        $order['status'] = 'completed';
                    }
                    if (Session::has('affilate')) 
                    {
                        $val = $request->total / $curr->value;
                        $val = $val / 100;
                        $sub = $val * $settings->affilate_charge;
                        $order['affilate_user'] = Session::get('affilate');
                        $order['affilate_charge'] = $sub;
                    }
                    $order->save();

                if($order->dp == 1){
                    $track = new OrderTrack;
                    $track->title = 'Completed';
                    $track->text = 'Your order has completed successfully.';
                    $track->order_id = $order->id;
                    $track->save();
                }
                else {
                    $track = new OrderTrack;
                    $track->title = 'Pending';
                    $track->text = 'You have successfully placed your order.';
                    $track->order_id = $order->id;
                    $track->save();
                }

                    
                    $notification = new Notification;
                    $notification->order_id = $order->id;
                    $notification->save();
                    if($request->coupon_id != "")
                    {
                       $coupon = Coupon::findOrFail($request->coupon_id);
                       $coupon->used++;
                       if($coupon->times != null)
                       {
                            $i = (int)$coupon->times;
                            $i--;
                            $coupon->times = (string)$i;
                       }
                        $coupon->update();

                    }
        foreach($cart->items as $prod)
        {
            $x = (string)$prod['size_qty'];
            if(!empty($x))
            {
                $product = Product::findOrFail($prod['item']['id']);
                $x = (int)$x;
                $x = $x - $prod['qty'];
                $temp = $product->size_qty;
                $temp[$prod['size_key']] = $x;
                $temp1 = implode(',', $temp);
                $product->size_qty =  $temp1;
                $product->update();               
            }
        }


        foreach($cart->items as $prod)
        {
            $x = (string)$prod['stock'];
            if($x != null)
            {

                $product = Product::findOrFail($prod['item']['id']);
                $product->stock =  $prod['stock'];
                $product->update();  
                if($product->stock <= 5)
                {
                    $notification = new Notification;
                    $notification->product_id = $product->id;
                    $notification->save();                    
                }              
            }
        }

        $notf = null;

        foreach($cart->items as $prod)
        {
            if($prod['item']['user_id'] != 0)
            {
                $vorder =  new VendorOrder;
                $vorder->order_id = $order->id;
                $vorder->user_id = $prod['item']['user_id'];
                $notf[] = $prod['item']['user_id'];
                $vorder->qty = $prod['qty'];
                $vorder->price = $prod['price'];
                $vorder->order_number = $order->order_number;             
                $vorder->save();
            }

        }

        if(!empty($notf))
        {
            $users = array_unique($notf);
            foreach ($users as $user) {
                $notification = new UserNotification;
                $notification->user_id = $user;
                $notification->order_number = $order->order_number;
                $notification->save();    
            }
        }

        $gs = Generalsetting::find(1);

        //Sending Email To Buyer

        if($gs->is_smtp == 1)
        {
        $data = [
            'to' => $request->email,
            'type' => "new_order",
            'cname' => $request->name,
            'oamount' => "",
            'aname' => "",
            'aemail' => "",
            'wtitle' => "",
            'onumber' => $order->order_number,
        ];

        $mailer = new GeniusMailer();
        $mailer->sendAutoOrderMail($data,$order->id);            
        }
        else
        {
           $to = $request->email;
           $subject = "Your Order Placed!!";
           $msg = "Hello ".$request->name."!\nYou have placed a new order.\nYour order number is ".$order->order_number.".Please wait for your delivery. \nThank you.";
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
           mail($to,$subject,$msg,$headers);            
        }
        //Sending Email To Admin
        if($gs->is_smtp == 1)
        {
            $data = [
                'to' => Pagesetting::find(1)->contact_email,
                'subject' => "New Order Recieved!!",
                'body' => "Hello Admin!<br>Your store has received a new order.<br>Order Number is ".$order->order_number.".Please login to your panel to check. <br>Thank you.",
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);            
        }
        else
        {
           $to = Pagesetting::find(1)->contact_email;
           $subject = "New Order Recieved!!";
           $msg = "Hello Admin!\nYour store has recieved a new order.\nOrder Number is ".$order->order_number.".Please login to your panel to check. \nThank you.";
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
           mail($to,$subject,$msg,$headers);
        }



            Session::put('temporder_id',$order->id);
            Session::put('tempcart',$cart);
            Session::forget('cart');

            Session::forget('already');
            Session::forget('coupon');
            Session::forget('coupon_total');
            Session::forget('coupon_total1');
            Session::forget('coupon_percentage');
                    
                    // return redirect($success_url);
                }
                
            }catch (Exception $e){
                return back()->with('unsuccess', $e->getMessage());
            }catch (\Cartalyst\Stripe\Exception\CardErrorException $e){
                return back()->with('unsuccess', $e->getMessage());
            }catch (\Cartalyst\Stripe\Exception\MissingParameterException $e){
                return back()->with('unsuccess', $e->getMessage());
            }
        }
    }
        return redirect($success_url);
        return back()->with('unsuccess', 'Please Enter Valid Credit Card Informations.');
    }

    private function add_to_cart_for_multiorder($id)
    {
          
                 $prod = Product::where('id','=',$id)->first(['id','user_id','slug','name','photo','size','size_qty','size_price','color','price','stock','type','file','link','license','license_qty','measure','whole_sell_qty','whole_sell_discount','attributes']);

        // Set Attrubutes
                 // dd($prod);
        $keys = '';
        $values = '';
        if(!empty($prod->license_qty))
        {
        $lcheck = 1;
            foreach($prod->license_qty as $ttl => $dtl)
            {
                if($dtl < 1)
                {
                    $lcheck = 0;
                }
                else
                {
                    $lcheck = 1;
                    break;
                }                    
            }
                if($lcheck == 0)
                {
                    return 0;            
                }
        }

        // Set Size

        $size = '';
        if(!empty($prod->size))
        { 
        $size = trim($prod->size[0]);
        }  
        $size = str_replace(' ','-',$size);

        // Set Color

        $color = '';
        if(!empty($prod->color))
        { 
        $color = $prod->color[0];
        $color = str_replace('#','',$color);
        }  

        // Vendor Comission

        if($prod->user_id != 0){
        $gs = Generalsetting::findOrFail(1);
        $prc = $prod->price + $gs->fixed_commission + ($prod->price/100) * $gs->percentage_commission;
        $prod->price = round($prc,2);
        }


        // Set Attribute


            if (!empty($prod->attributes))
            {
                $attrArr = json_decode($prod->attributes, true);

                $count = count($attrArr);
                $i = 0;
                $j = 0; 
                      if (!empty($attrArr))
                      {
                          foreach ($attrArr as $attrKey => $attrVal)
                          {

                            if (is_array($attrVal) && array_key_exists("details_status",$attrVal) && $attrVal['details_status'] == 1) {
                                if($j == $count - 1){
                                    $keys .= $attrKey;
                                }else{
                                    $keys .= $attrKey.',';
                                }
                                $j++;

                                foreach($attrVal['values'] as $optionKey => $optionVal)
                                {
                                    
                                    $values .= $optionVal . ',';
                                    $prod->price += $attrVal['prices'][$optionKey];
                                    break;
                                }

                            }
                          }

                      }

                }
                $keys = rtrim($keys, ',');
                $values = rtrim($values, ',');





        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->add($prod, $prod->id,$size,$color,$keys,$values);
        if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['dp'] == 1)
        {
            return 'digital';
        }
        if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['stock'] < 0)
        {
            return 0;
        }
        if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['size_qty'])
        {
            if($cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['qty'] > $cart->items[$id.$size.$color.str_replace(str_split(' ,'),'',$values)]['size_qty'])
            {
                return 0;
            }           
        }
        $cart->totalPrice = 0;
        foreach($cart->items as $data)
        $cart->totalPrice += $data['price'];
        Session::put('cart',$cart);
        $data[0] = count($cart->items);   
    }

    // Capcha Code Image
    private function  code_image()
    {
        $actual_path = str_replace('project','',base_path());
        $image = imagecreatetruecolor(200, 50);
        $background_color = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image,0,0,200,50,$background_color);

        $pixel = imagecolorallocate($image, 0,0,255);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixel);
        }

        $font = $actual_path.'assets/front/fonts/NotoSans-Bold.ttf';
        $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $length = strlen($allowed_letters);
        $letter = $allowed_letters[rand(0, $length-1)];
        $word='';
        //$text_color = imagecolorallocate($image, 8, 186, 239);
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $cap_length=6;// No. of character in image
        for ($i = 0; $i< $cap_length;$i++)
        {
            $letter = $allowed_letters[rand(0, $length-1)];
            imagettftext($image, 25, 1, 35+($i*25), 35, $text_color, $font, $letter);
            $word.=$letter;
        }
        $pixels = imagecolorallocate($image, 8, 186, 239);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixels);
        }
        session(['captcha_string' => $word]);
        imagepng($image, $actual_path."assets/images/capcha_code.png");
    }

}
