@extends('layouts.customer.DashboardLayout')

@section('content')




    <div class="am-pagebody" ng-app="app" ng-controller="app_cont">
        <div class="card pd-20 pd-sm-40">
            <div class="alert alert-success" id="show_message" ng-if="message!=''">
                <% message %>
            </div>
            <div class="row">



                <div class="col-lg-8">
                    <h6 class="card-body-title">
                        Create Travel Request</h6>
                    <p class="mg-b-20 mg-sm-b-30">
                        You can submit your travel request before 5 to 7 days of your trip.</p>
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
                        <form ng-submit="submit_request()">
                            <div class="row mg-b-25">
                                @csrf
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Travel Purpose: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="purpose"  ng-model="purpose" placeholder="Type Your Purpore" required>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Trip From: <span class="tx-danger">*</span></label>
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
                                        <label class="form-control-label">Trip To: <span class="tx-danger">*</span></label>
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
                                        <select class="form-control " data-placeholder="travel_type" ng-model="travel_type" name="travel_type" required>
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
                                    <div class="form-group">
                                        <label class="form-control-label">Start Date <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="date" name="start_date" data-date="" data-date-format="DD MMMM YYYY" ng-model="start_date" placeholder="Type Your Start Date" required>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">End Date: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="date" name="end_date" ng-model="end_date"  placeholder="Type Your End Start" required>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Choose Airline: </label>
                                        <select class="form-control " data-placeholder="airline" ng-model="airline" name="airline" required>
                                            <option label="Choose one" value="" selected>Choose one</option>

                                            @foreach($airlines as $key => $data)
                                                <option value="{{$data->id}}">
                                                    {{$data->name}}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label class="form-control-label">Comment:</label>
                                        <input class="form-control" type="text" name="comment"  ng-model="comment"  placeholder="Comments" required>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-12"><h6>Selected Members:</h6></div>
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









                                <!-- col-4 -->
                            </div><!-- row -->
                            <hr/>
                            <h6>Add Members</h6>
                            <div class="row mg-b-25">
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">

                                        <select class="form-control relation" data-placeholder="relation" name="relation">
                                            <option label="Choose one" value="" selected>Choose</option>

                                            @foreach($user_members as $key => $data)
                                                <option value="{{$data->id}}" relation="{{$data['relation']->name}}" first_name="{{$data->first_name}}" last_name="{{$data->last_name}}" passport_no="{{$data->passport_no}}">
                                                    {{$data->first_name}} {{$data->last_name}} <b>({{$data['relation']->name}})</b>
                                                </option>

                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <button class="btn btn-info mg-r-5" type="button" ng-click="add_member()"> Add</button>
                                    <a href="{{url('/customer_members')}}">Create New Member</a>
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
        $scope.purpose="";
        $scope.trip_from="";
        $scope.trip_to="";
        $scope.travel_type="";

        $scope.start_date="";

        $scope.end_date="";

        $scope.airline="";
        $scope.comment="";


        $scope.submit_disabled=false;
        $scope.submit_text="Create Request";

        $scope.message="";

        $scope.submit_request=function(){
            $scope.submit_disabled=true;
            $scope.submit_text="Please Wait";

            var startDate = new Date($scope.start_date);
            var date = startDate.getDate();
            var month = startDate.getMonth(); //Be careful! January is 0 not 1
            var year = startDate.getFullYear();
            var final_StartDate=year+"-"+(month+1)+"-"+date;


            var endDate = new Date($scope.end_date);
            var date = endDate.getDate();
            var month = endDate.getMonth(); //Be careful! January is 0 not 1
            var year = endDate.getFullYear();
            var final_endDate=year+"-"+(month+1)+"-"+date;


            $http({
                method : "POST",
                url:"{{url('/create_request')}}",
                data:{'selected_members':$scope.selected_ids,
                    'purpose':$scope.purpose,
                    'trip_from':$scope.trip_from,
                    'trip_to':$scope.trip_to,
                    'travel_type':$scope.travel_type,
                    'start_date':final_StartDate,
                    'end_date':final_endDate,
                    'airline':$scope.airline,
                    'comment':$scope.comment,
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
            });
        }

        $scope.add_member=function(){
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



    });
</script>





