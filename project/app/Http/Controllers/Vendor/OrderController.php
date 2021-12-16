<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Order;
use App\Models\VendorOrder;
use FedEx;
// use FedEx\TrackService\Request;
use FedEx\TrackService\ComplexType;
use FedEx\TrackService\SimpleType;
use FedEx\TrackService\Track;
class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $orders = VendorOrder::where('user_id','=',$user->id)->orderBy('id','desc')->get()->groupBy('order_number');
        return view('vendor.order.index',compact('user','orders'));
    }

    public function show($slug)
    {
        $user = Auth::user();
        $order = Order::where('order_number','=',$slug)->first();
        $cart = json_decode($order->cart,true);
        return view('vendor.order.details',compact('user','order','cart'));
    }

    public function license(Request $request, $slug)
    {
        $order = Order::where('order_number','=',$slug)->first();
       $cart = json_decode($order->cart,true);
        $cart->items[$request->license_key]['license'] = $request->license;
        $order->cart = utf8_encode(bzcompress(serialize($cart), 9));
        $order->update();         
        $msg = 'Successfully Changed The License Key.';
        return response()->json($msg);
    }



    public function invoice($slug)
    {
        $user = Auth::user();
        $order = Order::where('order_number','=',$slug)->first();
        $cart = json_decode($order->cart,true);
        return view('vendor.order.invoice',compact('user','order','cart'));
    }

    public function printpage($slug)
    {
        $user = Auth::user();
        $order = Order::where('order_number','=',$slug)->first();
        $cart = json_decode($order->cart,true);
        return view('vendor.order.print',compact('user','order','cart'));
    }

    public function status($slug,$status)
    {
        $mainorder = VendorOrder::where('order_number','=',$slug)->first();
        if ($mainorder->status == "completed"){
            return redirect()->back()->with('success','This Order is Already Completed');
        }else{

        $user = Auth::user();
        $order = VendorOrder::where('order_number','=',$slug)->where('user_id','=',$user->id)->update(['status' => $status]);
        return redirect()->route('vendor-order-index')->with('success','Order Status Updated Successfully');
    }
    }

    public function add_tracking_number()
    {
        $tracking_number = $_POST['tracking_number'];



            $acctNum = '510087240';
        $accessKey = 'XYC1MVIkU0SuUozl';
        $password = 'liqepq7o2PNtEffqqbiHoqcru';
        $meterNum = '119245809';
        $trackingId1 = 2323;
        $trackingId2 = '123456789012';
        $trackingId2 = $_POST['tracking_number'];





        // Build Authentication
            $request['WebAuthenticationDetail'] = array(
            'UserCredential' => array(
                'Key'      => $accessKey, //Replace it with FedEx Key, 
                'Password' => $password //Replace it with FedEx API Password
            )
        );
 
 
        //Build Client Detail
        $request['ClientDetail'] = array(
            'AccountNumber' => $acctNum, //Replace it with Account Number, 
            'MeterNumber'   => $meterNum //Replace it with Meter Number
        );
 
         
        // Build API Version info
        $request['Version'] = array(
            'ServiceId'    => 'trck',
            'Major'        => 10, // You can change it based on you using api version
            'Intermediate' => 0, // You can change it based on you using api version
            'Minor'        => 0 // You can change it based on you using api version
        );
 
 
        // Build Tracking Number info
        $request['SelectionDetails'] = array(
            'PackageIdentifier' => array(
                'Type'  => 'TRACKING_NUMBER_OR_DOORTAG',
                'Value' => $trackingId2 //Replace it with FedEx tracking number
            )
        );



        $wsdlPath = 'TrackService_v18.wsdl'; 
        $wsdlPath =  url('/').'/project/vendor/maxirus/fedex/src/_wsdl/TrackService_v10.wsdl'; 

        $endPoint = 'https://wsbeta.fedex.com:443/web-services'; //You will get it when requesting to FedEx key. It might change based on the API Environments
         
        $client = new \SoapClient($wsdlPath, array('trace' => true));
        $client->__setLocation($endPoint);
     
        $apiResponse = $client->track($request);

        if(isset($apiResponse->CompletedTrackDetails->TrackDetails->StatusDetail->Description))
        {


        $order = Order::find($_POST['order_id']);
        $order->fedex_trck_num =  $_POST['tracking_number'];
        $order->update();
          return redirect()->back()->with('success','Order tracking number add successfullt');
        }else{
            return redirect()->back()->with('unsuccess','Order tracking number is not correct');
        }   

    }

}
