@extends('layouts.hr_secretary.DashboardLayout')

@section('content')





        <div class="am-pagebody">
                       <div class="row row-sm">
                <div class="col-lg-6">
                    <div class="card">
                        <div id="rs1" class="wd-100p ht-200"></div>
                        <div class="overlay-body pd-x-20 pd-t-20">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-5"> Travel Requests</h6>
                                    <p class="tx-12">From January, 2019</p>
                                </div>
                                <a href="#" class="tx-gray-600 hover-info"><i class="icon ion-more tx-16 lh-0"></i></a>
                            </div><!-- d-flex -->
                            <h2 class="mg-b-5 tx-inverse tx-lato">00</h2>
                            <p class="tx-12 mg-b-0">View Details</p>
                        </div>
                    </div><!-- card -->
                </div><!-- col-4 -->
                <div class="col-lg-6 mg-t-15 mg-sm-t-20 mg-lg-t-0">
                    <div class="card">
                        <div id="rs2" class="wd-100p ht-200"></div>
                        <div class="overlay-body pd-x-20 pd-t-20">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="tx-12 tx-uppercase tx-inverse tx-bold mg-b-5"> Expense Claims</h6>
                                    <p class="tx-12">From January, 2019</p>
                                </div>
                                <a href="#" class="tx-gray-600 hover-info"><i class="icon ion-more tx-16 lh-0"></i></a>
                            </div><!-- d-flex -->
                            <h2 class="mg-b-5 tx-inverse tx-lato">00</h2>
                            <p class="tx-12 mg-b-0">View Details</p>
                        </div>
                    </div><!-- card -->
                </div><!-- col-4 -->
           
            </div><!-- row -->

        </div><!-- am-pagebody -->




@endsection