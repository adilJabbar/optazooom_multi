@extends('layouts.front')

@section('content')
<!--Breadcrumb-->
<div class="breadcrumb justify-content-center pt-60 pb-60">
    <div>
        <ol class="breadcrumb">
            <h3 class="bread-login">{{ $langg->lang168 }}</h3>
        </ol>
        <ol class="breadcrumb" style="position: relative; left: 25px;">

            <li class="breadcrumb-item bread-title"><a href="{{ route('front.index') }}">
								{{ $langg->lang17 }}
							</a></li>
            <li class="breadcrumb-item bread-title active bread-title" aria-current="page">{{ $langg->lang168 }}</li>
        </ol>
    </div>
</div>

<!--Breadcrumb end-->
@if($ps->featured == 1)
		<!-- Trending Item Area Start -->
		<section  class="trending">
						<div class="trending-item-slider-new">
							@foreach($feature_products as $prod)
								@include('includes.product.featured-product')
							@endforeach
						</div>
		</section>
		<!-- Tranding Item Area End -->
	@endif

    @endsection