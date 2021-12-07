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
                        <a href="#">
                        {{ $langg->lang427 }}                   
                           </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->


<section class="fourzerofour">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="content">
            <img src="{{asset('assets/images/404.jpg')}}" alt="">
          </div>
          <div class="">
          <a class="mybtn1" href="{{ route('front.index') }}">{{ $langg->lang430 }}</a>
        </div>
        </div>
      </div>
    </div>
</section>


@endsection