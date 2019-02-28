@extends('layouts.customer.DashboardLayout')

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
                  <!--  <p class="mg-b-20 mg-sm-b-30">
                        You can submit your travel request before 5 to 7 days of your trip.</p> -->
                </div>

            </div>
            <div id="wizard1">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif

                    @if($passport_not_found==1)
                        <div class="alert alert-danger">
                            Your passport attachment is not found in our system <a href="{{url('/customer_setting')}}">Attach Your Passport</a>
                        </div>
                    @endif

                <section>


                    <div class="form-layout">
                        <form ng-submit="submit_request()" id="create_request_form" enctype="multipart/form-data">
                            <div class="row mg-b-25">
                                @csrf
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Travel Purpose: <span class="tx-danger">*</span></label>
                                       <!-- <input class="form-control" type="text" name="purpose"  ng-model="purpose" placeholder="Type Your Purpore" required>-->
                                        <select class="form-control" name="purpose" ng-model="purpose" required>
                                            <option value="">Select Purpose</option>

                                                <option value="Business Trip" selected>Business Trip</option>
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
                                        <select class="form-control " data-placeholder="trip_from" ng-model="trip_from" name="trip_from" id="trip_from" required>
                                            <option label="Choose one" value="" selected>Select</option>

                                            @foreach($locations as $data)
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
                                        <select class="form-control " data-placeholder="trip_to" ng-model="trip_to" name="trip_to" id="trip_to" required>
                                            <option label="Choose one" value="" selected>Select</option>

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
                                        <select class="form-control " data-placeholder="travel_type" ng-model="travel_type"  ng-change="change_travel_type()" name="travel_type" required>
                                            <option label="Choose one" value="" selected>Select</option>

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
                                        <label class="form-control-label">Travel Authorization: <span class="tx-danger">.jpg, .png, .pdf, .zip, .docx</span></label>
										
										
									
                                        <input type="file" class="form-control" name="line_manager" id="line_manager"  ng-model="line_manager" accept=".jpg,.jpeg,.png,.doc,.docx,.pdf"/>
                                        <a href="{{asset('/line_manager_attachments')}}/{{$travel_details['line_manager_attachments']}}" target="_blank"><i class="fa fa-paperclip"></i> See current Attached</a>
 

										
										
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Departure Date<span class="tx-danger">*</span></label>
                                        <input class="form-control lightgraybg" type="text" name="start_date" id="Startdatepicker"  ng-model="start_date" placeholder="(dd-mm-yyyy)"  required autocomplete="off" readonly>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4" style="display: none;" id="return_date">
                                    <div class="form-group">
                                        <label class="form-control-label">Return Date: <span class="tx-danger">*</span></label>
                                        <input class="form-control lightgraybg" type="text" name="end_date" id="Enddatepicker" ng-model="end_date"  placeholder="(dd-mm-yyyy)" autocomplete="off" required readonly>
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
                                       
                                    
									<textarea  class="form-control" type="text"  name="comment"  ng-model="comment"  placeholder="Comments" autocomplete="off"> </textarea>
									</div>
                                </div><!-- col-4 -->












                                <!-- col-4 -->
                            </div><!-- row -->

                            <h6>Additional Travellers</h6>
                            <div class="row mg-b-25" ng-cloak>
                                <div class="col-md-12" ng-repeat="r in selected_ids">
                                    <div class="row  mg-t-10" style="width:100%;">
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
                                                <label class="form-control-label" style="display: block;"> &nbsp; </label>
                                                <button class="form-control btn btn-info mg-r-5" style="background: #17a2b8;" type="button" ng-click="selected_ids.splice($index, 1)"> Remove</button>
                                            </div>
                                        </div>

                                    </div>

                                </div>
								
                                <div class="col-lg-4 mg-t-10">
                                    <div class="form-group mg-b-10-force">

                                        <select class="form-control relation" data-placeholder="relation" name="relation">
                                            <option label="Choose one" value="" selected>Select Traveller</option>

                                            @foreach($user_members as $key => $data)
                                                <option value="{{$data->id}}" relation="{{$data['relation']->name}}" first_name="{{$data->first_name}}" last_name="{{$data->last_name}}" passport_no="{{$data->passport_no}}">
                                                    {{$data->first_name}} {{$data->last_name}} <b>({{$data['relation']->name}})</b>
                                                </option>

                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-4  mg-t-10">
                                    <button class="btn btn-info mg-r-5" type="button" ng-click="add_member()" style="    background-color: #eaeaea; border: 1px solid #d9d9d9; color: #4f5057;"> <i class=" fa fa-plus"></i> Add</button>
                                    <a href="{{url('/customer_members')}}"><button class="btn btn-info mg-r-5" type="button"  style="    background-color: #eaeaea; border: 1px solid #d9d9d9; color: #4f5057;">New Traveller</button></a> 
                                </div>
                            </div>
                            <div class="form-layout-footer text-right">
                                @if($passport_not_found==0)
                                    <button class="btn btn-info mg-r-5" type="submit" ng-disabled="submit_disabled" ng-bind="submit_text"></button>
                                    @else
                                    <button class="btn btn-info mg-r-5" type="submit" disabled>Submit</button>
                                @endif
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







        $scope.selected_ids=[];
        $scope.purpose="<?php echo $travel_details['purpose'] ?>";
        $scope.trip_from="<?php echo $travel_details['trip_from_loc'] ?>";
        $scope.trip_to="<?php echo $travel_details['trip_to_loc'] ?>";
        $scope.travel_type="<?php echo $travel_details['travel_type'] ?>";

        $scope.start_date="<?php echo date('d-m-Y', strtotime($travel_details['start_date'])) ?>";

        $scope.end_date="<?php if($travel_details['end_date']!=null){ echo date('d-m-Y', strtotime($travel_details['end_date']));}  ?>";

        $scope.airline="<?php echo $travel_details['airline_id'] ?>";
        $scope.comment="<?php echo $travel_details['comment'] ?>";


        $scope.submit_disabled=false;
        $scope.submit_text="Submit Request";

        $scope.message="";
        $scope.error_message="";
       // $scope.line_manager="";

        $scope.class="<?php echo $travel_details['class'] ?>";

        $scope.line_manager="";


        $scope.previous_travel_id="<?php echo $previous_travel_id ?>";

        $http.get("{{url('/get_travel_members/').'/'.$previous_travel_id}}")
            .then(function(response) {
                if($scope.travel_type==2){
                    $('#return_date').show();
                }

                for(var i=0; i<response.data.length; i++){

                    var user={
                        'fullname':response.data[i].user_member.first_name+' '+response.data[i].user_member.last_name,
                        'firstname': response.data[i].user_member.first_name,
                        'lastname': response.data[i].user_member.last_name,
                        'relation': response.data[i].user_member.relation.name,
                        'passport': response.data[i].user_member.passport_no,
                        'id': response.data[i].user_member.id
                    };
                    $scope.selected_ids.push(user);
                }

            });

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

            ///alert(datetime);


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
                fd.append("_token", "{{  csrf_token() }}");
                fd.append("previous_travel_id", $scope.previous_travel_id);

                //console.log(fd);
               // alert($scope.previous_travel_id);

                var config = {headers: {'Content-Type': undefined}};

                var httpPromise = $http.post("{{url('/resubmit_travel_req')}}", fd, config).then(function(response){
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

                        window.location="{{url('/customer_travel_list')}}";
                    }
                });

            }


        }

        $scope.add_member=function(){
            var selected_member_id= $('.relation :selected').val();
            var relation=$('.relation :selected').attr('relation');
            var first_name=$('.relation :selected').attr('first_name');
            var last_name=$('.relation :selected').attr('last_name');
            var passport_no= $('.relation :selected').attr('passport_no');


            if(selected_member_id==''){
                $scope.error_message="Please select any member";
                $(".show_error_message").fadeIn().delay(3000).fadeOut();
                $window.scrollTo(0, 0);
            }
            else{
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

                }
                else{

                    $scope.error_message="'"+first_name+" "+last_name+"' already selected";
                    $(".show_error_message").fadeIn().delay(3000).fadeOut();
                    $window.scrollTo(0, 0);
                }
            }


        }



        $scope.attachment_change=function(e){
            console.log(e);
        }

        $scope.change_start_date=function(){
            alert("Done");
        }

        $scope.change_travel_type=function(){
            if($scope.travel_type==2){
                $('#return_date').show();
            }
            else{
                $('#return_date').hide();
            }
        }


        //$('#datepicker').datetimepicker();
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





