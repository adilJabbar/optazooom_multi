@extends('layouts.front')

@section('content')

<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="pages">

                    <li><a href="{{route('front.indexx')}}">{{ $langg->lang17 }}</a></li>
                    <li><a
                            href="{{route('front.category',$productt->category->slug)}}">{{$productt->category->name}}</a>
                    </li>
                    @if($productt->subcategory_id != null)
                    <li><a
                            href="{{ route('front.subcat',['slug1' => $productt->category->slug, 'slug2' => $productt->subcategory->slug]) }}">{{$productt->subcategory->name}}</a>
                    </li>
                    @endif
                    @if($productt->childcategory_id != null)
                    <li><a
                            href="{{ route('front.childcat',['slug1' => $productt->category->slug, 'slug2' => $productt->subcategory->slug, 'slug3' => $productt->childcategory->slug]) }}">{{$productt->childcategory->name}}</a>
                    </li>
                    @endif
                    <li><a href="{{ route('front.product', $productt->slug) }}">{{ $productt->name }}</a>

                </ul>
            </div>
        </div>
    </div>
</div>

<section class="product-details-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-{{ $gs->reg_vendor == 1 ? '9' : '12' }}">
            <?php $email = DB::table('users')->where('id',$productt->user_id)->first('email');
             $email = $email->email;
             if($email == 'ozbpioptical@gmail.com')
             { ?>
                <div class="row">
                    <div class="col-lg-5 col-md-12">
                        <div class="xzoom-container">
                            <?php $img = explode(',', $productt->photo); ?>
                            <img class="xzoom5" id="xzoom-magnific"
                                src="{{filter_var($img[0], FILTER_VALIDATE_URL) ?$img[0]:asset('assets/images/products/'.$productt->photo)}}"
                                xoriginal="{{$img[0]}}" />
                            <div class="xzoom-thumbs">

                                <div class="all-slider">

                                    <!--  <a href="{{$img[0]}}">-->
                                    <!--<img class="xzoom-gallery5" width="80" src="{{filter_var($img[0], FILTER_VALIDATE_URL) ?$img[0]:asset('assets/images/products/'.$productt->photo)}}" title="The description goes here">-->
                                    <!--  </a>-->

                                    @foreach($productt->galleries as $gal)
                                    <a href="{{asset('assets/images/galleries/'.$gal->photo)}}">
                                        <img class="xzoom-gallery5" width="80"
                                            src="{{asset('assets/images/galleries/'.$gal->photo)}}"
                                            title="The description goes here">
                                    </a>
                                    @endforeach

                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-lg-7">
                        <div class="right-area">
                            <div class="product-info">
                                <h4 class="product-name">{{ $productt->name }}</h4>
                                <div class="info-meta-1">
                                    <ul>

                                        @if($productt->type == 'Physical')
                                        @if($productt->emptyStock())
                                        <li class="product-outstook">
                                            <p>
                                                <i class="icofont-close-circled"></i>
                                                {{ $langg->lang78 }}
                                            </p>
                                        </li>
                                        @else

                                        <li class="product-isstook">
                                            <p>
                                                <i class="icofont-check-circled"></i>
                                                {{ $gs->show_stock == 0 ? '' : $productt->stock }} {{ $langg->lang79 }}
                                            </p>
                                        </li>
                                        @endif
                                        @endif
                                        <li>
                                            <div class="ratings">
                                                <div class="empty-stars"></div>
                                                <div class="full-stars"
                                                    style="width:{{App\Models\Rating::ratings($productt->id)}}%"></div>
                                            </div>
                                        </li>
                                        <li class="review-count">
                                            <p>{{count($productt->ratings)}} {{ $langg->lang80 }}</p>
                                        </li>
                                        @if($productt->product_condition != 0)
                                        <li>
                                            <div
                                                class="{{ $productt->product_condition == 2 ? 'mybadge' : 'mybadge1' }}">
                                                {{ $productt->product_condition == 2 ? 'New' : 'Used' }}
                                            </div>
                                        </li>
                                        @endif
                                    </ul>
                                </div>


                                @if(Auth::user())
                                <div class="product-price">
                                    <p class="title">{{ $langg->lang87 }} :</p>
                                    <p class="price"><span id="sizeprice">{{ $productt->showPrice() }}</span>
                                        <small><del>{{ $productt->showPreviousPrice() }}</del></small>
                                    </p>
                                    @if($productt->youtube != null)
                                    <a href="{{ $productt->youtube }}" class="video-play-btn mfp-iframe">
                                        <i class="fas fa-play"></i>
                                    </a>
                                    @endif
                                </div>

                                @endif

                                <div class="info-meta-2">
                                    <ul>

                                        @if($productt->type == 'License')

                                        @if($productt->platform != null)
                                        <li>
                                            <p>{{ $langg->lang82 }}: <b>{{ $productt->platform }}</b></p>
                                        </li>
                                        @endif

                                        @if($productt->region != null)
                                        <li>
                                            <p>{{ $langg->lang83 }}: <b>{{ $productt->region }}</b></p>
                                        </li>
                                        @endif

                                        @if($productt->licence_type != null)
                                        <li>
                                            <p>{{ $langg->lang84 }}: <b>{{ $productt->licence_type }}</b></p>
                                        </li>
                                        @endif

                                        @endif

                                    </ul>
                                </div>


                                @if(!empty($productt->size))
                                <div class="product-size">
                                    <p class="title">{{ $langg->lang88 }} :</p>
                                    <ul class="siz-list">
                                        @php
                                        $is_first = true;
                                        @endphp
                                        @foreach($productt->size as $key => $data1)
                                        <li class="{{ $is_first ? 'active' : '' }}">
                                            <span class="box">{{ $data1 }}
                                                <input type="hidden" class="size" value="{{ $data1 }}">
                                                <input type="hidden" class="size_qty"
                                                    value="@if(isset($productt->size_qty[$key])){{ $productt->size_qty[$key] }}@endif">
                                                <input type="hidden" class="size_key" value="{{$key}}">
                                                <input type="hidden" class="size_price"
                                                    value="@if(isset($productt->size_price[$key])){{ round($productt->size_price[$key] * $curr->value,2) }} @endif">
                                            </span>
                                        </li>
                                        @php
                                        $is_first = false;
                                        @endphp
                                        @endforeach
                                        <li>
                                    </ul>
                                </div>
                                @endif

                                @if(!empty($productt->color))
                                <div>
                                    <p class="title">{{ $langg->lang89 }} :</p>
                                    <ul class="color-list">
                                        @php
                                        $is_first = true;
                                        @endphp
                                        <select  name="color_name" class="form-select-custom" id="color_select">
                                            @foreach($productt->color as $key => $data1)





                                    <?php try {
                                      $color_back = Helper::get_color_name($productt->color[$key])['hex'];
                                        echo $color_back;
                                    } catch (Exception $e) {
                                        $color_back = '#ffffff';
                                    }

                            ?>

                            <option value="{{ $productt->color[$key]}} ">{{ $productt->color[$key]}}
                            </option>

                                            <!--     <li class="{{ $is_first ? 'active' : '' }}">
                              <span >@if(isset($productt->color[$key])){{ $productt->color[$key]}}  @else(isset($productt->color[$key]['name'])) {{Helper::get_color_name($productt->color[$key])['name']}} @endif</span>
                              <span class="box" data-color="{{ $productt->color[$key] }}" style="background-color:{{$color_back}}"></span>
                            </li> -->
                                            @php
                                            $is_first = false;
                                            @endphp
                                            @endforeach
                                        </select>

                                    </ul>
                                </div>
                                @endif

                                @if(!empty($productt->size))

                                <input type="hidden" id="stock" value="{{ $productt->size_qty[0] }}">
                                @else
                                @php
                                $stck = (string)$productt->stock;
                                @endphp
                                <!-- Available Options For BPI -->
                                <div id="product">
                                @if(!empty($productt->impeller_mounting_hole))
                                <h3>Available Options</h3>
                                <div class="form-group required">
                                    <label class="control-label">Impeller Mounting Hole</label>
                                        <div id="input-option228">
                                            <?php
                                                $impeller_mounting_hole =   explode(',',$productt->impeller_mounting_hole);
                                                $variation_images =   explode(',',$productt->variation_images);
                                                //   dd( $impeller_mounting_hole,$variation_images);
                                                ?>


                                            @foreach($impeller_mounting_hole as $k => $v)
                                                <div class="radio">
                                                <label>
                                                <input type="radio" name="impller_mounting_hole" value="{{$v}}">
                                                    <img src="{{$variation_images[$k]}}" alt="Plain 1/2&quot;" class="img-thumbnail">
                                                    {{$v}}
                                                </label>
                                            </div>

                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                            </div>

                                                        @if($stck != null)
                                                        <input type="hidden" id="stock" value="{{ $stck }}">
                                                        @elseif($productt->type != 'Physical')
                                                        <input type="hidden" id="stock" value="0">
                                                        @else
                                                        <input type="hidden" id="stock" value="">
                                                        @endif

                                                        @endif
                                                        <input type="hidden" id="product_price"
                                                            value="{{ round($productt->vendorPrice() * $curr->value,2) }}">

                                                        <input type="hidden" id="product_id" value="{{ $productt->id }}">
                                                        <input type="hidden" id="curr_pos" value="{{ $gs->currency_format }}">
                                                        <input type="hidden" id="curr_sign" value="{{ $curr->sign }}">
                                                        <div class="info-meta-3">
                                                            <ul class="meta-list">
                                                                @if($productt->product_type != "affiliate")
                                                                <li class="d-block count {{ $productt->type == 'Physical' ? '' : 'd-none' }}">
                                                                    <div class="qty">
                                                                        <ul>
                                                                            <li>
                                                                                <span class="qtminus">
                                                                                    <i class="icofont-minus"></i>
                                                                                </span>
                                                                            </li>
                                                                            <li>
                                                                                <span class="qttotal">1</span>
                                                                            </li>
                                                                            <li>
                                                                                <span class="qtplus">
                                                                                    <i class="icofont-plus"></i>
                                                                                </span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                @endif

                                                                @if (!empty($productt->attributes))
                                                                @php
                                                                $attrArr = json_decode($productt->attributes, true);
                                                                @endphp
                                                                @endif
                                                                @if (!empty($attrArr))
                                                                <div class="product-attributes my-4">
                                                                    <div class="row">
                                                                        @foreach ($attrArr as $attrKey => $attrVal)
                                                                        @if (array_key_exists("details_status",$attrVal) &&
                                                                        $attrVal['details_status'] == 1)

                                                                        <div class="col-lg-6">
                                                                            <div class="form-group mb-2">
                                                                                <strong for=""
                                                                                    class="text-capitalize">{{ str_replace("_", " ", $attrKey) }}
                                                                                    :</strong>
                                                                                <div class="">
                                                                                    @foreach ($attrVal['values'] as $optionKey => $optionVal)
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="hidden" class="keys" value="">
                                                                                        <input type="hidden" class="values" value="">
                                                                                        <input type="radio" id="{{$attrKey}}{{ $optionKey }}"
                                                                                            name="{{ $attrKey }}"
                                                                                            class="custom-control-input product-attr"
                                                                                            data-key="{{ $attrKey }}"
                                                                                            data-price="{{ $attrVal['prices'][$optionKey] * $curr->value }}"
                                                                                            value="{{ $optionVal }}"
                                                                                            {{ $loop->first ? 'checked' : '' }}>
                                                                                        <label class="custom-control-label"
                                                                                            for="{{$attrKey}}{{ $optionKey }}">{{ $optionVal }}

                                                                                            @if (!empty($attrVal['prices'][$optionKey]))
                                                                                            +
                                                                                            {{$curr->sign}}
                                                                                            {{$attrVal['prices'][$optionKey] * $curr->value}}
                                                                                            @endif
                                                                                        </label>
                                                                                    </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                @endif

                                                                @if($productt->product_type == "affiliate")

                                                                <li class="addtocart">
                                                                    <a href="{{ route('affiliate.product', $productt->slug) }}"
                                                                        target="_blank"><i class="icofont-cart"></i> {{ $langg->lang251 }}</a>
                                                                </li>
                                                                @else
                                                                @if($productt->emptyStock())
                                                                <li class="addtocart">
                                                                    <a href="javascript:;" class="cart-out-of-stock">
                                                                        <i class="icofont-close-circled"></i>
                                                                        {{ $langg->lang78 }}</a>
                                                                </li>
                                                                @else
                                                                @if(Auth::user())
                                                                <li class="addtocart">
                                                                    <a href="javascript:;" id="addcrt"><i
                                                                            class="icofont-cart"></i>{{ $langg->lang90 }}</a>
                                                                </li>

                                                                {{-- <li class="addtocart">
                                                                    <a id="qaddcrt" href="javascript:;">
                                                                        <i class="icofont-cart"></i>{{ $langg->lang251 }}
                                                                    </a>
                                                                </li> --}}
                                                                @else
                                                                <li class="addtocart">
                                                                    <a rel-toggle="tooltip" title="{{ $langg->lang90 }}" data-toggle="modal"
                                                                        id="wish-btn" data-target="#comment-log-reg" data-placement="right">
                                                                        <i class="icofont-cart"></i>{{ $langg->lang90 }}
                                                                    </a>
                                                                </li>

                                                                <li class="addtocart">
                                                                    <a rel-toggle="tooltip" title="{{ $langg->lang251 }}" data-toggle="modal"
                                                                        id="wish-btn" data-target="#comment-log-reg" data-placement="right">
                                                                        <i class="icofont-cart"></i>{{ $langg->lang251 }}
                                                                    </a>
                                                                </li>

                                                                @endif
                                                                @endif

                                                                @endif

                                                                @if(Auth::guard('web')->check())
                                                                <li class="favorite">
                                                                    <a href="javascript:;" class="add-to-wish"
                                                                        data-href="{{ route('user-wishlist-add',$productt->id) }}"><i
                                                                            class="icofont-heart-alt"></i></a>
                                                                </li>
                                                                @else
                                                                <li class="favorite">
                                                                    <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg"><i
                                                                            class="icofont-heart-alt"></i></a>
                                                                </li>
                                                                @endif
                                                                <li class="compare">
                                                                    <a href="javascript:;" class="add-to-compare"
                                                                        data-href="{{ route('product.compare.add',$productt->id) }}"><i
                                                                            class="icofont-exchange"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="social-links social-sharing a2a_kit a2a_kit_size_32">
                                                            <ul class="link-list social-links">
                                                                <li>
                                                                    <a class="facebook a2a_button_facebook" href="">
                                                                        <i class="fab fa-facebook-f"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="twitter a2a_button_twitter" href="">
                                                                        <i class="fab fa-twitter"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="linkedin a2a_button_linkedin" href="">
                                                                        <i class="fab fa-linkedin-in"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="pinterest a2a_button_pinterest" href="">
                                                                        <i class="fab fa-pinterest-p"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <script async src="https://static.addtoany.com/menu/page.js"></script>


                                                        @if($productt->ship != null)
                                                        <p class="estimate-time">{{ $langg->lang86 }}: <b> {{ $productt->ship }}</b></p>
                                                        @endif
                                                        @if( $productt->sku != null )
                                                        <p class="p-sku">
                                                            {{ $langg->lang77 }}: <span class="idno">{{ $productt->sku }}</span>
                                                        </p>
                                                        @endif
                                                        @if($gs->is_report)

                                                        {{-- PRODUCT REPORT SECTION --}}

                                                        @if(Auth::guard('web')->check())

                                                        <div class="report-area">
                                                            <a href="javascript:;" data-toggle="modal" data-target="#report-modal"><i
                                                                    class="fas fa-flag"></i> {{ $langg->lang776 }}</a>
                                                        </div>

                                                        @else

                                                        <div class="report-area">
                                                            <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg"><i
                                                                    class="fas fa-flag"></i> {{ $langg->lang776 }}</a>
                                                        </div>
                                                        @endif

                                                        {{-- PRODUCT REPORT SECTION ENDS --}}

                                                        @endif



                                                    </div>
                                                </div>
                                            </div>
                                        </div>
             <?php } elseif($email == 'ozronsoptical@gmail.com')
             {?>
              <!-- Rons Optical Details and Data Starts Here -->
                            <div class="row">
                                <div class="col-lg-5 col-md-12">
                                    <div class="xzoom-container">

                                    <?php $img = explode(',', $productt->photo); ?>
                                        <img class="xzoom5" id="xzoom-magnific" src="{{filter_var($img[0], FILTER_VALIDATE_URL) ?$img[0]:asset('assets/images/products/'.$productt->photo)}}" xoriginal="{{$img[0]}}" />
                                        <div class="xzoom-thumbs">

                                        <div class="all-slider">

                                            <!--  <a href="{{$img[0]}}">-->
                                            <!--<img class="xzoom-gallery5" width="80" src="{{filter_var($img[0], FILTER_VALIDATE_URL) ?$img[0]:asset('assets/images/products/'.$productt->photo)}}" title="The description goes here">-->
                                            <!--  </a>-->

                                        @foreach($productt->galleries as $gal)
                                            <a href="{{asset('assets/images/galleries/'.$gal->photo)}}">
                                                <img class="xzoom-gallery5" width="80" src="{{asset('assets/images/galleries/'.$gal->photo)}}" title="The description goes here">
                                            </a>
                                        @endforeach

                                        </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-7">
                                        <div class="right-area">
                                            <div class="product-info">
                                            <h4 class="product-name">{{ $productt->name }}</h4>
                                                    <div class="info-meta-1">
                                                            <ul>
                                                                    @if($productt->type == 'Physical')
                                                                    @if($productt->emptyStock())
                                                                    <li class="product-outstook">
                                                                        <p>
                                                                        <i class="icofont-close-circled"></i>
                                                                        {{ $langg->lang78 }}
                                                                        </p>
                                                                    </li>
                                                                    @else

                                                                    <li class="product-isstook">
                                                                        <p>
                                                                        <i class="icofont-check-circled"></i>
                                                                        {{ $gs->show_stock == 0 ? '' : $productt->stock }} {{ $langg->lang79 }}
                                                                        </p>
                                                                    </li>
                                                                    @endif
                                                                    @endif
                                                                    <li>
                                                                        <div class="ratings">
                                                                        <div class="empty-stars"></div>
                                                                        <div class="full-stars" style="width:{{App\Models\Rating::ratings($productt->id)}}%"></div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="review-count">
                                                                        <p>{{count($productt->ratings)}} {{ $langg->lang80 }}</p>
                                                                    </li>
                                                                @if($productt->product_condition != 0)
                                                                    <li>
                                                                    <div class="{{ $productt->product_condition == 2 ? 'mybadge' : 'mybadge1' }}">
                                                                        {{ $productt->product_condition == 2 ? 'New' : 'Used' }}
                                                                    </div>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                    </div>


                                        @if(Auth::user())
                                        <div class="product-price">
                                        <p class="title">{{ $langg->lang87 }} :</p>
                                                <p class="price"><span id="sizeprice">{{ $productt->showPrice() }}</span>
                                                <small><del>{{ $productt->showPreviousPrice() }}</del></small></p>
                                                @if($productt->youtube != null)
                                                <a href="{{ $productt->youtube }}" class="video-play-btn mfp-iframe">
                                                    <i class="fas fa-play"></i>
                                                </a>
                                                @endif
                                            </div>

                                        @endif

                                            <div class="info-meta-2">
                                                <ul>

                                                @if($productt->type == 'License')

                                                @if($productt->platform != null)
                                                <li>
                                                    <p>{{ $langg->lang82 }}: <b>{{ $productt->platform }}</b></p>
                                                </li>
                                                @endif

                                                @if($productt->region != null)
                                                <li>
                                                    <p>{{ $langg->lang83 }}: <b>{{ $productt->region }}</b></p>
                                                </li>
                                                @endif

                                                @if($productt->licence_type != null)
                                                <li>
                                                    <p>{{ $langg->lang84 }}: <b>{{ $productt->licence_type }}</b></p>
                                                </li>
                                                @endif

                                                @endif

                                                </ul>
                                            </div>


                                            @if(!empty($productt->size))
                                            <div class="product-size">
                                                <p class="title">{{ $langg->lang88 }} :</p>
                                                <ul class="siz-list">
                                                @php
                                                $is_first = true;
                                                @endphp
                                                @foreach($productt->size as $key => $data1)
                                                <li class="{{ $is_first ? 'active' : '' }}">
                                                    <span class="box">{{ $data1 }}
                                                    <input type="hidden" class="size" value="{{ $data1 }}">
                                                    <input type="hidden" class="size_qty" value="@if(isset($productt->size_qty[$key])){{ $productt->size_qty[$key] }}@endif">
                                                    <input type="hidden" class="size_key" value="{{$key}}">
                                                    <input type="hidden" class="size_price"
                                                        value="@if(isset($productt->size_price[$key])){{ round($productt->size_price[$key] * $curr->value,2) }} @endif">
                                                    </span>
                                                </li>
                                                @php
                                                $is_first = false;
                                                @endphp
                                                @endforeach
                                                <li>
                                                </ul>
                                            </div>
                                            @endif

                                            @if(!empty($productt->color))
                                            <div>
                                                <label>{{ $langg->lang89 }} :</label>
                                                <ul class="color-list">
                                                @php
                                                $is_first = true;
                                                @endphp
                                                <select  name="color" class= "form-select-custom" id="color_select">
                                                @foreach($productt->color as $key => $data1)
                                                <?php try {
                                                    //dd(Helper::get_color_name($productt->color[$key])['hex']);

                                                $color_back = Helper::get_color_name($productt->color[$key])['hex'];
                                                    echo $color_back;
                                                } catch (Exception $e) {
                                                    $color_back = '#ffffff';
                                                }

                                                ?>

                                                    <option value="{{ $productt->color[$key]}} ">{{ $productt->color[$key]}} </option>

                                            <!--     <li class="{{ $is_first ? 'active' : '' }}">
                                                    <span >@if(isset($productt->color[$key])){{ $productt->color[$key]}}  @else(isset($productt->color[$key]['name'])) {{Helper::get_color_name($productt->color[$key])['name']}} @endif</span>
                                                    <span class="box" data-color="{{ $productt->color[$key] }}" style="background-color:{{$color_back}}"></span>
                                                </li> -->
                                                @php
                                                $is_first = false;
                                                @endphp
                                                @endforeach
                                                </select>

                                                </ul>
                                            </div>
                                            @endif

                                            @if(!empty($productt->size) && isset($productt->size_qty[0]))

                                            <input type="hidden" id="stock" value="{{ $productt->size_qty[0] }}">
                                            @else
                                            @php
                                            $stck = (string)$productt->stock;
                                            @endphp

                                            <!-- Variation 1 -->

                                         @if(!empty($productt->strength))


                                            <div>
                                                <label>Strength :</label>
                                                <ul class="color-list">
                                                @php
                                                $is_first = true;
                                                @endphp
                                                <?php  $strength = explode(',',$productt->strength);

                                                 ?>

                                                <select name="strength" class="form-select-custom" id="strength">
                                                @foreach($strength as $key => $data1)
                                                <?php

                                                ?>

                                                    <option value="{{ $data1}} ">{{  $data1}} </option>


                                                @php
                                                $is_first = false;
                                                @endphp
                                                @endforeach
                                                </select>

                                                </ul>
                                            </div>
                                        @endif
                                        @if(!empty($productt->lens))


                                        <div>
                                            <p class="title">Lens :</p>
                                            <ul class="color-list">
                                            @php
                                            $is_first = true;
                                            @endphp
                                            <?php  $lens = explode(',',$productt->lens);

                                             ?>

                                            <select name="lens" class="form-select-custom" id="lens">
                                            @foreach($lens as $key => $data1)
                                            <?php

                                            ?>

                                                <option value="{{ $data1}} ">{{  $data1}} </option>


                                            @php
                                            $is_first = false;
                                            @endphp
                                            @endforeach
                                            </select>

                                            </ul>
                                        </div>
                                    @endif
                                    @if(!empty($productt->frame_size))


                                    <div>
                                        <p class="title">Frame Size :</p>
                                        <ul class="color-list">
                                        @php
                                        $is_first = true;
                                        @endphp
                                        <?php  $frame_size = explode(',',$productt->frame_size);

                                         ?>

                                        <select name="frame_size" class="form-select-custom" id="frame_size">
                                        @foreach($frame_size as $key => $data1)
                                        <?php

                                        ?>

                                            <option value="{{ $data1}} ">{{  $data1}} </option>


                                        @php
                                        $is_first = false;
                                        @endphp
                                        @endforeach
                                        </select>

                                        </ul>
                                    </div>
                                    @endif

                                    @if(!empty($productt->frame_color))


                                    <div >
                                        <p class="title">Frame Color :</p>
                                        <ul class="color-list">
                                        @php
                                        $is_first = true;
                                        @endphp
                                        <?php  $frame_color = explode(',',$productt->frame_color);

                                         ?>

                                        <select name="frame_color" class="form-select-custom" id="frame_color">
                                        @foreach($frame_color as $key => $data1)
                                        <?php

                                        ?>

                                            <option value="{{ $data1}} ">{{  $data1}} </option>


                                        @php
                                        $is_first = false;
                                        @endphp
                                        @endforeach
                                        </select>

                                        </ul>
                                    </div>
                                    @endif

                                            @if($stck != null)
                                            <input type="hidden" id="stock" value="{{ $stck }}">
                                            @elseif($productt->type != 'Physical')
                                            <input type="hidden" id="stock" value="0">
                                            @else
                                            <input type="hidden" id="stock" value="">
                                            @endif

                                            @endif
                                            <input type="hidden" id="product_price" value="{{ round($productt->vendorPrice() * $curr->value,2) }}">

                                            <input type="hidden" id="product_id" value="{{ $productt->id }}">
                                            <input type="hidden" id="curr_pos" value="{{ $gs->currency_format }}">
                                            <input type="hidden" id="curr_sign" value="{{ $curr->sign }}">
                                            <div class="info-meta-3">
                                                <ul class="meta-list">
                                                @if($productt->product_type != "affiliate")
                                                <li class="d-block count {{ $productt->type == 'Physical' ? '' : 'd-none' }}">
                                                    <div class="qty">
                                                    <ul>
                                                        <li>
                                                        <span class="qtminus">
                                                            <i class="icofont-minus"></i>
                                                        </span>
                                                        </li>
                                                        <li>
                                                        <input type="number" name="qttotal" min="1"  value="1" class="qttotal"></span>
                                                        </li>
                                                        <li>
                                                        <span class="qtplus">
                                                            <i class="icofont-plus"></i>
                                                        </span>
                                                        </li>
                                                    </ul>
                                                    </div>
                                                </li>
                                                @endif

                                                @if (!empty($productt->attributes))
                                                    @php
                                                    $attrArr = json_decode($productt->attributes, true);
                                                    @endphp
                                                @endif
                                                @if (!empty($attrArr))
                                                    <div class="product-attributes my-4">
                                                    <div class="row">
                                                    @foreach ($attrArr as $attrKey => $attrVal)
                                                        @if (array_key_exists("details_status",$attrVal) && $attrVal['details_status'] == 1)

                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-2">
                                                            <strong for="" class="text-capitalize">{{ str_replace("_", " ", $attrKey) }} :</strong>
                                                            <div class="">
                                                            @foreach ($attrVal['values'] as $optionKey => $optionVal)
                                                            <div class="custom-control custom-radio">
                                                                <input type="hidden" class="keys" value="">
                                                                <input type="hidden" class="values" value="">
                                                                <input type="radio" id="{{$attrKey}}{{ $optionKey }}" name="{{ $attrKey }}" class="custom-control-input product-attr"  data-key="{{ $attrKey }}" data-price = "{{ $attrVal['prices'][$optionKey] * $curr->value }}" value="{{ $optionVal }}" {{ $loop->first ? 'checked' : '' }}>
                                                                <label class="custom-control-label" for="{{$attrKey}}{{ $optionKey }}">{{ $optionVal }}

                                                                @if (!empty($attrVal['prices'][$optionKey]))
                                                                +
                                                                {{$curr->sign}} {{$attrVal['prices'][$optionKey] * $curr->value}}
                                                                @endif
                                                                </label>
                                                            </div>
                                                            @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                        @endif
                                                    @endforeach
                                                    </div>
                                                    </div>
                                                @endif

                                                @if($productt->product_type == "affiliate")

                                                <li class="addtocart">
                                                    <a href="{{ route('affiliate.product', $productt->slug) }}" target="_blank"><i
                                                        class="icofont-cart"></i> {{ $langg->lang251 }}</a>
                                                </li>
                                                @else
                                                @if($productt->emptyStock())
                                                <li class="addtocart">
                                                    <a href="javascript:;" class="cart-out-of-stock">
                                                    <i class="icofont-close-circled"></i>
                                                    {{ $langg->lang78 }}</a>
                                                </li>
                                                @else
                                                @if(Auth::user())
                                                <li class="addtocart">
                                                    <a href="javascript:;" id="addcrt"><i class="icofont-cart"></i>{{ $langg->lang90 }}</a>
                                                </li>

                                                {{-- <li class="addtocart">
                                                    <a id="qaddcrt" href="javascript:;">
                                                    <i class="icofont-cart"></i>{{ $langg->lang251 }}
                                                    </a>
                                                </li> --}}
                                                @else
                                                    <li class="addtocart">
                                                    <a rel-toggle="tooltip" title="{{ $langg->lang90 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
                                                    <i class="icofont-cart"></i>{{ $langg->lang90 }}
                                                    </a>
                                                </li>

                                                    <li class="addtocart">
                                                    <a rel-toggle="tooltip" title="{{ $langg->lang251 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
                                                    <i class="icofont-cart"></i>{{ $langg->lang251 }}
                                                    </a>
                                                </li>

                                                @endif
                                                @endif

                                                @endif

                                                @if(Auth::guard('web')->check())
                                                <li class="favorite">
                                                    <a href="javascript:;" class="add-to-wish"
                                                    data-href="{{ route('user-wishlist-add',$productt->id) }}"><i class="icofont-heart-alt"></i></a>
                                                </li>
                                                @else
                                                <li class="favorite">
                                                    <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg"><i
                                                        class="icofont-heart-alt"></i></a>
                                                </li>
                                                @endif
                                                <li class="compare">
                                                    <a href="javascript:;" class="add-to-compare"
                                                    data-href="{{ route('product.compare.add',$productt->id) }}"><i class="icofont-exchange"></i></a>
                                                </li>
                                                </ul>
                                            </div>
                                            <div class="social-links social-sharing a2a_kit a2a_kit_size_32">
                                                <ul class="link-list social-links">
                                                <li>
                                                    <a class="facebook a2a_button_facebook" href="">
                                                    <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="twitter a2a_button_twitter" href="">
                                                    <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="linkedin a2a_button_linkedin" href="">
                                                    <i class="fab fa-linkedin-in"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="pinterest a2a_button_pinterest" href="">
                                                    <i class="fab fa-pinterest-p"></i>
                                                    </a>
                                                </li>
                                                </ul>
                                            </div>
                                            <script async src="https://static.addtoany.com/menu/page.js"></script>


                                            @if($productt->ship != null)
                                                <p class="estimate-time">{{ $langg->lang86 }}: <b> {{ $productt->ship }}</b></p>
                                            @endif
                                            @if( $productt->sku != null )
                                            <p class="p-sku">
                                                {{ $langg->lang77 }}: <span class="idno">{{ $productt->sku }}</span>
                                            </p>
                                            @endif
                                        @if($gs->is_report)

                                        {{-- PRODUCT REPORT SECTION --}}

                                                        @if(Auth::guard('web')->check())

                                                        <div class="report-area">
                                                            <a href="javascript:;" data-toggle="modal" data-target="#report-modal"><i class="fas fa-flag"></i> {{ $langg->lang776 }}</a>
                                                        </div>

                                                        @else

                                                        <div class="report-area">
                                                            <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg"><i class="fas fa-flag"></i> {{ $langg->lang776 }}</a>
                                                        </div>
                                                        @endif

                                        {{-- PRODUCT REPORT SECTION ENDS --}}

                                        @endif
                                            </div>
                                        </div>

                                        </div>
                            </div>
              <!-- Rons Optical Details and Data ends here -->
              <?php } elseif($email == 'ozcaprioptics@gmail.com')
             {
                if(!empty($productt->color_price_extra))
                    {
                        $color_pice_extra = explod(',',$productt->color_price_extra);
                    }
                    if(!empty($productt->title))
                    {
                        $title = explod(',',$productt->title);
                    }
                    if(!empty($productt->title_price_extra))
                    {
                        $title_price_extra = explod(',',$productt->title_price_extra);
                    }
                    if(!empty($productt->eye))
                    {
                        $eye = explod(',',$productt->eye);
                    }
                    if(!empty($productt->eye_price_extra))
                    {
                        $eye_price_extra = explod(',',$productt->eye_price_extra);
                    }


                 ?>
             <!-- Capri Optics Details and Data Starts Here -->
<div class="row">
    <div class="col-lg-5 col-md-12">
        <div class="xzoom-container">

          <?php $img = explode(',', $productt->photo); ?>
            <img class="xzoom5" id="xzoom-magnific" src="{{filter_var($img[0], FILTER_VALIDATE_URL) ?$img[0]:asset('assets/images/products/'.$productt->photo)}}" style="height:200px; width:400px;" xoriginal="{{$img[0]}}" />
            <div class="xzoom-thumbs">

              <div class="all-slider">

                <!--  <a href="{{$img[0]}}">-->
                <!--<img class="xzoom-gallery5" width="80" src="{{filter_var($img[0], FILTER_VALIDATE_URL) ?$img[0]:asset('assets/images/products/'.$productt->photo)}}" title="The description goes here">-->
                <!--  </a>-->

              @foreach($productt->galleries as $gal)
                  <a href="{{asset('assets/images/galleries/'.$gal->photo)}}">
                    <img class="xzoom-gallery5" width="80" src="{{asset('assets/images/galleries/'.$gal->photo)}}" title="The description goes here">
                  </a>
              @endforeach

              </div>

            </div>
        </div>

    </div>
    <div class="col-lg-7">
              <div class="right-area">
                <div class="product-info">
                  <h4 class="product-name">{{ $productt->name }}</h4>
                        <div class="info-meta-1">
                                <ul>
                                          @if($productt->type == 'Physical')
                                          @if($productt->emptyStock())
                                          <li class="product-outstook">
                                            <p>
                                              <i class="icofont-close-circled"></i>
                                              {{ $langg->lang78 }}
                                            </p>
                                          </li>
                                          @else

                                          <li class="product-isstook">
                                            <p>
                                              <i class="icofont-check-circled"></i>
                                              {{ $gs->show_stock == 0 ? '' : $productt->stock }} {{ $langg->lang79 }}
                                            </p>
                                          </li>
                                          @endif
                                          @endif
                                          <li>
                                            <div class="ratings">
                                              <div class="empty-stars"></div>
                                              <div class="full-stars" style="width:{{App\Models\Rating::ratings($productt->id)}}%"></div>
                                            </div>
                                          </li>
                                          <li class="review-count">
                                            <p>{{count($productt->ratings)}} {{ $langg->lang80 }}</p>
                                          </li>
                                      @if($productt->product_condition != 0)
                                        <li>
                                          <div class="{{ $productt->product_condition == 2 ? 'mybadge' : 'mybadge1' }}">
                                            {{ $productt->product_condition == 2 ? 'New' : 'Used' }}
                                          </div>
                                        </li>
                                      @endif
                                </ul>
                        </div>


            @if(Auth::user())
            <div class="product-price">
              <p class="title">{{ $langg->lang87 }} :</p>
                    <p class="price"><span id="sizeprice">{{ $productt->showPrice() }}</span>
                      <small><del>{{ $productt->showPreviousPrice() }}</del></small></p>
                      @if($productt->youtube != null)
                      <a href="{{ $productt->youtube }}" class="video-play-btn mfp-iframe">
                        <i class="fas fa-play"></i>
                      </a>
                    @endif
                  </div>

              @endif

                  <div class="info-meta-2">
                    <ul>

                      @if($productt->type == 'License')

                      @if($productt->platform != null)
                      <li>
                        <p>{{ $langg->lang82 }}: <b>{{ $productt->platform }}</b></p>
                      </li>
                      @endif

                      @if($productt->region != null)
                      <li>
                        <p>{{ $langg->lang83 }}: <b>{{ $productt->region }}</b></p>
                      </li>
                      @endif

                      @if($productt->licence_type != null)
                      <li>
                        <p>{{ $langg->lang84 }}: <b>{{ $productt->licence_type }}</b></p>
                      </li>
                      @endif

                      @endif

                    </ul>
                  </div>


                  @if(!empty($productt->size))
                  <div class="product-size">
                    <p class="title">{{ $langg->lang88 }} :</p>
                    <ul class="siz-list">
                      @php
                      $is_first = true;
                      @endphp
                      @foreach($productt->size as $key => $data1)
                      <li class="{{ $is_first ? 'active' : '' }}">
                        <span class="box">{{ $data1 }}
                          <input type="hidden" class="size" value="{{ $data1 }}">
                          <input type="hidden" class="size_qty" value="@if(isset($productt->size_qty[$key])){{ $productt->size_qty[$key] }}@endif">
                          <input type="hidden" class="size_key" value="{{$key}}">
                          <input type="hidden" class="size_price"
                            value="@if(isset($productt->size_price[$key])){{ round($productt->size_price[$key] * $curr->value,2) }} @endif">
                        </span>
                      </li>
                      @php
                      $is_first = false;
                      @endphp
                      @endforeach
                      <li>
                    </ul>
                  </div>
                  @endif

                  @if(!empty($productt->color))
                  <div>
                    <p class="title">{{ $langg->lang89 }} :</p>
                    <ul class="color-list">
                      @php
                      $is_first = true;
                      @endphp
                      <select name="color" class="form-select-custom" id="color_select">
                      @foreach($productt->color as $key => $data1)
                      <?php try {
                          //dd(Helper::get_color_name($productt->color[$key])['hex']);

                      $color_back = Helper::get_color_name($productt->color[$key])['hex'];
                        echo $color_back;
                      } catch (Exception $e) {
                        $color_back = '#ffffff';
                      }

                      ?>

                        <option value="{{ $productt->color[$key]}} ">{{ $productt->color[$key]}} </option>

                  <!--     <li class="{{ $is_first ? 'active' : '' }}">
                        <span >@if(isset($productt->color[$key])){{ $productt->color[$key]}}  @else(isset($productt->color[$key]['name'])) {{Helper::get_color_name($productt->color[$key])['name']}} @endif</span>
                        <span class="box" data-color="{{ $productt->color[$key] }}" style="background-color:{{$color_back}}"></span>
                      </li> -->
                      @php
                      $is_first = false;
                      @endphp
                      @endforeach
                      </select>

                    </ul>
                  </div>
                  @endif

                  @if(!empty($productt->size) && isset($productt->size_qty[0]))

                  <input type="hidden" id="stock" value="{{ $productt->size_qty[0] }}">
                  @else
                  @php
                  $stck = (string)$productt->stock;
                  @endphp

                  <!-- Variation 1 -->
                <?php echo $productt->specification ?>
                <form class="cart variation-form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="product_id" value="51906">
                <table class="to-cart">
                <thead>
                <tr>
                    <th class="col col-qty col-color">Quantity</th>
                    <th class="col col-size">Size</th>
                    <th class="col col-customer">Customer Name</th>
                </tr>
               </thead>
               <tbody>
               <tr class="variation-row purchasable" data-id="51907">
                <td class="col col-color col-qty">
                 <div class="quantity">
                    <label class="screen-reader-text" for="quantity_61c9b3cd6b40c">Quantity</label>
                    <input type="number" id="quantity_61c9b3cd6b40c" class="input-text qty text" step="1" min="0" max="" name="quantity" value="" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric">
	           </div>
                <span>Black Green Red</span>
                  <input type="hidden" data-type="attribute" name="pa_color" value="Black Green Red">
                </td>
              <td class="col col-size">
              <input type="hidden" data-type="attribute" name="pa_size" value="51- 19- 145">
               <label> 51- 19- 145 </label>
            </td>
             <td class="col col-customer">
              <input type="text" class="input-customer" name="customer" placeholder="Add Customer Name">
            </td>
            </tr>
            <tr class="variation-row purchasable" data-id="51909">
               <td class="col col-color col-qty">
                <div class="quantity">
		<label class="screen-reader-text" for="quantity_61c9b3cd6c078">Quantity</label>
		<input type="number" id="quantity_61c9b3cd6c078" class="input-text qty text" step="1" min="0" max="" name="quantity" value="" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric">
	           </div>
	     <span>Crystal Black Grey</span>
        <input type="hidden" data-type="attribute" name="pa_color" value="Crystal Black Grey">
          </td>
          <td class="col col-size">
          <input type="hidden" data-type="attribute" name="pa_size" value="51- 19- 145">
         <label> 51- 19- 145 </label>
         </td>
        <td class="col col-customer">
         <input type="text" class="input-customer" name="customer" placeholder="Add Customer Name">
        </td>
        </tr>
        <tr class="variation-row purchasable" data-id="51911">
        <td class="col col-color col-qty">
        <div class="quantity">
		<label class="screen-reader-text" for="quantity_61c9b3cd6cc5e">Quantity</label>
		<input type="number" id="quantity_61c9b3cd6cc5e" class="input-text qty text" step="1" min="0" max="" name="quantity" value="" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric">
	   </div>
	     <span>Tortoise Blue Red</span>
        <input type="hidden" data-type="attribute" name="pa_color" value="Tortoise Blue Red">
        </td>
        <td class="col col-size">
        <input type="hidden" data-type="attribute" name="pa_size" value="51- 19- 145">
        <label>  51- 19- 145 </label>
         </td>
          <td class="col col-customer">
         <input type="text" class="input-customer" name="customer" placeholder="Add Customer Name">
          </td>
        </tr>
            </tbody>
        </table>
    </form>
                  @if($stck != null)
                  <input type="hidden" id="stock" value="{{ $stck }}">
                  @elseif($productt->type != 'Physical')
                  <input type="hidden" id="stock" value="0">
                  @else
                  <input type="hidden" id="stock" value="">
                  @endif

                  @endif
                  <input type="hidden" id="product_price" value="{{ round($productt->vendorPrice() * $curr->value,2) }}">

                  <input type="hidden" id="product_id" value="{{ $productt->id }}">
                  <input type="hidden" id="curr_pos" value="{{ $gs->currency_format }}">
                  <input type="hidden" id="curr_sign" value="{{ $curr->sign }}">
                  <div class="info-meta-3">
                    <ul class="meta-list">
                      @if($productt->product_type != "affiliate")
                      <li class="d-block count {{ $productt->type == 'Physical' ? '' : 'd-none' }}">
                        <div class="qty">
                          <ul>
                            <li>
                              <span class="qtminus">
                                <i class="icofont-minus"></i>
                              </span>
                            </li>
                            <li>
                              <input type="number" name="qttotal" min="1"  value="1" class="qttotal"></span>
                            </li>
                            <li>
                              <span class="qtplus">
                                <i class="icofont-plus"></i>
                              </span>
                            </li>
                          </ul>
                        </div>
                      </li>
                      @endif

                      @if (!empty($productt->attributes))
                        @php
                          $attrArr = json_decode($productt->attributes, true);
                        @endphp
                      @endif
                      @if (!empty($attrArr))
                        <div class="product-attributes my-4">
                          <div class="row">
                          @foreach ($attrArr as $attrKey => $attrVal)
                            @if (array_key_exists("details_status",$attrVal) && $attrVal['details_status'] == 1)

                          <div class="col-lg-6">
                              <div class="form-group mb-2">
                                <strong for="" class="text-capitalize">{{ str_replace("_", " ", $attrKey) }} :</strong>
                                <div class="">
                                @foreach ($attrVal['values'] as $optionKey => $optionVal)
                                  <div class="custom-control custom-radio">
                                    <input type="hidden" class="keys" value="">
                                    <input type="hidden" class="values" value="">
                                    <input type="radio" id="{{$attrKey}}{{ $optionKey }}" name="{{ $attrKey }}" class="custom-control-input product-attr"  data-key="{{ $attrKey }}" data-price = "{{ $attrVal['prices'][$optionKey] * $curr->value }}" value="{{ $optionVal }}" {{ $loop->first ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="{{$attrKey}}{{ $optionKey }}">{{ $optionVal }}

                                    @if (!empty($attrVal['prices'][$optionKey]))
                                      +
                                      {{$curr->sign}} {{$attrVal['prices'][$optionKey] * $curr->value}}
                                    @endif
                                    </label>
                                  </div>
                                @endforeach
                                </div>
                              </div>
                          </div>
                            @endif
                          @endforeach
                          </div>
                        </div>
                      @endif

                      @if($productt->product_type == "affiliate")

                      <li class="addtocart">
                        <a href="{{ route('affiliate.product', $productt->slug) }}" target="_blank"><i
                            class="icofont-cart"></i> {{ $langg->lang251 }}</a>
                      </li>
                      @else
                      @if($productt->emptyStock())
                      <li class="addtocart">
                        <a href="javascript:;" class="cart-out-of-stock">
                          <i class="icofont-close-circled"></i>
                          {{ $langg->lang78 }}</a>
                      </li>
                      @else
                      @if(Auth::user())
                      <li class="addtocart">
                        <a href="javascript:;" id="addcrt"><i class="icofont-cart"></i>{{ $langg->lang90 }}</a>
                      </li>

                      {{-- <li class="addtocart">
                        <a id="qaddcrt" href="javascript:;">
                          <i class="icofont-cart"></i>{{ $langg->lang251 }}
                        </a>
                      </li> --}}
                      @else
                        <li class="addtocart">
                        <a rel-toggle="tooltip" title="{{ $langg->lang90 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
                          <i class="icofont-cart"></i>{{ $langg->lang90 }}
                        </a>
                      </li>

                        <li class="addtocart">
                        <a rel-toggle="tooltip" title="{{ $langg->lang251 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
                          <i class="icofont-cart"></i>{{ $langg->lang251 }}
                        </a>
                      </li>

                      @endif
                      @endif

                      @endif

                      @if(Auth::guard('web')->check())
                      <li class="favorite">
                        <a href="javascript:;" class="add-to-wish"
                          data-href="{{ route('user-wishlist-add',$productt->id) }}"><i class="icofont-heart-alt"></i></a>
                      </li>
                      @else
                      <li class="favorite">
                        <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg"><i
                            class="icofont-heart-alt"></i></a>
                      </li>
                      @endif
                      <li class="compare">
                        <a href="javascript:;" class="add-to-compare"
                          data-href="{{ route('product.compare.add',$productt->id) }}"><i class="icofont-exchange"></i></a>
                      </li>
                    </ul>
                  </div>
                  <div class="social-links social-sharing a2a_kit a2a_kit_size_32">
                    <ul class="link-list social-links">
                      <li>
                        <a class="facebook a2a_button_facebook" href="">
                          <i class="fab fa-facebook-f"></i>
                        </a>
                      </li>
                      <li>
                        <a class="twitter a2a_button_twitter" href="">
                          <i class="fab fa-twitter"></i>
                        </a>
                      </li>
                      <li>
                        <a class="linkedin a2a_button_linkedin" href="">
                          <i class="fab fa-linkedin-in"></i>
                        </a>
                      </li>
                      <li>
                        <a class="pinterest a2a_button_pinterest" href="">
                          <i class="fab fa-pinterest-p"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <script async src="https://static.addtoany.com/menu/page.js"></script>


                  @if($productt->ship != null)
                    <p class="estimate-time">{{ $langg->lang86 }}: <b> {{ $productt->ship }}</b></p>
                  @endif
                  @if( $productt->sku != null )
                  <p class="p-sku">
                    {{ $langg->lang77 }}: <span class="idno">{{ $productt->sku }}</span>
                  </p>
                  @endif
              @if($gs->is_report)

              {{-- PRODUCT REPORT SECTION --}}

                            @if(Auth::guard('web')->check())

                            <div class="report-area">
                                <a href="javascript:;" data-toggle="modal" data-target="#report-modal"><i class="fas fa-flag"></i> {{ $langg->lang776 }}</a>
                            </div>

                            @else

                            <div class="report-area">
                                <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg"><i class="fas fa-flag"></i> {{ $langg->lang776 }}</a>
                            </div>
                            @endif

              {{-- PRODUCT REPORT SECTION ENDS --}}

              @endif
                </div>
              </div>

            </div>
 </div>
<!-- Capri Optics Details and Data ends here -->
                    <?php }else if($email == 'info@opticalfirst.com'){ ?>

                        <!-- Optical First Data Starts Here -->
<div class="row">
    <div class="col-lg-5 col-md-12">
        <div class="xzoom-container">
            <input type="hidden" name="title_price" value="" id="title_price_input" />
            <input type="hidden" name="eye_price" value=""  id="eye_price_input" />
            <input type="hidden" name="color_price" value=""  id="color_price_input" />
          <?php $img = explode(',', $productt->photo); ?>
            <img class="xzoom5" id="xzoom-magnific" src="{{filter_var($img[0], FILTER_VALIDATE_URL) ?$img[0]:asset('assets/images/products/'.$productt->photo)}}" xoriginal="{{$img[0]}}" />
            <div class="xzoom-thumbs">

              <div class="all-slider">

                <!--  <a href="{{$img[0]}}">-->
                <!--<img class="xzoom-gallery5" width="80" src="{{filter_var($img[0], FILTER_VALIDATE_URL) ?$img[0]:asset('assets/images/products/'.$productt->photo)}}" title="The description goes here">-->
                <!--  </a>-->

              @foreach($productt->galleries as $gal)
                  <a href="{{asset('assets/images/galleries/'.$gal->photo)}}">
                    <img class="xzoom-gallery5" width="80" src="{{asset('assets/images/galleries/'.$gal->photo)}}" title="The description goes here">
                  </a>
              @endforeach

              </div>

            </div>
        </div>

    </div>
    <div class="col-lg-7">
              <div class="right-area">
                <div class="product-info">
                  <h4 class="product-name">{{ $productt->name }}</h4>
                        <div class="info-meta-1">
                                <ul>
                                          @if($productt->type == 'Physical')
                                          @if($productt->emptyStock())
                                          <li class="product-outstook">
                                            <p>
                                              <i class="icofont-close-circled"></i>
                                              {{ $langg->lang78 }}
                                            </p>
                                          </li>
                                          @else

                                          <li class="product-isstook">
                                            <p>
                                              <i class="icofont-check-circled"></i>
                                              {{ $gs->show_stock == 0 ? '' : $productt->stock }} {{ $langg->lang79 }}
                                            </p>
                                          </li>
                                          @endif
                                          @endif
                                          <li>
                                            <div class="ratings">
                                              <div class="empty-stars"></div>
                                              <div class="full-stars" style="width:{{App\Models\Rating::ratings($productt->id)}}%"></div>
                                            </div>
                                          </li>
                                          <li class="review-count">
                                            <p>{{count($productt->ratings)}} {{ $langg->lang80 }}</p>
                                          </li>
                                      @if($productt->product_condition != 0)
                                        <li>
                                          <div class="{{ $productt->product_condition == 2 ? 'mybadge' : 'mybadge1' }}">
                                            {{ $productt->product_condition == 2 ? 'New' : 'Used' }}
                                          </div>
                                        </li>
                                      @endif
                                </ul>
                        </div>


            @if(Auth::user())
            <div class="product-price">
              <p class="title">{{ $langg->lang87 }} :</p>
                    <p class="price"><span id="sizeprice">{{ $productt->showPrice() }}</span>
                      <small><del>{{ $productt->showPreviousPrice() }}</del></small></p>
                      @if($productt->youtube != null)
                      <a href="{{ $productt->youtube }}" class="video-play-btn mfp-iframe">
                        <i class="fas fa-play"></i>
                      </a>
                    @endif
                  </div>

              @endif

                  <div class="info-meta-2">
                    <ul>

                      @if($productt->type == 'License')

                      @if($productt->platform != null)
                      <li>
                        <p>{{ $langg->lang82 }}: <b>{{ $productt->platform }}</b></p>
                      </li>
                      @endif

                      @if($productt->region != null)
                      <li>
                        <p>{{ $langg->lang83 }}: <b>{{ $productt->region }}</b></p>
                      </li>
                      @endif

                      @if($productt->licence_type != null)
                      <li>
                        <p>{{ $langg->lang84 }}: <b>{{ $productt->licence_type }}</b></p>
                      </li>
                      @endif

                      @endif

                    </ul>
                  </div>


                  @if(!empty($productt->size))
                  <div class="product-size">
                    <p class="title">{{ $langg->lang88 }} :</p>
                    <ul class="siz-list">
                      @php
                      $is_first = true;
                      @endphp
                      @foreach($productt->size as $key => $data1)
                      <li class="{{ $is_first ? 'active' : '' }}">
                        <span class="box">{{ $data1 }}
                          <input type="hidden" class="size" value="{{ $data1 }}">
                          <input type="hidden" class="size_qty" value="@if(isset($productt->size_qty[$key])){{ $productt->size_qty[$key] }}@endif">
                          <input type="hidden" class="size_key" value="{{$key}}">
                          <input type="hidden" class="size_price"
                            value="@if(isset($productt->size_price[$key])){{ round($productt->size_price[$key] * $curr->value,2) }} @endif">
                        </span>
                      </li>
                      @php
                      $is_first = false;
                      @endphp
                      @endforeach
                      <li>
                    </ul>
                  </div>
                  @endif

                  @if(!empty($productt->color))
                  <div class="color-custom">
                    <label>{{ $langg->lang89 }} :</label>
                    <ul class="color-list">
                      @php
                      $is_first = true;
                      @endphp
                      <select name="color" id="color_select" class="form-select-custom color-price">
                      @foreach($productt->color as $key => $data1)
                      <?php try {
                          //dd(Helper::get_color_name($productt->color[$key])['hex']);

                      $color_back = Helper::get_color_name($productt->color[$key])['hex'];
                        echo $color_back;
                      } catch (Exception $e) {
                        $color_back = '#ffffff';
                      }

                      ?>

                        <option value="{{ $productt->color[$key]}} ">{{ $productt->color[$key]}} </option>

                  <!--     <li class="{{ $is_first ? 'active' : '' }}">
                        <span >@if(isset($productt->color[$key])){{ $productt->color[$key]}}  @else(isset($productt->color[$key]['name'])) {{Helper::get_color_name($productt->color[$key])['name']}} @endif</span>
                        <span class="box" data-color="{{ $productt->color[$key] }}" style="background-color:{{$color_back}}"></span>
                      </li> -->
                      @php
                      $is_first = false;
                      @endphp
                      @endforeach
                      </select>

                    </ul>
                  </div>
                  @endif

                  @if(!empty($productt->eye) && isset($productt->eye))

                  <input type="hidden" id="stock" value="@if(isset($productt->size_qty[0])){{ $productt->size_qty[0] }}@endif">

                  @php
                  $stck = (string)$productt->stock;
                  @endphp

                  <!-- Variation 1 -->
                  @if(!empty($productt->eye) && isset($productt->eye))
                  <?php $eye = explode(',',$productt->eye) ?>
                  <label>Eye : </label>
                  <select name="eye" class="form-select-custom form-select-lg mb-3 eye">
                      @foreach($eye as $eye_v => $eye_k)
                      <option value="{{$eye_k}}" >{{$eye_k}}</option>
                      @endforeach
                 </select>
                 @endif

                 <?php
                 if(!empty($productt->eye_price_extra))
                 {
                    $eye_price_extra = explode(',',$productt->eye_price_extra);
                 }

                 ?>
                 

                 @if(!empty($productt->title) && isset($productt->title))

                 <input type="hidden" id="stock" value="@if(isset($productt->size_qty[0])){{ $productt->size_qty[0] }}@endif">

                 @php
                 $stck = (string)$productt->stock;
                 @endphp

                 <!-- Variation 1 -->
                 @if(!empty($productt->title) && isset($productt->title))
                 <?php $title = explode(',',$productt->title) ?>
                 <label>Title : </label>
                 <select name="title" class="form-select-custom form-select-lg mb-3 title">
                     @foreach($title as $title_v => $title_k)
                     <option value="{{$title_k}}" >{{$title_k}}</option>
                     @endforeach
                </select>
                @endif
                @endif
                <?php
                if(!empty($productt->title_price_extra))
                {
                   $title_price_extra = explode(',',$productt->title_price_extra);
                }

                ?>

                <form id="prescription"  method="GET" enctype="multipart/form-data">


                 <!-- Variation 2 -->

                  <label>Add My Prescription: </label>

                  <select class="form-select-custom form-select-lg mb-3" onchange="check(this);">
                      <option selected>Choose Add My Prescription</option>
                      <option value="uppres">Upload Prescription</option>
                      <option value="manpres">Insert Prescription Manually</option>
                 </select>
                 <div id="upload_prescription" style="display: none;">
                    <label for="left_os">Upload Image</label>
                    <input type="file" id="img" name="img" accept="image/*">
                 </div>
                 <div id="manual_prescription" style="display:none;">

                        <label for="left_os">Left Eye (OS): Power</label>
                        <input class="form-select-custom"  id="left_os" type="number" name="left_eye">


                        <label for="right">Right Eye (OD): Power</label>
                        <input class="form-select-custom" id="right_od" type="number" name="right_eye">


                        <label for="bc">BC</label>
                        <input class="form-select-custom" id="bc" type="number" name="bc">

                        <label for="left_diy">Left DIY</label>
                        <input class="form-select-custom" id="left_diy" type="number" name="left_diy">

                        <label for="right_diy">Right DIY</label>
                        <input class="form-select-custom" id="right_diy" type="number" name="right_diy">

                        <label for="right_cyl">Right Eye CYL</label>
                        <input class="form-select-custom" id="right_cyl" type="number" name="right_eye_cyl">

                        <label for="left_cyl">Left Eye CYL</label>
                        <input class="form-select-custom" id="left_cyl" type="number" name="left_eye_cyl">

                        <label for="left_axis">Left Eye Axis</label>
                        <input class="form-select-custom" id="left_axis" type="number" name="left_eye_axis">

                        <label for="right_axis">Right Eye Axis</label>
                        <input  class="form-select-custom" id="right_axis" type="number" name="right_eye_axis">

                        <label for="left_os">Add Power</label>
                        <select class="form-select-custom" name="power">
                          <option value="choose add power">Choose Add Power</option>
                          <option value="75">75</option>
                          <option value="100">100</option>
                          <option value="125">125</option>
                          <option value="150">150</option>
                          <option value="175">175</option>
                          <option value="200">200</option>
                          <option value="225">225</option>
                          <option value="250">250</option>
                          <option value="275">275</option>
                          <option value="300">300</option>
                          <option value="325">325</option>
                          <option value="350">350</option>
                          <option value="375">375 XR</option>
                          <option value="400">400 XR</option>
                          <option value="425">425 XR</option>
                          <option value="450">450 XR</option>
                          <option value="475">475 XR</option>
                          <option value="500">500 XR</option>
                          <option value="525">525 XR</option>
                          <option value="550">550 XR</option>
                          <option value="570">570 XR</option>
                         
                        </select>

                    </div>
                </form>


                  @if($stck != null)
                  <input type="hidden" id="stock" value="{{ $stck }}">
                  @elseif($productt->type != 'Physical')
                  <input type="hidden" id="stock" value="0">
                  @else
                  <input type="hidden" id="stock" value="">
                  @endif

                  @endif
                  <input type="hidden" id="product_price" value="{{ round($productt->vendorPrice() * $curr->value,2) }}">

                  <input type="hidden" id="product_id" value="{{ $productt->id }}">
                  <input type="hidden" id="curr_pos" value="{{ $gs->currency_format }}">
                  <input type="hidden" id="curr_sign" value="{{ $curr->sign }}">
                  <div class="info-meta-3">
                    <ul class="meta-list">
                      @if($productt->product_type != "affiliate")
                      <li class="d-block count {{ $productt->type == 'Physical' ? '' : 'd-none' }}">
                        <div class="qty">
                          <ul>
                            <li>
                              <span class="qtminus">
                                <i class="icofont-minus"></i>
                              </span>
                            </li>
                            <li>
                              <input type="number" name="qttotal" min="1"  value="1" class="qttotal"></span>
                            </li>
                            <li>
                              <span class="qtplus">
                                <i class="icofont-plus"></i>
                              </span>
                            </li>
                          </ul>
                        </div>
                      </li>
                      @endif

                      @if (!empty($productt->attributes))
                        @php
                          $attrArr = json_decode($productt->attributes, true);
                        @endphp
                      @endif
                      @if (!empty($attrArr))
                        <div class="product-attributes my-4">
                          <div class="row">
                          @foreach ($attrArr as $attrKey => $attrVal)
                            @if (array_key_exists("details_status",$attrVal) && $attrVal['details_status'] == 1)

                          <div class="col-lg-6">
                              <div class="form-group mb-2">
                                <strong for="" class="text-capitalize">{{ str_replace("_", " ", $attrKey) }} :</strong>
                                <div class="">
                                @foreach ($attrVal['values'] as $optionKey => $optionVal)
                                  <div class="custom-control custom-radio">
                                    <input type="hidden" class="keys" value="">
                                    <input type="hidden" class="values" value="">
                                    <input type="radio" id="{{$attrKey}}{{ $optionKey }}" name="{{ $attrKey }}" class="custom-control-input product-attr"  data-key="{{ $attrKey }}" data-price = "{{ $attrVal['prices'][$optionKey] * $curr->value }}" value="{{ $optionVal }}" {{ $loop->first ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="{{$attrKey}}{{ $optionKey }}">{{ $optionVal }}

                                    @if (!empty($attrVal['prices'][$optionKey]))
                                      +
                                      {{$curr->sign}} {{$attrVal['prices'][$optionKey] * $curr->value}}
                                    @endif
                                    </label>
                                  </div>
                                @endforeach
                                </div>
                              </div>
                          </div>
                            @endif
                          @endforeach
                          </div>
                        </div>
                      @endif

                      @if($productt->product_type == "affiliate")

                      <li class="addtocart">
                        <a href="{{ route('affiliate.product', $productt->slug) }}" target="_blank"><i
                            class="icofont-cart"></i> {{ $langg->lang251 }}</a>
                      </li>
                      @else
                      @if($productt->emptyStock())
                      <li class="addtocart">
                        <a href="javascript:;" class="cart-out-of-stock">
                          <i class="icofont-close-circled"></i>
                          {{ $langg->lang78 }}</a>
                      </li>
                      @else
                      @if(Auth::user())
                      <li class="addtocart">
                        <a href="javascript:;" id="<?php if($email=='info@opticalfirst.com'){ echo 'addcrtt'; }else{ ?>addcrt <?php } ?>"><i class="icofont-cart"></i>{{ $langg->lang90 }}</a>
                      </li>

                      {{-- <li class="addtocart">
                        <a id="qaddcrt" href="javascript:;">
                          <i class="icofont-cart"></i>{{ $langg->lang251 }}
                        </a>
                      </li> --}}
                      @else
                        <li class="addtocart">
                        <a rel-toggle="tooltip" title="{{ $langg->lang90 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
                          <i class="icofont-cart"></i>{{ $langg->lang90 }}
                        </a>
                      </li>

                        <li class="addtocart">
                        <a rel-toggle="tooltip" title="{{ $langg->lang251 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
                          <i class="icofont-cart"></i>{{ $langg->lang251 }}
                        </a>
                      </li>

                      @endif
                      @endif

                      @endif

                      @if(Auth::guard('web')->check())
                      <li class="favorite">
                        <a href="javascript:;" class="add-to-wish"
                          data-href="{{ route('user-wishlist-add',$productt->id) }}"><i class="icofont-heart-alt"></i></a>
                      </li>
                      @else
                      <li class="favorite">
                        <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg"><i
                            class="icofont-heart-alt"></i></a>
                      </li>
                      @endif
                      <li class="compare">
                        <a href="javascript:;" class="add-to-compare"
                          data-href="{{ route('product.compare.add',$productt->id) }}"><i class="icofont-exchange"></i></a>
                      </li>
                    </ul>
                  </div>
                  <div class="social-links social-sharing a2a_kit a2a_kit_size_32">
                    <ul class="link-list social-links">
                      <li>
                        <a class="facebook a2a_button_facebook" href="">
                          <i class="fab fa-facebook-f"></i>
                        </a>
                      </li>
                      <li>
                        <a class="twitter a2a_button_twitter" href="">
                          <i class="fab fa-twitter"></i>
                        </a>
                      </li>
                      <li>
                        <a class="linkedin a2a_button_linkedin" href="">
                          <i class="fab fa-linkedin-in"></i>
                        </a>
                      </li>
                      <li>
                        <a class="pinterest a2a_button_pinterest" href="">
                          <i class="fab fa-pinterest-p"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <script async src="https://static.addtoany.com/menu/page.js"></script>


                  @if($productt->ship != null)
                    <p class="estimate-time">{{ $langg->lang86 }}: <b> {{ $productt->ship }}</b></p>
                  @endif
                  @if( $productt->sku != null )
                  <p class="p-sku">
                    {{ $langg->lang77 }}: <span class="idno">{{ $productt->sku }}</span>
                  </p>
                  @endif
              @if($gs->is_report)

              {{-- PRODUCT REPORT SECTION --}}

                            @if(Auth::guard('web')->check())

                            <div class="report-area">
                                <a href="javascript:;" data-toggle="modal" data-target="#report-modal"><i class="fas fa-flag"></i> {{ $langg->lang776 }}</a>
                            </div>

                            @else

                            <div class="report-area">
                                <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg"><i class="fas fa-flag"></i> {{ $langg->lang776 }}</a>
                            </div>
                            @endif

              {{-- PRODUCT REPORT SECTION ENDS --}}

              @endif
                </div>
              </div>

            </div>
 </div>
<!-- Optical First Data Ends Here -->
                <?php



                ?>


               <?php     }else{ //dd($email); ?>
                  <div class="row">
                    <div class="col-lg-5 col-md-12">
                        <div class="xzoom-container">
                            <?php $img = explode(',', $productt->photo); ?>
                            <img class="xzoom5" id="xzoom-magnific"
                                src="{{filter_var($img[0], FILTER_VALIDATE_URL) ?$img[0]:asset('assets/images/products/'.$productt->photo)}}"
                                xoriginal="{{$img[0]}}" />
                            <div class="xzoom-thumbs">

                                <div class="all-slider">

                                    <!--  <a href="{{$img[0]}}">-->
                                    <!--<img class="xzoom-gallery5" width="80" src="{{filter_var($img[0], FILTER_VALIDATE_URL) ?$img[0]:asset('assets/images/products/'.$productt->photo)}}" title="The description goes here">-->
                                    <!--  </a>-->

                                    @foreach($productt->galleries as $gal)
                                    <a href="{{asset('assets/images/galleries/'.$gal->photo)}}">
                                        <img class="xzoom-gallery5" width="80"
                                            src="{{asset('assets/images/galleries/'.$gal->photo)}}"
                                            title="The description goes here">
                                    </a>
                                    @endforeach

                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-lg-7">
                        <div class="right-area">
                            <div class="product-info">
                                <h4 class="product-name">{{ $productt->name }}</h4>
                                <div class="info-meta-1">
                                    <ul>

                                        @if($productt->type == 'Physical')
                                        @if($productt->emptyStock())
                                        <li class="product-outstook">
                                            <p>
                                                <i class="icofont-close-circled"></i>
                                                {{ $langg->lang78 }}
                                            </p>
                                        </li>
                                        @else

                                        <li class="product-isstook">
                                            <p>
                                                <i class="icofont-check-circled"></i>
                                                {{ $gs->show_stock == 0 ? '' : $productt->stock }} {{ $langg->lang79 }}
                                            </p>
                                        </li>
                                        @endif
                                        @endif
                                        <li>
                                            <div class="ratings">
                                                <div class="empty-stars"></div>
                                                <div class="full-stars"
                                                    style="width:{{App\Models\Rating::ratings($productt->id)}}%"></div>
                                            </div>
                                        </li>
                                        <li class="review-count">
                                            <p>{{count($productt->ratings)}} {{ $langg->lang80 }}</p>
                                        </li>
                                        @if($productt->product_condition != 0)
                                        <li>
                                            <div
                                                class="{{ $productt->product_condition == 2 ? 'mybadge' : 'mybadge1' }}">
                                                {{ $productt->product_condition == 2 ? 'New' : 'Used' }}
                                            </div>
                                        </li>
                                        @endif
                                    </ul>
                                </div>


                                @if(Auth::user())
                        <div class="product-price">
                          <p class="title">{{ $langg->lang87 }} :</p>
                                <p class="price"><span id="sizeprice">
                                    @if($email == "amconlabs@gmail.com" )
                                    {{$productt->current_price_detail}}
                                    @else
                                    {{ $productt->showPrice() }}
                                    @endif
                                </span>
                                  <small><del>{{ $productt->showPreviousPrice() }}</del></small></p>
                                  @if($productt->youtube != null)
                                  <a href="{{ $productt->youtube }}" class="video-play-btn mfp-iframe">
                                    <i class="fas fa-play"></i>
                                  </a>
                                @endif
                              </div>

                          @endif

                                <div class="info-meta-2">
                                    <ul>

                                        @if($productt->type == 'License')

                                        @if($productt->platform != null)
                                        <li>
                                            <p>{{ $langg->lang82 }}: <b>{{ $productt->platform }}</b></p>
                                        </li>
                                        @endif

                                        @if($productt->region != null)
                                        <li>
                                            <p>{{ $langg->lang83 }}: <b>{{ $productt->region }}</b></p>
                                        </li>
                                        @endif

                                        @if($productt->licence_type != null)
                                        <li>
                                            <p>{{ $langg->lang84 }}: <b>{{ $productt->licence_type }}</b></p>
                                        </li>
                                        @endif

                                        @endif

                                    </ul>
                                </div>


                                @if(!empty($productt->size))
                                <div class="product-size">
                                    <p class="title">{{ $langg->lang88 }} :</p>
                                    <ul class="siz-list">
                                        @php
                                        $is_first = true;
                                        @endphp
                                        @foreach($productt->size as $key => $data1)
                                        <li class="{{ $is_first ? 'active' : '' }}">
                                            <span class="box">{{ $data1 }}
                                                <input type="hidden" class="size" value="{{ $data1 }}">
                                                <input type="hidden" class="size_qty"
                                                    value="@if(isset($productt->size_qty[$key])){{ $productt->size_qty[$key] }}@endif">
                                                <input type="hidden" class="size_key" value="{{$key}}">
                                                <input type="hidden" class="size_price"
                                                    value="@if(isset($productt->size_price[$key])){{ round($productt->size_price[$key] * $curr->value,2) }} @endif">
                                            </span>
                                        </li>
                                        @php
                                        $is_first = false;
                                        @endphp
                                        @endforeach
                                        <li>
                                    </ul>
                                </div>
                                @endif

                                @if(!empty($productt->color))
                                <div >
                                    <p class="title">{{ $langg->lang89 }} :</p>
                                    <ul class="color-list">
                                        @php
                                        $is_first = true;
                                        @endphp
                                        <select name="color_name" class="form-select-custom" id="color_select">
                                            @foreach($productt->color as $key => $data1)





                                            <?php try {
                                //dd(Helper::get_color_name($productt->color[$key])['hex']);

                            $color_back = Helper::get_color_name($productt->color[$key])['hex'];
                              echo $color_back;
                            } catch (Exception $e) {
                              $color_back = '#ffffff';
                            }

                            ?>

                                            <option value="{{ $productt->color[$key]}} ">{{ $productt->color[$key]}}
                                            </option>

                                            <!--     <li class="{{ $is_first ? 'active' : '' }}">
                              <span >@if(isset($productt->color[$key])){{ $productt->color[$key]}}  @else(isset($productt->color[$key]['name'])) {{Helper::get_color_name($productt->color[$key])['name']}} @endif</span>
                              <span class="box" data-color="{{ $productt->color[$key] }}" style="background-color:{{$color_back}}"></span>
                            </li> -->
                                            @php
                                            $is_first = false;
                                            @endphp
                                            @endforeach
                                        </select>

                                    </ul>
                                </div>
                                @endif

                                @if(!empty($productt->size))

                                <input type="hidden" id="stock" value="@if(isset($productt->size_qty[0]) && !empty($productt->size_qty[0])) {{ $productt->size_qty[0] }} @endif">
                                @else
                                @php
                                $stck = (string)$productt->stock;
                                @endphp
                                @if($stck != null)
                                <input type="hidden" id="stock" value="{{ $stck }}">
                                @elseif($productt->type != 'Physical')
                                <input type="hidden" id="stock" value="0">
                                @else
                                <input type="hidden" id="stock" value="">
                                @endif

                                @endif
                                <input type="hidden" id="product_price"
                                    value="{{ round($productt->vendorPrice() * $curr->value,2) }}">

                                <input type="hidden" id="product_id" value="{{ $productt->id }}">
                                <input type="hidden" id="curr_pos" value="{{ $gs->currency_format }}">
                                <input type="hidden" id="curr_sign" value="{{ $curr->sign }}">
                                <div class="info-meta-3">
                                    <ul class="meta-list">
                                        @if($productt->product_type != "affiliate")
                                        <li class="d-block count {{ $productt->type == 'Physical' ? '' : 'd-none' }}">
                                            <div class="qty">
                                                <ul>
                                                    <li>
                                                        <span class="qtminus">
                                                            <i class="icofont-minus"></i>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <input type="number" name="qttotal" min="1"  value="1" class="qttotal"></span>
                                                    </li>
                                                    <li>
                                                        <span class="qtplus">
                                                            <i class="icofont-plus"></i>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        @endif

                                        @if (!empty($productt->attributes))
                                        @php
                                        $attrArr = json_decode($productt->attributes, true);
                                        @endphp
                                        @endif
                                        @if (!empty($attrArr))
                                        <div class="product-attributes my-4">
                                            <div class="row">
                                                @foreach ($attrArr as $attrKey => $attrVal)
                                                @if (array_key_exists("details_status",$attrVal) &&
                                                $attrVal['details_status'] == 1)

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-2">
                                                        <strong for=""
                                                            class="text-capitalize">{{ str_replace("_", " ", $attrKey) }}
                                                            :</strong>
                                                        <div class="">
                                                            @foreach ($attrVal['values'] as $optionKey => $optionVal)
                                                            <div class="custom-control custom-radio">
                                                                <input type="hidden" class="keys" value="">
                                                                <input type="hidden" class="values" value="">
                                                                <input type="radio" id="{{$attrKey}}{{ $optionKey }}"
                                                                    name="{{ $attrKey }}"
                                                                    class="custom-control-input product-attr"
                                                                    data-key="{{ $attrKey }}"
                                                                    data-price="{{ $attrVal['prices'][$optionKey] * $curr->value }}"
                                                                    value="{{ $optionVal }}"
                                                                    {{ $loop->first ? 'checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="{{$attrKey}}{{ $optionKey }}">{{ $optionVal }}

                                                                    @if (!empty($attrVal['prices'][$optionKey]))
                                                                    +
                                                                    {{$curr->sign}}
                                                                    {{$attrVal['prices'][$optionKey] * $curr->value}}
                                                                    @endif
                                                                </label>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif

                                        @if($productt->product_type == "affiliate")

                                        <li class="addtocart">
                                            <a href="{{ route('affiliate.product', $productt->slug) }}"
                                                target="_blank"><i class="icofont-cart"></i> {{ $langg->lang251 }}</a>
                                        </li>
                                        @else
                                        @if($productt->emptyStock())
                                        <li class="addtocart">
                                            <a href="javascript:;" class="cart-out-of-stock">
                                                <i class="icofont-close-circled"></i>
                                                {{ $langg->lang78 }}</a>
                                        </li>
                                        @else
                                        @if(Auth::user())
                                        <li class="addtocart">
                                            <a href="javascript:;" id="addcrt"><i
                                                    class="icofont-cart"></i>{{ $langg->lang90 }}</a>
                                        </li>

                                        {{-- <li class="addtocart">
                                            <a id="qaddcrt" href="javascript:;">
                                                <i class="icofont-cart"></i>{{ $langg->lang251 }}
                                            </a>
                                        </li> --}}
                                        @else
                                        <li class="addtocart">
                                            <a rel-toggle="tooltip" title="{{ $langg->lang90 }}" data-toggle="modal"
                                                id="wish-btn" data-target="#comment-log-reg" data-placement="right">
                                                <i class="icofont-cart"></i>{{ $langg->lang90 }}
                                            </a>
                                        </li>

                                        <li class="addtocart">
                                            <a rel-toggle="tooltip" title="{{ $langg->lang251 }}" data-toggle="modal"
                                                id="wish-btn" data-target="#comment-log-reg" data-placement="right">
                                                <i class="icofont-cart"></i>{{ $langg->lang251 }}
                                            </a>
                                        </li>

                                        @endif
                                        @endif

                                        @endif

                                        @if(Auth::guard('web')->check())
                                        <li class="favorite">
                                            <a href="javascript:;" class="add-to-wish"
                                                data-href="{{ route('user-wishlist-add',$productt->id) }}"><i
                                                    class="icofont-heart-alt"></i></a>
                                        </li>
                                        @else
                                        <li class="favorite">
                                            <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg"><i
                                                    class="icofont-heart-alt"></i></a>
                                        </li>
                                        @endif
                                        <li class="compare">
                                            <a href="javascript:;" class="add-to-compare"
                                                data-href="{{ route('product.compare.add',$productt->id) }}"><i
                                                    class="icofont-exchange"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="social-links social-sharing a2a_kit a2a_kit_size_32">
                                    <ul class="link-list social-links">
                                        <li>
                                            <a class="facebook a2a_button_facebook" href="">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="twitter a2a_button_twitter" href="">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="linkedin a2a_button_linkedin" href="">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="pinterest a2a_button_pinterest" href="">
                                                <i class="fab fa-pinterest-p"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <script async src="https://static.addtoany.com/menu/page.js"></script>


                                @if($productt->ship != null)
                                <p class="estimate-time">{{ $langg->lang86 }}: <b> {{ $productt->ship }}</b></p>
                                @endif
                                @if( $productt->sku != null )
                                <p class="p-sku">
                                    {{ $langg->lang77 }}: <span class="idno">{{ $productt->sku }}</span>
                                </p>
                                @endif
                                @if($gs->is_report)

                                {{-- PRODUCT REPORT SECTION --}}

                                @if(Auth::guard('web')->check())

                                <div class="report-area">
                                    <a href="javascript:;" data-toggle="modal" data-target="#report-modal"><i
                                            class="fas fa-flag"></i> {{ $langg->lang776 }}</a>
                                </div>

                                @else

                                <div class="report-area">
                                    <a href="javascript:;" data-toggle="modal" data-target="#comment-log-reg"><i
                                            class="fas fa-flag"></i> {{ $langg->lang776 }}</a>
                                </div>
                                @endif

                                {{-- PRODUCT REPORT SECTION ENDS --}}

                                @endif



                            </div>
                        </div>
                    </div>
                  </div>
                <?php } ?>


                <div class="row">
                    <div class="col-lg-12">
                        <div id="product-details-tab">
                            <div class="top-menu-area">
                                <ul class="tab-menu">
                                    <li><a href="#tabs-1">{{ $langg->lang92 }}</a></li>
                                    <!-- <li><a href="#tabs-2">{{ $langg->lang93 }}</a></li> -->
                                    <li><a href="#tabs-3">{{ $langg->lang94 }}({{ count($productt->ratings) }})</a></li>
                                    @if($gs->is_comment == 1)
                                    <li><a href="#tabs-4">{{ $langg->lang95 }}(<span
                                                id="comment_count">{{ count($productt->comments) }}</span>)</a></li>
                                    @endif
                                </ul>
                            </div>

                            <div class="tab-content-wrapper">
                                <div id="tabs-1" class="tab-content-area">
                                    <p>{!! $productt->details !!}</p>
                                </div>
                                <div id="tabs-2" class="tab-content-area">
                                    <p>{!! $productt->policy !!}</p>
                                </div>
                                <div id="tabs-3" class="tab-content-area">
                                    <div class="heading-area">
                                        <h4 class="title">
                                            {{ $langg->lang96 }}
                                        </h4>
                                        <div class="reating-area">
                                            <div class="stars"><span
                                                    id="star-rating">{{App\Models\Rating::rating($productt->id)}}</span>
                                                <i class="fas fa-star"></i></div>
                                        </div>
                                    </div>
                                    <div id="replay-area">
                                        <div id="reviews-section">
                                            @if(count($productt->ratings) > 0)
                                            <ul class="all-replay">
                                                @foreach($productt->ratings as $review)
                                                <li>
                                                    <div class="single-review">
                                                        <div class="left-area">
                                                            <img src="{{ $review->user->photo ? asset('assets/images/users/'.$review->user->photo):asset('assets/images/noimage.png') }}"
                                                                alt="">
                                                            <h5 class="name">{{ $review->user->name }}</h5>
                                                            <p class="date">
                                                                {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$review->review_date)->diffForHumans() }}
                                                            </p>
                                                        </div>
                                                        <div class="right-area">
                                                            <div class="header-area">
                                                                <div class="stars-area">
                                                                    <ul class="stars">
                                                                        <div class="ratings">
                                                                            <div class="empty-stars"></div>
                                                                            <div class="full-stars"
                                                                                style="width:{{$review->rating*20}}%">
                                                                            </div>
                                                                        </div>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="review-body">
                                                                <p>
                                                                    {{$review->review}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </li>
                                            </ul>
                                            @else
                                            <p>{{ $langg->lang97 }}</p>
                                            @endif
                                        </div>
                                        @if(Auth::guard('web')->check())
                                        <div class="review-area">
                                            <h4 class="title">{{ $langg->lang98 }}</h4>
                                            <div class="star-area">
                                                <ul class="star-list">
                                                    <li class="stars" data-val="1">
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                    <li class="stars" data-val="2">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                    <li class="stars" data-val="3">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                    <li class="stars" data-val="4">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                    <li class="stars active" data-val="5">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="write-comment-area">
                                            <div class="gocover"
                                                style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                                            </div>
                                            <form id="reviewform" action="{{route('front.review.submit')}}"
                                                data-href="{{ route('front.reviews',$productt->id) }}" method="POST">
                                                @include('includes.admin.form-both')
                                                {{ csrf_field() }}
                                                <input type="hidden" id="rating" name="rating" value="5">
                                                <input type="hidden" name="user_id"
                                                    value="{{Auth::guard('web')->user()->id}}">
                                                <input type="hidden" name="product_id" value="{{$productt->id}}">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <textarea name="review" placeholder="{{ $langg->lang99 }}"
                                                            required=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <button class="submit-btn"
                                                            type="submit">{{ $langg->lang100 }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <br>
                                                <h5 class="text-center"><a href="javascript:;" data-toggle="modal"
                                                        data-target="#comment-log-reg"
                                                        class="btn login-btn mr-1">{{ $langg->lang101 }}</a>
                                                    {{ $langg->lang102 }}</h5>
                                                <br>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @if($gs->is_comment == 1)
                                <div id="tabs-4" class="tab-content-area">
                                    <div id="comment-area">

                                        @include('includes.comment-replies')

                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($gs->reg_vendor == 1)
            <div class="col-lg-3">
                        @if(!empty($productt->whole_sell_qty))
                <div class="table-area wholesell-details-page">
                    <h3>{{ $langg->lang770 }}</h3>
                    <table class="table">
                    <tr>
                        <th>{{ $langg->lang768 }}</th>
                        <th>{{ $langg->lang769 }}</th>
                    </tr>
                    @foreach($productt->whole_sell_qty as $key => $data1)
                    <tr>
                        <td>{{ $productt->whole_sell_qty[$key] }}+</td>
                        <td>{{ $productt->whole_sell_discount[$key] }}% {{ $langg->lang771 }}</td>
                    </tr>
                    @endforeach
                    </table>
                </div>
                @endif
                <div class="seller-info mt-3">
                    <div class="content">
                        <h4 class="title">
                            Vendor
                        </h4>

                        <p class="stor-name">
                            @if( $productt->user_id != 0)
                            @if(isset($productt->user))
                            {{ $productt->user->shop_name }}

                            @if($productt->user->checkStatus())
                            <br>
                            <a class="verify-link" href="javascript:;" data-toggle="tooltip" data-placement="top"
                                title="{{ $langg->lang783 }}">
                                {{--  {{ $langg->lang783 }} --}}
                                <i class="fas fa-check-circle"></i>

                            </a>
                            @endif

                            @else
                            {{ $langg->lang247 }}
                            @endif
                            @else
                            {{ App\Models\Admin::find(1)->shop_name }}
                            @endif
                        </p>

                        <!-- <div class="total-product">

                    @if( $productt->user_id  != 0)
                        <p>{{ App\Models\Product::where('user_id','=',$productt->user_id)->get()->count() }}</p>
                    @else
                        <p>{{ App\Models\Product::where('user_id','=',0)->get()->count() }}</p>
                    @endif
                      <span>{{ $langg->lang248 }}</span>
                    </div> -->
                    </div>
                    @if( $productt->user_id != 0)
                    <a href="{{ route('front.vendor',str_replace(' ', '-', $productt->user->shop_name)) }}"
                        class="view-stor">{{ $langg->lang249 }}</a>
                    @endif
                    {{-- CONTACT SELLER --}}
                    <div class="contact-seller">

                        {{-- If The Product Belongs To A Vendor --}}

                        @if($productt->user_id != 0)


                        <ul class="list">


                            @if(Auth::guard('web')->check())

                            <li>

                                @if(
                                Auth::guard('web')->user()->favorites()->where('vendor_id','=',$productt->user->id)->get()->count()
                                >
                                0)

                                <a class="view-stor" href="javascript:;">
                                    <i class="icofont-check"></i>
                                    {{ $langg->lang225 }}
                                </a>

                                @else

                                <a class="favorite-prod view-stor"
                                    data-href="{{ route('user-favorite',[ Auth::guard('web')->user()->id, $productt->user->id]) }}"
                                    href="javascript:;">
                                    <i class="icofont-plus"></i>
                                    {{ $langg->lang224 }}
                                </a>


                                @endif

                            </li>

                            <li>
                                <a class="view-stor" href="javascript:;" data-toggle="modal" data-target="#vendorform1">
                                    <i class="icofont-ui-chat"></i>
                                    {{ $langg->lang81 }}
                                </a>
                            </li>
                            @else

                            <li>

                                <a class="view-stor" href="javascript:;" data-toggle="modal"
                                    data-target="#comment-log-reg">
                                    <i class="icofont-plus"></i>
                                    {{ $langg->lang224 }}
                                </a>


                            </li>

                            <li>

                                <a class="view-stor" href="javascript:;" data-toggle="modal"
                                    data-target="#comment-log-reg">
                                    <i class="icofont-ui-chat"></i>
                                    {{ $langg->lang81 }}
                                </a>
                            </li>

                            @endif

                        </ul>


                        {{-- VENDOR PART ENDS HERE :) --}}
                        @else


                        {{-- If The Product Belongs To Admin  --}}

                        <ul class="list">
                            @if(Auth::guard('web')->check())
                            <li>
                                <a class="view-stor" href="javascript:;" data-toggle="modal" data-target="#vendorform">
                                    <i class="icofont-ui-chat"></i>
                                    {{ $langg->lang81 }}
                                </a>
                            </li>
                            @else
                            <li>
                                <a class="view-stor" href="javascript:;" data-toggle="modal"
                                    data-target="#comment-log-reg">
                                    <i class="icofont-ui-chat"></i>
                                    {{ $langg->lang81 }}
                                </a>
                            </li>

                            @endif

                        </ul>

                        @endif

                    </div>

                    {{-- CONTACT SELLER ENDS --}}

                </div>








                <div class="categori  mt-30">
                    <div class="section-top">
                        <h2 class="section-title">
                            {{ $langg->lang245 }}
                        </h2>
                    </div>
                    <div class="hot-and-new-item-slider">

                        @foreach($vendors->chunk(3) as $chunk)
                        <div class="item-slide">
                            <ul class="item-list">
                                @foreach($chunk as $prod)
                                @include('includes.product.list-product')
                                @endforeach
                            </ul>
                        </div>
                        @endforeach

                    </div>

                </div>




            </div>
            @endif
        </div>
    </div>
    <!-- Trending Item Area Start -->
    <div class="trending">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 remove-padding">
                    <div class="section-top">
                        <h2 class="section-title">
                            {{ $langg->lang216 }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 remove-padding">
                    <div class="trending-item-slider">
                        @foreach($productt->category->products()->where('status','=',1)->where('id','!=',$productt->id)->take(8)->get()
                        as $prod)
                        @include('includes.product.slider-product')
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Tranding Item Area End -->
</section>
<!-- Product Details Area End -->

{{-- MESSAGE MODAL --}}
<div class="message-modal">
    <div class="modal" id="vendorform" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vendorformLabel">{{ $langg->lang118 }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="contact-form">
                                    <form id="emailreply1">
                                        {{csrf_field()}}
                                        <ul>
                                            <li>
                                                <input type="text" class="input-field" id="subj1" name="subject"
                                                    placeholder="{{ $langg->lang119}}" required="">
                                            </li>
                                            <li>
                                                <textarea class="input-field textarea" name="message" id="msg1"
                                                    placeholder="{{ $langg->lang120 }}" required=""></textarea>
                                            </li>
                                            <input type="hidden" name="type" value="Ticket">
                                        </ul>
                                        <button class="submit-btn" id="emlsub"
                                            type="submit">{{ $langg->lang118 }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MESSAGE MODAL ENDS --}}


    @if(Auth::guard('web')->check())

    @if($productt->user_id != 0)

    {{-- MESSAGE VENDOR MODAL --}}


    <div class="modal" id="vendorform1" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel1"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vendorformLabel1">{{ $langg->lang118 }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="contact-form">
                                    <form id="emailreply">
                                        {{csrf_field()}}
                                        <ul>

                                            <li>
                                                <input type="text" class="input-field" readonly=""
                                                    placeholder="Send To {{ $productt->user->shop_name }}" readonly="">
                                            </li>

                                            <li>
                                                <input type="text" class="input-field" id="subj" name="subject"
                                                    placeholder="{{ $langg->lang119}}" required="">
                                            </li>

                                            <li>
                                                <textarea class="input-field textarea" name="message" id="msg"
                                                    placeholder="{{ $langg->lang120 }}" required=""></textarea>
                                            </li>

                                            <input type="hidden" name="email"
                                                value="{{ Auth::guard('web')->user()->email }}">
                                            <input type="hidden" name="name"
                                                value="{{ Auth::guard('web')->user()->name }}">
                                            <input type="hidden" name="user_id"
                                                value="{{ Auth::guard('web')->user()->id }}">
                                            <input type="hidden" name="vendor_id" value="{{ $productt->user->id }}">

                                        </ul>
                                        <button class="submit-btn" id="emlsub1"
                                            type="submit">{{ $langg->lang118 }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- MESSAGE VENDOR MODAL ENDS --}}


    @endif

    @endif

</div>


@if($gs->is_report)

@if(Auth::check())

{{-- REPORT MODAL SECTION --}}

<div class="modal fade" id="report-modal" tabindex="-1" role="dialog" aria-labelledby="report-modal-Title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="gocover"
                    style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                </div>

                <div class="login-area">
                    <div class="header-area forgot-passwor-area">
                        <h4 class="title">{{ $langg->lang777 }}</h4>
                        <p class="text">{{ $langg->lang778 }}</p>
                    </div>
                    <div class="login-form">

                        <form id="reportform" action="{{ route('product.report') }}" method="POST">

                            @include('includes.admin.form-login')

                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="product_id" value="{{ $productt->id }}">
                            <div class="form-input">
                                <input type="text" name="title" class="User Name" placeholder="{{ $langg->lang779 }}"
                                    required="">
                                <i class="icofont-notepad"></i>
                            </div>

                            <div class="form-input">
                                <textarea name="note" class="User Name" placeholder="{{ $langg->lang780 }}"
                                    required=""></textarea>
                            </div>

                            <button type="submit" class="submit-btn">{{ $langg->lang196 }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- REPORT MODAL SECTION ENDS --}}

@endif

@endif

@endsection


@section('scripts')

<script type="text/javascript">

$(document).on('change', '.color-price', function() {

            var color = '<?php echo json_encode($productt->color); ?>';
            var color_price = '<?php echo json_encode($productt->color_price_extra); ?>';
            value = $(this).val();
            value = value.replace(/\s/g, '');
            color_price = JSON.parse(color_price);
            color_price =color_price.split(",");
            var original_price = parseFloat($('#product_price').val());
            size_price = parseFloat($('.product-size .siz-list li.active').find('.size_price').val());
            if (isNaN(size_price)) {
                size_price = 0;
            }
            $.each(JSON.parse(color), function (i, elem) {
            if(String(value) == String(elem))
            {
                if($('input[name="title_price"]').val())
                {
                    var title_price = $('input[name="title_price"]').val();

                }else{
                    title_price = 0;
                }
                if($('input[name="eye_price"]').val())
                {
                    var eye_price = $('input[name="eye_price"]').val();

                }else{
                    eye_price = 0;
                }

                total = parseFloat(color_price[i])+parseFloat(original_price)+parseFloat(size_price)+parseFloat(title_price)+parseFloat(eye_price);
                $('#color_price_input').val(color_price[i]);
                $('#sizeprice').html('$' + total.toFixed(2));

                return false;
               }
            });
        });


        $(document).on('change', '.eye', function() {
            var eye = '<?php echo json_encode($productt->eye); ?>';
            var eye = <?php echo json_encode($productt->eye) ?>;

            var eye_price = '<?php echo json_encode($productt->eye_price_extra); ?>';
            value = $(this).val();
            value = value.replace(/\s/g, '');
            eye_price = JSON.parse(eye_price);
            eye_price =eye_price.split(",");
            eye =eye.split(",");
            var original_price = parseFloat($('#product_price').val());
            size_price = parseFloat($('.product-size .siz-list li.active').find('.size_price').val());
            // alert(eye);
            $.each(eye, function (i, elem) {

            if(String(value) == String(elem))
               {
                if($('input[name="title_price"]').val())
                {
                    var title_price = $('input[name="title_price"]').val();

                }else{
                    title_price = 0;
                }
                if($('input[name="color_price"]').val())
                {
                    var color_price = $('input[name="color_price"]').val();

                }else{
                    color_price = 0;
                }
                total = parseFloat(eye_price[i])+original_price+size_price+parseFloat(title_price)+parseFloat(color_price);
                $('#eye_price_input').val(eye_price[i]);
                $('#sizeprice').html('$' + total.toFixed(2));
                return false;
               }
            });
        });
        $(document).on('change', '.title', function() {
            var title = '<?php echo json_encode($productt->title); ?>';
            var title = <?php echo json_encode($productt->title) ?>;

            var title_price = '<?php echo json_encode($productt->title_price_extra); ?>';
            value = $(this).val();
            value = value.replace(/\s/g, '');
            title_price = JSON.parse(title_price);
            title_price =title_price.split(",");
            title =title.split(",");
            var original_price = parseFloat($('#product_price').val());
            size_price = parseFloat($('.product-size .siz-list li.active').find('.size_price').val());
            // alert(eye);
            $.each(title, function (i, elem) {
            if(String(value) == String(elem))
            {
                if($('input[name="eye_price"]').val())
                {
                    var eye_price = $('input[name="eye_price"]').val();

                }else{
                    eye_price = 0;
                }
                if($('input[name="color_price"]').val())
                {
                    var color_price = $('input[name="color_price"]').val();

                }else{
                    color_price = 0;
                }
                total = parseFloat(title_price[i])+original_price+size_price+parseFloat(eye_price)+parseFloat(color_price);
                $('#title_price_input').val(title_price[i]);
                $('#sizeprice').html('$' + total.toFixed(2));
                return false;
               }
            });
        });



  $(document).on("submit", "#emailreply1", function() {
      var token = $(this).find('input[name=_token]').val();
      var subject = $(this).find('input[name=subject]').val();
      var message = $(this).find('textarea[name=message]').val();
      var $type = $(this).find('input[name=type]').val();
      $('#subj1').prop('disabled', true);
      $('#msg1').prop('disabled', true);
      $('#emlsub').prop('disabled', true);
      $.ajax({
          type: 'post',
          url: "{{URL::to('/user/admin/user/send/message')}}",
          data: {
              '_token': token,
              'subject': subject,
              'message': message,
              'type': $type
          },
          success: function(data) {
              $('#subj1').prop('disabled', false);
              $('#msg1').prop('disabled', false);
              $('#subj1').val('');
              $('#msg1').val('');
              $('#emlsub').prop('disabled', false);
              if (data == 0)
                  toastr.error("Oops Something Goes Wrong !!");
              else
                  toastr.success("Message Sent !!");
              $('.close').click();
          }

      });
      return false;
  });
</script>


<script type="text/javascript">
  $(document).on("submit", "#emailreply", function() {
      var token = $(this).find('input[name=_token]').val();
      var subject = $(this).find('input[name=subject]').val();
      var message = $(this).find('textarea[name=message]').val();
      var email = $(this).find('input[name=email]').val();
      var name = $(this).find('input[name=name]').val();
      var user_id = $(this).find('input[name=user_id]').val();
      var vendor_id = $(this).find('input[name=vendor_id]').val();
      $('#subj').prop('disabled', true);
      $('#msg').prop('disabled', true);
      $('#emlsub').prop('disabled', true);
      $.ajax({
          type: 'post',
          url: "{{URL::to('/vendor/contact')}}",
          data: {
              '_token': token,
              'subject': subject,
              'message': message,
              'email': email,
              'name': name,
              'user_id': user_id,
              'vendor_id': vendor_id
          },
          success: function() {
              $('#subj').prop('disabled', false);
              $('#msg').prop('disabled', false);
              $('#subj').val('');
              $('#msg').val('');
              $('#emlsub').prop('disabled', false);
              toastr.success("{{ $langg->message_sent }}");
              $('.ti-close').click();
          }
      });
      return false;
  });
</script>
<?php
$product_variation_images = explode(',',$productt->variation_images);
?>
<script>
 $('#color_select').on('change',function(){
var variation_img = '<?php echo json_encode($product_variation_images);  ?>';
var color = '<?php echo json_encode( $productt->color); ?>';

var val = $(this).val();

$.each(JSON.parse(color),function(index, value) {
    value =value.replace(/'/g,  '"');
    val =val.replace(/'/g,  '"');

  if(value==val)
  {
        alert('aaa');
  }

});


 })


 function check(that){
      if (that.value == "uppres") {
              document.getElementById("upload_prescription").style.display = "block";
          } else {
              document.getElementById("upload_prescription").style.display = "none";
          }
          if (that.value == "manpres") {
              document.getElementById("manual_prescription").style.display = "block";
          } else {
              document.getElementById("manual_prescription").style.display = "none";
          }
    }
</script>



@endsection
