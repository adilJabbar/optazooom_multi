	<li>
			<div class="single-box">
				<div class="left-area">
				<?php if(strpos($prod->thumbnail,'png') || strpos($prod->thumbnail,'jpg') || strpos($prod->thumbnail,'jpeg')) { ?>
					@if($prod->thumbnail)
					<img src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" alt="">
					@else
					<img class="img-fluid" src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}" alt="">
					@endif
					<?php }else{ 
														$img = explode(',',$prod->photo);
													?>
																<img class="img-fluid" src="@if(isset($img[0])) {{ $img[0] }} @endif" alt="">

											 <?php 	} ?>
				</div>
				<div class="right-area">
						<div class="stars">
							<div class="ratings">
								<div class="empty-stars"></div>
								<div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
							</div>
							</div>
							@if(Auth::user())
							<h4 class="price">{{ $prod->showPrice() }} <del>{{ $prod->showPreviousPrice() }}</del> </h4>
							@endif
							<p class="text"><a href="{{ route('front.product',$prod->slug) }}">{{ mb_strlen($prod->name,'utf-8') > 35 ? mb_substr($prod->name,0,35,'utf-8').'...' : $prod->name }}</a></p>
				</div>
			</div>
		</li>




