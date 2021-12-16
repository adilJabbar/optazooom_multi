@extends('layouts.vendor') 

@section('content')  
                    <div class="content-area">
                        <div class="mr-breadcrumb">
                            <div class="row">
                                <div class="col-lg-12">
                                        <h4 class="heading">{{ $langg->lang443 }}</h4>
                                        <ul class="links">
                                            <li>
                                                <a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">{{ $langg->lang442 }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('vendor-order-index') }}">{{ $langg->lang443 }}</a>
                                            </li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                        <div class="product-area">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mr-table allproduct">
                                        @include('includes.form-success') 

                                        <div class="table-responsiv">
                                        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                                                <table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ $langg->lang534 }}</th>
                                                            <th>{{ $langg->lang535 }}</th>
                                                            <th>{{ $langg->lang536 }}</th>
                                                            <th>{{ $langg->lang537 }}</th>
                                                                <th>Fedex Tracking Number</th>
                                                            <th>{{ $langg->lang538 }}</th>
                                                        </tr>
                                                    </thead>


                                              <tbody>
                                                @foreach($orders as $orderr) 
                                                @php 
                                                $qty = $orderr->sum('qty');
                                                $price = $orderr->sum('price');                                       
                                                @endphp
                    @foreach($orderr as $order)


@php 

  if($user->shipping_cost != 0){
      $price +=  round($user->shipping_cost * $order->order->currency_value , 2);
    }
  if(App\Models\Order::where('order_number','=',$order->order->order_number)->first()->tax != 0){
      $price  += ($price / 100) * App\Models\Order::where('order_number','=',$order->order->order_number)->first()->tax;
    }    

@endphp
                                                        <tr>
                                                    <td> <a href="{{route('vendor-order-invoice',$order->order_number)}}">{{ $order->order->order_number}}</a></td>
                                          <td>{{$qty}}</td>
                                      <td>{{$order->order->currency_sign}}{{round($price * $order->order->currency_value, 2)}}</td>
                                      <td>{{$order->order->method}}</td>
                                      <td>{{$order->order->fedex_trck_num}}</td>
                                      <td>

                                        <div class="action-list">

                                        <a href="{{route('vendor-order-show',$order->order->order_number)}}" class="btn btn-primary product-btn"><i class="fa fa-eye"></i> {{ $langg->lang539 }}</a>
                                            <select class="vendor-btn {{ $order->status }}">
                                            <option value="{{ route('vendor-order-status',[ $order->order->order_number,  'pending']) }}" {{  $order->status == "pending" ? 'selected' : ''  }}>{{ $langg->lang540 }}</option>
                                            <option value="{{ route('vendor-order-status',[ $order->order->order_number,  'processing']) }}" {{  $order->status == "processing" ? 'selected' : ''  }}>{{ $langg->lang541 }}</option>
                                            <option value="{{ route('vendor-order-status',[ $order->order->order_number,  'completed']) }}" {{  $order->status == "completed" ? 'selected' : ''  }}>{{ $langg->lang542 }}</option>
                                            <option value="{{ route('vendor-order-status',[ $order->order->order_number, 'declined']) }}" {{  $order->status == "declined" ? 'selected' : ''  }}>{{ $langg->lang543 }}</option>
                                            </select>


                                            <button <?php if(!empty($order->order->fedex_trck_num)){ echo "disabled"; } ?> type="button" class="btn btn-primary product-btn" data-toggle="modal" onclick="send_order_id({{$order->order->id}})" data-target="#myModal">Add Tracking Number</button>

 






                                        </div>

                                        </td>

                                                  </tr>

                                                  @break
                    @endforeach

                                                  @endforeach
                                                  </tbody>
                                                    
                                                </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

{{-- ORDER MODAL --}}
 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Tracking Number</h4>
        </div>
        <div class="modal-body">
          <form action="{{url('vendor/add-tracking-number')}}" method="POST">
            @csrf
            <input type="text" required="required" name="tracking_number" placeholder="add tracking number" value="">
            <input type="hidden" name="order_id" id="order_id_for_track" value="">
            <button class="btn btn-success btn-ok order-btn" type="submit"> Add </button>
          </form>   
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


  
<div class="modal fade" id="confirm-delete2" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="submit-loader">
        <img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
    </div>
    <div class="modal-header d-block text-center">
        <h4 class="modal-title d-inline-block">{{ $langg->lang544 }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p class="text-center">{{ $langg->lang545 }}</p>
        <p class="text-center">{{ $langg->lang546 }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ $langg->lang547 }}</button>
            <a class="btn btn-success btn-ok order-btn">{{ $langg->lang548 }}</a>
      </div>

    </div>
  </div>
</div>










<div class="modal fade" id="confirm-delete1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="submit-loader">
            <img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
        </div>
    <div class="modal-header d-block text-center">
        <h4 class="modal-title d-inline-block">Add Tracking Number</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p class="text-center">{{ __("You are about to update the order's Status.") }}</p>
        <p class="text-center">{{ __('Do you want to proceed?') }}</p>
        <input type="hidden" id="t-add" value="{{ route('admin-order-track-add') }}">
        <input type="hidden" id="t-id" value="">
        <input type="hidden" id="t-title" value="">
        <textarea class="input-field" placeholder="Enter Your Tracking Note (Optional)" id="t-txt"></textarea>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
            <a class="btn btn-success btn-ok order-btn">{{ __('Proceed') }}</a>
      </div>

    </div>
  </div>
</div>
{{-- ORDER MODAL ENDS --}}


@endsection    

@section('scripts')

{{-- DATA TABLE --}}

    <script type="text/javascript">
    function send_order_id(id)
    {
        $('#order_id_for_track').val(id);
    }

$('.vendor-btn').on('change',function(){
          $('#confirm-delete2').modal('show');
          $('#confirm-delete2').find('.btn-ok').attr('href', $(this).val());

});

        var table = $('#geniustable').DataTable({
               ordering: false
           });
                                                                
    </script>

{{-- DATA TABLE --}}
    
@endsection   