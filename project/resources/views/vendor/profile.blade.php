@extends('layouts.vendor')
@section('content')

						<div class="content-area">
							<div class="mr-breadcrumb">
								<div class="row">
									<div class="col-lg-12">
											<h4 class="heading">{{ $langg->lang434 }}</h4>
											<ul class="links">
												<li>
													<a href="{{ route('vendor-dashboard') }}">{{ $langg->lang441 }} </a>
												</li>
												<li>
													<a href="{{ route('vendor-profile') }}">{{ $langg->lang434 }} </a>
												</li>
											</ul>
									</div>
								</div>
							</div>
							<div class="add-product-content1">
								<div class="row">
									<div class="col-lg-12">
										<div class="product-description">
											<div class="body-area">

				                        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
											<form id="geniusform" action="{{ route('vendor-profile-update') }}" method="POST" enctype="multipart/form-data">
												{{csrf_field()}}

                      						 @include('includes.vendor.form-both')  

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ $langg->lang457 }}: </h4>
														</div>
													</div>
													<div class="col-lg-7">
														<div class="right-area">
																<h6 class="heading"> {{ $data->shop_name }}
																	@if($data->checkStatus())
																	<a class="badge badge-success verify-link" href="javascript:;">{{ $langg->lang783 }}</a>
																	@else
																	 <span class="verify-link"><a href="{{ route('vendor-verify') }}">{{ $langg->lang784 }}</a></span>
																	@endif
																</h6>
														</div>
													</div>
												</div>	

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">First Name *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="name" placeholder="First Name" required="" value="{{$data->name}}">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">Last Name *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="l_name" placeholder="Last Name" required="" value="{{$data->l_name}}">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">Email *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="email" placeholder="Email" required="" value="{{$data->email}}">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">Mobile Number</h4>
																
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="phone" placeholder="Mobile Number" required="" value="{{$data->phone}}">
													</div>
												</div>



													<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">Company</h4>
																
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="shop_name" placeholder="Company"  value="{{$data->shop_name}}">
													</div>
												</div>



													<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">Website</h4>
																
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="reg_number" placeholder="Website"  value="{{$data->website}}">
													</div>
												</div>	


												<?php $category = DB::table('vendor_category')->where('user_id',$data->id)->get(); 

												?>


												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">Supplier Category</h4>
																
														</div>
													</div>
													<div class="col-lg-7">
														<div class="col-lg-12">

						<div class="form-input">
                               
                                    <label>Select Supplier Category (You can check more then one)</label>
                                    <div style="border-bottom: 1px solid #cfcfcf;"></div>
                                    <span class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input <?php foreach ($category as $key => $value) {
                                        	if($value->category == 'case')
                                        	{
                                        		echo "checked";
                                        	}
                                        	// code...
                                        } ?> type="checkbox" id="cases" name="category[]" value="case">
                                        <label for="cases">Cases</label>
                                        
                                    </span>
                                    <span class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input <?php foreach ($category as $key => $value) {
                                        	if($value->category == 'frames')
                                        	{
                                        		echo "checked";
                                        	}
                                        	// code...
                                        } ?> type="checkbox" id="frames" name="category[]" value="frames">
                                        <label for="frames">Frames</label>
                                        
                                    </span>
                                    <span class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input  <?php foreach ($category as $key => $value) {
                                        	if($value->category== 'supplies')
                                        	{
                                        		echo "checked";
                                        	}
                                        	// code...
                                        } ?> type="checkbox" id="supplies" name="category[]" value="supplies">
                                        <label for="supplies">Supplies</label>
                                        
                                    </span>
                                    <span class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input  <?php foreach ($category as $key => $value) {
                                        	if($value->category == 'lenses')
                                        	{
                                        		echo "checked";
                                        	}
                                        	// code...
                                        } ?> type="checkbox" id="lenses" name="category[]" value="lenses">
                                        <label for="lenses">Contact Lenses</label>
                                        
                                    </span>
                                    <span class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input  <?php foreach ($category as $key => $value) {
                                        	if($value->category == 'all')
                                        	{
                                        		echo "checked";
                                        	}
                                        	// code...
                                        } ?> type="checkbox"  id="all" name="category[]" value="all">
                                        <label for="all">All</label>
                                        
                                    </span>

                   
                                    <span class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input  <?php foreach ($category as $key => $value) {
                                        	if($value->category == 'other')
                                        	{
                                        		echo "checked";
                                        	}
                                        	// code...
                                        } ?> type="checkbox" id="other" name="category[]" value="other">
                                        <label for="other">Others</label>
                                    </span>
                                    
                                
     
                            </div>
                           	</div>
							</div>
						</div>


						<div class="row">
							<div class="col-lg-4">
								<div class="left-area">
										<h4 class="heading">Website</h4>
										
								</div>
							</div>
							<div class="col-lg-7">
						  <select style=" width: 100%;height: 50px;background: #f3f8fc;padding: 0px 30px 0px 45px;border: 1px solid rgba(0, 0, 0, 0.1);font-size: 14px;" class="User Name" placeholder="How Did You Hear About Us?" name="hear_from">
	                        <option   value="">How Did You Hear About Us?</option>
	                        <option  <?php if($data->country == "usa"){ echo "selected"; } ?>  value="facebook">Facebook</option>
	                        <option <?php if($data->country == "instagram"){ echo "selected"; } ?> value="instagram">Instagram</option>
	                      </select>
						</div>
					</div>




		<div class="row">
			<div class="col-lg-4">
				<div class="left-area">
					<h4 class="heading">Website</h4>
								
				</div>
				</div>
				<div class="col-lg-7">
					<select style=" width: 100%;height: 50px;
			    background: #f3f8fc;
			    padding: 0px 30px 0px 45px;
			    border: 1px
			    solid rgba(0, 0, 0, 0.1);
			    font-size: 14px;" class="User Name" placeholder="How Did You Hear About Us?" name="hear_from">
                <option  value="">Country(Optional)</option>
                <option <?php if($data->country == "usa"){ echo "selected"; } ?> value="usa">USA</option>
                <option <?php if($data->country == "uae"){ echo "selected"; } ?> value="uae">UAE</option>
                <option <?php if($data->country == "uk"){ echo "selected"; } ?> value="uk">United Kingdom</option>
              </select>
			</div>
		</div>








		<div class="row">
			<div class="col-lg-4">
				<div class="left-area">
					<h4 class="heading">Shop Image</h4>
								
				</div>
				</div>
				<div class="col-lg-7">
					  <input   type="file" id="supplies" name="shop_image" value="">
			</div>
		</div>

											<!-- 	<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ $langg->lang463 }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<textarea class="input-field nic-edit" name="shop_details" placeholder="{{ $langg->lang463 }}">{{$data->shop_details}}</textarea>
													</div>
												</div> -->

						                        <div class="row">
						                          <div class="col-lg-4">
						                            <div class="left-area">
						                              
						                            </div>
						                          </div>
						                          <div class="col-lg-7">
						                            <button class="addProductSubmit-btn" type="submit">{{ $langg->lang464 }}</button>
						                          </div>
						                        </div>

											</form>


											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

@endsection