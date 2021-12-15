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


  <!-- Top Header Area End -->

  <!-- Logo Header Area Start -->

  <!-- Logo Header Area End -->


<section class="login-signup">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <nav class="comment-log-reg-tabmenu">
          
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-log" role="tabpanel" aria-labelledby="nav-log-tab">
            <div class="login-area">
              <div class="header-area">
                <h4 class="title">Enter Private Credentials</h4>
              </div>
              <div class="login-form signin-form">
                
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
</div>
@endif
                @include('includes.admin.form-login')
                <form action="{{ route('user.login.submitt') }}" method="POST">
                  {{ csrf_field() }}
                  <div class="form-input">
                    <input type="email" name="email" placeholder="{{ $langg->lang173 }}" required="">
                    <i class="icofont-user-alt-5"></i>
                  </div>
                  <div class="form-input">
                    <input type="password" class="Password" name="password" placeholder="{{ $langg->lang174 }}"
                      required="">
                    <i class="icofont-ui-password"></i>
                  </div>
                  <div class="form-forgot-pass">
                
                   
                  </div>
                  <input type="hidden" name="modal" value="1">
                  <input class="mauthdata" type="hidden" value="{{ $langg->lang177 }}">
                  <button type="submit" style="background-color: #6199d6" class="submit-btn">{{ $langg->lang178 }}</button>
                
                </form>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="nav-reg" role="tabpanel" aria-labelledby="nav-reg-tab">
            <div class="login-area signup-area">
              <div class="header-area">
                <h4 class="title">{{ $langg->lang181 }}</h4>
              </div>
              <div class="login-form signup-form">
                @include('includes.admin.form-login')
                <form class="mregisterform" action="{{route('user-register-submit')}}" method="POST">
                  {{ csrf_field() }}

                  <div class="form-input">
                    <input type="text" class="User Name" name="name" placeholder="First Name" required="">
                    <i class="icofont-user-alt-5"></i>
                  </div>

                  <div class="form-input">
                    <input type="text" class="User Name" name="l_name" placeholder="Last Name" required="">
                    <i class="icofont-user-alt-5"></i>
                  </div>

                   <div class="form-input">
                    <input type="text" class="User Name" name="company" placeholder="Company Name" required="">
                    <i class="icofont-cart"></i>
                  </div>


                  <div class="form-input">
                    <input type="email" class="User Name" name="email" placeholder="{{ $langg->lang183 }}" required="">
                    <i class="icofont-email"></i>
                  </div>

                  <div class="form-input">
                    <input type="text" class="User Name" name="work_phone" placeholder="Work Phone" required="">
                    <i class="icofont-phone"></i>
                  </div>

                   <div class="form-input">
                    <input type="text" class="User Name" name="phone" placeholder="Mobile Phone" required="">
                    <i class="icofont-phone"></i>
                  </div>

                  <div class="form-input">
                      <select style=" width: 100%;height: 50px;
    background: #f3f8fc;
    padding: 0px 30px 0px 45px;
    border: 1px
    solid rgba(0, 0, 0, 0.1);
    font-size: 14px;
    font-weight:300;" class="User Name" placeholder="How Did You Hear About Us?" name="hear_from">
                        <option  value="">How Did You Hear About Us?</option>
						            <option value="google">Facebook</option>
                        <option value="facebook">Facebook</option>
                        <option value="instagram">Instagram</option>
                        <option value="referral_from_colleague">Referral from Colleague </option>
                        <option value="kristie_nguyen">Kristie Nguyen</option>
                      </select>
                    <i class="icofont-location-pin"></i>
                  </div>

                  <div class="form-input">
                    <input type="password" class="Password" name="password" placeholder="{{ $langg->lang186 }}"
                      required="">
                    <i class="icofont-ui-password"></i>
                  </div>

                  <div class="form-input">
                    <input type="password" class="Password" name="password_confirmation"
                      placeholder="{{ $langg->lang187 }}" required="">
                    <i class="icofont-ui-password"></i>
                  </div>

                 <div class="from-input">
                   <input type="checkbox" id="opta-login" name="opta-login" value="opta-login">
                   <label for="opta-login"> By submitting this form, I agree to the <span style="color:#fdac38;"><a href="{{asset('/vendor_code_conduct')}}">Privacy Policy</a></span> of OptaZoom</label><br>
                 </div>

                  @if($gs->is_capcha == 1)

               <!--    <ul class="captcha-area">
                    <li>
                      <p><img class="codeimg1" src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i
                          class="fas fa-sync-alt pointer refresh_code "></i></p>
                    </li>
                  </ul>

                  <div class="form-input">
                    <input type="text" class="Password" name="codes" placeholder="{{ $langg->lang51 }}" required="">
                    <i class="icofont-refresh"></i>
                  </div> -->

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
</section>



  <!--Modal Popup start for OTP Verification-->

    <div class="modal fade pt-100" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">       
          <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="login-verification text-center">
                <h3 class="modal-input-heading">Registration Verification</h3>
                <p class="modal-description">We have sent you an authentication<br>
                    code via SMS for Phone Number verification</p>
                    </div>
            <div class="modal-body ">
                <div class="position-relative" >
                    <div class="p-2 text-center"> 
                   <div id="message_otp"></div>
                    <div id="msg"></div>     
                        <div> 
                            <p class="code-title">Enter Code Here</p>
                        </div>
                        <form id="verify_otp" action="{{route('user-verify-otp')}}" method="POST">
                             {{ csrf_field() }}
                        <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2 " >
                         <input  oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="m-2 text-center form-control rounded tabs" name="first" value="" type="text" id="first" maxlength="1" /> 
                         <input  oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="m-2 text-center form-control rounded tabs" name="second" value="" type="text" id="second" maxlength="1" /> 
                         <input  oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="m-2 text-center form-control rounded tabs" name="third" type="text" id="third" maxlength="1" /> 
                         <input  oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="m-2 text-center form-control rounded tabs"   name="fourth"  type="text" id="fourth" maxlength="1" /> 
                         <input  oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="m-2 text-center form-control rounded tabs" name="fifth" type="text" id="fifth" maxlength="1" /> 
                         <input  oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="m-2 text-center form-control rounded tabs" type="text" name="sixth" id="sixth" maxlength="1" /> </div>
                        <button class="register-otp-button" type="submit"><i class="fa fa-long-arrow-right circle-icon-arrow"></i> </button>
                        <!-- <a href="#"><i class="fa fa-long-arrow-right circle-icon-arrow"></i></a> -->
                        <input type="hidden" name="id" value="" id="vendor_id">
                        </form>
                        <div class="card-2">
                             <div id="resend_code">
                        </div>
                          <!-- <a onclick="resend_code()" href="#"> <p class="resend-title">Resend Code</p></a> -->
                             <a href="#" class="text-decoration-none ms-3"><span class="time" id="timer">00:59</span></a> </div>
                        </div>
                    </div>
                   
                </div>
            </div>
          </div>
        </div>


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
					            	<option value="google">Facebook</option>
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