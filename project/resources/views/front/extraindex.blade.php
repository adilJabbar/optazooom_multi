
		@if($ps->small_banner == 1)

		<!-- Banner Area One Start -->
		<section class="banner-section">
			<div class="container">
				@foreach($top_small_banners->chunk(2) as $chunk)
					<div class="row">
						@foreach($chunk as $img)
							<div class="col-lg-6 remove-padding">
								<div class="left">
									<a class="banner-effect" href="{{ $img->link }}" target="_blank">
										<img src="{{asset('assets/images/banners/'.$img->photo)}}" alt="">
									</a>
								</div>
							</div>
						@endforeach
					</div>
				@endforeach
			</div>
		</section>
		<!-- Banner Area One Start -->
	@endif
	
	@if($ps->best == 1)
		<!-- Phone and Accessories Area Start -->
		<section class="phone-and-accessories categori-item">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="section-top">
							<h2 class="section-title">
								{{ $langg->lang27 }}
							</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-9">
						<div class="row">
							@foreach($best_products as $prod)
								@include('includes.product.home-product')
							@endforeach
						</div>
					</div>
					<div class="col-lg-3 remove-padding d-none d-lg-block">
						<div class="aside">
							<a class="banner-effect mb-10" href="{{ $ps->best_seller_banner_link }}">
								<img src="{{asset('assets/images/'.$ps->best_seller_banner)}}" alt="">
							</a>
							<a class="banner-effect" href="{{ $ps->best_seller_banner_link1 }}">
								<img src="{{asset('assets/images/'.$ps->best_seller_banner1)}}" alt="">
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Phone and Accessories Area start-->
	@endif

	

	@if($ps->large_banner == 1)
		<!-- Banner Area One Start -->
		<section class="banner-section">
			<div class="container">
				@foreach($large_banners->chunk(1) as $chunk)
					<div class="row">
						@foreach($chunk as $img)
							<div class="col-lg-12 remove-padding">
								<div class="img">
									<a class="banner-effect" href="{{ $img->link }}">
										<img src="{{asset('assets/images/banners/'.$img->photo)}}" alt="">
									</a>
								</div>
							</div>
						@endforeach
					</div>
				@endforeach
			</div>
		</section>
		<!-- Banner Area One Start -->
	@endif

	@if($ps->top_rated == 1)
		<!-- Electronics Area Start -->
		<section class="categori-item electronics-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="section-top">
							<h2 class="section-title">
								{{ $langg->lang28 }}
							</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="row">

							@foreach($top_products as $prod)
								@include('includes.product.top-product')
							@endforeach

						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Electronics Area start-->
	@endif

	@if($ps->bottom_small == 1)
		<!-- Banner Area One Start -->
		<section class="banner-section">
			<div class="container">
				@foreach($bottom_small_banners->chunk(3) as $chunk)
					<div class="row">
						@foreach($chunk as $img)
							<div class="col-lg-4 remove-padding">
								<div class="left">
									<a class="banner-effect" href="{{ $img->link }}" target="_blank">
										<img src="{{asset('assets/images/banners/'.$img->photo)}}" alt="">
									</a>
								</div>
							</div>
						@endforeach
					</div>
				@endforeach
			</div>
		</section>
		<!-- Banner Area One Start -->
	@endif

	@if($ps->big == 1)
		<!-- Clothing and Apparel Area Start -->
		<section class="categori-item clothing-and-Apparel-Area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="section-top">
							<h2 class="section-title">
								{{ $langg->lang29 }}
							</h2>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-9">
						<div class="row">
							@foreach($big_products as $prod)
								@include('includes.product.home-product')
							@endforeach
						</div>
					</div>
					<div class="col-lg-3 remove-padding d-none d-lg-block">
						<div class="aside">
							<a class="banner-effect mb-10" href="{{ $ps->big_save_banner_link }}">
								<img src="{{asset('assets/images/'.$ps->big_save_banner)}}" alt="">
							</a>
							<a class="banner-effect" href="{{ $ps->big_save_banner_link1 }}">
								<img src="{{asset('assets/images/'.$ps->big_save_banner1)}}" alt="">
							</a>
						</div>
					</div>
				</div>
			</div>
			</div>
		</section>
		<!-- Clothing and Apparel Area start-->
	@endif

	@if($ps->hot_sale == 1)
		<!-- hot-and-new-item Area Start -->
		<section class="hot-and-new-item">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="accessories-slider">
							<div class="slide-item">
								<div class="row">
									<div class="col-lg-3 col-sm-6">
										<div class="categori">
											<div class="section-top">
												<h2 class="section-title">
													{{ $langg->lang30 }}
												</h2>
											</div>
											<div class="hot-and-new-item-slider">
												@foreach($hot_products->chunk(3) as $chunk)
													<div class="item-slide">
														<ul class="item-list">
															@foreach($chunk as $prod)
																@include('includes.product.list-product')
															@endforeach
														</ul>
													</div>
												@endforeach
											</div>

										</div>
									</div>
									<div class="col-lg-3 col-sm-6">
										<div class="categori">
											<div class="section-top">
												<h2 class="section-title">
													{{ $langg->lang31 }}
												</h2>
											</div>

											<div class="hot-and-new-item-slider">

												@foreach($latest_products->chunk(3) as $chunk)
													<div class="item-slide">
														<ul class="item-list">
															@foreach($chunk as $prod)
																@include('includes.product.list-product')
															@endforeach
														</ul>
													</div>
												@endforeach

											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-6">
										<div class="categori">
											<div class="section-top">
												<h2 class="section-title">
													{{ $langg->lang32 }}
												</h2>
											</div>


											<div class="hot-and-new-item-slider">

												@foreach($trending_products->chunk(3) as $chunk)
													<div class="item-slide">
														<ul class="item-list">
															@foreach($chunk as $prod)
																@include('includes.product.list-product')
															@endforeach
														</ul>
													</div>
												@endforeach

											</div>

										</div>
									</div>
									<div class="col-lg-3 col-sm-6">
										<div class="categori">
											<div class="section-top">
												<h2 class="section-title">
													{{ $langg->lang33 }}
												</h2>
											</div>

											<div class="hot-and-new-item-slider">

												@foreach($sale_products->chunk(3) as $chunk)
													<div class="item-slide">
														<ul class="item-list">
															@foreach($chunk as $prod)
																@include('includes.product.list-product')
															@endforeach
														</ul>
													</div>
												@endforeach

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Clothing and Apparel Area start-->
	@endif

	@if($ps->review_blog == 1)
		<!-- Blog Area Start -->
		<section class="blog-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="aside">
							<div class="slider-wrapper">
								<div class="aside-review-slider">
									@foreach($reviews as $review)
										<div class="slide-item">
											<div class="top-area">
												<div class="left">
													<img src="{{ $review->photo ? asset('assets/images/reviews/'.$review->photo) : asset('assets/images/noimage.png') }}" alt="">
												</div>
												<div class="right">
													<div class="content">
														<h4 class="name">{{ $review->title }}</h4>
														<p class="dagenation">{{ $review->subtitle }}</p>
													</div>
												</div>
											</div>
											<blockquote class="review-text">
												<p>
													{!! $review->details !!}
												</p>
											</blockquote>
										</div>
									@endforeach


								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						@foreach(DB::table('blogs')->orderby('views','desc')->take(2)->get() as $blogg)

							<div class="blog-box">
								<div class="blog-images">
									<div class="img">
										<img src="{{ $blogg->photo ? asset('assets/images/blogs/'.$blogg->photo):asset('assets/images/noimage.png') }}" class="img-fluid" alt="">
										<div class="date d-flex justify-content-center">
											<div class="box align-self-center">
												<p>{{date('d', strtotime($blogg->created_at))}}</p>
												<p>{{date('M', strtotime($blogg->created_at))}}</p>
											</div>
										</div>
									</div>

								</div>
								<div class="details">
									<a href='{{route('front.blogshow',$blogg->id)}}'>
										<h4 class="blog-title">
											{{mb_strlen($blogg->title,'utf-8') > 40 ? mb_substr($blogg->title,0,40,'utf-8')."...":$blogg->title}}
										</h4>
									</a>
									<p class="blog-text">
										{{substr(strip_tags($blogg->details),0,170)}}
									</p>
									<a class="read-more-btn" href="{{route('front.blogshow',$blogg->id)}}">{{ $langg->lang34 }}</a>
								</div>
							</div>

						@endforeach

					</div>
				</div>
			</div>
		</section>
		<!-- Blog Area start-->
	@endif


			<!-- Icon Section -->

			<div class="container save-section" data-aos="fade-up">
    <div class="savetime">
        <img src="{{asset('assets/images/savetime.svg')}}" />
        <div>
            <p>SAVE TIME</p>
            <p>Time is precious, OptaZoom makes it easy for you to order all your optical supplies in one place.
            </p>
        </div>
    </div>
    <div class="savetime">
        <img src="{{asset('assets/images/savemoney.svg')}}" />
        <div>
            <p>SAVE MONEY</p>
            <p>Take advantage of OptaZoom's special distributor pricing and pay less for the same products you already use.
            </p>
        </div>
    </div>
    <div class="savetime" >
        <img src="{{asset('assets/images/less.svg')}}" />
        <div>
            <p>LESS HASSLE</p>
            <p>We make it easy for you to order the items you need all in one place.</p>
        </div>
    </div>
