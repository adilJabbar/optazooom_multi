        <div class="col-lg-3 col-md-6">
          <div class="left-area">
            <div class="filter-result-area">
            <div class="header-area">
              <h4 class="title">
                {{$langg->lang61}}
              </h4>
            </div>
            <div class="body-area">

                <ul class="filter-list filter-list-category">
                <?php

                $string = str_replace('-',' ', request()->segment(count(request()->segments())));
                    $max_price=0;
				$categories_order = DB::table('categories')->join('products','products.category_id','=','categories.id')->join('users','users.id','=','products.user_id')->where('users.shop_name',$string)->select('categories.*')->distinct('categories.name')->orderby('categories.name' , 'ASC')->get();
                    foreach ($vprods as $key => $value) {
                        $price =   $value->price;
                        if($max_price<$price)
                        {
                            $max_price = $price;
                        }

                    }

									?>
                                    <input type="hidden" id="max_price_product" name="max_price_product" value="{{$max_price}}" />
                  @foreach ($categories_order as $element)
                  <li>
                    <div class="content">
                        <a href="{{route('front.category', $element->slug)}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="category-link">  {{$element->name}}</a>
                        @if(!empty($cat) && $cat->id == $element->id && !empty($cat->subs))
                            @foreach ($cat->subs as $key => $subelement)
                            <div class="sub-content open">
                              <a href="{{route('front.category', [$cat->slug, $subelement->slug])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="subcategory-link">{{$subelement->name}}</a>
                              @if(!empty($subcat) && $subcat->id == $subelement->id && !empty($subcat->childs))
                                @foreach ($subcat->childs as $key => $childcat)
                                <div class="child-content open">
                                  <a href="{{route('front.category', [$cat->slug, $subcat->slug, $childcat->slug])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="subcategory-link">{{$childcat->name}}</a>
                                </div>
                                @endforeach
                              @endif
                            </div>
                            @endforeach

                          </div>
                        @endif


                  </li>
                  @endforeach

                </ul>


              <form class="price-range-block" id="priceForm" action="{{ route('front.vendor', Request::route('category')) }}">
                  @if (!empty(request()->input('sort')))
                    <input type="hidden" name="sort" value="{{ request()->input('sort') }}" />
                  @endif
                  <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                  <div class="livecount">
                    <input type="number" min=0  name="min"  id="min_price" class="price-range-field" />
                    <span>{{$langg->lang62}}</span>
                    <input type="number" min=0  name="max" id="max_price" class="price-range-field" />
                  </div>
                </form>

                <button class="filter-btn" type="button" onclick="document.getElementById('priceForm').submit();">{{$langg->lang58}}</button>
            </div>
            </div>


            @if ((!empty($cat) && !empty(json_decode($cat->attributes, true))) || (!empty($subcat) && !empty(json_decode($subcat->attributes, true))) || (!empty($childcat) && !empty(json_decode($childcat->attributes, true))))

              <div class="tags-area">
                <div class="header-area">
                  <h4 class="title">
                      Filters
                  </h4>
                </div>
                <div class="body-area">
                  <form id="attrForm" action="{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}" method="post">
                    <ul class="filter">
                      <div class="single-filter">
                        @if (!empty($cat) && !empty(json_decode($cat->attributes, true)))
                          @foreach ($cat->attributes as $key => $attr)
                            <div>
                              <strong>{{$attr->name}}</strong>
                            </div>
                            @if (!empty($attr->attribute_options))
                              @foreach ($attr->attribute_options as $key => $option)
                                <div class="form-check">
                                  <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                                  <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{$option->name}}</label>
                                </div>
                              @endforeach
                            @endif
                          @endforeach
                        @endif

                        @if (!empty($subcat) && !empty(json_decode($subcat->attributes, true)))
                          @foreach ($subcat->attributes as $key => $attr)
                            <div>
                              <strong>{{$attr->name}}</strong>
                            </div>
                            @if (!empty($attr->attribute_options))
                              @foreach ($attr->attribute_options as $key => $option)
                                <div class="form-check">
                                  <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                                  <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{$option->name}}</label>
                                </div>
                              @endforeach
                            @endif
                          @endforeach
                        @endif

                        @if (!empty($childcat) && !empty(json_decode($childcat->attributes, true)))
                          @foreach ($childcat->attributes as $key => $attr)
                            <div>
                              <strong>{{$attr->name}}</strong>
                            </div>
                            @if (!empty($attr->attribute_options))
                              @foreach ($attr->attribute_options as $key => $option)
                                <div class="form-check">
                                  <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                                  <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{$option->name}}</label>
                                </div>
                              @endforeach
                            @endif
                          @endforeach
                        @endif
                      </div>
                    </ul>
                  </form>
                </div>
              </div>
            @endif


            @if(!isset($vendor))

            {{-- <div class="tags-area">
                <div class="header-area">
                    <h4 class="title">
                        {{$langg->lang63}}
                    </h4>
                  </div>
                  <div class="body-area">
                    <ul class="taglist">
                      @foreach(App\Models\Product::showTags() as $tag)
                      @if(!empty($tag))
                      <li>
                        <a class="{{ isset($tags) ? ($tag == $tags ? 'active' : '') : ''}}" href="{{ route('front.tag',$tag) }}">
                            {{ $tag }}
                        </a>
                      </li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
            </div> --}}


            @else

            <!-- <div class="service-center"> -->
              <!-- <div class="header-area">
                <h4 class="title">
                    {{ $langg->lang227 }}
                </h4>
              </div> -->
              <!-- <div class="body-area">
                <ul class="list">
                  <li>
                      <a href="javascript:;" data-toggle="modal" data-target="{{ Auth::guard('web')->check() ? '#vendorform1' : '#comment-log-reg' }}">
                          <i class="icofont-email"></i> <span class="service-text">{{ $langg->lang228 }}</span>
                      </a>
                  </li>
                  <li>
                        <a href="tel:+{{$vendor->shop_number}}">
                          <i class="icofont-phone"></i> <span class="service-text">{{$vendor->shop_number}}</span>
                        </a>
                  </li>
                </ul>

              </div> -->
<!--
              <div class="footer-area">
                <p class="title">
                  {{ $langg->lang229 }}
                </p>
                <ul class="list">


              @if($vendor->f_check != 0)
              <li><a href="{{$vendor->f_url}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
              @endif
              @if($vendor->g_check != 0)
              <li><a href="{{$vendor->g_url}}" target="_blank"><i class="fab fa-google"></i></a></li>
              @endif
              @if($vendor->t_check != 0)
              <li><a href="{{$vendor->t_url}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
              @endif
              @if($vendor->l_check != 0)
              <li><a href="{{$vendor->l_url}}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
              @endif


                </ul>
              </div>
            </div> -->

<!--
            @endif -->


          </div>
        </div>
