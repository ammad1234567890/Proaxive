@extends('layouts.customer.DashboardLayout')

@section('content')





        <div class="am-pagebody">
            <div class="row row-sm">
                <div class="col-lg-6">
                    <div class="card">
                        <div id="rs1" class="wd-100p ht-200"></div>
                        <div class="overlay-body pd-x-20 pd-t-20">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-5">My Travel Requests</h6>

                                </div>
                                <a href="#" class="tx-gray-600 hover-info"><i class="icon ion-more tx-16 lh-0"></i></a>
                            </div><!-- d-flex -->
                            <h2 class="mg-b-5 tx-inverse tx-lato">{{$travel_request_count}}</h2>
                            <a href="{{url('/customer_travel_list')}}"><p class="tx-12 mg-b-0">View Details</p></a>
                        </div>
                    </div><!-- card -->
                </div><!-- col-4 -->
                <div class="col-lg-6 mg-t-15 mg-sm-t-20 mg-lg-t-0">
                    <div class="card">
                        <div id="rs2" class="wd-100p ht-200"></div>
                        <div class="overlay-body pd-x-20 pd-t-20">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-5">My Expense Claims</h6>

                                </div>
                                <a href="#" class="tx-gray-600 hover-info"><i class="icon ion-more tx-16 lh-0"></i></a>
                            </div><!-- d-flex -->
                            <h2 class="mg-b-5 tx-inverse tx-lato">{{$travel_expense_count}}</h2>
                            <a href="{{url('expense/grid')}}"><p class="tx-12 mg-b-0">View Details</p></a>
                        </div>
                    </div><!-- card -->
                </div><!-- col-4 -->
           
            </div><!-- row -->

            <div class="row row-sm mg-t-15 mg-sm-t-20">
                <div class="col-md-12">
                    <div class="card pd-20 pd-sm-40">
                        <h6 class="card-body-title">Quick Links</h6>
                        <p class="mg-b-20 mg-sm-b-30"> <br>
						
						<a href="{{url('/travel_request')}}">New Travel Request</a> <br>
						<a href="{{url('/expense/add')}}">New Expense Claim</a>
						</p>
                        <div id="f2" class="ht-200 ht-sm-300"></div>
                    </div><!-- card -->
                </div><!-- col-6 -->
          
            </div><!-- row -->

            <!-- row -->

        </div><!-- am-pagebody -->


            <!-- row -->






@endsection