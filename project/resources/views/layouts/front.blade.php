<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(isset($page->meta_tag) && isset($page->meta_description))
        <meta name="keywords" content="{{ $page->meta_tag }}">
        <meta name="description" content="{{ $page->meta_description }}">
		<title>{{$gs->title}}</title>
    @elseif(isset($blog->meta_tag) && isset($blog->meta_description))
        <meta name="keywords" content="{{ $blog->meta_tag }}">
        <meta name="description" content="{{ $blog->meta_description }}">
		<title>{{$gs->title}}</title>
    @elseif(isset($productt))
		<meta name="keywords" content="{{ !empty($productt->meta_tag) ? implode(',', $productt->meta_tag ): '' }}">
		<meta name="description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}">
	    <meta property="og:title" content="{{$productt->name}}" />
	    <meta property="og:description" content="{{ $productt->meta_description != null ? $productt->meta_description : strip_tags($productt->description) }}" />
	    <meta property="og:image" content="{{asset('assets/images/thumbnails/'.$productt->thumbnail)}}" />
	    <meta name="author" content="GeniusOcean">
    	<title>{{substr($productt->name, 0,11)."-"}}{{$gs->title}}</title>
    @else
	    <meta name="keywords" content="{{ $seo->meta_keys }}">
	    <meta name="author" content="GeniusOcean">
		<title>{{$gs->title}}</title>
    @endif
	<!-- favicon -->
	<link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>

@if($langg->rtl == "1")

	<!-- stylesheet -->
	<link rel="stylesheet" href="{{asset('assets/front/css/rtl/all.css')}}">

    <!--Updated CSS-->
 	<link rel="stylesheet" href="{{ asset('assets/front/css/rtl/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

@else

	<!-- stylesheet -->
	<link rel="stylesheet" href="{{asset('assets/front/css/all.css')}}">
    <!--Updated CSS-->
 	<link rel="stylesheet" href="{{ asset('assets/front/css/styles.php?color='.str_replace('#','',$gs->colors).'&'.'header_color='.str_replace('#','',$gs->header_color).'&'.'footer_color='.str_replace('#','',$gs->footer_color).'&'.'copyright_color='.str_replace('#','',$gs->copyright_color).'&'.'menu_color='.str_replace('#','',$gs->menu_color).'&'.'menu_hover_color='.str_replace('#','',$gs->menu_hover_color)) }}">