</div>

<div class="container ">
    <div class="about-optazoom row animate__animated animate__fadeInUp" >
        <div class="about-img col-md-6" >
            <div class="col-md-12">
                <img src="{{asset('assets/images/about.png')}}"  />
            </div>
        </div>
        <div class="col-md-6" >
            <div class="col-md-12">
                <h3>About<span style="font-weight:300;"> Optazoom</span></h3>
                <p>
                            With OptaZoom, shopping for all your practice needs becomes easy. Spend less time and money ordering the same items from multiple vendors and spend more time with patients.
            <br><br>
            At OptaZoom.com we envisioned a one stop shopping experience where an ECP can have access to the entire eye care industry with the click of a button.
            <br><br>
            Well, we haven’t gotten the entire eye care industry on board yet. However, with over 50 companies ranging from frames, cases, supplies and just over 80,000 different items to choose from, we at OptaZoom.com are simplifying the buying experience for ECPS across the globe and we hope to do the same for you.
                    
                </p>
               <div class="creation-account text-right">
                    <a href="{{ asset('/about_optazoom') }}"><button type="button" class="btn ">Read more</button></a>
                </div>
            </div>
        </div>

    </div>
</div>
			<!-- End Icon Section -->

			@if($ps->featured == 1)
		<!-- Trending Item Area Start -->
		<section  class="trending">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="section-top">
							<h2 class="section-title">
								{{ $langg->lang26 }}
							</h2>
						 <!-- <a href="#" class="link">View All</a>  -->
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="trending-item-slider">
							@foreach($feature_products as $prod)
								@include('includes.product.slider-product')
							@endforeach
						</div>
					</div>

				</div>
			</div>
		</section>
		<!-- Tranding Item Area End -->
	@endif
						<!--- Featured Vendors--->
						<section class="categori-item electronics-section" id="flashdeals">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="section-top">
							<h2 class="section-title">
								{{ $langg->lang531 }}
							</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="flash-deals">
							<div class="flas-deal-slider">
							@php
				   $vendors = DB::select('select * from users where is_featured="2" ');
					foreach ($vendors as $vendor)
					{
						@endphp
						<div class="featured">
						<div class="featured-vendor">
							<a href="{{ route('front.vendor',str_replace(' ', '-', $vendor->shop_name)) }}">
								<div class="cat-img">
								<img src="{{ $vendor->photo ? asset('assets/images/users/'.$vendor->photo):asset('assets/images/noimage.png') }}" />
                               </div>
							   <hr>
								<h4 class="vendor-name"><?php echo $vendor->name ?></h4>
							</a>
						</div>
			          </div>
				@php	}
					@endphp
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
			<!-- End Featured Vendors -->

			@if($ps->flash_deal == 1)
		<!-- Electronics Area Start -->
		<section class="categori-item electronics-section" id="flashdeals">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="section-top">
							<h2 class="section-title">
								{{ $langg->lang244 }}
							</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="flash-deals">
							<div class="flas-deal-slider">

								@foreach($discount_products as $prod)
									@include('includes.product.flash-product')
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Electronics Area start-->
	@endif



			<!-- Testimonials -->
			<div class="container">
					<div class="professional-heading">
						<h3>OPTICAL PROFESSIONALS LOVE OPTAZOOM<h3>
					</div>
				<div class="main-slider-testimonials">
					<div class="professionals">
							<div class="profesional-profile">
									<div class="professional-img">
									   <img style="height:130px;" src="{{asset('assets/images/test/brand_726.png')}}">
									</div>
									<p class="testimonails-p">
									Great company, great customer service and fast shipping! Highly recommend!									</p>
									<hr>
									<h5>Cecilia Rojas</h5>
									<p> OPTICAL MANAGER

