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
<!-- <link rel="stylesheet" type="text/css" href="http://kenwheeler.github.io/slick/slick/slick-theme.css"/> -->

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
						<a href="{{ route('front.index') }}">
							<img src="{{asset('assets/images/'.$gs->logo)}}" alt="">
						</a>
					</div>
				</div>
				<div class="col-lg-6 col-sm-12 remove-padding order-last order-sm-2 order-md-2">
					<div class="search-box-wrapper">
						<div class="search-box">
							<div class="categori-container" id="catSelectForm">
								<select name="category" id="category_select" class="categoris">
									<option value="">{{ $langg->lang1 }}</option>
									@foreach($categories as $data)
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
                                <nav style="display:block;">
                                    <ul>
                                        <li class="arrow-icon">
                                        <a href="{{url('category')}}">All Categories</a>
                                          
                                        </li>
                                        <li class="arrow-icon"><a href="{{url('category')}}">Featured Products</a></li>
                                        <li class="dropdown-holder"><a href="javascript:void(0)">Deals</a>
                                            <ul class="hb-dropdown feature-hb-deals">
                                                <div class="main-section-deals">
                                                    <div class="featureicon">
                                                        <a href="#">
                                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                            viewBox="0 0 41 50" style="enable-background:new 0 0 41 50;" xml:space="preserve">
                                                        <style type="text/css">
                                                            .st0{fill-rule:evenodd;clip-rule:evenodd;fill:#909090;}
                                                        </style>
                                                        <g>
                                                            <path class="st0" d="M28.8,20c-1.1-2.3-2.5-4.4-4.3-6.2c-0.1-0.1-0.3-0.2-0.5-0.3c-0.2,0-0.4,0-0.5,0c-0.2,0.1-0.4,0.2-0.5,0.3
                                                                c-0.1,0.2-0.2,0.3-0.2,0.5c-0.1,2.4-0.9,4.7-2.3,6.7c-1.1,1-2,2.1-2.9,3.3c-0.6,1-1.1,2-1.5,3.1c-0.4-0.9-0.7-2-0.7-3
                                                                c0-0.2-0.1-0.4-0.2-0.5c-0.1-0.2-0.3-0.3-0.5-0.4c-0.2-0.1-0.4-0.1-0.6-0.1c-0.2,0-0.4,0.1-0.5,0.3c-2.3,2.3-4,5.1-4.9,8.2
                                                                c0,0.1,0,0.2,0,0.3c0,0.1,0,0.2,0.1,0.3C8.9,32.8,9,32.9,9.1,33c0.1,0.1,0.2,0.1,0.3,0.1c0.2,0.1,0.5,0,0.7-0.1
                                                                c0.2-0.1,0.3-0.3,0.4-0.5c0.6-2.4,1.8-4.7,3.4-6.7c0.2,1.3,0.8,2.5,1.7,3.6c0.1,0.1,0.3,0.3,0.5,0.3c0.2,0.1,0.4,0.1,0.6,0
                                                                c0.2,0,0.4-0.1,0.5-0.3c0.1-0.1,0.2-0.3,0.3-0.5c0.3-1.4,0.9-2.8,1.7-4c0.9-1.1,1.8-2.1,2.8-3.1c1.3-1.8,2.1-3.8,2.4-6
                                                                c1.2,1.5,2.2,3.1,3,4.8c0.1,0.2,0.3,0.4,0.5,0.5c0.2,0.1,0.5,0.1,0.7,0c0.2-0.1,0.4-0.3,0.4-0.5C28.9,20.5,28.9,20.2,28.8,20
                                                                L28.8,20z"/>
                                                            <path class="st0" d="M17.6,43.3c0.2,0.1,0.5,0.1,0.7,0c0.2-0.1,0.4-0.3,0.5-0.5l5-11.6c0.1-0.1,0.1-0.2,0.2-0.3c0-0.1,0-0.3,0-0.4
                                                                c0-0.1-0.1-0.2-0.2-0.3c-0.1-0.1-0.2-0.2-0.3-0.2c-0.2-0.1-0.5-0.1-0.7,0c-0.2,0.1-0.4,0.3-0.5,0.5l-5,11.6
                                                                c-0.1,0.1-0.1,0.2-0.1,0.3c0,0.1,0,0.2,0,0.4c0,0.1,0.1,0.2,0.2,0.3C17.4,43.2,17.5,43.3,17.6,43.3L17.6,43.3z"/>
                                                            <path class="st0" d="M20.4,38.5c0.8-0.9,1.2-2.1,1.3-3.3c0.1-1.3-0.3-2.5-1.2-3.5c-0.8-1-2-1.6-3.3-1.7c-1.3,0.1-2.4,0.6-3.3,1.6
                                                                c-0.8,0.9-1.3,2.1-1.2,3.4c-0.1,1.3,0.4,2.5,1.2,3.4c0.8,0.9,2,1.5,3.3,1.6c0.6,0,1.2-0.1,1.8-0.4C19.5,39.4,20,39,20.4,38.5
                                                                L20.4,38.5z M18.4,36.7c-0.1,0.2-0.3,0.4-0.6,0.5c-0.2,0.1-0.5,0.2-0.7,0.2c-0.6-0.1-1.1-0.4-1.4-0.8c-0.4-0.5-0.5-1-0.4-1.6
                                                                c0-0.6,0.1-1.1,0.5-1.6c0.4-0.4,0.9-0.7,1.4-0.8c1.2,0,1.9,1.3,1.9,2.4C19,35.6,18.8,36.2,18.4,36.7L18.4,36.7z"/>
                                                            <path class="st0" d="M25.5,45.4c0.9-0.1,1.8-0.5,2.4-1.2c0.6-0.7,1-1.6,0.9-2.5l0,0c0-0.5,0-0.9-0.2-1.4c-0.2-0.4-0.4-0.8-0.7-1.2
                                                                c-0.3-0.3-0.7-0.6-1.1-0.8C26.5,38.1,26,38,25.5,38l0,0c-0.9,0.1-1.7,0.6-2.3,1.2c-0.6,0.7-0.9,1.6-0.9,2.5s0.3,1.8,0.9,2.5
                                                                C23.8,44.8,24.6,45.3,25.5,45.4L25.5,45.4z M25.6,40c0.4,0.1,0.7,0.3,1,0.7c0.2,0.3,0.4,0.7,0.4,1.1s-0.1,0.8-0.4,1.1
                                                                c-0.2,0.3-0.6,0.6-1,0.7c-0.4-0.1-0.8-0.3-1-0.6c-0.3-0.3-0.4-0.7-0.3-1.2c0-0.4,0.1-0.8,0.3-1.2C24.8,40.3,25.1,40.1,25.6,40z"/>
                                                            <path class="st0" d="M38.8,19.7c-0.3-0.9-0.7-1.6-0.9-2c-0.1-0.2-0.2-0.3-0.4-0.4c-0.2-0.1-0.4-0.1-0.5-0.1c-0.2,0-0.4,0.1-0.5,0.3
                                                                c-0.1,0.1-0.2,0.3-0.3,0.5c-0.1,0.6-0.3,1.3-0.6,1.9c-0.2,0.7-0.6,1.3-1,1.9c0-0.8,0-1.7,0-2.6c-0.2-4.1-1.2-8.2-2.9-12
                                                                c0-0.1-0.1-0.2-0.2-0.3c-0.1-0.1-0.2-0.1-0.2-0.2c-0.1,0-0.2-0.1-0.3-0.1c-0.1,0-0.2,0-0.3,0.1c-0.1,0-0.2,0.1-0.3,0.2
                                                                c-0.1,0.1-0.1,0.2-0.2,0.3c0,0.1,0,0.2,0,0.3c0,0.1,0,0.2,0.1,0.3c1.6,3.6,2.6,7.4,2.7,11.4c0,1.3,0,2.6-0.2,3.9
                                                                c0,0.3,0.1,0.5,0.2,0.8c0.1,0.1,0.2,0.2,0.3,0.3c0.1,0.1,0.3,0.1,0.4,0.1c0.1,0,0.3,0,0.4-0.1c0.1-0.1,0.3-0.1,0.4-0.2
                                                                c1.2-1.1,2.1-2.6,2.6-4.1c0,0.1,0,0.3,0,0.4c1.8,4.4,2.4,9.2,1.8,14c0,0.4-0.2,1-0.3,1.6c0,0.1,0,0.2,0,0.3c0,0.1,0.1,0.2,0.1,0.3
                                                                c0.1,0.1,0.1,0.2,0.2,0.2s0.2,0.1,0.3,0.1c0.2,0,0.4,0,0.6-0.1c0.2-0.1,0.3-0.3,0.3-0.5c0.1-0.5,0.2-1.1,0.3-1.7
                                                                C41.2,29.4,40.6,24.3,38.8,19.7z"/>
                                                            <path class="st0" d="M37.2,38.9c-0.2-0.1-0.4-0.1-0.6,0c-0.2,0.1-0.4,0.2-0.5,0.4c-1.4,2.8-3.5,5.1-6.2,6.7c1.2-1.3,2-2.8,2.6-4.4
                                                                l0,0c1-3.7,0.7-7.5-0.9-11l-0.6-1.3c-0.1-0.2-0.3-0.3-0.4-0.4c-0.2-0.1-0.4-0.1-0.6-0.1c-0.2,0-0.4,0.1-0.5,0.2
                                                                c-0.1,0.1-0.2,0.3-0.3,0.5c-0.1,0.5-0.3,1-0.5,1.4c0-1.7-0.3-3.4-0.8-5.1c-0.1-0.2-0.2-0.4-0.4-0.5c-0.2-0.1-0.4-0.1-0.6-0.1
                                                                c-0.1,0-0.2,0.1-0.3,0.1c-0.1,0.1-0.2,0.1-0.2,0.2c-0.1,0.1-0.1,0.2-0.1,0.3c0,0.1,0,0.2,0,0.3c0.7,2.2,0.9,4.4,0.6,6.7
                                                                c0,0.2,0.1,0.4,0.2,0.6c0.1,0.1,0.2,0.2,0.3,0.2c0.1,0.1,0.3,0.1,0.4,0.1c0.2,0,0.3,0,0.4-0.1c0.1-0.1,0.3-0.1,0.4-0.3
                                                                c0.7-0.6,1.2-1.3,1.6-2.1c1.4,3.1,1.6,6.5,0.7,9.7c-0.7,2.2-2.2,4.1-4.1,5.5c-1.9,1.4-4.2,2.1-6.6,2h-0.4c-2.6,0-5.1-0.9-7.2-2.5
                                                                c-2-1.6-3.5-3.8-4.1-6.3c-0.2-1.2-0.3-2.3-0.2-3.5c0-0.1,0-0.2-0.1-0.3c0-0.1-0.1-0.2-0.2-0.3c-0.1-0.1-0.2-0.1-0.3-0.2
                                                                c-0.1,0-0.2-0.1-0.3,0c-0.2,0-0.4,0-0.6,0.2c-0.2,0.1-0.3,0.3-0.3,0.5c-0.1,1.3-0.1,2.6,0.2,3.9c0.5,2.3,1.7,4.4,3.4,6
                                                                c-2.3-1.3-4.2-3.2-5.6-5.4c-1.4-2.2-2.3-4.7-2.6-7.3c-0.4-3.3-0.1-6.7,1-9.9c1.1-3.2,2.9-6.1,5.3-8.5c0.3,1.9,1.1,3.7,2.5,5.1
                                                                c0.1,0.1,0.3,0.3,0.5,0.3c0.2,0.1,0.4,0.1,0.6,0c0.2,0,0.4-0.1,0.5-0.3c0.1-0.1,0.3-0.3,0.3-0.5c0.5-1.9,1.3-3.7,2.5-5.3
                                                                c1.3-1.4,2.6-2.7,4.1-3.9c2-2.4,3.3-5.3,3.6-8.4c1.2,1.3,2.4,2.7,3.4,4.2c0,0.1,0.1,0.2,0.2,0.3c0.1,0.1,0.2,0.2,0.3,0.2
                                                                c0.1,0,0.3,0.1,0.4,0c0.1,0,0.3-0.1,0.4-0.1c0.1,0,0.2-0.1,0.2-0.2c0.1-0.1,0.1-0.2,0.1-0.3c0-0.1,0-0.2,0-0.3c0-0.1,0-0.2-0.1-0.3
                                                                c-1.3-2-2.8-3.8-4.5-5.4c-0.2-0.1-0.3-0.2-0.5-0.3C22.5,0,22.3,0,22.1,0c-0.2,0-0.4,0.1-0.5,0.3c-0.1,0.1-0.2,0.3-0.3,0.5
                                                                C21.1,4,19.9,7,17.9,9.4c-1.5,1.3-2.9,2.6-4.2,4.2c-1.1,1.5-1.9,3.1-2.5,4.8c-1-1.4-1.5-3.1-1.5-4.8c0-0.2-0.1-0.4-0.2-0.5
                                                                c-0.1-0.1-0.3-0.3-0.4-0.3c-0.2-0.1-0.4-0.1-0.6-0.1c-0.2,0-0.4,0.1-0.5,0.3c-2.9,2.6-5.1,5.8-6.5,9.4c-1.4,3.6-1.8,7.4-1.3,11.2
                                                                c0.4,3.7,2,7.2,4.4,10c2.5,2.8,5.7,4.8,9.3,5.7c1.8,0.5,3.8,0.8,5.7,0.8c0,0,0,0,0.8,0c3.5-0.1,7-1,10.1-2.8c3-1.7,5.5-4.2,7.1-7.2
                                                                c0-0.1,0.1-0.2,0.1-0.3c0-0.1,0-0.2-0.1-0.3c0-0.1-0.1-0.2-0.2-0.2c-0.1-0.1-0.2-0.1-0.3-0.1V38.9z"/>
                                                        </g>
                                                        </svg>
                                                                                                                
                                                        <p>Today's Deals</p></a>
                                                    </div>
                                                    <div class="featureicon">
                                                        <a href="#">
                                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
<style type="text/css">
    .st0{fill-rule:evenodd;clip-rule:evenodd;fill:#909090;}
</style>
<g>
    <path class="st0" d="M6.1,50c0.2,0,0.4-0.1,0.6-0.2l7.5-5.2l7.5,5.1c0.2,0.1,0.4,0.2,0.6,0.2c0.2,0,0.4-0.1,0.6-0.2
        c0.2-0.1,0.3-0.3,0.4-0.5c0.1-0.2,0.1-0.4,0-0.6l-2.3-9.4l7.1-6c0.1-0.1,0.3-0.3,0.3-0.5c0-0.2,0-0.4,0-0.6
        c-0.1-0.2-0.2-0.4-0.4-0.5c-0.2-0.1-0.4-0.2-0.6-0.2l-9-0.4l-3.3-8.9c-0.1-0.2-0.2-0.4-0.4-0.5c-0.2-0.1-0.4-0.2-0.6-0.2
        c-0.2,0-0.4,0.1-0.6,0.2c-0.2,0.1-0.3,0.3-0.4,0.5L10,31l-9,0.5c-0.2,0-0.4,0.1-0.6,0.2c-0.2,0.1-0.3,0.3-0.4,0.5
        c-0.1,0.2-0.1,0.4,0,0.6C0,33,0.2,33.2,0.3,33.3l7.1,6l-2.3,9.2c0,0.2,0,0.4,0,0.6c0.1,0.2,0.2,0.4,0.4,0.5C5.7,49.8,5.9,50,6.1,50
        z M14.3,42.2c-0.2-0.1-0.4-0.1-0.6,0l-5.7,4.2l1.8-7.1c0.1-0.2,0-0.4,0-0.6c-0.1-0.2-0.2-0.4-0.3-0.5l-5.5-4.7l7.1-0.4
        c0.2,0,0.4-0.1,0.6-0.2c0.2-0.1,0.3-0.3,0.4-0.5l2.3-6.7l2.5,6.7c0.1,0.2,0.2,0.4,0.4,0.5c0.2,0.1,0.4,0.2,0.6,0.2l7.1,0.4
        l-5.6,4.7c-0.2,0.1-0.3,0.3-0.3,0.5c-0.1,0.2-0.1,0.4,0,0.6l1.8,7.1l-5.8-4C14.7,42.3,14.5,42.2,14.3,42.2L14.3,42.2z"/>
    <path class="st0" d="M30.2,50c0.7,0,1.3-0.1,1.9-0.4c0.6-0.3,1.2-0.6,1.6-1.1l14.6-14.6c0.5-0.5,0.9-1,1.1-1.6
        c0.3-0.6,0.4-1.3,0.4-1.9c0-1.3-0.5-2.6-1.4-3.6L25,2.3c-0.7-0.7-1.5-1.3-2.4-1.7S20.8,0,19.8,0H5.2C3.8,0,2.5,0.5,1.5,1.5
        S0,3.8,0,5.2v14.6c0,1,0.2,1.9,0.6,2.8c0.4,0.9,1,1.7,1.7,2.4L5,27.6c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3
        c0.2-0.2,0.3-0.5,0.3-0.8c0-0.3-0.1-0.5-0.3-0.8l-2.9-2.5c-0.5-0.5-0.9-1.1-1.1-1.7c-0.3-0.7-0.4-1.3-0.4-2V5.2
        C2.1,4.4,2.4,3.6,3,3s1.4-0.9,2.2-0.9h14.6c0.7,0,1.4,0.1,2,0.4c0.7,0.3,1.2,0.6,1.7,1.1l23.5,24.4c0.5,0.6,0.8,1.3,0.9,2.1
        c0,0.4-0.1,0.8-0.2,1.2c-0.2,0.4-0.4,0.7-0.7,1L32.4,47c-0.6,0.5-1.4,0.8-2.2,0.8c-0.8,0-1.6-0.3-2.2-0.8c-0.1-0.1-0.2-0.2-0.3-0.2
        c-0.1,0-0.3-0.1-0.4-0.1s-0.3,0-0.4,0.1c-0.1,0.1-0.2,0.1-0.3,0.2c-0.1,0.1-0.2,0.2-0.2,0.3c0,0.1-0.1,0.3-0.1,0.4
        c0,0.1,0,0.3,0.1,0.4c0.1,0.1,0.1,0.2,0.2,0.3c1,0.9,2.2,1.4,3.6,1.4L30.2,50z"/>
    <path class="st0" d="M8.9,17.9c1.1,0,2.1-0.3,3-0.9c0.9-0.6,1.6-1.4,2-2.4c0.4-1,0.5-2.1,0.3-3.1c-0.2-1-0.7-2-1.5-2.7
        C12,8,11,7.5,10,7.2C8.9,7,7.9,7.1,6.9,7.6s-1.8,1.1-2.4,2c-0.6,0.9-0.9,1.9-0.9,3c0,1.4,0.6,2.8,1.6,3.8
        C6.1,17.3,7.5,17.9,8.9,17.9L8.9,17.9z M8.9,9.8c0.5,0,1,0.2,1.5,0.5c0.4,0.3,0.8,0.7,1,1.2c0.2,0.5,0.3,1,0.2,1.5
        c-0.1,0.5-0.4,1-0.7,1.4c-0.4,0.4-0.9,0.6-1.4,0.7c-0.5,0.1-1.1,0.1-1.5-0.2c-0.5-0.2-0.9-0.5-1.2-1c-0.3-0.4-0.5-1-0.5-1.5
        c0-0.7,0.3-1.4,0.8-1.9C7.5,10.1,8.2,9.8,8.9,9.8L8.9,9.8z"/>
</g>
</svg>                                                     
    <p>Daily Offers</p></a>
                                                    </div>
                                                </div>
                                            </ul>
                                        </li>
                                       
                                         <li class="arrow-icon"><a href="{{ route('user.optanews') }}">OptaZoom News</a></li>
                                          <li class="arrow-icon"><a href="{{ route('front.vendorlist') }}">Vendors</a></li>
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
			
				<div class="col-md-6 col-lg-3">
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

							<li>
								<a href="{{ route('front.contact') }}">
									{{ $langg->lang23 }}
								</a>
							</li>
							
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
				<div class="col-md-6 col-lg-2">
					<div class="footer-widget info-link-widget">
						<h4 class="title">
								SERVICES
						</h4>
						<ul class="link-list">
							<li>
							<a href="{{ route('user.login')}}">Practioner Login	</a>
							</li>

							<li>
							<a href="javascript:;" data-toggle="modal" data-target="#vendor-login">Vendor Login</a>
							</li>
							<li>
							<a href="{{ route('user.optanews')}}">Optazoom News</a>
							</li>
							<li>
							<a  href="javascript:;" data-toggle="modal" data-target="#vendor-login">Become a  Vendor</a>
							</li>
							<li>
							<a href="{{ route('user-forgot')}}">Reset Passwrod</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="footer-widget recent-post-widget">
						<h4 class="title">
							{{ $langg->lang24 }}
						</h4>
						<ul class="post-list">
							@foreach (App\Models\Blog::orderBy('created_at', 'desc')->limit(3)->get() as $blog)
							<li>
								<div class="post">
								  <div class="post-img">
									<img style="width: 73px; height: 59px;" src="{{ asset('assets/images/blogs/'.$blog->photo) }}" alt="">
								  </div>
								  <div class="post-details">
									<a href="{{ route('front.blogshow',$blog->id) }}">
										<h4 class="post-title">
											{{mb_strlen($blog->title,'utf-8') > 45 ? mb_substr($blog->title,0,45,'utf-8')." .." : $blog->title}}
										</h4>
									</a>
									<p class="date">
										{{ date('M d - Y',(strtotime($blog->created_at))) }}
									</p>
								  </div>
								</div>
							  </li>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="col-md-6 col-lg-2">
					<div class="footer-widget recent-post-widget">
						<h4 class="title">
							COMPANY
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
                                    <form action="#" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="footer-subscribe-form validate" target="_blank" novalidate>
                                        <div id="mc_embed_signup_scroll">
                                            <div id="mc-form" class="mc-form subscribe-form">
                                                <input id="mc-email" class="newsleter-filter_input" type="email" autocomplete="off" placeholder="Enter your email" />
                                                <button class="btn btn-sm subscribe-btn" id="mc-submit">Subscribe</button>
                                               
                                            </div>
                                        </div>
                                    </form>
					</div>
				</div>
			</div>
		</div>

		<div class="copy-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-9">
							<div class="content">
								<div class="content">
									<p>{!! $gs->copyright !!}</p>
							    </div>
						   </div>
					</div>
					<div class="col-lg-3 copy">
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
    padding: 0px 30px 0px 45px;
    border: 1px
    solid rgba(0, 0, 0, 0.1);
    font-size: 14px;" class="User Name" placeholder="How Did You Hear About Us?" name="hear_from">
                        <option  value="">How Did You Hear About Us?</option>
                        <option value="facebook">Facebook</option>
                        <option value="instagram">Instagram</option>
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
			    font-size: 14px;" class="User Name" placeholder="How Did You Hear About Us?" name="hear_from">
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

</body>

</html>
