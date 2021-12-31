
									<div class="col-lg-4 col-md-4 col-6 remove-padding">
										<a href="{{ route('front.product', $prod->slug) }}" class="item">
										<?php $email = DB::table('users')->where('id',$prod->user_id)->first('email');
                                        $email = $email->email;
										if($email == 'ozcaprioptics@gmail.com')
										{
										?>
										
											<div class="item-img">
												@if(!isset($prod->features))
													<div class="sell-area">
													  @foreach($prod->features as $key => $data1)
														<span class="sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }}</span>
														@endforeach
													</div>
												@endif
													<div class="extra-list">
														<ul>
															<li>
																@if(Auth::guard('web')->check())

																<span class="add-to-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" data-placement="right" title="{{ $langg->lang54 }}" data-placement="right"><i class="icofont-heart-alt" ></i>
																</span>

																@else

																<span rel-toggle="tooltip" title="{{ $langg->lang54 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
																	<i class="icofont-heart-alt"></i>
																</span>

																@endif
															</li>
															<li>
															@if(Auth::user())
															<span class="quick-view" rel-toggle="tooltip" title="{{ $langg->lang55 }}" href="javascript:;" data-href="{{ route('product.quick',$prod->id) }}" data-toggle="modal" data-target="#quickview" data-placement="right"> <i class="icofont-eye"></i>
															</span>
															@endif
															</li>
															<!-- <li>
																<span class="add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  data-toggle="tooltip" data-placement="right" title="{{ $langg->lang57 }}" data-placement="right">
																	<i class="icofont-exchange"></i>
																</span>
															</li> -->
														</ul>
													</div>
													
													
																<?php  

																$img = explode(',',$prod->photo);

																if(isset($img[0]) && strpos($img[0],'png') || strpos($img[0],'jpg') || strpos($img[0],'jpeg')) { ?>
																<!-- @if($img[0]) -->
																
															
																<img class="img-fluid" src="{{ $img[0] ? asset('assets/images/products/'.$img[0]):asset('assets/images/noimage.png') }}" alt="" style="height:200px;">
														<!-- 	     @else
																<img class="img-fluid" src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}" alt="">
																@endif -->


															<?php }else{ 


																	$img = explode(',',$prod->photo);
																if(isset($img[0]) && strpos($img[0],'images')) 
																{ ?>
															<img class="img-fluid" src="{{ $img[0] ? asset('assets/images/products/'.$img[0]):asset('assets/images/noimage.png') }}" alt="">
														<?php		}else{
															
														
																?>
																			<img class="img-fluid" src="@if(isset($img[0])) {{ $img[0] }} @endif" alt="">
																					

														<?php 	}
														
														}?>
											
											</div>
												  <?php } else { ?>
													<div class="item-img">
												@if(!empty($prod->features))
													<div class="sell-area">
													  @foreach($prod->features as $key => $data1)
														<span class="sale" style="background-color:{{ $prod->colors[$key] }}">{{ $prod->features[$key] }}</span>
														@endforeach
													</div>
												@endif
													<div class="extra-list">
														<ul>
															<li>
																@if(Auth::guard('web')->check())

																<span class="add-to-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" data-placement="right" title="{{ $langg->lang54 }}" data-placement="right"><i class="icofont-heart-alt" ></i>
																</span>

																@else

																<span rel-toggle="tooltip" title="{{ $langg->lang54 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
																	<i class="icofont-heart-alt"></i>
																</span>

																@endif
															</li>
															<li>
															@if(Auth::user())
															<span class="quick-view" rel-toggle="tooltip" title="{{ $langg->lang55 }}" href="javascript:;" data-href="{{ route('product.quick',$prod->id) }}" data-toggle="modal" data-target="#quickview" data-placement="right"> <i class="icofont-eye"></i>
															</span>
															@endif
															</li>
															<!-- <li>
																<span class="add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}"  data-toggle="tooltip" data-placement="right" title="{{ $langg->lang57 }}" data-placement="right">
																	<i class="icofont-exchange"></i>
																</span>
															</li> -->
														</ul>
													</div>
													
													
																<?php  

																$img = explode(',',$prod->photo);

																if(isset($img[0]) && strpos($img[0],'png') || strpos($img[0],'jpg') || strpos($img[0],'jpeg')) { ?>
																<!-- @if($img[0]) -->
																
															
																<img class="img-fluid" src="{{ $img[0] ? asset('assets/images/products/'.$img[0]):asset('assets/images/noimage.png') }}" alt="">
														<!-- 	     @else
																<img class="img-fluid" src="{{ $prod->photo ? asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}" alt="">
																@endif -->


															<?php }else{ 


																	$img = explode(',',$prod->photo);
																if(isset($img[0]) && strpos($img[0],'images')) 
																{ ?>
															<img class="img-fluid" src="{{ $img[0] ? asset('assets/images/products/'.$img[0]):asset('assets/images/noimage.png') }}" alt="">
														<?php		}else{
															
														
																?>
																			<img class="img-fluid" src="@if(isset($img[0])) {{ $img[0] }} @endif" alt="">
																					

														<?php 	}
														
														}?>
											</div>
											<?php } ?>
						
											<div class="info">
												<div class="stars">
													<div class="ratings">
														<div class="empty-stars"></div>
														<div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
													</div>
												</div>
												@if(Auth::user())
												<h4 class="price">{{ $prod->setCurrency() }} <del><small>{{ $prod->showPreviousPrice() }}</small></del></h4>
												@endif
														<h5 class="name">{{ $prod->showName() }}</h5>
														<div class="item-cart-area">
															@if($prod->product_type == "affiliate")
																<span class="add-to-cart-btn affilate-btn"
																	data-href="{{ route('affiliate.product', $prod->slug) }}"><i class="icofont-cart"></i>
																	{{ $langg->lang251 }}
																</span>
															@else
																@if($prod->emptyStock())
																<span class="add-to-cart-btn cart-out-of-stock">
																	<i class="icofont-close-circled"></i> {{ $langg->lang78 }}
																</span>
																@else
																@if(Auth::user())
																<span class="add-to-cart add-to-cart-btn" data-href="{{ route('product.cart.add',$prod->id) }}">
																	<i class="icofont-cart"></i> {{ $langg->lang56 }}
																</span>
																<span class="add-to-cart-quick add-to-cart-btn"
																	data-href="{{ route('product.cart.quickadd',$prod->id) }}">
																	<i class="icofont-cart"></i> {{ $langg->lang251 }}
																</span>
																@else
																<span rel-toggle="tooltip" class="add-to-cart-btn" title="{{ $langg->lang56 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
																		<i class="icofont-cart"></i> {{ $langg->lang56 }}
																</span>

																	<span rel-toggle="tooltip" class="add-to-cart-btn" title="{{ $langg->lang251 }}" data-toggle="modal" id="wish-btn" data-target="#comment-log-reg" data-placement="right">
																		<i class="icofont-cart"></i> {{ $langg->lang251 }}
																</span>


																@endif

																@endif
															@endif
														</div>
											</div>
										</a>
									</div>
