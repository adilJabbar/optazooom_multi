@extends('layouts.front')
@section('content')

    <!--Breadcrumb-->
    <div class="breadcrumb justify-content-center pt-60 pb-60">
        <div>
            <ol class="breadcrumb">
                <h3 class="bread-login"> {{ $page->title }}</h3>
            </ol>
            <ol class="breadcrumb">
            
                <li class="breadcrumb-item bread-title"><a href="{{ route('front.index') }}">
                            {{ $langg->lang17 }}
                        </a></li>
    <li class="breadcrumb-item bread-title active bread-title" aria-current="page">
    {{ $page->title }}
    </li>
            </ol>
        </div>
    </div>

    <!--Breadcrumb end-->



<section class="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="about-info">
            <h4 class="title">
              {{ $page->title }}
            </h4>
            <p>
              {!! $page->details !!}
            </p>

          </div>
        </div>
      </div>
    </div>
  </section>

@endsection