</p>
							</div>
                     </div>

					 <div class="professionals">
							<div class="profesional-profile">
									<div class="professional-img">
									   <img style="height:130px;" src="{{asset('assets/images/test/brand_725.jpg')}}">
									</div>
									<p class="testimonails-p">
									We love OptaZoom and have ordered from them several times! Super fast shipping and very responsive to messages.									</p>
									<hr>
									<h5>LaTandra Blue, O.D.</h5>
									<p>OPTOMETRIST</p>
							</div>
                     </div>

					 <div class="professionals">
							<div class="profesional-profile">
									<div class="professional-img">
									   <img style="height:130px;" src="{{asset('assets/images/test/brand_724.jpg')}}">
									</div>
									<p class="testimonails-p">
									The OptaZoom Team is an unparalleled platform that offers Eye Care Professionals (ECPs) a plethora of resources all under one roof. Not only are their leadership and support teams top notch, but their tech platform itself is innovative, user friendly, and highly resourceful. Highly recommend OptaZoom!									</p>
									<hr>
									<h5>Solomon Gould, O.D., M.B.A.</h5>
									<p> Optometrist </p>
							</div>
                     </div>

					 <div class="professionals">
							<div class="profesional-profile">
									<div class="professional-img">
									   <img style="height:130px;" src="{{asset('assets/images/test/brand_723.jpg')}}">
									</div>
									<p class="testimonails-p">
									I'm a new practice owner and just like all practice owners I needed to find vendors for all the different kinds of equipment and supplies my practice needed. It was such a difficult process, until I found OptoZoom. Their website was easy to use and allowed me to find all the vendors I needed in a very short amount of time.									</p>
									<hr>
									<h5> David Antonyan, O.D.</h5>
									<p> Optometrist </p>
							</div>
                     </div>

					 <div class="professionals">
							<div class="profesional-profile">
									<div class="professional-img">
									   <img style="height:130px;" src="{{asset('assets/images/test/brand_722.jpg')}}">
									</div>
									<p class="testimonails-p">
									I use OptaZoom for most of my supplies and I have to say that they are second to none when it comes to customer service. I highly recommend them to anybody who owns an Optometric practice.									</p>
									<hr>
									<h5>Jeffrey Taranto, O.D.</h5>
									<p> Optometrist </p>
							</div>
                     </div>
					 <div class="professionals">
							<div class="profesional-profile">
									<div class="professional-img">
									   <img style="height:130px;" src="{{asset('assets/images/test/brand_721.jpg')}}">
									</div>
									<p class="testimonails-p">
									Great customer service and prices! Website very easy to navigate!									<hr>
									<h5>Dr. Giannie Castellanos</h5>
									<p> Optometrist </p>
							</div>
                     </div>
					 <div class="professionals">
							<div class="profesional-profile">
									<div class="professional-img">
									   <img style="height:130px;" src="{{asset('assets/images/test/brand_720.jpg')}}">
									</div>
									<p class="testimonails-p">
									The Jeff Bezos of eyecare supplies. I just clicked a few buttons and bam I was able to order all my usual medical supplies for the exam lane. So long having to compare prices at 4 different sites. I just found one site for all my goods at competitive prices, finally!									<hr>
									<h5>Perry Brill</h5>
									<p>CEO AT EYETREPRENEUR & FORMER OPTICAL MANAGER</p>
							</div>
                     </div>
					 <div class="professionals">
							<div class="profesional-profile">
									<div class="professional-img">
									   <img style="height:130px;" src="{{asset('assets/images/test/brand_719.jpg')}}">
									</div>
									<p class="testimonails-p">
									The OptaZoom team has always been responsive and professional in all my interactions with them. I consider them to be a top quality vendor.	
									<hr>
									<h5>Fayiz Mahgoub, OD</h5>
									<p>OPTOMETRIST</p>
							</div>
                     </div>
					 <div class="professionals">
							<div class="profesional-profile">
									<div class="professional-img">
									   <img style="height:130px;" src="{{asset('assets/images/test/brand_718.jpg')}}">
									</div>
									<p class="testimonails-p">
									Very easy to order- no hassles and you can find anything!								
									<hr>
									<h5>Jennifer Tabiza, O.D.</h5>
									<p>OPTOMETRIST & CO-FOUNDER OF DR. CONTACT LENS</p>
							</div>
                     </div>
               </div>
			   <div class="creation-account aos-init aos-animate" data-aos="fade-up">
           				 <a href="javascript:;" data-toggle="modal" data-target="#vendor-login"><button class="btn become-vendor ">Join Free Today</button></a>
			  </div>
			<!-- Testimonials End -->
	@if($ps->partners == 1)
		<!-- Partners Area Start -->
		<section class="partners">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-top">
							<h2 class="section-title">
								{{ $langg->lang236 }}
							</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="partner-slider">
							@foreach($partners as $data)
								<div class="item-slide">
									<a href="{{ $data->link }}" target="_blank">
										<img src="{{asset('assets/images/partner/'.$data->photo)}}" alt="">
									</a>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Partners Area Start -->
	@endif

	@if($ps->service == 1)

	{{-- Info Area Start --}}
	<section class="info-area">
			<div class="container">

					@foreach($services->chunk(4) as $chunk)
	
						<div class="row">
	
							<div class="col-lg-12 p-0">
								<div class="info-big-box">
									<div class="row">
										@foreach($chunk as $service)
											<div class="col-6 col-xl-3 p-0">
												<div class="info-box">
													<div class="icon">
														<img src="{{ asset('assets/images/services/'.$service->photo) }}">
													</div>
													<div class="info">
														<div class="details">
															<h4 class="title">{{ $service->title }}</h4>
															<p class="text">
																{!! $service->details !!}
															</p>
														</div>
													</div>
												</div>
											</div>
										@endforeach
									</div>
								</div>
							</div>
	
						</div>
	
					@endforeach
	
			</div>
		</section>
		{{-- Info Area End  --}}

		@endif		

	<!-- main -->
	<script src="{{asset('assets/front/js/mainextra.js')}}"></script>