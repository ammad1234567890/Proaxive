@extends('layouts.hr.DashboardLayout')

@section('content')




    <div class="am-pagebody" ng-app="app" ng-controller="app_cont">
        <div class="card pd-20 pd-sm-40">
            <div class="alert alert-success show_message" ng-if="message!=''" ng-cloak>
                <% message %>
            </div>

            <div class="alert alert-danger show_error_message" style="display: none;" ng-cloak>
                <% error_message %>
            </div>
            <div class="alert alert-danger show_error_message_file" style="display: none;" ng-cloak>

            </div>
            <div class="row">



                <div class="col-lg-8">
                    <h6 class="card-body-title">
                        New Travel Request</h6>
                    <br>
                </div>

            </div>
            <div id="wizard1">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                <section>


                    <div class="form-layout">
                        <form ng-submit="submit_request()">
                            <div class="row mg-b-25">
                                @csrf
								
								<div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
									<label class="form-control-label">Employee: <span class="tx-danger">*</span></label>
                                        <select class="form-control"  name="customer_id" ng-model="customer_id" ng-change="get_customer_members()" required>
                                            <option label="Choose one" value="" selected>Select Employee</option>
                                            @foreach($customers  as $key => $data)
                                                <option value="{{$data->id}}">{{$data->first_name}} {{$data->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
								
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Travel Purpose: <span class="tx-danger">*</span></label>
                                        <!-- <input class="form-control" type="text" name="purpose"  ng-model="purpose" placeholder="Type Your Purpore" required>-->
                                        <select class="form-control" name="purpose" ng-model="purpose" required>
                                            <option value="">Select Purpose</option>
                                            <option value="Business Trip">Business Trip</option>
                                            <option value="Demobilization">Demobilization</option>
                                            <option value="Job Rotation">Job Rotation</option>
                                            <option value="Mobilization">Mobilization</option>
                                            <option value="Training">Training</option>
                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Departure: <span class="tx-danger">*</span></label>
                                        <select class="form-control " data-placeholder="trip_from" ng-model="trip_from" name="trip_from" required>
                                            <option label="Choose one" value="" selected>Choose one</option>

                                            @foreach($locations as $key => $data)
                                                <option value="{{$data->id}}">
                                                    {{$data->name}}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Destination: <span class="tx-danger">*</span></label>
                                        <select class="form-control " data-placeholder="trip_to" ng-model="trip_to" name="trip_to" required>
                                            <option label="Choose one" value="" selected>Choose one</option>

                                            @foreach($locations as $key => $data)
                                                <option value="{{$data->id}}">
                                                    {{$data->name}}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Travel type: <span class="tx-danger">*</span></label>
                                        <select class="form-control " data-placeholder="travel_type" ng-model="travel_type" name="travel_type" ng-change="change_travel_type()" required>
                                            <option label="Choose one" value="" selected>Choose one</option>

                                            @foreach($travel_type as $key => $data)
                                                <option value="{{$data->id}}">
                                                    {{$data->name}}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Class: <span class="tx-danger">*</span></label>
                                        <select class="form-control"  name="class" ng-model="class" required>
                                            <option value="Economy" selected>Economy</option>
                                            <option value="Business">Business</option>
                                            <option value="First Class">First Class</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Travel Authorization: <span class="tx-danger">*</span></label>
                                        <input type="file" class="form-control" name="line_manager" id="line_manager" ng-model="line_manager" accept=".jpg,.jpeg,.png,.doc,.docx,.pdf" required/>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Departure Date<span class="tx-danger">*</span></label>
                                        <input class="form-control lightgraybg" type="text" name="start_date" id="Startdatepicker" ng-model="start_date" placeholder="(dd-mm-yyyy)" required autocomplete="off" readonly>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4" style="display: none;" id="return_date">
                                    <div class="form-group">
                                        <label class="form-control-label">Return Date: <span class="tx-danger">*</span></label>
                                        <input class="form-control lightgraybg " type="text" name="end_date" id="Enddatepicker" ng-model="end_date"  placeholder="(dd-mm-yyyy)" autocomplete="off" required readonly>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Preferred Airline: </label>
                                        <select class="form-control " data-placeholder="airline" ng-model="airline" name="airline" required>


                                            @foreach($airlines as $key => $data)
                                                <option value="{{$data->id}}">
                                                    {{$data->name}}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Comments:</label>
                                        <input class="form-control" type="text" name="comment"  ng-model="comment"  placeholder="Comments">
                                    </div>
                                </div><!-- col-4 -->
                            </div><!-- row -->

                            <h6>Additional Travellers</h6>
                            <div class="row mg-b-25">
                                <div class="col-md-12" ng-repeat="r in selected_ids">
                                    <div class="row" style="width:100%;">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-control-label">Full Name:</label>
                                                <input class="form-control" type="text" ng-model="r.fullname" readonly>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-control-label">Relation:</label>
                                                <input class="form-control" type="text" ng-model="r.relation" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-control-label">Passport:</label>
                                                <input class="form-control" type="text" ng-model="r.passport" readonly>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-control-label" style="display: block;">*</label>
                                                <button class="form-control btn btn-info mg-r-5" style="background: #17a2b8;" type="button" ng-click="selected_ids.splice($index, 1)"> Remove</button>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">

                                        <select class="form-control relation" data-placeholder="relation" name="relation">
                                            <option label="Choose one"  ng-repeat="data in members_list" ng-value="<%data.id%>" relation="<%data.relation%>" passport_no="<%data.passport_no%>" first_name="<%data.first_name%>" last_name="<%data.last_name%>"><% data.first_name %> <% data.last_name %></option>


                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <button class="btn btn-info mg-r-5" type="button" ng-click="add_member()"> Add</button>

                                </div>
                            </div>
                            <div class="form-layout-footer text-right">

                                    <button class="btn btn-info mg-r-5" type="submit" ng-disabled="submit_disabled" ng-bind="submit_text"></button>



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
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script>
    //var myapp = angular.module('app', []);

    var myapp = angular.module('app', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    myapp.controller('app_cont', function($scope, $http, $window) {

        $scope.members_list=[];


        $scope.customer_id="";


        $scope.selected_ids=[];
        $scope.purpose="";
        $scope.trip_from="";
        $scope.trip_to="";
        $scope.travel_type="";

        $scope.start_date="";

        $scope.end_date="";

        $scope.airline="41";
        $scope.comment="";


        $scope.submit_disabled=false;
        $scope.submit_text="Submit Request";

        $scope.message="";
        $scope.line_manager="";
        $scope.class="Economy";

        $scope.submit_request=function(){
            var startdate=$('#Startdatepicker').val();
            var enddate=$('#Enddatepicker').val();

            $scope.start_date=startdate;
            $scope.end_date=enddate;




            var startDate = startdate.split("-");
            var startDay=startDate[0];
            var startMonth=startDate[1];
            var startYear=startDate[2];


            var endDate = enddate.split("-");
            var endDay=endDate[0];
            var endMonth=endDate[1];
            var endYear=endDate[2];

            var finalEndDate=endYear+"-"+endMonth+"-"+endDay;
            var finalStartDate=startYear+"-"+startMonth+"-"+startDay;


            var FinalENDdatetime = new Date(finalEndDate);
            var FinalSTARTdatetime = new Date(finalStartDate);

            if(Date.parse(FinalENDdatetime)<Date.parse(FinalSTARTdatetime)){
                $scope.error_message="Return Date cannot be prior to the departure date";
                $(".show_error_message").fadeIn().delay(3000).fadeOut();


                $window.scrollTo(0, 0);
            }
            else if(startdate==""){
                $scope.error_message="Please provide Departure Date";
                $(".show_error_message").fadeIn().delay(3000).fadeOut();


                $window.scrollTo(0, 0);
            }
            else if($scope.travel_type==2 && enddate==""){
                $scope.error_message="Please provide return Date";
                $(".show_error_message").fadeIn().delay(3000).fadeOut();


                $window.scrollTo(0, 0);
            }
            else if($scope.trip_from==$scope.trip_to){
                $scope.error_message="Departure and Destination cannot be same";
                $(".show_error_message").fadeIn().delay(3000).fadeOut();

                $('#trip_from').addClass('error_textbox');
                $('#trip_to').addClass('error_textbox');
                // $('#trip_to').css("border-color", "red");
                $window.scrollTo(0, 0);
            }
            else{
                $scope.submit_disabled=true;
                $scope.submit_text="Please Wait";

                var image=$("#line_manager").prop("files")[0];
                //console.log(image);

                var fd = new FormData()

                fd.append("purpose", $scope.purpose);
                fd.append("line_manager", image);
                fd.append("trip_from", $scope.trip_from);
                fd.append("trip_to", $scope.trip_to);
                fd.append("travel_type", $scope.travel_type);
                fd.append("start_date", startdate);
                fd.append("end_date", enddate);
                fd.append("airline", $scope.airline);
                fd.append("comment", $scope.comment);
                fd.append("class", $scope.class);
                fd.append("selected_members", JSON.stringify($scope.selected_ids));
                fd.append("customer_id", $scope.customer_id);
                fd.append("_token", "{{  csrf_token() }}");



                var config = {headers: {'Content-Type': undefined}};

                var httpPromise = $http.post("{{url('/create_request_from_hr')}}", fd, config).then(function(response){
                    if(response.data[0]['status']==1){
                        $scope.submit_disabled=false;
                        $scope.submit_text="Submit Request";
                        $scope.message=response.data[0]['message'];

                        $scope.selected_ids=[];
                        $scope.purpose="";
                        $scope.trip_from="";
                        $scope.trip_to="";
                        $scope.travel_type="";

                        $scope.start_date="";

                        $scope.end_date="";

                        $scope.airline="41";
                        $scope.comment="";

                        $scope.class="Economy";
                        $scope.line_manager="";
                        $('#trip_from').removeClass('error_textbox');
                        $('#trip_to').removeClass('error_textbox');
                        $('#Startdatepicker').removeClass('error_textbox');
                        $('#Enddatepicker').removeClass('error_textbox');

                        $('#line_manager').val('');

                        $window.scrollTo(0, 0);

                        window.location="{{url('/travel_list')}}";
                    }
                });
            }


            /*$http({
                method : "POST",
                url:"{{url('/create_request_from_hr')}}",
                data:{'selected_members':$scope.selected_ids,
                    'purpose':$scope.purpose,
                    'trip_from':$scope.trip_from,
                    'trip_to':$scope.trip_to,
                    'travel_type':$scope.travel_type,
                    'start_date':final_StartDate,
                    'end_date':final_endDate,
                    'airline':$scope.airline,
                    'comment':$scope.comment,
                    'customer_id': $scope.customer_id,
                    "_token": "{{ csrf_token() }}",
                },
            }).then(function mySuccess(response) {
                if(response.data[0]['status']==1){
                    $scope.submit_disabled=false;
                    $scope.submit_text="Create Request";
                    $scope.message=response.data[0]['message'];

                    $scope.selected_ids=[];
                    $scope.purpose="";
                    $scope.trip_from="";
                    $scope.trip_to="";
                    $scope.travel_type="";

                    $scope.start_date="";

                    $scope.end_date="";

                    $scope.airline="";
                    $scope.comment="";


                    $window.scrollTo(0, 0);
                }
            }, function myError(response) {
                $scope.message = response.data[0]['message'];
            });*/
        }

        $scope.add_member=function(){
            if($scope.customer_id!=""){
                var selected_member_id= $('.relation :selected').val();
                var relation=$('.relation :selected').attr('relation');
                var first_name=$('.relation :selected').attr('first_name');
                var last_name=$('.relation :selected').attr('last_name');
                var passport_no= $('.relation :selected').attr('passport_no');

                var is_found=0;

                for(var i=0; i<$scope.selected_ids.length; i++){
                    if(selected_member_id==$scope.selected_ids[i].id){
                        is_found=1;
                    }
                }

                if(is_found==0){
                    var user={
                        'fullname':first_name+' '+last_name,
                        'firstname': first_name,
                        'lastname': last_name,
                        'relation': relation,
                        'passport': passport_no,
                        'id': selected_member_id
                    };
                    $scope.selected_ids.push(user);

                    console.log($scope.selected_ids);
                }
                else{
                    alert("This member already selected!");
                }
            }
            else{
                alert("Please select the customer first.");
            }

        }

        $scope.get_customer_members=function(){
            $scope.members_list=[];
            $http({
                method : "GET",
                url:"{{url('/get_customer_members')}}/"+$scope.customer_id,
            }).then(function mySuccess(response) {
                var data=(response.data);

                for(var i=0; i<response.data.length; i++){
                    //alert(response.data[i].first_name);
                    $scope.members_list.push(
                        {'first_name':response.data[i].first_name,
                            'last_name': response.data[i].last_name,
                            'passport_no': response.data[i].passport_no,
                            'relation': response.data[i].relation_id,
                            'id':  response.data[i].id,
                        });
                }
               // $scope.members_list.push(data);
            }, function myError(response) {
                $scope.message = response.data[0]['message'];
            });
        }

        $scope.change_travel_type=function(){
            if($scope.travel_type==2){
                $('#return_date').show();
            }
            else{
                $('#return_date').hide();
            }
        }


        var dateToday = new Date();
        $('#Startdatepicker').datetimepicker({
            timepicker: false,
            format: 'd-m-Y',
            formatDate: 'Y/m/d',
            minDate: dateToday,
            scrollMonth : false,
            scrollInput : false
        });

        $('#Enddatepicker').datetimepicker({
            timepicker: false,
            format: 'd-m-Y',
            formatDate: 'Y/m/d',
            minDate: dateToday,
            scrollMonth : false,
            scrollInput : false

        });

        $('#Startdatepicker').change(function(){
            $('#Startdatepicker').removeClass('error_textbox');
        });


        $('#Enddatepicker').change(function(){
            $('#Enddatepicker').removeClass('error_textbox');
        });

        $('#trip_from').change(function(){
            //$('#trip_from').css('border-color', 'grey');
            $('#trip_from').removeClass('error_textbox');
            $('#trip_to').removeClass('error_textbox');
        });

        $('#trip_to').change(function(){
            //$('#trip_from').css('border-color', 'grey');
            $('#trip_to').removeClass('error_textbox');
            $('#trip_from').removeClass('error_textbox');
        });

        $('#line_manager').change(function(){
            var fileExtension = ['jpeg', 'jpg', 'png', 'pdf', 'docx', 'zip'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $('#line_manager').val("");

                $(".show_error_message_file").html('Please provide valid attachment file');
                $(".show_error_message_file").fadeIn().delay(3000).fadeOut();
            }
        });
    });
</script>





