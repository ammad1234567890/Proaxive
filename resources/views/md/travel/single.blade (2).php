@extends('layouts.md.DashboardLayout')

@section('content')


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


       <!-- Designer card -->
     <div class="am-pagebody">
            <div class="card pd-20 pd-sm-40">
                <div class="row ">
                    <div class="col-lg-8">
                        <h6 class="card-body-title">
                            Travel Request Details</h6>
                        <p class="mg-b-20 mg-sm-b-30">
                            <label class="form-control-label">TR# <b> {{$single['request_no']}}</b></label> |
                            Request Date: <label class="form-control-label"><b>{{Date('d/m/Y', strtotime($single['created_at']))}}</b>
                                @if($single['is_resubmit_entry']==1)

                                    <b style="color:green;">(Request resubmitted)</b>
                                @endif


                            </label>
                        </p>
                    </div>
                    <div class="col-lg-4 text-right">
                        <p class="mg-b-20 mg-sm-b-30 ">
                            Status:

@if($single['status']['id']==1)
                                <span class="cursorpointer status_tag" style="background:#ff9600; display: inline-block; padding:5px; color:#fff; border-radius:5px;"><i class="fa fa-refresh" style="color: white;" title="Pending"></i> {{$single['status']['name']}}</span>
                                @elseif($single['status']['id']==2)
                                    <span class="cursorpointer status_tag" style="background:#1894ff; display: inline-block; padding:5px; color:#fff; border-radius:5px;"><i class="fa fa-refresh" style="color: white;" title="Processing"></i> {{$single['status']['name']}}</span>
                                @elseif($single['status']['id']==3)
                                    <span class="cursorpointer status_tag" style="background:red; display: inline-block; padding:5px; color:#fff; border-radius:5px;"><i class="fa fa-ban" style="color: white;" title="Pending"></i> {{$single['status']['name']}}</span>
                                @elseif($single['status']['id']==4)
                                    <span class="cursorpointer status_tag" style="background:green; display: inline-block; padding:5px; color:#fff; border-radius:5px;"><i class="fa fa-check-circle" style="color: white;" title="Approved"></i> {{$single['status']['name']}}</span>
                                @endif
							
							
							
							
							
							
                           
							
							
							
							
							
							
							</p>
                        <div class="approval_workflow ">
						
 @if($single['approvals']!=null)
                            <table class="table tabletd_padding_min " width="100%">
                                <thead>
                                    <tr>
                                        <th class="  text-left">
                                            Approval
                                        </th>
                                        <th class="wd-25p text-center">
                                            Status
                                        </th>
                                        <th class="  text-left">
                                            Comment
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($single['approvals'] as $approve)
                                        <tr>
                                            <td>{{$approve['user']['name']}} ({{$approve['user']['designation_name']['name']}})</td>
                                            @if($approve['status']==3)
                                                <td style="color:red;">Disapproved</td>
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
                        </div>
                    </div>
                </div>

                <hr  class="sp_row" />
               
  <h5>
                       Employee Details</h5> 

                       <br />
                <div class="form-layout">
                    <div class="row mg-b-25">

 <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">
                                    
                                 Employee ID:
                                </label>
                                <br />
                                <label class="form-control-label">
                                    <b> {{$single['user']['emp_id']}}</b>
                                </label>
                            </div>
                        </div>
					
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">
                                    
                                 Full Name:
                                </label>
                                <br />
                                <label class="form-control-label">
                                    <b>{{$single['user']['name']}}</b>
                                </label>
                            </div>
                        </div>
                        <!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">
                                    Email:
                                </label>
                                <br />
                                <label class="form-control-label">
                                    <b>{{$single['user']['email']}}</b>
                                </label>
                            </div>
                        </div>
                        <!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">
                                    Department:
                                </label>
                                <br />
                                <label class="form-control-label">
                                    <b>{{$single['user']['department']['name']}}</b>
                                </label>
                            </div>
                        </div>
                        <!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">
                                    Designation:
                                </label>
                                <br />
                                <label class="form-control-label">
                                    <b>{{$single['user']['designation_name']['name']}} </b>
                                </label>
                            </div>
                        </div>
                        <!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">
                                    Passport No:
                                </label>
                                <br />
                                <label class="form-control-label">
                                    <b>{{$single['user']['passport_no']}}</b>
                                </label>
                            </div>
                        </div>
                        <!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">
                                    Attachments:
                                </label>
                                <br />
                                <label class="form-control-label">
                                    <b><a href="{{asset('/passports/'.$single['user']['passport_attachment'])}}" target="_blank"> <i class="fa fa-paperclip"></i> See Attached</a></b>
                                </label>
                            </div>
                        </div>
                        <!-- col-4 -->
                        
                        <!-- col-4 -->
                
                            
                  
                        <!-- col-4 -->
                    </div>
         
                    <!-- form-layout-footer -->
                </div>
                <!-- form-layout -->

                  <hr  class="sp_row" />
                     <h5>
                       Travel Details</h5>

                       <br />


                <div class="form-layout">
                    <div class="row mg-b-25">


                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">
                                    Travel Purpose:
                                </label>
                                <br />
                                <label class="form-control-label">
                                    <b>{{$single['purpose']}}</b>
                                </label>
                            </div>
                        </div>
                        <!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">
                                    Trip:
                                </label>
                                <br />
                                <label class="form-control-label">
                                    <b>{{$single['from_loc']['name']}} - {{$single['toloc']['name']}}</b>
                                </label>
                            </div>
                        </div>
                        <!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">
                                    Travel type:
                                </label>
                                <br />
                                <label class="form-control-label">
                                    <b>{{$single['traveltype']['name']}}</b>
                                </label>
                            </div>
                        </div>
                        <!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">
                                    Trip Date :
                                </label>
                                <br />
                                <label class="form-control-label">
                                    <b>{{Date('d/m/Y', strtotime($single['start_date']))}}  <?php if($single['end_date']!=''){ echo '- '.Date('d/m/Y', strtotime($single['end_date']));} ?> </b>
                                </label>
                            </div>
                        </div>
                        <!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">
                                    Class:
                                </label>
                                <br />
                                <label class="form-control-label">
                                    <b>{{$single['class']}}</b>
                                </label>
                            </div>
                        </div>
                        <!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">
                                    Airline:
                                </label>
                                <br />
                                <label class="form-control-label">
                                    <b>{{$single['airline']['name']}}</b>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">
                                    Travel Authorization:
                                </label>
                                <br />
                                <label class="form-control-label">
                                    <b>
                                        <a href="{{asset('/line_manager_attachments/'.$single['line_manager_attachments'])}}" target="_blank"> <i class="fa fa-paperclip"></i> See Attached</a>
                                    </b>
                                </label>
                            </div>
                        </div>
                        <!-- col-4 -->
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label">
                                    Comments:
                                </label>
                                <br />
                                <label class="form-control-label">
                                    <b>{{$single['comment']}}
                                    </b>
                                </label>
                            </div>
                        </div>
                        <!-- col-4 -->
                
                            <div class="col-md-12">


                            

                              <h5 class=" mg-t-20-force">
                                    Additional Travellers</h5>

                                <table class="table display responsive nowrap members_table" width="100%"  >
                                    <thead>
                                    <tr>
                                        <th class="wd-25p text-left">
                                            First Name
                                        </th>
                                        <th class="wd-25p text-left">
                                            Last Name
                                        </th>
                                        <th class="wd-25p text-left">
                                            Relationship
                                        </th>
                                        <th class="wd-25p text-left">
                                            Passport No.
                                        </th>
                                        <th class="wd-25p text-left">
                                            Attachment
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($single['members']!=null)
                                        @foreach($single['members'] as $member)
                                            <tr>
                                                <td>{{$member['user_member']['first_name']}}</td>
                                                <td>{{$member['user_member']['last_name']}}</td>
                                                <td>{{$member['user_member']['relation']['name']}}</td>
                                                <td>{{$member['user_member']['passport_no']}}</td>
                                                <td><a href="{{asset('/passports/'.$member['user_member']['passport_attachment'])}}" target="_blank">{{$member['user_member']['passport_attachment']}}</a></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                                No Additional Travellers
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                              
                                
                            </div>
                        @if($single['status']['id']==2)
                        <div class="col-lg-12">