@endif

	@yield('styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

</head>

<body>

@if($gs->is_loader == 1)
	<div class="preloader" id="preloader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center #FFF;"></div>
	@endif
	<div class="xloader d-none" id="xloader" style="background: url({{asset('assets/front/images/xloading.gif')}}) no-repeat scroll center center #FFF;"></div>

@if($gs->is_popup== 1)

@if(isset($visited))
    <div style="display:none">
        <img src="{{asset('assets/images/'.$gs->popup_background)}}">
    </div>

    <!--  Starting of subscribe-pre-loader Area   -->
    <div class="subscribe-preloader-wrap" id="subscriptionForm" style="display: none;">
        <div class="subscribePreloader__thumb" style="background-image: url({{asset('assets/images/'.$gs->popup_background)}});">
            <span class="preload-close"><i class="fas fa-times"></i></span>
            <div class="subscribePreloader__text text-center">
                <h1>{{$gs->popup_title}}</h1>
                <p>{{$gs->popup_text}}</p>
                <form action="{{route('front.subscribe')}}" id="subscribeform" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="email" name="email"  placeholder="{{ $langg->lang741 }}" required="">
                        <button id="sub-btn" type="submit">{{ $langg->lang742 }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  Ending of subscribe-pre-loader Area   -->

@endif

@endif


	<section class="top-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 remove-padding">
					<div class="content">
						<div class="left-content">
							<div class="list">
							<i class="icofont-phone circle-icon"  aria-hidden="true"></i> <span>Customer Support: </span><a href="#" style="color:black"><b> 844-700-9666</b></a>
							</div>
						</div>
						<div class="right-content">
						<ul class="ht-menu">
                                    <!-- Begin Setting Area -->
                                    <li>
                                        <a href="https://www.facebook.com/optazoom/" target="_blank">
                                            <i class="icofont-facebook circle-icon-fb"></i>
                                        </a>
                                    </li>
                                    <!-- Setting Area End Here -->
                                    <li>
                                        <a href="https://www.youtube.com/channel/UCK0vZ9a4iXMJ3tr1bMSpFyA" target="_blank">
                                            <i class="icofont-brand-youtube circle-icon"></i>
                                        </a>
                                    </li>
                                    <!-- Begin Language Area -->
                                    <li>
                                        <a href="https://www.instagram.com/optazoom/?hl=en" target="_blank">
                                            <i class="icofont-instagram circle-icon"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/optazoom?lang=en" target="_blank">
                                            <i class="icofont-twitter circle-icon"></i>
                                        </a>
                                    </li>
                                    <!-- Language Area End Here -->
                                </ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Top Header Area End -->
	<!-- Logo Header Area Start -->
	<section class="logo-header">
		<div class="container">
			<div class="row ">
				<div class="col-lg-3 col-sm-6 col-12 remove-padding">
					<div class="logo">
						<a href="{{ route('front.indexx') }}">
							<img src="{{asset('assets/images/'.$gs->logo)}}" alt="">
						</a>
					</div>
				</div>
					<?php
						$categoriess = DB::table('categories')->orderby('name','ASC')->get();
					?>
				<div class="col-lg-6 col-sm-12 remove-padding order-sm-2 order-md-2">
					<div class="search-box-wrapper">
						<div class="search-box">
							<div class="categori-container" id="catSelectForm">
								<select name="category" id="category_select" class="categoris">
									<option value="Category">{{ $langg->lang1 }}</option>
									@foreach($categoriess as $data)
									<option value="{{ $data->slug }}" {{ Request::route('category') == $data->slug ? 'selected' : '' }}>{{ $data->name }}</option>
									@endforeach
								</select>
							</div>

							<form id="searchForm" class="search-form" action="{{ route('front.category', [Request::route('category'),Request::route('subcategory'),Request::route('childcategory')]) }}" method="GET">
								@if (!empty(request()->input('sort')))
									<input type="hidden" name="sort" value="{{ request()->input('sort') }}">
								@endif
								@if (!empty(request()->input('minprice')))
									<input type="hidden" name="minprice" value="{{ request()->input('minprice') }}">
								@endif
								@if (!empty(request()->input('maxprice')))
									<input type="hidden" name="maxprice" value="{{ request()->input('maxprice') }}">
								@endif
								<input type="text" id="prod_name" name="search" placeholder="{{ $langg->lang2 }}" value="{{ request()->input('search') }}" autocomplete="off">
								<div class="autocomplete">
								  <div id="myInputautocomplete-list" class="autocomplete-items">
								  </div>
								</div>
								<button type="submit"><img src="{{asset('assets/images/search.png')}}" class="search"></button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 col-12 remove-padding order-lg-last">
					<div class="helpful-links">
						<ul class="helpful-links-inner">
						@if(!Auth::guard('web')->check())
									<li class="login">
										<a href="{{ route('user.login') }}" class="sign-log">
											<div class="">
												<span class="sign-in">{{ $langg->lang12 }}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>/</span>
												<span></span>
											</div>
										</a>
									</li>
									@else
										<!-- <li class="profilearea my-dropdown">
											<a href="javascript: ;" id="profile-icon" class="profile carticon">
												<span class="text">
													<i class="far fa-user"></i>	{{ $langg->lang11 }} <i class="fas fa-chevron-down"></i>
												</span>
											</a>
											<div class="my-dropdown-menu profile-dropdown">
												<ul class="profile-links">
													<li>
														<a href="{{ route('user-dashboard') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang221 }}</a>
													</li>
													@if(Auth::user()->IsVendor())
													<li>
														<a href="{{ route('vendor-dashboard') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang222 }}</a>
													</li>
													@endif

													<li>
														<a href="{{ route('user-profile') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang205 }}</a>
													</li>

													<li>
														<a href="{{ route('user-logout') }}"><i class="fas fa-angle-double-right"></i> {{ $langg->lang223 }}</a>
													</li>
												</ul>
											</div>
										</li> -->
										<div class="dropdown">
										<a href="javascript: ;" id="profile-icon" class="profile carticon">
												<span class="text">
													{{ $langg->lang11 }} <i class="fas fa-chevron-down"></i>
												</span>
											</a>
											<div class="dropdown-content">
											<a href="{{ route('user-dashboard') }}">{{ $langg->lang221 }}</a>
											@if(Auth::user()->IsVendor())
														<a href="{{ route('vendor-dashboard') }}">{{ $langg->lang222 }}</a>
													@endif
											<a href="{{ route('user-profile') }}"> {{ $langg->lang205 }}</a>
											<a href="{{ route('user-logout') }}"> {{ $langg->lang223 }}</a>

										</div>
									     </div>

									@endif

									@if(!Auth::user())
									<li class="login">
										<a href="{{ route('user.login') }}" class="sign-logs">
											<div class="">
												<span class="sign-in">LOG IN</span>
												<span></span>
											</div>
										</a>
									</li>
									@endif

                        			<!-- @if($gs->reg_vendor == 1)
										<li>
                        				@if(Auth::check())
	                        				@if(Auth::guard('web')->user()->is_vendor == 2)
	                        					<a href="{{ route('vendor-dashboard') }}" class="sell-btn">{{ $langg->lang220 }}</a>
	                        				@else
	                        					<a href="{{ route('user-package') }}" class="sell-btn">{{ $langg->lang220 }}</a>
	                        				@endif
										</li>
                        				@else
										<li>
											<a href="javascript:;" data-toggle="modal" data-target="#vendor-login" class="sell-btn">{{ $langg->lang220 }}</a>
										</li>
										@endif
									@endif -->

							<li class="my-dropdown"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang3 }}">
								<a href="{{route('front.cart')}}" class="cart carticon">
									<div class="icon">

									<img src="{{asset('assets/images/Cart.svg')}}" height="35"/>
										<span class="cart-quantity" id="cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
									</div>

								</a>
								<div class="my-dropdown-menu" id="cart-items">
									@include('load.cart')
								</div>
							</li>
							 <li class="wishlist"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang9 }}">
								@if(Auth::guard('web')->check())
									<a href="{{ route('user-wishlists') }}" class="wish">
									<img src="{{asset('assets/images/heart_b.svg')}}" height="30"/>
										<span id="wishlist-count">{{ Auth::user()->wishlistCount() }}</span>
									</a>
								@else
									<!-- <a href="javascript:;" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" class="wish">
									<img src="{{asset('assets/images/heart_b.svg')}}" height="30"/>

										<span id="wishlist-count">0</span>
									</a> -->
								@endif
							</li>
							 <!-- <li class="compare"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang10 }}">
								<a href="{{ route('product.compare') }}" class="wish compare-product">
									<div class="icon">
										<i class="fas fa-exchange-alt"></i>
										<span id="compare-count">{{ Session::has('compare') ? count(Session::get('compare')->items) : '0' }}</span>
									</div>
								</a>
							</li> -->


						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Logo Header Area End -->

	      <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Begin Header Bottom Menu Area -->
                            <div class="hb-menu">
								<nav class="navbar navbar-expand-sm">
										<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarmenu">
											<span class="navbar-toggler-icon"></span>
										</button>
										<div class="collapse navbar-collapse" id="navbarmenu">
											<ul class="navbar-nav">
												<li class="nav-item arrow-icon"><a href="{{url('category')}}"> All Products</a></li>

												<li class="nav-item arrow-icon"> <a href="{{ route('front.featured')}}">Featured Products</a></li>
												<li class="nav-item arrow-icon"><a id="check" href="{{ route('front.flash')}}">Flash Deals</a></li>
												<li class="nav-item arrow-icon"><a href="{{ route('user.optanews') }}">OptaNews</a></li>
												<li class="nav-item arrow-icon"><a href="{{ route('front.vendorlist') }}">Vendors</a></li>
											</ul>
										</div>
								</nav>
                            </div>
                            <!-- Header Bottom Menu Area End Here -->
                        </div>
                    </div>
                </div>
           </div>
            <!-- Header Bottom Area End Here -->
            <!-- Begin Mobile Menu Area -->
            <div class="mobile-menu-area d-lg-none d-xl-none col-12">
                <div class="container">
                    <div class="row">
                        <div class="mobile-menu">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area End Here -->

