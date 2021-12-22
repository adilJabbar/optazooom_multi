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
                        <a href="{{ route('user-profile') }}">
                         Profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('includes.user-dashboard-sidebar')
<div class="col-lg-8">
                    <div class="user-profile-details">
                        <div class="account-info">
                            <div class="header-area">
                                <h4 class="title">
                                    {{ $langg->lang262 }}
                                </h4>
                            </div>
                            <div class="edit-info-area">

                                <div class="body">
                                    <div class="edit-info-area-form">
                                        <div class="gocover"
                                            style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                                        </div>
                                        <form id="userform" action="{{route('user-profile-update')}}" method="POST"
                                            enctype="multipart/form-data">
    
                                            {{ csrf_field() }}
    
                                            @include('includes.admin.form-both')
                                            <div class="upload-img">
                                                @if($user->is_provider == 1)
                                                <div class="img"><img
                                                        src="{{ $user->photo ? asset($user->photo):asset('assets/images/'.$gs->user_image) }}">
                                                </div>
                                                @else
                                                <div class="img"><img
                                                        src="{{ $user->photo ? asset('assets/images/users/'.$user->photo):asset('assets/images/'.$gs->user_image) }}">
                                                </div>
                                                @endif
                                                @if($user->is_provider != 1)
                                                <div class="file-upload-area">
                                                    <div class="upload-file">
                                                        <input type="file" name="photo" class="upload">
                                                        <span>{{ $langg->lang263 }}</span>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input name="name" type="text" class="input-field"
                                                        placeholder="First Name" required=""
                                                        value="{{ $user->name }}">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input name="l_name" type="text" class="input-field"
                                                        placeholder="Last Name" required=""
                                                        value="{{ $user->l_name }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input name="email" type="email" class="input-field" 
                                                        placeholder="{{ $langg->lang265 }}" required=""
                                                        value="{{ $user->email }}" disabled>
                                                   
                                                </div>
                                                <div class="col-lg-6">
                                                    <input name="phone" type="text" class="input-field"
                                                        placeholder="{{ $langg->lang266 }}" required=""
                                                        value="{{ $user->phone }}" disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input name="work_phone" type="text" class="input-field"
                                                        placeholder="Work Phone" value="{{ $user->work_phone }}">
                                                </div>
    
                                                 <div class="col-lg-6">
                                                    <input name="company" type="text" class="input-field"
                                                        placeholder="Company Name" value="{{ $user->company }}">
                                                </div>
    
                                            </div>
                                            <div class="row">
                                                    <div class="col-lg-6">
                                                        <select style=" width: 100%;height: 50px;background: #f3f8fc;padding: 0px 30px 0px 45px;border: 1px solid rgba(0, 0, 0, 0.1);font-size: 14px;" class="User Name" placeholder="How Did You Hear About Us?" name="hear_from">
                                                        <option   value="">How Did You Hear About Us?</option>
                                                        <option  <?php if($user->country == "usa"){ echo "selected"; } ?>  value="facebook">Facebook</option>
                                                        <option <?php if($user->country == "instagram"){ echo "selected"; } ?> value="instagram">Instagram</option>
                                                      </select>
                                                    </div>
    
    
                                            </div>
    
                                            <div class="form-links">
                                                <button class="submit-btn" type="submit">{{ $langg->lang271 }}</button>
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
  </section>

@endsection