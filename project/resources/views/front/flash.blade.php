
@extends('layouts.front')
@section('content')
<!--Breadcrumb-->
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
                        <a href="{{ route('front.featured') }}">
                           Flash Deals
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->


	

@if($ps->flash_deal == 1)
		<!-- Trending Item Area Start -->
		<section  class="categori-item electronics-section">
				<div class="container-fluid">
						<div class="row">
							@foreach($discount_products as $prod)
							  <div class="col-lg-3 col-md-4 col-sm-12">
							  @if(strpos($prod->discount_date, '-') !== false || strpos($prod->discount_date, '/') !== false)

@if(Carbon\Carbon::now()->format('Y-m-d') < Carbon\Carbon::parse($prod->discount_date)->format('Y-m-d'))


	<a href="{{ route('front.product', $prod->slug) }}" class="item">
		<div class="item-img">
			@if(!empty($prod->features))
				<div class="sell-area">
				@foreach($prod->features as $key => $data1)
					<span class="sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }}</span>
					@endforeach 
				</div>
			@endif
				<div class="extra-list">
					<ul>
						<li>
							@if(Auth::guard('web')->check())

							<span class="add-to-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" data-placement="right" title="{{ $langg->lang54 }}" data-placement="right"><i class="icofont-heart-alt" ></i>
							</span>

							@else 

							<span class="add-to-cart-btn" rel-toggle="tooltip" title="{{ $langg->lang54 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
								<i class="icofont-heart-alt"></i>
							</span>

							@endif
						</li>
						<li>
							@if(Auth::user())
						<span class="quick-view" rel-toggle="tooltip" title="{{ $langg->lang55 }}" href="javascript:;" data-href="{{ route('product.quick',$prod->id) }}" data-toggle="modal" data-target="#quickview" data-placement="right"> <i class="icofont-eye"></i>
						</span>
						@endif
						</li>
					</ul>
				</div>
				<?php  
													$img = explode(',',$prod->photo);

													 if(strpos($prod->thumbnail,'png') || strpos($prod->thumbnail,'jpg') || strpos($prod->thumbnail,'jpeg')) {
												    ?>
													@if($prod->thumbnail)
													
												
													<img class="img-fluid" src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" alt="">
												     @else
													<img class="img-fluid" src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}" alt="">
													@endif


												<?php }else{  ?>

												 <img class="img-fluid" src="{{ $prod->thumbnail ? $prod->thumbnail:asset('assets/images/noimage.png') }}" alt="">																		   

											 <?php 	
											 
											 }?>	</div>
		<div class="info">
			<div class="stars">
				<div class="ratings">
					<div class="empty-stars"></div>
					<div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
				</div>
			</div>
			
	@if(Auth::guard('web')->check())
			<h4 class="price">{{ $prod->showPrice() }} <del><small>{{ $prod->showPreviousPrice() }}</small></del></h4>
			@endif					<h5 class="name">{{ $prod->showName() }}</h5>
					<div class="item-cart-area">
												@if($prod->product_type == "affiliate")
													<span class="add-to-cart-btn affilate-btn" data-href="{{ route('affiliate.product', $prod->slug) }}"><i class="icofont-cart"></i> {{ $langg->lang251 }}
													</span>
												@else
													<span class="add-to-cart add-to-cart-btn" data-href="{{ route('product.cart.add',$prod->id) }}">
														<i class="icofont-cart"></i> {{ $langg->lang56 }}
													</span>
													<span class="add-to-cart-quick add-to-cart-btn" data-href="{{ route('product.cart.quickadd',$prod->id) }}">
														<i class="icofont-cart"></i> {{ $langg->lang251 }}
													</span>
												@endif
					</div>
		</div>
		
		<div class="deal-counter">
		<div data-countdown="{{ $prod->discount_date }}"></div>
		</div>
	</a>


@endif
			

@endif
				             </div>	
				            @endforeach
				       </div>
			    </div>
		</section>
								<!-- Tranding Item Area End -->
@endif

@endsection