@yield('content')

	<!-- Footer Area Start -->
	<footer class="footer" id="footer">
		<div class="container-fluid">
			<div class="row footer-wrap">

				<div class="col-md-6 col-lg-2">
				<div class="footer-widget info-link-widget">
						<h4 class="title">
								{{ $langg->lang21 }}
						</h4>
						<ul class="link-list">
						<li>
								<a href="{{ asset('/about_optazoom') }}">
									</i>About Optazoom
								</a>
							</li>


							@foreach(DB::table('pages')->where('footer','=',1)->get() as $data)
							<li>
								<a href="{{ route('front.page',$data->slug) }}">
									{{ $data->title }}
								</a>
							</li>
							@endforeach
						</ul>
					</div>
					<div class="footer-info-area">
						<!-- <div class="footer-logo">
							<a href="{{ route('front.index') }}" class="logo-link">
								<img src="{{asset('assets/images/'.$gs->footer_logo)}}" alt="">
							</a>
						</div>
						<div class="text">
							<p>
									{!! $gs->footer !!}
							</p>
						</div> -->
					</div>
					<!-- <div class="fotter-social-links">
						<ul>

                               	     @if($socialsetting->f_status == 1)
                                      <li>
                                        <a href="{{ $socialsetting->facebook }}" class="facebook" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if($socialsetting->g_status == 1)
                                      <li>
                                        <a href="{{ $socialsetting->gplus }}" class="google-plus" target="_blank">
                                            <i class="fab fa-google-plus-g"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if($socialsetting->t_status == 1)
                                      <li>
                                        <a href="{{ $socialsetting->twitter }}" class="twitter" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if($socialsetting->l_status == 1)
                                      <li>
                                        <a href="{{ $socialsetting->linkedin }}" class="linkedin" target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                      </li>
                                      @endif

                                      @if($socialsetting->d_status == 1)
                                      <li>
                                        <a href="{{ $socialsetting->dribble }}" class="dribbble" target="_blank">
                                            <i class="fab fa-dribbble"></i>
                                        </a>
                                      </li>
                                      @endif

						</ul>
					</div> -->
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="footer-widget info-link-widget">
						<h4 class="title">
								SERVICES
						</h4>
						<ul class="link-list">
							<li>
							<a href="{{ route('user.login')}}">Practitioner Log In	</a>
							</li>

							<li>
							<a href="javascript:;" data-toggle="modal" data-target="#vendor-login">Vendor Log In</a>
							</li>
							<li>
							<a href="{{ route('user.optanews')}}">Optazoom News</a>
							</li>
							<li>
							<a  href="javascript:;" data-toggle="modal" data-target="#vendor-login">Become a Vendor</a>
							</li>
							<li>
							<a href="{{ route('user-forgot')}}">Reset Password</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="footer-widget recent-post-widget">
						<h4 class="title">
							{{ $langg->lang24 }}
						</h4>
						<ul style="overflow:auto;width:auto;height:200px; padding-right:10px;">

						<?php

	// $url = 'https://visionmonday.com/rss/eyecare/';
	// $rss = Feed::loadRss($url);
	$rss = DB::table('news_feed')->get();

	if(isset($rss))
	{

	foreach ($rss as $item )
	{

	?>

                      <p class="li-blog-heading pt-xs-25 pt-sm-25"><a class="a_title" href="<?php echo 'news_feed_detail?title='.$item->title.'&link='.$item->link; ?>">{{$item->title}}</a></p>

					  <?php
						}
					}
					?>
				  </ul>
					</div>
				</div>
				<div class="col-md-6 col-lg-2">
					<div class="footer-widget recent-post-widget">
						<h4 class="title">
							CONTACT
						</h4>
						<div class="footer-static-middle">
						<ul class="des">

							<li>
								<span><i class="fa fa-envelope"></i></span>
								&nbsp <a href="mailto://info@yourdomain.com">info@optazoom.com</a>
							</li>
							<li>
								<span><b><i class="fa fa-phone"></i></b> </span>
								&nbsp  <a href="#">844-700-9666</a>
							</li>
							</ul>
