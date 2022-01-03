@extends('layouts.front')
@section('content')

<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="pages">
                    <li>
                        <a href="{{ route('front.indexx') }}">
                            {{ $langg->lang17 }}
                        </a>
                    </li>
                    <li>
                    <a href="{{ route('front.about') }}">
                     About Optazoom
                    </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->

    <!-- Page Area Start -->
    <div class="container">
            <div class="about-content row" style="padding-bottom: 30px; padding-top:30px;">
                <div class="col-lg-3 col-md-3 col-">
                    <div class="about-img" style="margin-top:50px; text-align:center;">
                        <img src="{{asset('assets/images/aron.jpg')}}"">
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="pt-30">
                        <p>
                        Hi! I’m Aaron, the founder of OptaZoom.<br>
                        I grew up in Santa Monica in a family optical business, that’s been around for nearly 40 years and still here today; serving optical and optometry practices internationally (Triumph Optical). Around 4 years ago I developed optazoom.com that enables ECP’s to order from many different suppliers in one place, like Amazon or instacart.<br> 
                        The goal of OptaZoom was to make as many familiar supplier availble to ECP’s, at the same time offer those products that they already know at the same price as going direct, all in one platform. <br>
                        I currently live in Los Angeles with my beautiful wife and daughter Talia. I love my family and I strive each day to move the eye care industry forward, one step at a time.<br>
                        Click the link below and join the OptaZoom family making that ordering process one less thing to worry about in your practice.
                       </p>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="pt-30">
                        <p>
                        With OptaZoom, shopping for all your practice needs becomes easy. Spend less time and money ordering the same items from multiple vendors and spend more time with patients.
                        At OptaZoom.com we envisioned a one stop shopping experience where an ECP can have access to the entire eye care industry with the click of a button.
                        Well, we haven’t gotten the entire eye care industry on board yet. However, with over 50 companies ranging from frames, cases, supplies and just over 80,000 different items to choose from, we at OptaZoom.com are simplifying the buying experience for ECPS across the globe and we hope to do the same for you.
                    </p>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5">
                    <div class="about-img" style="margin-top:50px;">
                        <img src="{{asset('assets/images/aron_opta_2.png')}}"">
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
               <div class="creation-account text-center">
                    <a href="{{ route('user.login')}}"><button type="button" class="btn ">Join Free Today</button></a>
                </div>
    <!-- Page Area End -->

    @endsection