@extends('layouts.front')
@section('content')
        <div class="vendorheader text-center">
            <div class="container ">
                <h3>VENDORS</h3>
                <div class="lower-text">
                 <span><a href="{{route('front.index')}}">{{ $langg->lang17 }}</a></span> <span>/</span> <span>Vendors</p>
               </div>
            </div>
        </div>
        <div class="container pt-60">
               <div class="main-form-search">
                    <form action="#" method="GET">
                        <!-- <label>Search:</label> -->
                        <input id="fsearch" type="text"  name="fsearch" value="" class="li-search-field" placeholder="Search a specific Vendor" style="float:right;">             
                    </form>
                </div>
            </div>
            
       <div class="container pt-60">
                            
            <div class="row userss">
            @foreach ($users as $user)
                    <div class="col-lg-3">
                        <div class="featured">
                            <div class="featured-vendor">
                                <a href="{{ route('front.vendor',str_replace(' ', '-', $user->shop_name)) }}">
                                    <div class="cat-img">
                                    <img src="{{ $user->photo ? asset('assets/images/users/'.$user->photo):asset('assets/images/noimage.png') }}" />
                                    
                                </div>

                                <hr>
                                    <h4 class="vendor-name">{{ $user->name }}</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        <div class="container">
            <div class="pagination">
        {!! $users->links() !!}
          </div>
        </div>
        
     
@endsection


@section('scripts')
<script type="text/javascript">
    var searchRequest = null;

$(function () {
    var minlength = 3;

    $("input[name=fsearch]").keyup(function () {
        var that = this,
        value = $(this).val();
       

            $.ajax({
                type: "GET",
                url: "<?php echo url('get_vendors_ajax'); ?>"+"?key="+value,
                success: function(data){
                    data = jQuery.parseJSON(data);
                    $('.userss').html(data);
                  
                }
            });
        
    });
});

</script>


@endsection