</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-2">
					<div class="footer-widget recent-post-widget">
						<h4 class="title">
							NEWSLETTER
						</h4>
						<p class="footer-text" style="color:#888;">
                                        Get Updates by subscribing to our news letter
                                    </p>
									<!-- <form action="{{ route('admin-gs-update') }}" id="geniusform" method="POST" enctype="multipart/form-data"> -->
                                        <div id="mc_embed_signup_scroll">
                                            <div id="mc-form" class="mc-form subscribe-form">
												<input type="email" class="newsleter-filter_input" name="email"  placeholder="{{ $langg->lang741 }}" required="">
                                                 <button id="sub-btn" class="btn btn-sm subscribe-btn" type="submit">{{ $langg->lang742 }}</button>
                                            </div>
                                        </div>
                                    <!-- </form> -->
					</div>
				</div>
			</div>
		</div>

		<div class="copy-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 col-md-8">
							<div class="content">
								<div class="content">
									<p>{!! $gs->copyright !!}</p>
							    </div>
						   </div>
					</div>
					<div class="col-lg-3 col-md-4 copy">
                            <!-- Footer Links Area End Here -->
                            <!-- Begin Footer Payment Area -->
                            <div class="copyright">
                                <div class="footer-images d-flex m-20">
                                    <a href="#">
                                        <img src="{{asset('assets/images/paypal.png')}}" width="40" alt="">
                                    </a>
                                    <a href="#">
                                        <img src="{{asset('assets/images/visa.png')}}" width="40" alt="">
                                    </a>
                                    <a href="#">
                                        <img src="{{asset('assets/images/debit.png')}}" width="40" alt="">
                                    </a>
                                    <a href="#">
                                        <img src="{{asset('assets/images/american.png')}}" width="40" alt="">
                                    </a>
                                </div>
                            </div>

                            <!-- Copyright Area End Here -->
                        </div>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer Area End -->

	<!-- Back to Top Start -->
	<div class="bottomtotop">
		<i class="fas fa-chevron-right"></i>
	</div>
	<!-- Back to Top End -->

	<!-- LOGIN MODAL -->
	<div class="modal fade" id="comment-log-reg" tabindex="-1" role="dialog" aria-labelledby="comment-log-reg-Title"
		aria-hidden="true">
		<div class="modal-dialog  modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<nav class="comment-log-reg-tabmenu">
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link login active" id="nav-log-tab1" data-toggle="tab" href="#nav-log1"
								role="tab" aria-controls="nav-log" aria-selected="true">
								{{ $langg->lang197 }}
							</a>
							<a class="nav-item nav-link" id="nav-reg-tab1" data-toggle="tab" href="#nav-reg1" role="tab"
								aria-controls="nav-reg" aria-selected="false">
								{{ $langg->lang198 }}
							</a>
						</div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-log1" role="tabpanel"
							aria-labelledby="nav-log-tab1">
							<div class="login-area">
								<div class="header-area">
									<h4 class="title">{{ $langg->lang172 }}</h4>
								</div>
								<div class="login-form signin-form">
									@include('includes.admin.form-login')
									<form class="mloginform" action="{{ route('user.login.submit') }}" method="POST">
										{{ csrf_field() }}
										<div class="form-input">
											<input type="email" name="email" placeholder="{{ $langg->lang173 }}"
												required="">
											<i class="icofont-user-alt-5"></i>
										</div>
										<div class="form-input">
											<input type="password" class="Password" name="password"
												placeholder="{{ $langg->lang174 }}" required="">
											<i class="icofont-ui-password"></i>
										</div>
										<div class="form-forgot-pass">
											<div class="left">
												<input type="checkbox" name="remember" id="mrp"
													{{ old('remember') ? 'checked' : '' }}>
												<label for="mrp">{{ $langg->lang175 }}</label>
											</div>
											<div class="right">
												<a href="javascript:;" id="show-forgot">
													{{ $langg->lang176 }}
												</a>
											</div>
										</div>
										<input type="hidden" name="modal" value="1">
										<input class="mauthdata" type="hidden" value="{{ $langg->lang177 }}">
										<button type="submit" class="submit-btn">{{ $langg->lang178 }}</button>
										@if($socialsetting->f_check == 1 ||
										$socialsetting->g_check == 1)
										<div class="social-area">
											<h3 class="title">{{ $langg->lang179 }}</h3>
											<p class="text">{{ $langg->lang180 }}</p>
											<ul class="social-links">
												@if($socialsetting->f_check == 1)
												<li>
													<a href="{{ route('social-provider','facebook') }}">
														<i class="fab fa-facebook-f"></i>
													</a>
												</li>
												@endif
												@if($socialsetting->g_check == 1)
												<li>
													<a href="{{ route('social-provider','google') }}">
														<i class="fab fa-google-plus-g"></i>
													</a>
												</li>
												@endif
											</ul>
										</div>
										@endif
									</form>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="nav-reg1" role="tabpanel" aria-labelledby="nav-reg-tab1">
							<div class="login-area signup-area">
								<div class="header-area">
									<h4 class="title">{{ $langg->lang181 }}</h4>
								</div>
								<div class="login-form signup-form">
									@include('includes.admin.form-login')
									<form class="mregisterform" action="{{route('user-register-submit')}}"
										method="POST">
										{{ csrf_field() }}

										<div class="form-input">
											<input type="text" class="User Name" name="name"
												placeholder="{{ $langg->lang182 }}" required="">
											<i class="icofont-user-alt-5"></i>
										</div>

										<div class="form-input">
											<input type="email" class="User Name" name="email"
												placeholder="{{ $langg->lang183 }}" required="">
											<i class="icofont-email"></i>
										</div>

										<div class="form-input">
											<input type="text" class="User Name" name="phone"
												placeholder="{{ $langg->lang184 }}" required="">
											<i class="icofont-phone"></i>
										</div>

										<div class="form-input">
											<input type="text" class="User Name" name="address"
												placeholder="{{ $langg->lang185 }}" required="">
											<i class="icofont-location-pin"></i>
										</div>

										<div class="form-input">
											<input type="password" class="Password" name="password"
												placeholder="{{ $langg->lang186 }}" required="">
											<i class="icofont-ui-password"></i>
										</div>

										<div class="form-input">
											<input type="password" class="Password" name="password_confirmation"
												placeholder="{{ $langg->lang187 }}" required="">
											<i class="icofont-ui-password"></i>
										</div>


										@if($gs->is_capcha == 1)

										<ul class="captcha-area">
											<li>
												<p><img class="codeimg1"
														src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i
														class="fas fa-sync-alt pointer refresh_code "></i></p>
											</li>
										</ul>

										<div class="form-input">
											<input type="text" class="Password" name="codes"
												placeholder="{{ $langg->lang51 }}" required="">
											<i class="icofont-refresh"></i>
										</div>



										@endif

										<input class="mprocessdata" type="hidden" value="{{ $langg->lang188 }}">
										<button type="submit" class="submit-btn">{{ $langg->lang189 }}</button>

									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- LOGIN MODAL ENDS -->

	<!-- FORGOT MODAL -->
	<div class="modal fade" id="forgot-modal" tabindex="-1" role="dialog" aria-labelledby="comment-log-reg-Title"
		aria-hidden="true">
		<div class="modal-dialog  modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="login-area">
						<div class="header-area forgot-passwor-area">
							<h4 class="title">{{ $langg->lang191 }} </h4>
							<p class="text">{{ $langg->lang192 }} </p>
						</div>
						<div class="login-form">
							@include('includes.admin.form-login')
							<form id="mforgotform" action="{{route('user-forgot-submit')}}" method="POST">
								{{ csrf_field() }}
								<div class="form-input">
									<input type="email" name="email" class="User Name"
										placeholder="{{ $langg->lang193 }}" required="">
									<i class="icofont-user-alt-5"></i>
								</div>
								<div class="to-login-page">
									<a href="javascript:;" id="show-login">
										{{ $langg->lang194 }}
									</a>
								</div>
								<input class="fauthdata" type="hidden" value="{{ $langg->lang195 }}">
								<button type="submit" class="submit-btn">{{ $langg->lang196 }}</button>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- FORGOT MODAL ENDS -->


