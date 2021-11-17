@extends('layouts.front')
@section('content')

    <!--Breadcrumb-->
    <div class="breadcrumb justify-content-center pt-60 pb-60">
        <div>
            <ol class="breadcrumb">
                <h3 class="bread-login">About</h3>
            </ol>
            <ol class="breadcrumb">
            
                <li class="breadcrumb-item bread-title"><a href="{{ route('front.index') }}">
                            {{ $langg->lang17 }}
                        </a></li>
    <li class="breadcrumb-item bread-title active bread-title" aria-current="page">
   About
    </li>
            </ol>
        </div>
    </div>

    <!--Breadcrumb end-->

    <!-- Page Area Start -->
    <div class="container">
            <div class="about-content row" style="padding-bottom: 30px;">
                <div class="about-img">
                    <div class="col-md-12">
                        <img style="width: 1200px; height:450px;" src="{{asset('assets/images/aboutnew.jpg')}}"">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="pt-30">
                        <p>
                        With OptaZoom, shopping for all your practice needs becomes easy. Spend less time and money ordering the same items from multiple vendors and spend more time with patients.
                        At OptaZoom.com we envisioned a one stop shopping experience where an ECP can have access to the entire eye care industry with the click of a button.
                        Well, we haven’t gotten the entire eye care industry on board yet. However, with over 50 companies ranging from frames, cases, supplies and just over 80,000 different items to choose from, we at OptaZoom.com are simplifying the buying experience for ECPS across the globe and we hope to do the same for you.
                    </p>
                    </div>
                </div>

            </div>
        </div>

        <div class="container save-section" style="padding:0;">
    <div class="savetime">
        <img src="{{asset('assets/images/savetime.svg')}}" />
        <div>
            <p>SAVE TIME</p>
            <p>Time is precious, OptaZoom makes it easy for you to order all your optical supplies in one place.
            </p>
        </div>
    </div>


    <div class="savetime">
        <img src="{{asset('assets/images/savemoney.svg')}}" />
        <div>
            <p>SAVE MONEY</p>
            <p>Take advantage of OptaZoom's special distributor pricing and pay less for the same products you already use.
            </p>
        </div>
    </div>



    <div class="savetime" >
        <img src="{{asset('assets/images/less.svg')}}" />
        <div>
            <p>LESS HASSLE</p>
            <p>We make it easy for you to order the items you need all in one place.</p>
        </div>
    </div>
</div>
    <!-- Page Area End -->

    @endsection