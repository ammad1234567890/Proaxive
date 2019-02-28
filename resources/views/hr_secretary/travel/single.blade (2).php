@extends('layouts.hr_secretary.DashboardLayout')

@section('content')





    <div class="am-pagebody">
        <div class="card pd-20 pd-sm-40">
            <div class="row ">
                <div class="col-lg-8">

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
                    <div class="row">
                        <div class="col-md-12">
                            <h5>TR# {{$single['request_no']}}
                                @if($single['status']['id']==1)
                                <span style="background:gray; display: inline-block; padding:5px; color:#fff; border-radius:5px;">{{$single['status']['name']}}</span>
                                @elseif($single['status']['id']==2)
                                    <span style="background:blue; display: inline-block; padding:5px; color:#fff; border-radius:5px;">{{$single['status']['name']}}</span>
                                @elseif($single['status']['id']==3)
                                    <span style="background:red; display: inline-block; padding:5px; color:#fff; border-radius:5px;">{{$single['status']['name']}}</span>
                                @elseif($single['status']['id']==4)
                                    <span style="background:green; display: inline-block; padding:5px; color:#fff; border-radius:5px;">{{$single['status']['name']}}</span>
                                @endif

                                    <span style="float:right;">Request Date: {{Date('d/m/Y', strtotime($single['created_at']))}}</span>
                            </h5>

                        </div>

                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Employee Details</h6>

                            <table width="100%">
                                <tr>
                                    <td>Full Name</td>
                                    <td>: {{$single['user']['name']}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>: {{$single['user']['email']}}</td>
                                </tr>
                                <tr>
                                    <td>Department</td>
                                    <td>: {{$single['user']['department']['name']}}</td>
                                </tr>
                                <tr>
                                    <td>Designation</td>
                                    <td>: {{$single['user']['designation_name']['name']}}</td>
                                </tr>
                                <tr>
                                    <td>Passport No</td>
                                    <td>: {{$single['user']['passport_no']}}</td>
                                </tr>
                                <tr>
                                    <td>Passport Attachment</td>
                                    <td>: <a href="{{asset('/passports/'.$single['user']['passport_attachment'])}}" target="_blank">{{$single['user']['passport_attachment']}}</a></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6>Travel Details</h6>
                            <table width="100%">
                                <tr>
                                    <td>Purpose</td>
                                    <td>: {{$single['purpose']}}</td>
                                </tr>
                                <tr>
                                    <td>Trip</td>
                                    <td>: {{$single['from_loc']['name']}} - {{$single['toloc']['name']}}</td>
                                </tr>
                                <tr>
                                    <td>Travel type</td>
                                    <td>: {{$single['traveltype']['name']}}</td>
                                </tr>
                                <tr>
                                    <td>Trip Date</td>
                                    <td>: {{Date('d/M/Y', strtotime($single['start_date']))}} - {{Date('d/M/Y', strtotime($single['end_date']))}}</td>
                                </tr>
                                <tr>
                                    <td>Airline</td>
                                    <td>: {{$single['airline']['name']}}</td>
                                </tr>
                                <tr>
                                    <td>Comment</td>
                                    <td>: {{$single['comment']}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br/>


                    <div class="row">

                        <div class="col-md-12">
                            @if($single['members']!=null)
                            <h5>Other Travel Members:</h5>
                            <table class="table display responsive nowrap members_table" width="100%" border="1px">
                                <thead>
                                <tr>
                                    <th class="wd-25p text-center">First Name</th>
                                    <th class="wd-25p text-center">Last Name</th>
                                    <th class="wd-25p text-center">Passport</th>
                                    <th class="wd-25p text-center">Attachment</th>

                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($single['members'] as $member)
                                        <tr>
                                            <td>{{$member['user_member']['first_name']}}</td>
                                            <td>{{$member['user_member']['last_name']}}</td>
                                            <td>{{$member['user_member']['passport_no']}}</td>
                                            <td><a href="{{asset('/passports/'.$member['user_member']['passport_attachment'])}}" target="_blank">{{$member['user_member']['passport_attachment']}}</a></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            @endif
                            @if($single['approvals']!=null)
                            <h5>Approvals</h5>
                                <table class="table display responsive nowrap members_table" width="100%" border="1px">
                                    <thead>
                                    <tr>
                                        <th class="wd-25p text-center">Action User</th>
                                        <th class="wd-25p text-center">Status</th>
                                        <th class="wd-25p text-center">Comment</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($single['approvals'] as $approve)
                                        <tr>
                                            <td>{{$approve['user']['name']}} ({{$approve['user']['designation_name']['name']}})</td>
                                            @if($approve['status']==3)
                                                <td style="color:red;">Rejected</td>
                                            @endif
                                            @if($approve['status']==4)
                                                <td style="color:green;">Approved</td>
                                            @endif
                                            @if($approve['comment']=='')
                                                <td>----</td>
                                                @else
                                                <td>{{$approve['comment']}}</td>
                                            @endif

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                @endif
                            @if($single['status']['id']==1)
                                <form method="POST" action="{{url('hr_approval')}}" id="approval_form">
                                    @csrf
                                    <input type="hidden" name="request_id" value="{{$single['id']}}"/>
                                    <div class="form-group">
                                        <div class="validation_error_message" style="display:none;">Please Type Comment</div>
                                        <textarea width="100%" placeholder="Type your comment" class="form-control" name="comment" id="comment"></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select class="form-control" name="status" id="approve_status" required>
                                                <option value="">Select Status</option>
                                                <option value="1">Approved</option>
                                                <option value="2">Rejected</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <button class="btn btn-primary mg-r-5" type="submit" id="submit_approval"> Submit</button>
                                        </div>
                                    </div>

                                </form>

                            @endif

                        </div>





                    </div>




                </section>

            </div>
        </div>
        <!-- card -->

        <!-- card -->
    </div>



@endsection

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>



<script>

    $(document).ready(function(){

        $('#approval_form').on('submit', function() {
            var comment=$('#comment').val();
            var approve_status= $('#approve_status').val();


            if(approve_status==1){
                $('#submit_approval').attr('disabled', true);
                $('#submit_approval').html('Please wait');
                $('#approval_form').jqxValidator('validate');

            }
            else if(approve_status==2){
                if(comment!=''){
                   // $('#approval_form').submit();
                    $('#submit_approval').attr('disabled', true);
                    $('#submit_approval').html('Please wait');
                }
                else{

                    $('.validation_error_message').slideDown().delay(1000).slideUp();
                    return false;
                   // alert("Please type Comment");
                }
            }
        });
    });
</script>