<!-- VENDOR LOGIN MODAL -->
	<div class="modal fade" id="vendor-login" tabindex="-1" role="dialog" aria-labelledby="vendor-login-Title" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" style="transition: .5s;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<nav class="comment-log-reg-tabmenu">
					<div class="nav nav-tabs" id="nav-tab1" role="tablist">
						<a class="nav-item nav-link login active" id="nav-log-tab11" data-toggle="tab" href="#nav-log11" role="tab" aria-controls="nav-log" aria-selected="true">
							{{ $langg->lang234 }}
						</a>
						<a class="nav-item nav-link" id="nav-reg-tab11" data-toggle="tab" href="#nav-reg11" role="tab" aria-controls="nav-reg" aria-selected="false">
							{{ $langg->lang235 }}
						</a>
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-log11" role="tabpanel" aria-labelledby="nav-log-tab">
				        <div class="login-area">
				          <div class="login-form signin-form">
				                @include('includes.admin.form-login')
				            <form class="mloginform" action="{{ route('user.login.submit') }}" method="POST">
				              {{ csrf_field() }}
				              <div class="form-input">
				                <input type="email" name="email" placeholder="{{ $langg->lang173 }}" required="">
				                <i class="icofont-user-alt-5"></i>
				              </div>
				              <div class="form-input">
				                <input type="password" class="Password" name="password" placeholder="{{ $langg->lang174 }}" required="">
				                <i class="icofont-ui-password"></i>
				              </div>
				              <div class="form-forgot-pass">
				                <div class="left">
				                  <input type="checkbox" name="remember"  id="mrp1" {{ old('remember') ? 'checked' : '' }}>
				                  <label for="mrp1">{{ $langg->lang175 }}</label>
				                </div>
				                <div class="right">
				                  <a href="javascript:;" id="show-forgot1">
				                    {{ $langg->lang176 }}
				                  </a>
				                </div>
				              </div>
				              <input type="hidden" name="modal"  value="1">
				               <input type="hidden" name="vendor"  value="1">
				              <input class="mauthdata" type="hidden"  value="{{ $langg->lang177 }}">
				              <button type="submit" class="submit-btn">{{ $langg->lang178 }}</button>
					              @if($socialsetting->f_check == 1 || $socialsetting->g_check == 1)
					              <div class="social-area">
					                  <h3 class="title">{{ $langg->lang179 }}</h3>
					                  <p class="text">{{ $langg->lang180 }}</p>
					                  <ul class="social-links">
					                    @if($socialsetting->f_check == 1)
					                    <li>
					                      <a href="{{ route('social-provider','facebook') }}">
					                        <i class="fab fa-facebook-f"></i>
					                      </a>
					                    </li>
					                    @endif
					                    @if($socialsetting->g_check == 1)
					                    <li>
					                      <a href="{{ route('social-provider','google') }}">
					                        <i class="fab fa-google-plus-g"></i>
					                      </a>
					                    </li>
					                    @endif
					                  </ul>
					              </div>
					              @endif
				            </form>
				          </div>
				        </div>
					</div>
					<div class="tab-pane fade" id="nav-reg11" role="tabpanel" aria-labelledby="nav-reg-tab">
                <div class="login-area signup-area">
                    <div class="login-form signup-form">
                       @include('includes.admin.form-login')
                        <form class="mregisterform" action="{{route('user-register-submit')}}" method="POST">
                          {{ csrf_field() }}

                          <div class="row">

                          <div class="col-lg-6">
                            <div class="form-input">
                                <input type="text" class="User Name" name="name" placeholder="First Name" required="">
                                <i class="icofont-user-alt-5"></i>
                            	</div>
                           </div>
                            <div class="col-lg-6">
                           <div class="form-input">
                                <input type="text" class="User Name" name="l_name" placeholder="Last Name" required="">
                                <i class="icofont-user-alt-5"></i>
                            	</div>
                           </div>

                           <div class="col-lg-6">
 <div class="form-input">
                                <input type="email" class="User Name" name="email" placeholder="{{ $langg->lang183 }}" required="">
                                <i class="icofont-email"></i>
                            </div>

                           	</div>
                           <div class="col-lg-6">
    <div class="form-input">
                                <input type="text" class="User Name" name="phone" placeholder="Mobile Number" required="">
                                <i class="icofont-phone"></i>
                            </div>

                           	</div>
                          <!--  <div class="col-lg-6">

