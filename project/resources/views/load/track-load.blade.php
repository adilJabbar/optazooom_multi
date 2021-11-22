                        @if(isset($apiResponse))
                    <div class="tracking-steps-area">
                        
                            <div class="track">
                     @switch($apiResponse->CompletedTrackDetails->TrackDetails->StatusDetail->Description)
                                @case('Picked Up')
                                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Picked</span> </div>

                                @case('Arrived at FedEx location')
                                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Processing</span> </div>

                                @case('At local FedEx facility')
                                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span>  <span class="text">Processing</span> </div>

                                @case('At destination sort facility')
                                <div class="step active">  <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Processing</span> </div>

                                @case('Departed FedEx location')
                                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>

                                @case('On FedEx vehicle for delivery')
                                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>

                                @case('Delivered')
                                <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>

                                @default
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span><span class="text">Pending </span> </div>                              
                       @endswitch

                    </div>
                        
                    </div>

                    <div class="track">
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span>
                    <span class="text">
                        
                    </span> 
                 </div>
                <div class="step active"> 
                    <span class="icon"> <i class="fa fa-user"></i> </span> 
                    <span class="text"> Picked by courier</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
            </div>


                        @else 
                        <h3 class="text-center">{{ $langg->lang775 }}</h3>
                        @endif          