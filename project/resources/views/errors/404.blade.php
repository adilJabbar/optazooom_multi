@extends('layouts.front')
@section('content')

<!--Breadcrumb-->
<div class="breadcrumb justify-content-center pt-60 pb-60">
    <div>
        <ol class="breadcrumb">
            <h3 class="bread-login">{{ $langg->lang427 }}</h3>
        </ol>
        <ol class="breadcrumb">

            <li class="breadcrumb-item bread-title"><a href="{{ route('front.index') }}">
								{{ $langg->lang17 }}
							</a></li>
            <li class="breadcrumb-item bread-title active bread-title" aria-current="page">{{ $langg->lang427 }}</li>
        </ol>
    </div>
</div>

<!--Breadcrumb end-->


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