<br>
                        <h5>Comments</h5>
                            <form method="POST" action="{{url('md_approval')}}" id="approval_form">
                                @csrf
                                <input type="hidden" name="request_id" value="{{$single['id']}}"/>
                                <div class="form-group">
                                    <div class="validation_error_message" style="display:none;">Please Type Comment</div>
                                    <textarea width="100%" placeholder="Type your comment" class="form-control" name="comment" id="comment" required></textarea>
                                </div>
                                <div class="row">
                                    <input type="hidden" name="status" id="selected_status" value="2"/>

                                    <div class="col-md-6">
                                        <button class="btn btn-primary mg-r-5" type="button" id="submit_approval"> Approve</button>
                                        <button class="btn btn-primary mg-r-5" type="button" id="submit_rejected_btn"> Disapprove</button>

                                    </div>
                                </div>

                            </form>


                        </div>
                    @endif
                        <!-- col-4 -->
                    </div>
         
                    <!-- form-layout-footer -->
                </div>











            </div>
   
            
        </div>
        <!-- Designer card -->







@endsection

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>




    <script>

    $(document).ready(function(){

	 $(".status_tag").click(function(){
    $(".approval_workflow").fadeToggle();
  });

        $("#submit_approval").click(function(){
            $('#selected_status').val("1");
            $('#submit_approval').attr('disabled', true);
            $("#submit_rejected_btn").attr('disabled', true);

            var selected_status=$('#selected_status').val();
            if(selected_status==1){
                $('#submit_approval').html('Please wait');
            }
            else{
                $('#submit_rejected_btn').html('Please wait');
            }
            $('#approval_form')[0].submit();
        });

        $("#submit_rejected_btn").click(function(){
            $('#selected_status').val("2");


            var comment=$('#comment').val();

            var selected_status=$('#selected_status').val();


            if(comment!='' && selected_status==1){
                // $('#approval_form').submit();
                $('#submit_approval').attr('disabled', true);
                $("#submit_rejected_btn").attr('disabled', true);
                $('#submit_approval').html('Please wait');
                $('#approval_form')[0].submit();
            }
            else if(comment!='' && selected_status==2){
                $('#submit_approval').attr('disabled', true);
                $("#submit_rejected_btn").attr('disabled', true);
                $('#submit_rejected_btn').html('Please wait');
                $('#approval_form')[0].submit();
            }
            else{
                $('.validation_error_message').slideDown().delay(1000).slideUp();
            }

        });
    });
</script>
