<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\PaymentGateway;
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

    public function orders()
    {
        $user = Auth::guard('web')->user();
        $orders = Order::where('user_id','=',$user->id)->orderBy('id','desc')->get();

        return view('user.order.index',compact('user','orders'));
    }

    public function ordertrack()
    {
        $user = Auth::guard('web')->user();
        return view('user.order-track',compact('user'));
    }

    public function trackload($id)
    {
        $acctNum = '510087240';
        $accessKey = 'XYC1MVIkU0SuUozl';
        $password = 'liqepq7o2PNtEffqqbiHoqcru';
        $meterNum = '119245809';
        $trackingId1 = 2323;
        $trackingId2 = '123456789012';
        $trackingId2 = $id;





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

        $order = Order::where('fedex_trck_num','=',$id)->first();

        // if(isset($apiResponse->CompletedTrackDetails->TrackDetails->StatusDetail->Description))
        // {

        //     $order_track = new OrderTrack;
        //     $order_track->order_id = $order->id;
        //     $order_track->title = $apiResponse->CompletedTrackDetails->TrackDetails->StatusDetail->Description;
        //     $db_check = OrderTrack::where('order_id',$order->id)->where('title',$apiResponse->CompletedTrackDetails->TrackDetails->StatusDetail->Description)->first();
        //     if(!isset($db_check->id))
        //     {
        //         $order_track->save();
        //     }
        // }


        $datas = array('Pending','Processing','On Delivery','Completed');
        return view('load.track-load',compact('order','datas','apiResponse'));

    }


    public function order($id)
    {
        $user = Auth::guard('web')->user();
        $order = Order::findOrfail($id);

        $cart = json_decode($order->cart,true);
        return view('user.order.details',compact('user','order','cart'));
    }

    public function orderdownload($slug,$id)
    {
        $user = Auth::guard('web')->user();
        $order = Order::where('order_number','=',$slug)->first();
        $prod = Product::findOrFail($id);
        if(!isset($order) || $prod->type == 'Physical' || $order->user_id != $user->id)
        {
            return redirect()->back();
        }
        return response()->download(public_path('assets/files/'.$prod->file));
    }

    public function orderprint($id)
    {
        $user = Auth::guard('web')->user();
        $order = Order::findOrfail($id);
        $cart = json_decode($order->cart,true);
        return view('user.order.print',compact('user','order','cart'));
    }

    public function trans()
    {
        $id = $_GET['id'];
        $trans = $_GET['tin'];
        $order = Order::findOrFail($id);
        $order->txnid = $trans;
        $order->update();
        $data = $order->txnid;
        return response()->json($data);
    }

}
