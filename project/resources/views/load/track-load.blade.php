@if(isset($apiResponse->CompletedTrackDetails->TrackDetails->StatusDetail->Description))
    <div class="tracking-steps-area">
        <div class="track">

                @switch($apiResponse->CompletedTrackDetails->TrackDetails->StatusDetail->Description)
                            @case('Shipment information sent to FedEx')
                            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Picked Up</span> </div>
                            <div class="step "> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Processing</span> </div>
                            <div class="step "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>
                            @break
                            @case('Tendered')
                            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Picked Up</span> </div>
                            <div class="step "> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Processing</span> </div>
                            <div class="step "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>
                            @break
                            @case('Picked up')
                            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Picked Up</span> </div>
                            <div class="step "> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Processing</span> </div>
                            <div class="step "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>
                            @break
                            @case('At FedEx destination facility')
                            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Picked Up</span> </div>
                            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Processing</span> </div>
                            <div class="step "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>
                            @break
                            @case('Arrived at FedEx location')
                            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Picked Up</span> </div>
                            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Processing</span> </div>
                            <div class="step "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>
                            @break
                            @case('At destination sort facility')
                            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Picked Up</span> </div>
                            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Processing</span> </div>
                            <div class="step "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>
                            @break
                            @case('Departed FedEx location')
                            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Picked Up</span> </div>
                            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Processing</span> </div>
                            <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>
                            @break
                            @case('On FedEx vehicle for delivery')
                            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Picked Up</span> </div>
                            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Processing</span> </div>
                            <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>
                            @break
                            @case('Delivered')
                            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Picked Up</span> </div>
                            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Processing</span> </div>
                            <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                            <div class="step active"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>
                            @break
                           @default
                           <div class="step"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Picked Up</span> </div>
                            <div class="step "> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Processing</span> </div>
                            <div class="step "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>
                @endswitch
         </div>
     </div>

     <?php
        $vendor = DB::table('vendor_orders')->join('orders','orders.id','=','vendor_orders.order_id')->join('users','users.id','=','vendor_orders.user_id')->where('orders.id',$order->id) ->select(
            'users.*'
        )->first();


     ?>
     <div class="container">
        <article class="card">
            <header class="card-header"> My Orders / Tracking </header>
            <div class="card-body">
                <h6>Order ID: {{$order->order_number}}</h6>
                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Estimated Delivery time:</strong> <br>Soon</div>
                        <div class="col"> <strong>Shipping BY:</strong> <br> {{  $vendor->name}}, | <i class="fa fa-phone"></i> {{  $vendor->phone}} </div>
                        <div class="col"> <strong>Status:</strong> <br> {{$apiResponse->CompletedTrackDetails->TrackDetails->StatusDetail->Description}} </div>
                        <div class="col"> <strong>Tracking #:</strong> <br>{{$apiResponse->CompletedTrackDetails->TrackDetails->TrackingNumber}} </div>
                    </div>
                </article>

                <hr>
                <hr> <a href="#" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a>
            </div>
        </article>
    </div>

@else
<h3 class="text-center">Tracking ID not found </h3>
<div class="">
<p>You have entered the incorrect tracking number. Please contact from fedex and enter the correct tracking id.</p>
</div>
@endif
