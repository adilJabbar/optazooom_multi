@extends('layouts.front')
@section('content')
        <!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="pages">
                    <li>
                        <a href="{{ route('front.indexx') }}">
                            {{ $langg->lang17 }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('front.vendorlist') }}">
                            Vendors
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
        <div class="container pt-60">
               <div class="main-form-search">
                    <form action="#" method="GET">
                        <!-- <label>Search:</label> -->
                        <input id="fsearch" type="text"  name="fsearch" value="" class="li-search-field" placeholder="Search a specific Vendor" style="float:right; padding:10px 25px; font-weight:300; border:1px solid rgba(0,0,0,0.4)">             
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



