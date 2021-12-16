@extends('layouts.front')

@section('content')
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="pages">
                    <li>
                        <a href="{{ route('front.index') }}">
                            {{ $langg->lang17 }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.login') }}">
                         Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<section class="login-signup">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <nav class="comment-log-reg-tabmenu">
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link login active" id="nav-log-tab" data-toggle="tab" href="#nav-log" role="tab"
              aria-controls="nav-log" aria-selected="true">
              {{ $langg->lang197 }}
            </a>
            <a class="nav-item nav-link" id="nav-reg-tab" data-toggle="tab" href="#nav-reg" role="tab"
              aria-controls="nav-reg" aria-selected="false">
              {{ $langg->lang198 }}
            </a>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-log" role="tabpanel" aria-labelledby="nav-log-tab">
            <div class="login-area">
              <div class="header-area">
                <h4 class="title">{{ $langg->lang172 }}</h4>
              </div>
              <div class="login-form signin-form">
                @include('includes.admin.form-login')
                <form class="mloginform" action="{{ route('user.login.submit') }}" method="POST">
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
                    <div class="left">
                      <input type="checkbox" name="remember" id="mrp" {{ old('remember') ? 'checked' : '' }}>
                      <label for="mrp">{{ $langg->lang175 }}</label>
                    </div>
                    <div class="right">
                      <a href="{{ route('user-forgot') }}">
                        {{ $langg->lang176 }}
                      </a>
                    </div>
                  </div>
                  <input type="hidden" name="modal" value="1">
                  <input class="mauthdata" type="hidden" value="{{ $langg->lang177 }}">
                  <button type="submit" class="submit-btn">{{ $langg->lang178 }}</button>
                  @if(App\Models\Socialsetting::find(1)->f_check == 1 || App\Models\Socialsetting::find(1)->g_check ==
                  1)
                  <div class="social-area">
                    <h3 class="title">{{ $langg->lang179 }}</h3>
                    <p class="text">{{ $langg->lang180 }}</p>
                    <ul class="social-links">
                      @if(App\Models\Socialsetting::find(1)->f_check == 1)
                      <li>
                        <a href="{{ route('social-provider','facebook') }}">
                          <i class="fab fa-facebook-f"></i>
                        </a>
                      </li>
                      @endif
                      @if(App\Models\Socialsetting::find(1)->g_check == 1)
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
                         <input  maxlength="1"  oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="m-2 text-center form-control rounded tabs" name="first" value="" type="text" id="first" maxlength="1" /> 
                         <input  maxlength="1"  oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="m-2 text-center form-control rounded tabs" name="second" value="" type="text" id="second" maxlength="1" /> 
                         <input  maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="m-2 text-center form-control rounded tabs" name="third" type="text" id="third" maxlength="1" /> 
                         <input  maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="m-2 text-center form-control rounded tabs"   name="fourth"  type="text" id="fourth" maxlength="1" /> 
                         <input  maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="m-2 text-center form-control rounded tabs" name="fifth" type="text" id="fifth" maxlength="1" /> 
                         <input  maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="m-2 text-center form-control rounded tabs" type="text" name="sixth" id="sixth" maxlength="1" /> </div>
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


@endsection