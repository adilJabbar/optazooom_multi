@extends('layouts.front')
@section('content')


<section class="user-dashbord">
	  <!--Breadcrumb-->
<div class="breadcrumb justify-content-center pt-60 pb-60">
    <div>
        <ol class="breadcrumb">
            <h3 class="bread-login">My Account</h3>
        </ol>
        <ol class="breadcrumb" style="position: relative; left: 25px;">

            <li class="breadcrumb-item bread-title"><a href="#">Home</a></li>
            <li class="breadcrumb-item bread-title active bread-title" aria-current="page">Profile</li>
        </ol>
    </div>
</div>
<!--Breadcrumb end-->
    <div class="container">
      <div class="row">
        @include('includes.user-dashboard-sidebar')
        <div class="col-lg-8">
					<div class="user-profile-details">
						<div class="order-history">
							<div class="header-area">
								<h4 class="title" >
									{{ $langg->lang329 }}
									<a class="mybtn1" href="{{route('user-wwt-create')}}"> <i class="fas fa-plus"></i> {{ $langg->lang330 }}</a>
								</h4>
							</div>
							<div class="mr-table allproduct mt-4">
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>{{ $langg->lang331 }}</th>
														<th>{{ $langg->lang332 }}</th>
														<th>{{ $langg->lang333 }}</th>
														<th>{{ $langg->lang334 }}</th>
														<th>{{ $langg->lang335 }}</th>
													</tr>
												</thead>
												<tbody>
                            @foreach($withdraws as $withdraw)
                                <tr>
                                    <td>{{date('d-M-Y',strtotime($withdraw->created_at))}}</td>
                                    <td>{{$withdraw->method}}</td>
                                    @if($withdraw->method != "Bank")
                                        <td>{{$withdraw->acc_email}}</td>
                                    @else
                                        <td>{{$withdraw->iban}}</td>
                                    @endif
                                    <td>{{$sign->sign}}{{ round($withdraw->amount * $sign->value , 2) }}</td>
                                    <td>{{ucfirst($withdraw->status)}}</td>
                                </tr>
                            @endforeach
												</tbody>
											</table>
									</div>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection