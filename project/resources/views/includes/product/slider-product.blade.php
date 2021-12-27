<a href="{{ route('front.product', $prod->slug) }}" class="item">
		<div class="item-img">
			@if(!isset($prod->features))
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
			<?php  
			$img = explode(',',$prod->photo);
            if(strpos($prod->thumbnail,'png') || strpos($prod->thumbnail,'jpg') || strpos($prod->thumbnail,'jpeg')) {
			 ?>	

			@if($prod->thumbnail)	
			<img class="img-fluid" src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" alt="">
			 @else
				<img class="img-fluid" src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}" alt="">
			@endif
				<?php }
				
				else {  ?>
				
				<img class="img-fluid" src="{{ $prod->thumbnail ? $prod->thumbnail:asset('assets/images/noimage.png') }}" alt="">	 <?php  }?>
		</div>
		<div class="info">
			<div class="stars">
				<div class="ratings">
					<div class="empty-stars"></div>
					<div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
				</div>
			</div>
				@if(Auth::user())
			<h4 class="price">{{ $prod->showPrice() }} <del><small>{{ $prod->showPreviousPrice() }}</small></del></h4>

								@endif 	
					<h5 class="name">{{ $prod->showName() }}</h5>
					<div class="item-cart-area">
						@if($prod->product_type == "affiliate")
							<span class="add-to-cart-btn affilate-btn"
								data-href="{{ route('affiliate.product', $prod->slug) }}"><i class="icofont-cart"></i>
								{{ $langg->lang251 }}
							</span>
						@else
							@if($prod->stock === 0)
							<span class="add-to-cart-btn cart-out-of-stock">
								<i class="icofont-close-circled"></i> {{ $langg->lang78 }}
							</span>													
							@else

							@if(Auth::guard('web')->check())
							<span class="add-to-cart add-to-cart-btn" data-href="{{ route('product.cart.add',$prod->id) }}">
								<i class="icofont-cart"></i> {{ $langg->lang56 }}
							</span>
							<span class="add-to-cart-quick add-to-cart-btn"
								data-href="{{ route('product.cart.quickadd',$prod->id) }}">
								<i class="icofont-cart"></i> {{ $langg->lang251 }}
							</span>
							@else

						<span rel-toggle="tooltip" class="add-to-cart-btn" title="{{ $langg->lang56 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
							<i class="icofont-heart-alt"></i>{{ $langg->lang56 }}
						</span>	
						<span rel-toggle="tooltip" class="add-to-cart-btn" title="{{ $langg->lang251 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
							<i class="icofont-heart-alt"></i>{{ $langg->lang251 }}
						</span>	


							@endif

							@endif
						@endif
					</div>
		</div>
	</a>