<div class="form-input">
                                <input type="text" class="User Name" name="address" placeholder="{{ $langg->lang185 }}" required="">
                                <i class="icofont-location-pin"></i>
                            </div>
                           	</div> -->

                           <div class="col-lg-6">
 <div class="form-input">
                                <input type="text" class="User Name" name="shop_name" placeholder="Company" required="">
                                <i class="icofont-cart-alt"></i>
                            </div>

                           	</div>
                           <div class="col-lg-6">

 <div class="form-input">
                                <input type="text" class="User Name" name="website" placeholder="Website">
                                <i class="icofont-cart"></i>
                            </div>
                           	</div>
                           <div class="col-lg-12">

<div class="form-input">

                                    <label>Select Supplier Category (You can check more then one)</label>
                                    <div style="border-bottom: 1px solid #cfcfcf;"></div>
                                    <span class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input type="checkbox" id="cases" name="category[]" value="case">
                                        <label for="cases">Cases</label>

                                    </span>
                                    <span class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input type="checkbox" id="frames" name="category[]" value="frames">
                                        <label for="frames">Frames</label>

                                    </span>
                                    <span class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input type="checkbox" id="supplies" name="category[]" value="supplies">
                                        <label for="supplies">Supplies</label>

                                    </span>
                                    <span class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input type="checkbox" id="lenses" name="category[]" value="lenses">
                                        <label for="lenses">Contact Lenses</label>

                                    </span>
                                    <span class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input type="checkbox"  id="all" name="category[]" value="all">
                                        <label for="all">All</label>

                                    </span>


                                    <span class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input type="checkbox" id="other" name="category[]" value="other">
                                        <label for="other">Others</label>
                                    </span>



                            </div>
                           	</div>
                         <!--   <div class="col-lg-6">

 <div class="form-input">
                                <input type="text" class="User Name" name="shop_address" placeholder="{{ $langg->lang241 }}" required="">
                                <i class="icofont-opencart"></i>
                            </div>
                           	</div> -->
                          <!--  <div class="col-lg-6">

