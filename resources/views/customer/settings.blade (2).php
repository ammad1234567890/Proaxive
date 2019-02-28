@extends('layouts.customer.DashboardLayout')

@section('content')





    <div class="am-pagebody" ng-app="myApp" ng-controller="myCtrl">
        <div class="card pd-20 pd-sm-40">
            <div class="row ">
                <div class="col-lg-8">
                    <h6 class="card-body-title">
                        Settings</h6>
                    <p class="mg-b-20 mg-sm-b-30">
                        You can change your account settings</p>
                </div>

            </div>
            <div id="wizard1">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif

                    @if(session()->has('error_message'))
                        <div class="alert alert-danger">
                            {{ session()->get('error_message') }}
                        </div>
                    @endif



                <section>


                    <div class="form-layout">
                        <form method="post" action="{{url('/update_general')}}">
                            <div class="row mg-b-25">
                                @csrf
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">First Name: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_name" value="{{$user->first_name}}" required>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Last Name: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="last_name" value="{{$user->last_name}}" required>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="email" name="email" value="{{$user->email}}" required>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Phone Number:</label>
                                        <input class="form-control" type="text" name="phone_no" value="{{$user->phone_no}}">
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Project Name: <span class="tx-danger">*</span></label>
                                        <select class="form-control " data-placeholder="department" name="department" required>
                                            <option label="Choose one" value="" selected>Choose one</option>
                                        @foreach($department as $key => $data)


                                            @if($data->id==$user->department_id)
                                                <option value="{{$data->id}}" selected>
                                                    {{$data->name}}
                                                </option>
                                            @else
                                                <option value="{{$data->id}}">
                                                    {{$data->name}}
                                                </option>
                                            @endif

                                        @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Designation: <span class="tx-danger">*</span></label>
                                        <select class="form-control " data-placeholder="designation" name="designation" disabled required>
                                            <option label="Choose one" value="" selected>Choose one</option>
                                            @foreach($designation as $key => $data)


                                                @if($data->id==$user->designation_id)
                                                    <option value="{{$data->id}}" selected>
                                                        {{$data->name}}
                                                    </option>

                                                @else
                                                    <option value="{{$data->id}}">
                                                        {{$data->name}}
                                                    </option>
                                                @endif

                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Role: <span class="tx-danger">*</span></label>
                                        <select class="form-control " data-placeholder="role" name="role" required disabled>
                                            <option label="Choose one" value="" selected>Choose one</option>
                                            @foreach($role as $key => $data)
                                                @if($data->id==$user->role_id)
                                                <option value="{{$data->id}}" selected>
                                                    {{$data->name}}
                                                </option>
                                                @endif

                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <!-- col-4 -->
                            </div><!-- row -->
                            <div class="form-layout-footer text-right">
                                <button class="btn btn-info mg-r-5" type="submit"> Update General Information</button>
                            </div><!-- form-layout-footer -->
                        </form>
                            <hr/>
                        <form method="post" action="{{url('/update_passport')}}" enctype="multipart/form-data">
                            <h5>Passport Details</h5>
                            @csrf
                            <div class="row mg-b-25">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label class="form-control-label">Passport Number: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="passport_no" value="{{$user->passport_no}}" required>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-7">
                                    <div class="form-group">

                                        @if($user->passport_attachment==null)
                                            <label class="form-control-label">New Passport Attachment: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="file" name="passport_attachment" required>
                                            @else
                                            <label class="form-control-label">New Passport Attachment:</label>
                                            <input class="form-control" type="file" name="passport_attachment">
                                        @endif
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-5">
                                    <div class="form-group">

                                        @if($user->passport_attachment!=null)
                                            <label class="form-control-label">Attached Passport: <span class="tx-danger">*</span></label>
                                        <img src="{{asset('passports/').'/'.$user->passport_attachment}}" width="100%" height="200px"/>
                                            @endif
                                    </div>
                                </div><!-- col-4 -->

                            </div>
                            <div class="form-layout-footer text-right">
                                    <button class="btn btn-info mg-r-5" type="submit"> Update Passport Details</button>
                            </div><!-- form-layout-footer -->
                        </form>

                            <hr/>
                        <form method="post" action="{{url('/update_password')}}">
                            <h5>Change Password</h5>
                            @csrf
                            <div class="row mg-b-25">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Old Password: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="password" name="old_password" placeholder="Type Old Password" required>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="password" name="new_password" placeholder="Type New Password" required>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Confirm Password: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="password" name="confirm_password" placeholder="ReType New Password" required>
                                    </div>
                                </div><!-- col-4 -->

                            </div>
                            <div class="form-layout-footer text-right">
                                <button class="btn btn-info mg-r-5" type="submit"> Update</button>
                            </div><!-- form-layout-footer -->
                        </form>
                    </div><!-- form-layout -->

                </section>

            </div>
        </div>
        <!-- card -->

        <!-- card -->
    </div>



@endsection



