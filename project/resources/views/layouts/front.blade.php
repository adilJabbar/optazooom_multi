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
										<li class="profilearea my-dropdown">
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
										</li>
									@endif

									
									<!-- <li class="login">
										<a href="{{ route('user.login') }}" class="sign-logs">
											<div class="">
												<span class="sign-in">LOG IN</span>
												<span></span>
											</div>
										</a>
									</li> -->
									
                        			@if($gs->reg_vendor == 1)
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
									@endif
 
							<li class="my-dropdown"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang3 }}">
								<a href="javascript:;" class="cart carticon">
									<div class="icon">
									<img src="{{asset('assets/images/Cart.svg')}}" height="35"/>
										<span class="cart-quantity" id="cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
									</div>

								</a>
								<div class="my-dropdown-menu" id="cart-items">
									@include('load.cart')
								</div>
							</li>
							<!-- <li class="wishlist"  data-toggle="tooltip" data-placement="top" title="{{ $langg->lang9 }}">
								@if(Auth::guard('web')->check())
									<a href="{{ route('user-wishlists') }}" class="wish">
										<i class="far fa-heart"></i>
										<span id="wishlist-count">{{ Auth::user()->wishlistCount() }}</span>
									</a>
								@else
									<a href="javascript:;" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" class="wish">
										<i class="far fa-heart"></i>
										<span id="wishlist-count">0</span>
									</a>
								@endif
							</li> -->
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
                                        <li class="dropdown-holder">
                                        <a href="javascript:void(0)">Categories</a>
                                            <ul class="hb-dropdown feature-hb ">
                                                <div class="main-section">
                                                    <div class="featureicon">
                                                        <a href="/optazoom-multi/category/Contact-Lenses/">
                                                        <svg width="99" height="55" viewBox="0 0 99 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0)">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M94.2222 40.5105C86.0583 29.5191 76.7046 19.456 66.33 10.5027C66.2324 10.3993 66.1105 10.3216 65.9752 10.2767C65.84 10.2319 65.6957 10.2211 65.5553 10.2455C65.4222 10.2486 65.2915 10.281 65.1724 10.3403C65.0534 10.3995 64.9489 10.4843 64.8666 10.5884C64.7627 10.6857 64.6848 10.8071 64.6397 10.9418C64.5946 11.0765 64.5838 11.2202 64.6083 11.36C64.6115 11.4926 64.6439 11.6228 64.7035 11.7413C64.763 11.8599 64.8481 11.9639 64.9526 12.0459C80.147 25.1636 96.5896 44.7973 96.934 50.2844V50.7989H96.4174C94.647 50.3721 92.9792 49.5999 91.5105 48.5268C75.4983 38.1956 49.9305 9.21663 49.5861 2.52918V2.05763H50.1026C54.252 3.46956 58.042 5.76645 61.2079 8.78794C61.3304 8.83982 61.4621 8.86656 61.5953 8.86656C61.7284 8.86656 61.8601 8.83982 61.9826 8.78794C62.2171 8.79865 62.4472 8.72227 62.6283 8.5736C62.6804 8.45159 62.7072 8.32037 62.7072 8.18779C62.7072 8.05521 62.6804 7.92399 62.6283 7.80198C62.5872 7.53404 62.4495 7.2902 62.2409 7.11608C59.5532 4.89373 56.6723 2.91398 53.6322 1.20026C51.8244 0.257158 49.3279 -0.814549 47.9074 0.557235C47.5202 0.992947 47.3194 1.56218 47.3479 2.14336V2.14336C44.8372 9.19789 44.4778 16.8344 46.3148 24.0919V24.6492H45.7122C42.3118 24.6492 38.7822 24.3491 35.2096 24.3491C22.3396 24.4777 3.88833e-05 25.9353 3.88833e-05 31.3795C-0.0033346 31.9388 0.212921 32.4772 0.602648 32.8799V32.8799C3.6788 39.4938 8.6029 45.0852 14.786 48.9852C20.969 52.8852 28.1493 54.9287 35.4679 54.8713C40.3999 54.8587 45.2877 53.9432 49.8874 52.1706C50.0392 52.1373 50.1819 52.0715 50.3057 51.978C50.4295 51.8844 50.5315 51.7653 50.6047 51.6287C50.6778 51.4922 50.7204 51.3415 50.7295 51.1869C50.7386 51.0324 50.714 50.8778 50.6574 50.7336C50.6008 50.5895 50.5134 50.4593 50.4015 50.352C50.2895 50.2446 50.1555 50.1628 50.0087 50.1119C49.8619 50.0611 49.7058 50.0425 49.5511 50.0575C49.3964 50.0725 49.2469 50.1207 49.1126 50.1987C41.1368 53.4037 32.2849 53.722 24.0978 51.098C15.9106 48.4741 8.90649 43.0741 4.30439 35.8378L3.917 34.8947L4.95004 35.2377C16.2705 38.7529 39.8153 38.71 52.2979 37.5954V37.8098C54.0117 40.2087 55.958 42.4343 58.1087 44.4544L58.4531 44.7973L58.0657 45.0974C56.5626 46.2954 54.9648 47.3706 53.2879 48.3125C53.0396 48.4533 52.8548 48.6834 52.7713 48.9555C52.6861 49.2057 52.6861 49.477 52.7713 49.7272C52.8292 49.8494 52.9127 49.9578 53.0163 50.0451C53.1198 50.1324 53.241 50.1965 53.3716 50.2331C53.5022 50.2697 53.6392 50.2779 53.7733 50.2572C53.9074 50.2365 54.0354 50.1873 54.1487 50.113C56.3057 49.0587 58.353 47.7951 60.2609 46.3406L60.5192 46.1262L60.8205 46.3406C65.7732 50.4526 71.7164 53.2083 78.0642 54.3359C84.412 55.4635 90.9453 54.924 97.02 52.7708C97.5737 52.7562 98.0994 52.5252 98.4835 52.1278C100.679 49.77 95.987 42.8682 94.2222 40.5105ZM50.49 35.6235C45.7983 36.0522 40.8053 36.2236 35.8983 36.2236C20.2305 36.2236 5.2083 34.2946 2.32439 31.6796L1.98004 31.3795L2.32439 31.0795C5.55265 28.0787 25.8261 25.7209 46.9174 26.9212H47.3479V27.1784C48.2398 29.9114 49.4231 32.5413 50.8774 35.0233L51.2218 35.5806L50.49 35.6235ZM92.1992 51.9992C89.6506 52.6292 87.0342 52.9459 84.4083 52.9423C74.9159 52.837 65.8498 49.0004 59.1848 42.2681C54.5306 37.7956 51.0876 32.2236 49.1761 26.0702C47.2646 19.9168 46.9466 13.3819 48.2518 7.07321V7.07321H49.0266C54.5129 15.9077 61.0449 24.0538 68.4822 31.3367C75.5568 38.9871 83.5515 45.7398 92.2853 51.4419L93.2322 51.9563L92.1992 51.9992Z" fill="#909090"/>
                                                        </g>
                                                        <defs>
                                                        <clipPath id="clip0">
                                                        <rect width="99" height="55" fill="white"/>
                                                        </clipPath>
                                                        </defs>
                                                        </svg>                                                         
                                                         <p>Contact Lenses</p>
                                                        </a>
                                                    </div>
                                                    <div class="featureicon">
                                                        <a href="/optazoom-multi/category/Accessories">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="68.19" height="62.775" viewBox="0 0 68.19 62.775"><defs><style>.a{fill:#909090;}</style></defs><g transform="translate(0 -0.007)"><g transform="translate(32.947 0.007)"><g transform="translate(10.324)"><path class="a" d="M48.595,23.548a.811.811,0,0,1-.562-1.4L71.327.227a.814.814,0,1,1,1.114,1.186L49.156,23.322A.81.81,0,0,1,48.595,23.548Z" transform="translate(-47.777 -0.007)"/></g><g transform="translate(8.459 8.198)"><path class="a" d="M46.535,19.086H46.49a.813.813,0,0,1-.77-.86l.489-8.4a.816.816,0,0,1,1.63.091l-.489,8.4A.821.821,0,0,1,46.535,19.086Z" transform="translate(-45.718 -9.059)"/></g><g transform="translate(0 9.212)"><path class="a" d="M41.9,20.305a.829.829,0,0,1-.715-.417l-4.709-8.5A.813.813,0,1,1,37.9,10.6l4.709,8.5a.814.814,0,0,1-.317,1.1A.888.888,0,0,1,41.9,20.305Z" transform="translate(-36.378 -10.178)"/></g><g transform="translate(15.244 23.233)"><path class="a" d="M62.43,27.471h-.018l-8.4-.181a.812.812,0,0,1-.8-.833.835.835,0,0,1,.833-.8l8.4.181a.815.815,0,0,1-.018,1.63Z" transform="translate(-53.21 -25.66)"/></g><g transform="translate(13.829 26.881)"><path class="a" d="M60.571,36.682a.85.85,0,0,1-.453-.136l-8.106-5.362a.816.816,0,1,1,.906-1.359l8.106,5.362a.815.815,0,0,1,.226,1.132A.8.8,0,0,1,60.571,36.682Z" transform="translate(-51.648 -29.688)"/></g></g><g transform="translate(0 16.674)"><path class="a" d="M23.058,18.41A23.054,23.054,0,1,0,46.108,41.459,23.081,23.081,0,0,0,23.058,18.41ZM36.9,25.347A12.275,12.275,0,0,1,41.19,33.1a9.8,9.8,0,0,1-9.618,11.285,12.318,12.318,0,0,1-8.332-3.007c-4.9-4.184-5.823-11.176-2.065-15.6a9.981,9.981,0,0,1,7.4-3.442A12.192,12.192,0,0,1,36.9,25.347ZM23.058,62.887a21.424,21.424,0,1,1,0-42.847,21.158,21.158,0,0,1,5.334.679,11.559,11.559,0,0,0-8.459,4,11.441,11.441,0,0,0-2.7,7.49A13.815,13.815,0,0,0,22.18,42.619a13.969,13.969,0,0,0,9.03,3.405c.136,0,.272,0,.408-.009a11.408,11.408,0,0,0,11.23-12.734,21.186,21.186,0,0,1,1.63,8.178A21.446,21.446,0,0,1,23.058,62.887Z" transform="translate(0 -18.41)"/></g><g transform="translate(24.815 24.818)"><path class="a" d="M37.525,29.474c-2.789-2.382-6.539-2.717-8.912-.969a4.913,4.913,0,0,0-.878.806,5.18,5.18,0,0,0-.335.444,6.849,6.849,0,0,1,1.467.761c.226.154.444.317.661.5A6.245,6.245,0,0,1,31.439,38.4a4.348,4.348,0,0,1-.643.978,2.219,2.219,0,0,1-.326.326,7.8,7.8,0,0,0,1.522.779,7.638,7.638,0,0,0,2.817.552,5.714,5.714,0,0,0,4.429-1.911C41.465,36.5,40.7,32.173,37.525,29.474ZM38,38.06a4.615,4.615,0,0,1-5.081,1.023,7.887,7.887,0,0,0-2.328-9.31c-.136-.109-.272-.217-.408-.317a5.984,5.984,0,0,1,6.285,1.259C38.956,32.834,39.636,36.131,38,38.06Z" transform="translate(-27.4 -27.402)"/></g></g></svg>
                                                            <p>Accessories </p>
                                                        </a>
                                                    </div>
                                                    <div class="featureicon">

                                                        <a href="/optazoom-multi/category/Sunglasses/">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="104.16" height="31.43" viewBox="0 0 104.16 31.43"><defs><style>.a{fill:#909090;}</style></defs><g transform="translate(0 0)"><path class="a" d="M99.262-.75H78.4A45.083,45.083,0,0,0,64.03,1.582L56.294,4.157a15.888,15.888,0,0,1-9.918,0L38.64,1.582A45.167,45.167,0,0,0,24.274-.75H3.408A4.171,4.171,0,0,0-.75,3.4V5.778A4.136,4.136,0,0,0,2.4,9.8l3.465.871v9.253A10.792,10.792,0,0,0,16.623,30.68H29.846A17.492,17.492,0,0,0,47.219,13.626l.009-.834.824.159a17.2,17.2,0,0,0,6.565,0l.824-.159.019.834A17.478,17.478,0,0,0,72.823,30.68H86.038A10.78,10.78,0,0,0,96.8,19.919V18.271a.852.852,0,0,0-.805-.9.784.784,0,0,0-.609.225.85.85,0,0,0-.272.59v1.733a9.087,9.087,0,0,1-9.066,9.075H72.814A15.73,15.73,0,0,1,57.127,13.307V5.656l7.427-2.482A43.712,43.712,0,0,1,78.386.926h9.3a7.45,7.45,0,0,1,7.427,7.427v3.306a.824.824,0,0,0,.871.787.854.854,0,0,0,.815-.815v-.965l3.465-.871a4.139,4.139,0,0,0,3.147-4.027V3.389A4.161,4.161,0,0,0,99.262-.75ZM5.843,8.915,2.809,8.166a2.457,2.457,0,0,1-1.873-2.4V3.4A2.478,2.478,0,0,1,3.4.936H9.458L8.344,2.116A9.055,9.055,0,0,0,5.871,8.053Zm39.69,4.4A15.73,15.73,0,0,1,29.846,29H29.5l-.009-.009H16.623a9.087,9.087,0,0,1-9.066-9.075V8.353A7.434,7.434,0,0,1,14.974.936h9.3A43.407,43.407,0,0,1,38.106,3.183l7.427,2.472Zm9.918-2.285-.543.131a15.823,15.823,0,0,1-3.578.412,15.8,15.8,0,0,1-3.568-.412l-.543-.131V6.171l.834.159a17.587,17.587,0,0,0,6.565,0l.834-.159S55.451,11.031,55.451,11.031Zm46.274-5.263a2.456,2.456,0,0,1-1.864,2.388l-3.044.768-.028-.871a9.046,9.046,0,0,0-2.463-5.938L93.2.936h6.059A2.466,2.466,0,0,1,101.725,3.4S101.725,5.768,101.725,5.768Z" transform="translate(0.75 0.75)"/><g transform="translate(17.354 7.436)"><path class="a" d="M34.347,8.033a.859.859,0,0,1-.243.6L19.222,23.5a.842.842,0,0,1-1.189,0,.837.837,0,0,1,0-1.2L32.9,7.433a.843.843,0,0,1,1.442.6Z" transform="translate(-17.78 -7.19)"/></g><g transform="translate(70.173 6.604)"><path class="a" d="M91.393,7.742,75.66,23.476l-.075.075a.891.891,0,0,1-.609.206.849.849,0,0,1-.8-.89.929.929,0,0,1,.318-.618L90.251,6.5a.846.846,0,0,1,1.143,1.246Z" transform="translate(-74.179 -6.302)"/></g></g><g transform="translate(74.855 13.479)"><path class="a" d="M90.372,15.261,80.829,24.8l-.047.047a.524.524,0,0,1-.365.122.513.513,0,0,1-.356-.169.491.491,0,0,1-.131-.365.55.55,0,0,1,.2-.375l9.553-9.553a.511.511,0,0,1,.693.749Z" transform="translate(-79.929 -14.392)"/></g><g transform="translate(19.844 6.604)"><path class="a" d="M31.632,7.921l-9.543,9.543-.047.047a.524.524,0,0,1-.365.122.513.513,0,0,1-.356-.169.491.491,0,0,1-.131-.365.55.55,0,0,1,.2-.375l9.553-9.553a.511.511,0,0,1,.693.749Z" transform="translate(-21.189 -7.052)"/></g></svg> 
                                                            <p>Sunglasses</p>
                                                        </a>
                                                    </div>
                                                    <div class="featureicon">
                                                        <a href="/optazoom-multi/category/Opthalmic-Frames/">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="86.955" height="50.439" viewBox="0 0 86.955 50.439"><defs><style>.a{fill:#909090;}</style></defs><g transform="translate(6.007 -40.516)"><path class="a" d="M86.745,29.727,78.878,5.349A7.661,7.661,0,0,0,71.556,0H68.5a1.109,1.109,0,0,0-1.1,1.1,1.109,1.109,0,0,0,1.1,1.1h3.04a5.5,5.5,0,0,1,5.245,3.817l7.867,24.39a1.978,1.978,0,0,1,.093.638,2.077,2.077,0,0,1-2.077,2.089H80.99V29.008a1.108,1.108,0,0,0-.7-1.021,41.642,41.642,0,0,0-30.853-.476,2.991,2.991,0,0,0-1.926,2.576L47.5,30.3l-.186-.081a9.681,9.681,0,0,0-7.67,0l-.186.081-.023-.209a2.973,2.973,0,0,0-1.926-2.576,41.612,41.612,0,0,0-30.841.476,1.108,1.108,0,0,0-.7,1.021v4.131H4.293a2.086,2.086,0,0,1-1.984-2.727l7.855-24.39A5.5,5.5,0,0,1,15.409,2.2h3.04a1.1,1.1,0,1,0,0-2.2h-3.04A7.657,7.657,0,0,0,8.076,5.349L.209,29.727a4.293,4.293,0,0,0,4.084,5.616H6.057l.012.128A16.738,16.738,0,0,0,39.451,33.7V32.8l.07-.046a7.538,7.538,0,0,1,7.925,0l.07.046V33.7A16.738,16.738,0,0,0,80.9,35.471l.012-.128h1.764a4.118,4.118,0,0,0,1.3-.209A4.291,4.291,0,0,0,86.745,29.727ZM37.246,33.7a14.538,14.538,0,0,1-29.066.545c0-.174-.012-.36-.012-.545V29.762l.093-.035a39.513,39.513,0,0,1,28.5-.151.8.8,0,0,1,.487.731Zm41.539,0A14.549,14.549,0,0,1,64.258,48.223h-.012A14.539,14.539,0,0,1,49.708,33.7V30.307a.792.792,0,0,1,.5-.731A40.007,40.007,0,0,1,64.246,27a40.507,40.507,0,0,1,14.446,2.727l.093.035Z" transform="translate(-6.007 40.516)"/></g></svg>                                                        
                                                            <p>Opthalmic Frames</p>
                                                        </a>                                                        
                                                    </div>
                                                    <div class="featureicon">
                                                        <a href="/optazoom-multi/category/Equipment/">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="92.254" height="64.745" viewBox="0 0 92.254 64.745"><defs><style>.a{fill:#909090;}</style></defs><g transform="translate(-0.65 -0.48)"><g transform="translate(29.646 0.48)"><path class="a" d="M66.9,14.529H53.759V.48H52.128V16.161H65.271v4.713h-31V16.161H47.415V.48H45.783V14.529H32.64v7.976H47.1a5.343,5.343,0,1,0,5.357,0H66.9Zm-13.415,12.6a3.716,3.716,0,1,1-3.707-3.716A3.714,3.714,0,0,1,53.487,27.128Z" transform="translate(-32.64 -0.48)"/></g><g transform="translate(0.65 19.107)"><g transform="translate(0 2.637)"><path class="a" d="M.7,40.981c.254,3.218,1.387,5.8,3.1,7.088,2.656,1.994,4.677,4.414,5.411,6.472a12.578,12.578,0,0,0,3.064,4.713l.245.227c3.653,3.535,7.106,6.871,13.388,7.768a16.89,16.89,0,0,0,2.329.172,15.7,15.7,0,0,0,12.146-5.792A19.491,19.491,0,0,0,43.967,43.4c-6.236-18.962-22.7-19.615-26.984-19.443-.517.018-.852.054-.979.063h-.689a7.745,7.745,0,0,1,.87,3.49A7.385,7.385,0,0,1,4.194,33.285a8.227,8.227,0,0,1-1.1-1.079l-.29.3a5.18,5.18,0,0,0-.7.915A13.092,13.092,0,0,0,.7,40.981ZM3.26,34.509a8.931,8.931,0,0,0,14.231-9.046c4.541-.154,19.216.789,25.008,18.427a17.914,17.914,0,0,1-3.29,16.75,13.984,13.984,0,0,1-13.08,5.085c-5.783-.825-9.064-4-12.536-7.351l-.236-.227a10.92,10.92,0,0,1-2.692-4.124c-.843-2.366-3-4.985-5.937-7.188C3.387,45.83,2.454,43.6,2.236,40.863A12.307,12.307,0,0,1,3.26,34.509Z" transform="translate(-0.65 -23.94)"/></g><g transform="translate(1.94)"><path class="a" d="M9,33.448a6.209,6.209,0,1,1,6.209-6.209A6.213,6.213,0,0,1,9,33.448ZM9,22.571a4.668,4.668,0,1,0,4.668,4.668A4.673,4.673,0,0,0,9,22.571Z" transform="translate(-2.79 -21.03)"/></g><g transform="translate(25.506 15.409)"><path class="a" d="M35,50.448a6.209,6.209,0,1,1,6.209-6.209A6.213,6.213,0,0,1,35,50.448Zm0-10.877a4.668,4.668,0,1,0,4.668,4.668A4.673,4.673,0,0,0,35,39.571Z" transform="translate(-28.79 -38.03)"/></g><g transform="translate(11.91 21.754)"><path class="a" d="M18.639,54.729a4.849,4.849,0,1,1,4.849-4.849A4.855,4.855,0,0,1,18.639,54.729Zm0-8.158a3.308,3.308,0,1,0,3.308,3.308A3.315,3.315,0,0,0,18.639,46.571Z" transform="translate(-13.79 -45.03)"/></g><g transform="translate(20.974 31.724)"><path class="a" d="M29.093,66.635a5.3,5.3,0,1,1,5.3-5.3A5.3,5.3,0,0,1,29.093,66.635Zm0-9.064a3.762,3.762,0,1,0,3.762,3.762A3.764,3.764,0,0,0,29.093,57.571Z" transform="translate(-23.79 -56.03)"/></g><g transform="translate(48.037)"><g transform="translate(0 2.637)"><path class="a" d="M96.405,33.421a5.18,5.18,0,0,0-.7-.915l-.29-.3a8.227,8.227,0,0,1-1.1,1.079,7.385,7.385,0,0,1-11.992-5.774,7.745,7.745,0,0,1,.87-3.49H82.51c-.127-.009-.462-.045-.979-.063-4.287-.172-20.748.48-26.984,19.443a19.492,19.492,0,0,0,3.58,18.228,15.7,15.7,0,0,0,12.146,5.792,16.89,16.89,0,0,0,2.329-.172c6.281-.9,9.735-4.233,13.388-7.768l.245-.227A12.578,12.578,0,0,0,89.3,54.54c.734-2.058,2.755-4.478,5.411-6.472,1.713-1.287,2.846-3.87,3.1-7.088A13.092,13.092,0,0,0,96.405,33.421Zm-.127,7.442c-.218,2.737-1.151,4.967-2.493,5.973-2.937,2.2-5.094,4.822-5.937,7.188a10.92,10.92,0,0,1-2.692,4.124l-.236.227c-3.472,3.354-6.753,6.526-12.536,7.351a13.984,13.984,0,0,1-13.08-5.085,17.914,17.914,0,0,1-3.29-16.75c5.792-17.639,20.467-18.581,25.008-18.427a8.925,8.925,0,0,0,14.231,9.046A12.307,12.307,0,0,1,96.278,40.863Z" transform="translate(-53.647 -23.94)"/></g><g transform="translate(29.86)"><path class="a" d="M92.8,33.448a6.209,6.209,0,1,1,6.209-6.209A6.213,6.213,0,0,1,92.8,33.448Zm0-10.877a4.668,4.668,0,1,0,4.668,4.668A4.673,4.673,0,0,0,92.8,22.571Z" transform="translate(-86.59 -21.03)"/></g><g transform="translate(6.293 15.409)"><path class="a" d="M66.8,50.448a6.209,6.209,0,1,1,6.209-6.209A6.213,6.213,0,0,1,66.8,50.448Zm0-10.877a4.668,4.668,0,1,0,4.668,4.668A4.673,4.673,0,0,0,66.8,39.571Z" transform="translate(-60.59 -38.03)"/></g><g transform="translate(22.608 21.754)"><path class="a" d="M83.439,54.729a4.849,4.849,0,1,1,4.849-4.849A4.855,4.855,0,0,1,83.439,54.729Zm0-8.158a3.308,3.308,0,1,0,3.308,3.308A3.315,3.315,0,0,0,83.439,46.571Z" transform="translate(-78.59 -45.03)"/></g><g transform="translate(12.638 31.724)"><path class="a" d="M72.893,66.635a5.3,5.3,0,1,1,5.3-5.3A5.3,5.3,0,0,1,72.893,66.635Zm0-9.064a3.762,3.762,0,1,0,3.762,3.762A3.764,3.764,0,0,0,72.893,57.571Z" transform="translate(-67.59 -56.03)"/></g></g></g></g></svg>
                                                        <p>Equipment</p>
                                                        </a>
                                                    </div>
                                                    <div class="featureicon">
                                                        <a href="/optazoom-multi/category/Pharmaceuticals/">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="81.954" height="68.67" viewBox="0 0 81.954 68.67"><defs><style>.a{fill:#909090;}</style></defs><g transform="translate(22.378 24.964)"><path class="a" d="M42.049,26.16a18.6,18.6,0,1,0,18.6,18.6A18.641,18.641,0,0,0,42.049,26.16ZM53.8,56.525a16.62,16.62,0,1,1,4.876-11.757A16.575,16.575,0,0,1,53.8,56.525Z" transform="translate(-23.45 -26.16)"/></g><g transform="translate(25.371 18.475)"><path class="a" d="M70.974,31.527a.952.952,0,0,1-.3.7,1.03,1.03,0,0,1-.7.286.95.95,0,0,1-.611-.21C60.095,25.028,50.953,21.335,42.2,21.335a36.266,36.266,0,0,0-14.238,3.121.983.983,0,0,1-.754.01,1.044,1.044,0,0,1-.544-.525.983.983,0,0,1-.01-.754,1.029,1.029,0,0,1,.544-.553A38.19,38.19,0,0,1,42.211,19.36c9.209,0,18.761,3.827,28.4,11.385A1.033,1.033,0,0,1,70.974,31.527Z" transform="translate(-26.586 -19.36)"/></g><g transform="translate(0 32.989)"><path class="a" d="M81.009,47.73A82.836,82.836,0,0,1,66.332,61.118c-8.617,6.05-17.149,9.133-25.355,9.133s-16.738-3.073-25.355-9.133A82.836,82.836,0,0,1,.945,47.73a3.986,3.986,0,0,1,0-5.153c1.126-1.3,2.958-3.35,5.4-5.7a.967.967,0,0,1,.687-.277h.01a.952.952,0,0,1,.7.3,1.006,1.006,0,0,1,.277.7.99.99,0,0,1-.3.7c-2.357,2.262-4.17,4.275-5.268,5.554a2.006,2.006,0,0,0,0,2.586,80.843,80.843,0,0,0,14.3,13.074c8.283,5.812,16.433,8.76,24.22,8.76s15.937-2.949,24.22-8.76A80.406,80.406,0,0,0,79.5,46.451a2.006,2.006,0,0,0,0-2.586A85.378,85.378,0,0,0,72.087,36.3a1,1,0,0,1-.324-.678.945.945,0,0,1,.248-.716,1.048,1.048,0,0,1,.678-.334,1.011,1.011,0,0,1,.716.248,87,87,0,0,1,7.606,7.749A4,4,0,0,1,81.009,47.73Z" transform="translate(0 -34.569)"/></g><g transform="translate(30.738 33.333)"><path class="a" d="M52.7,45.16a10.212,10.212,0,1,1-4.81-8.684.926.926,0,0,1,.439.62.983.983,0,0,1-.124.744.962.962,0,0,1-.611.439,1,1,0,0,1-.744-.124,8.306,8.306,0,0,0-4.371-1.25,8.29,8.29,0,1,0,7.472,4.733.99.99,0,0,1,1.212-1.355,1.031,1.031,0,0,1,.573.506A10.251,10.251,0,0,1,52.7,45.16Z" transform="translate(-32.21 -34.93)"/></g><g transform="translate(12.864)"><path class="a" d="M77.484,3.311H73.266a.983.983,0,1,0,0,1.966h4.218a3.116,3.116,0,0,1,0,6.231H60.727V5.287h7.338a.983.983,0,0,0,0-1.966H60.736l-.01-.219A3.246,3.246,0,0,0,57.511,0h-.954a3.24,3.24,0,0,0-3.225,3.225v.5H32.194a11.434,11.434,0,0,0-4.027.735,9.5,9.5,0,0,1-3.34.611H16.81a3.336,3.336,0,0,0-.1,6.67h8.1a9.575,9.575,0,0,1,3.34.611,11.4,11.4,0,0,0,4.027.735H53.321v.5A3.228,3.228,0,0,0,56.547,16.8H57.5a3.231,3.231,0,0,0,3.216-3.092v-.219H77.474a5.091,5.091,0,0,0,.01-10.182ZM53.331,11.089H32.194a9.085,9.085,0,0,1-3.34-.611,11.434,11.434,0,0,0-4.027-.735H16.763a1.356,1.356,0,0,1-.038-2.71h8.092A11.224,11.224,0,0,0,28.844,6.3a9.535,9.535,0,0,1,3.34-.611H53.321v5.4Zm5.42,2.481a1.244,1.244,0,0,1-1.241,1.241h-.954a1.246,1.246,0,0,1-1.25-1.241V3.225a1.246,1.246,0,0,1,1.25-1.241h.954a1.244,1.244,0,0,1,1.241,1.241Z" transform="translate(-13.48)"/></g><g transform="translate(8.15 17.215)"><path class="a" d="M18.56,18.937a2.631,2.631,0,0,0-1.994-.9,2.67,2.67,0,0,0-1.785.687,2.169,2.169,0,0,0-.21.21C11.823,22,8.54,26.275,8.54,29.234a8.04,8.04,0,0,0,8.016,8.016l.01.229V37.25a8.025,8.025,0,0,0,8.006-8.016C24.582,26.256,21.308,21.991,18.56,18.937ZM16.575,35.274a6.048,6.048,0,0,1-6.041-6.041c0-1.765,2.071-5.134,5.525-8.98a.668.668,0,0,1,.468-.229.68.68,0,0,1,.5.162l.067.067c3.445,3.846,5.516,7.214,5.516,8.98A6.046,6.046,0,0,1,16.575,35.274Z" transform="translate(-8.54 -18.04)"/></g></svg>
                                                            <p>Pharmaceuticals </p>
                                                        </a>
                                                    </div>
                                                    <div class="featureicon">
                                                        <a href="/optazoom-multi/category/Optical-Supplies/">
                                                        <svg width="51" height="55" viewBox="0 0 51 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0)">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M50.8318 4.36119L50.4674 3.86119C50.3594 3.76553 50.2197 3.71265 50.0748 3.71265C49.93 3.71265 49.7903 3.76553 49.6823 3.86119L40.7664 10.4445C40.6614 10.3266 40.549 10.2153 40.43 10.1112L46.4019 1.38897C46.4888 1.28834 46.5366 1.16028 46.5366 1.02786C46.5366 0.89544 46.4888 0.767376 46.4019 0.666747L45.8692 0.166747C45.7597 0.0631654 45.6141 0.00537109 45.4627 0.00537109C45.3113 0.00537109 45.1657 0.0631654 45.0561 0.166747L36.9814 6.69453L34.1776 11.4723L28.5702 12.1112C28.4613 12.1222 28.3514 12.1079 28.2491 12.0693C28.1469 12.0307 28.0552 11.969 27.9814 11.889L26.7477 10.5834C26.5642 10.3736 26.3255 10.2183 26.0582 10.135C25.7909 10.0516 25.5055 10.0434 25.2337 10.1112C24.9894 10.1505 24.7579 10.2465 24.5581 10.3913C24.3583 10.5361 24.1959 10.7257 24.0842 10.9445L23.8879 11.3056L23.4393 14.5001C23.4289 14.5951 23.3878 14.6843 23.3221 14.7543C23.2564 14.8244 23.1697 14.8716 23.0748 14.889C18.1494 16.1595 13.5401 18.4192 9.53278 21.5279C6.31928 23.8981 3.30903 26.5274 0.53278 29.389C0.358151 29.5595 0.219483 29.7628 0.124834 29.9869C0.030186 30.211 -0.0185547 30.4516 -0.0185547 30.6945C-0.0185547 30.9375 0.030186 31.178 0.124834 31.4021C0.219483 31.6263 0.358151 31.8295 0.53278 32.0001L1.06549 32.5556C1.4238 32.9076 1.90672 33.107 2.41128 33.1112C2.87495 33.1064 3.32192 32.9391 3.67297 32.639C5.4954 31.0279 8.83185 28.2779 11.4113 26.2501C15.7419 22.861 20.5621 20.1361 25.7103 18.1667L34.6823 14.6945C35.0492 15.3408 35.5936 15.8705 36.2524 16.2223L32.972 24.5556C30.9616 29.64 28.1924 34.3966 24.7571 38.6667C22.7103 41.2501 19.9346 44.5279 18.3085 46.3334C17.9834 46.6865 17.8032 47.1472 17.8032 47.6251C17.8032 48.103 17.9834 48.5637 18.3085 48.9167L18.8412 49.4445C19.0168 49.6213 19.2264 49.7615 19.4575 49.8569C19.6886 49.9523 19.9366 50.001 20.187 50.0001C20.6741 50.0037 21.1447 49.8252 21.5047 49.5001C24.3085 46.7223 34.0094 36.9445 36.1683 27.2779C36.1897 27.1856 36.2385 27.1019 36.3085 27.0375C36.3785 26.9731 36.4664 26.931 36.5608 26.9167L39.6449 26.5834L40.1496 26.3612C40.3726 26.246 40.5649 26.0803 40.7111 25.8776C40.8572 25.6749 40.953 25.4408 40.9907 25.1945C41.0333 24.9504 41.0119 24.6996 40.9284 24.4661C40.8449 24.2326 40.7023 24.0243 40.5141 23.8612L39.2524 22.5279C39.1734 22.4534 39.1122 22.3624 39.0734 22.2614C39.0345 22.1605 39.0191 22.0522 39.0281 21.9445L39.673 16.389L44.8599 13.2223L50.8599 5.11119C50.9507 5.00534 50.9982 4.86962 50.993 4.73079C50.9878 4.59196 50.9303 4.46009 50.8318 4.36119ZM25.43 17.4723C20.2206 19.5135 15.3526 22.323 10.9907 25.8056C8.41128 27.7779 5.0468 30.5556 3.19633 32.0834C2.98043 32.2747 2.70094 32.3805 2.41128 32.3805C2.12163 32.3805 1.84213 32.2747 1.62624 32.0834L1.06549 31.5556C0.86256 31.3355 0.750042 31.0482 0.750042 30.7501C0.750042 30.452 0.86256 30.1646 1.06549 29.9445C3.86923 27.1667 13.5702 17.7501 23.2431 15.6667C23.4851 15.6204 23.7057 15.4982 23.8723 15.3181C24.0389 15.1381 24.1427 14.9097 24.1683 14.6667L24.5328 11.639L24.701 11.3334C24.7389 11.2146 24.8083 11.1081 24.902 11.025C24.9958 10.9419 25.1103 10.8853 25.2337 10.8612C25.3709 10.8289 25.5144 10.8352 25.6482 10.8793C25.7819 10.9235 25.9006 11.0038 25.9907 11.1112L27.2244 12.4445C27.3823 12.5987 27.5713 12.7181 27.7791 12.7947C27.9869 12.8713 28.2087 12.9034 28.43 12.889H28.7103L29.5795 15.9167L25.43 17.4723ZM34.2337 14.0834L30.2804 15.5834L29.4674 12.8056L34.2337 12.2779V14.0834ZM40.0935 24.2779C40.1866 24.3666 40.2578 24.4755 40.3015 24.5959C40.3453 24.7163 40.3605 24.8451 40.3459 24.9723C40.3297 25.1035 40.28 25.2285 40.2015 25.3355C40.123 25.4424 40.0183 25.5277 39.8973 25.5834H39.5889L36.4487 26.0834C36.1985 26.103 35.9616 26.2033 35.7743 26.3688C35.587 26.5343 35.4595 26.756 35.4113 27.0001C33.3085 36.5834 23.8038 46.2223 20.944 48.9445C20.7296 49.1499 20.4431 49.2647 20.1449 49.2647C19.8467 49.2647 19.5602 49.1499 19.3459 48.9445L18.8132 48.389C18.6077 48.1813 18.4926 47.902 18.4926 47.6112C18.4926 47.3203 18.6077 47.0411 18.8132 46.8334C20.4954 45.0001 23.2991 41.6667 25.2337 39.139C28.7405 34.8118 31.5755 29.9901 33.6449 24.8334L35.215 20.7779L38.3552 21.2779V21.8612C38.3259 22.0814 38.3515 22.3054 38.4297 22.5136C38.5079 22.7218 38.6363 22.9079 38.8038 23.0556L40.0935 24.2779ZM39.6169 15.389C39.4262 15.518 39.2187 15.6208 39.0001 15.6945V16.5001L38.8318 18.1112V18.3612L38.5795 20.5556L35.6356 20.0834L36.2804 18.4445L37.0655 16.4723L37.3178 15.7779C37.0178 15.7347 36.7253 15.6506 36.4487 15.5279C35.9779 15.2684 35.5847 14.8902 35.309 14.4316C35.0332 13.9731 34.8848 13.4505 34.8786 12.9167C34.8862 11.9343 35.1676 10.973 35.6917 10.139L35.8599 9.86119L37.43 7.27786L45.4206 0.805636L45.729 1.08341L39.8131 9.69452L39.3926 10.3056C39.8672 10.5606 40.2636 10.9378 40.54 11.3973C40.8163 11.8569 40.9624 12.3818 40.9627 12.9167C40.964 13.4073 40.8415 13.8904 40.6065 14.3221C40.3715 14.7538 40.0313 15.1206 39.6169 15.389ZM44.4393 12.6112L41.3552 14.4445C41.5906 13.9588 41.715 13.4277 41.7197 12.889C41.698 12.2648 41.5249 11.655 41.215 11.1112L49.9066 4.55564L50.215 4.83341L44.4393 12.6112ZM38.0468 14.4445C37.7284 14.45 37.4156 14.3611 37.1485 14.1893C36.8815 14.0174 36.6723 13.7705 36.5479 13.48C36.4235 13.1896 36.3895 12.869 36.4502 12.5593C36.511 12.2496 36.6638 11.9649 36.889 11.7418C37.1141 11.5188 37.4014 11.3674 37.714 11.3072C38.0266 11.247 38.3503 11.2807 38.6434 11.4039C38.9365 11.5272 39.1858 11.7344 39.3593 11.999C39.5327 12.2636 39.6224 12.5735 39.6169 12.889C39.6206 13.0956 39.5828 13.3008 39.5055 13.4928C39.4283 13.6847 39.3132 13.8595 39.1671 14.0069C39.0209 14.1543 38.8465 14.2714 38.6542 14.3513C38.4618 14.4312 38.2554 14.4723 38.0468 14.4723V14.4445Z" fill="#909090"/>
                                                        </g>
                                                        <defs>
                                                        <clipPath id="clip0">
                                                        <rect width="51" height="55" fill="white"/>
                                                        </clipPath>
                                                        </defs>
                                                        </svg>
                                                    <p>Optical Supplies</p>
                                                     </a>
                                                    </div>
                                                    <div class="featureicon">
                                                        <a href="/optazoom-multi/category/Cases/">
                                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     viewBox="0 0 77 52.6" style="enable-background:new 0 0 77 52.6;" xml:space="preserve">
<style type="text/css">
    .st0{fill:#909090;}
    .st1{fill:none;stroke:#909090;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
</style>
<g transform="translate(-2.034 -7.93)">
    <g>
        <path class="st0" d="M11.4,30.6c-0.1,0-0.1,0-0.2,0c-3.4-0.6-9.5-3.4-8.7-9.5c0.9-7.2,6.5-12.3,10-12.7c0.7-0.2,2.9-0.5,10-0.5H59
            c7.1,0,9.3,0.2,10,0.5c3.5,0.4,9.1,5.6,10,12.7c0.8,6.1-5.4,8.9-8.7,9.5c-0.5,0.1-1-0.2-1-0.7c-0.1-0.5,0.2-1,0.7-1
            c0.3-0.1,8-1.6,7.3-7.5c-0.9-6.8-6.1-10.9-8.5-11.2c-0.1,0-0.2,0-0.3-0.1C68.2,10,66.6,9.7,59,9.7H22.6c-7.7,0-9.2,0.3-9.5,0.4
            c-0.1,0-0.2,0.1-0.3,0.1c-2.4,0.2-7.6,4.4-8.5,11.2c-0.8,5.9,7.2,7.5,7.3,7.5c0.5,0.1,0.8,0.6,0.7,1
            C12.2,30.3,11.9,30.6,11.4,30.6z"/>
    </g>
    <path class="st1" d="M59,8.8"/>
    <g>
        <path class="st0" d="M7.8,23.4c-0.3,0-0.5-0.1-0.7-0.4c-0.3-0.4-0.2-1,0.2-1.3c2-1.5,4.4-2.4,6.9-2.6l52.1,0
            c2.6,0.2,4.9,1.1,6.9,2.6c0.4,0.3,0.5,0.9,0.2,1.3c-0.3,0.4-0.9,0.5-1.3,0.2c-1.7-1.3-3.8-2.1-5.9-2.2l-52,0
            c-2.1,0.1-4.1,0.9-5.8,2.2C8.2,23.3,8,23.4,7.8,23.4z"/>
    </g>
    <path class="st1" d="M72.6,45.9"/>
    <g>
        <path class="st0" d="M65.8,51.3H14.6c-3.6,0-7.7-4.7-8.2-5.3c-0.3-0.4-0.3-0.9,0.1-1.3c0.4-0.3,0.9-0.3,1.3,0.1
            c1.1,1.3,4.4,4.6,6.8,4.6h51.2c2.4,0,5.7-3.3,6.8-4.6c0.3-0.4,0.9-0.4,1.3-0.1c0.4,0.3,0.4,0.9,0.1,1.3
            C73.5,46.6,69.5,51.3,65.8,51.3z"/>
    </g>
    <g>
        <path class="st0" d="M18.7,60.5c-7.9-0.8-13-3.5-15.3-7.9c-3.9-7.5,1.5-17,1.7-17.4c0.2-0.4,0.8-0.6,1.2-0.3C6.8,35,7,35.6,6.7,36
            C6.7,36.1,1.6,45.2,5,51.8c2,3.9,6.7,6.3,13.8,7l43.6,0c7-0.7,11.7-3,13.7-7c3.4-6.6-1.6-15.6-1.7-15.7c-0.2-0.4-0.1-1,0.3-1.2
            c0.4-0.2,1-0.1,1.2,0.3c0.2,0.4,5.6,10,1.7,17.4c-2.3,4.5-7.4,7.2-15.2,7.9L18.7,60.5z"/>
    </g>
    <g>
        <path class="st0" d="M18.1,43.4c-1.4,0-2.7-0.5-3.6-1.5c-1-1-1.5-2.3-1.5-3.6v-2.4c0-1.4,0.5-2.7,1.5-3.6c1-1,2.3-1.5,3.6-1.5
            h12.1c0,0,0,0,0,0c2.8,0,5.1,2.3,5.1,5.1v2.4c0,2.8-2.3,5.1-5.2,5.1c0,0,0,0,0,0H18.1C18.1,43.4,18.1,43.4,18.1,43.4z M18.1,32.5
            c-0.9,0-1.7,0.3-2.4,1c-0.6,0.6-1,1.5-1,2.4v2.4c0,0.9,0.3,1.7,1,2.4c0.6,0.6,1.5,1,2.4,1c0,0,0,0,0,0h12.1c0,0,0,0,0,0
            c1.8,0,3.4-1.5,3.4-3.3v-2.4c0-1.8-1.5-3.3-3.3-3.3c0,0,0,0,0,0H18.1z"/>
    </g>
    <g>
        <path class="st0" d="M60.6,43.4C60.6,43.4,60.6,43.4,60.6,43.4H48.6c0,0,0,0,0,0c-1.4,0-2.7-0.5-3.6-1.5c-1-1-1.5-2.3-1.5-3.6
            v-2.5c0-1.4,0.5-2.7,1.5-3.6c1-1,2.3-1.5,3.6-1.5h12.1c0,0,0,0,0,0c2.8,0,5.1,2.3,5.1,5.1v2.4C65.8,41.1,63.5,43.4,60.6,43.4z
             M48.6,41.6h12.1h0c0,0,0,0,0,0c1.8,0,3.4-1.5,3.4-3.3v-2.4c0-1.8-1.5-3.3-3.3-3.3c0,0,0,0,0,0H48.6c-0.9,0-1.7,0.3-2.4,1
            c-0.6,0.6-1,1.5-1,2.4v2.4c0,0.9,0.3,1.7,1,2.4C46.8,41.3,47.7,41.6,48.6,41.6C48.6,41.6,48.6,41.6,48.6,41.6z"/>
    </g>
    <g>
        <path class="st0" d="M43.6,35.4h-8.4c-0.5,0-0.9-0.4-0.9-0.9c0-0.5,0.4-0.9,0.9-0.9h8.4c0.5,0,0.9,0.4,0.9,0.9
            C44.5,35,44.1,35.4,43.6,35.4z"/>
    </g>
</g>
</svg>
                                                        <p>Cases</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </ul>
                                        </li>
                                        <li class="arrow-icon"><a href="#">Featured Products</a></li>
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
</svg>                                                         <p>Daily Offers</p></a>
                                                    </div>
                                                </div>
                                            </ul>
                                        </li>
                                       
                                         <li class="arrow-icon"><a href="{{ route('user.optanews') }}">OptaZoom News</a></li>
                                          <li class="arrow-icon"><a href="#">Vendors</a></li>
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
								<a href="{{ route('front.index') }}">
									<i class="fas fa-angle-double-right"></i>{{ $langg->lang22 }}
								</a>
							</li>

							@foreach(DB::table('pages')->where('footer','=',1)->get() as $data)
							<li>
								<a href="{{ route('front.page',$data->slug) }}">
									<i class="fas fa-angle-double-right"></i>{{ $data->title }}
								</a>
							</li>
							@endforeach

							<li>
								<a href="{{ route('front.contact') }}">
									<i class="fas fa-angle-double-right"></i>{{ $langg->lang23 }}
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
							<a href="#">Practioner Login	</a>
							</li>

							<li>
							<a href="#">Vendor Login</a>
							</li>
							<li>
							<a href="#">Optazoom News</a>
							</li>
							<li>
							<a href="#">Become a  Vendor</a>
							</li>
							<li>
							<a href="#">Reset Passwrod</a>
							</li>
							<li>
							<a href="#">Industry news</a>
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