<div class="form-input">
                                <input type="text" class="User Name" name="reg_number" placeholder="{{ $langg->lang242 }}" required="">
                                <i class="icofont-ui-cart"></i>
                            </div>
                           	</div> -->
                           <div class="col-lg-6">

<div class="form-input">
                      <select style=" width: 100%;height: 50px;
    background: #f3f8fc;
    padding: 0px 30px 0px 10px;
    border: 1px
    solid rgba(0, 0, 0, 0.1);
    font-size: 14px;" class="User Name" placeholder="How Did You Hear About Us?" name="hear_from">
                        <option  value="">How Did You Hear About Us?</option>
						<option value="google">Google</option>
						<option value="facebook">Facebook</option>
                        <option value="instagram">Instagram</option>
						<option value="referral_from_colleague">Referral from Colleague </option>
						<option value="kristie_nguyen">Kristie Nguyen</option>
                      </select>

                  </div>
                           	</div>

<div class="col-lg-6">
	<div class="form-input">
              <select style=" width: 100%;height: 50px;
			    background: #f3f8fc;
			    padding: 0px 30px 0px 45px;
			    border: 1px
			    solid rgba(0, 0, 0, 0.1);
			    font-size: 14px;" class="User Name" placeholder="How Did You Hear About Us?" name="country">
                <option  value="">Country(Optional)</option>
                <option value="usa">USA</option>
                <option value="uae">UAE</option>
                <option value="uk">United Kingdom</option>
              </select>

    </div>
</div>

                           <div class="col-lg-6">
  <div class="form-input">
                                <input type="password" class="Password" name="password" placeholder="{{ $langg->lang186 }}" required="">
                                <i class="icofont-ui-password"></i>
                            </div>

                           	</div>
                           <div class="col-lg-6">
 								<div class="form-input">
                                <input type="password" class="Password" name="password_confirmation" placeholder="{{ $langg->lang187 }}" required="">
                                <i class="icofont-ui-password"></i>
                            	</div>
                           	</div>
							   <div class="from-input">
                   <input type="checkbox" id="opta-vendor" name="opta-login" value="opta-vendor">
                   <label for="opta-vendor"> By submitting this form, I agree to the <span style="color:#fdac38;"><a href="{{asset('/privacy')}}">Privacy Policy</a></span> of OptaZoom</label><br>
                 </div>

                            @if($gs->is_capcha == 1)

