@extends('layouts.front')
@section('content')
<!-- search bar -->

                   
<!-- end serach bar -->
        <div class="vendorheader text-center">
            <div class="container ">
                <h3>VENDORS</h3>
                <div class="lower-text">
                 <span><a href="{{route('front.index')}}">{{ $langg->lang17 }}</a></span> <span>/</span> <span>Vendors</p>
               </div>
            </div>
        </div>
        <!-- <div class="justify-content-between">      
                       <div class="toadjuctserach"  >
                             <form action="#" method="GET">
                                    <div style="border-bottom: 1px solid #0000006e; width: 205px;">
                                     <input id="fsearch" style="border: none; box-shadow: none; padding-bottom: 8px; border-radius: 0;" type="text"  name="fsearch" value="" class="li-search-field" placeholder="Search a specific Vendor">
                                    <input id="uri_seg" type="hidden" name="uri_seg" value="">
                                        <input type="hidden" name="category" value="" class="li-search-field" placeholder="Search a specific Vendor">
                                    <button id="btn" type="submit" class="li-search-btn"  style="border: none; box-shadow: none;padding-bottom: 8px; background:none;   border-radius: 0;"><i style="color:#f7b543;font-size: 24px;" class="fa fa-search"></i></button>
                                    </div>
                                </form>
                        </div>
                     </div> -->
       <div class="container pt-60">
           <div class="row">
           @foreach ($users as $user)
                <div class="col-lg-3">
                    <div class="featured">
						<div class="featured-vendor">
							<a href="#">
								<div class="cat-img">
                                  <img src="{{asset('assets/images/services/'.$user->photo)}}" />
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

     

@endsection


@section('scripts')