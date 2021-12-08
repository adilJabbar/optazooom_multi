

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

							<span rel-toggle="tooltip" title="{{ $langg->lang54 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
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
				  <?php if(strpos($prod->thumbnail,'png') || strpos($prod->thumbnail,'jpg') || strpos($prod->thumbnail,'jpeg')) { ?>
					@if($prod->thumbnail)
					<img class="img-fluid" src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" alt="">
					@else
					<img class="img-fluid" src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}" alt="">
					@endif
					<?php }else{ 
					$img = explode(',',$prod->photo);
				?>
							<img class="img-fluid" src="@if(isset($img[0])) {{ $img[0] }} @endif" alt="">

					 <?php 	} ?>
					</div>
		<div class="info">
			<div class="stars">
				<div class="ratings">
					<div class="empty-stars"></div>
					<div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
				</div>
			</div>
			<h4 class="price">{{ $prod->showPrice() }} <del><small>{{ $prod->showPreviousPrice() }}</small></del></h4>
					<h5 class="name">{{ $prod->showName() }}</h5>
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