<!-- <div class="col-lg-6">


                            <ul class="captcha-area">
                                <li>
                                 	<p>
                                 		<img class="codeimg1" src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i class="fas fa-sync-alt pointer refresh_code "></i>
                                 	</p>

                                </li>
                            </ul>


</div> -->

<!-- <div class="col-lg-6">

 <div class="form-input">
                                <input type="text" class="Password" name="codes" placeholder="{{ $langg->lang51 }}" required="">
                                <i class="icofont-refresh"></i>

                            </div>



                          </div> -->

                          @endif

				            <input type="hidden" name="vendor"  value="1">
                            <input class="mprocessdata" type="hidden"  value="{{ $langg->lang188 }}">
                            <button type="submit" class="submit-btn">{{ $langg->lang189 }}</button>

                           	</div>




                        </form>
                    </div>
                </div>
					</div>
				</div>
      </div>
    </div>
  </div>
</div>
<!-- VENDOR LOGIN MODAL ENDS -->

<!-- Product Quick View Modal -->

	  <div class="modal fade" id="quickview" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog quickview-modal modal-dialog-centered modal-lg" role="document">
		  <div class="modal-content">
			<div class="submit-loader">
				<img src="{{asset('assets/images/'.$gs->loader)}}" alt="">
			</div>
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
				<div class="container quick-view-modal">

				</div>
			</div>
		  </div>
		</div>
	  </div>
<!-- Product Quick View Modal -->

<!-- Order Tracking modal Start-->
    <div class="modal fade" id="track-order-modal" tabindex="-1" role="dialog" aria-labelledby="order-tracking-modal" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"> <b>{{ $langg->lang772 }}</b> </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                        <div class="order-tracking-content">
                            <form id="track-form" class="track-form">
                                {{ csrf_field() }}
                                <input type="text" id="track-code" placeholder="{{ $langg->lang773 }}" required="">
                                <button type="submit" class="mybtn1">{{ $langg->lang774 }}</button>
                                <a href="#"  data-toggle="modal" data-target="#order-tracking-modal"></a>
                            </form>
                        </div>

                        <div>
				            <div class="submit-loader d-none">
								<img src="{{asset('assets/images/'.$gs->loader)}}" alt="">
							</div>
							<div id="track-order">

							</div>
                        </div>

            </div>
            </div>
        </div>
    </div>
<!-- Order Tracking modal End -->

<script type="text/javascript">
  var mainurl = "{{url('/')}}";
  var gs      = {!! json_encode(\App\Models\Generalsetting::first()->makeHidden(['stripe_key', 'stripe_secret', 'smtp_pass', 'instamojo_key', 'instamojo_token', 'paystack_key', 'paystack_email', 'paypal_business', 'paytm_merchant', 'paytm_secret', 'paytm_website', 'paytm_industry', 'paytm_mode', 'molly_key', 'razorpay_key', 'razorpay_secret'])) !!};
  var langg    = {!! json_encode($langg) !!};
</script>

	<!-- jquery -->
	{{-- <script src="{{asset('assets/front/js/all.js')}}"></script> --}}
	<script src="{{asset('assets/front/js/jquery.js')}}"></script>
	<script src="{{asset('assets/front/js/vue.js')}}"></script>
	<script src="{{asset('assets/front/jquery-ui/jquery-ui.min.js')}}"></script>
	<!-- popper -->
	<script src="{{asset('assets/front/js/popper.min.js')}}"></script>
	<!-- bootstrap -->
	<script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
	<!-- plugin js-->
	<script src="{{asset('assets/front/js/plugin.js')}}"></script>

	<script src="{{asset('assets/front/js/xzoom.min.js')}}"></script>
	<script src="{{asset('assets/front/js/jquery.hammer.min.js')}}"></script>
	<script src="{{asset('assets/front/js/setup.js')}}"></script>

	<script src="{{asset('assets/front/js/toastr.js')}}"></script>
	<!-- main -->
	<script src="{{asset('assets/front/js/main.js')}}"></script>
	<!-- custom -->
	<script src="{{asset('assets/front/js/custom.js')}}"></script>


    {!! $seo->google_analytics !!}

	@if($gs->is_talkto == 1)
		<!--Start of Tawk.to Script-->
		{!! $gs->talkto !!}
		<!--End of Tawk.to Script-->
	@endif

	@yield('scripts')


	<script type="text/javascript">
  $(".tabs").keyup(function () {

    if (this.value.length == this.maxLength) {
      var $next = $(this).next('.tabs');
      if ($next.length)
          $(this).next('.tabs').focus();
      else
          $(this).blur();
    }
});
</script>

</body>

</html>
