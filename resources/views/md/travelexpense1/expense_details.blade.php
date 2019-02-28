@extends('layouts.md.DashboardLayout')
@section('content')
<div class="am-pagebody">
    <div class="card pd-20 pd-sm-40">
        <div class="row ">
            <div class="col-lg-8">
            </div>
        </div>
        <div id="wizard1">
            <section>
                <div class="row">
                    @if(session()->has('error_message'))
                    <div class="alert alert-danger">
                        {{ session()->get('error_message') }}
                    </div>
                    @endif
                    <div class="col-md-12">
                        <h5>{{$data['data'][0]->travelexpense_no}}
                            <span style="float:right;">Expense Date: {{date("d-M-Y", strtotime($data['data'][0]->created_at))}}</span>
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
                                <td>: {{$data['data'][0]->employee_name}}</td>
                            </tr>
                            <tr>
                                <td>Expense Type</td>
                                <td>:  {{$data['data'][0]->expense_type}}</td>
                            </tr>
                            <tr>
                                <td>Travel Purpose</td>
                                <td>:  {{$data['data'][0]->travel_purpose}}</td>
                            </tr>
                            <tr>
                                <td>Destination</td>
                                <td>: 
                                    @if($data['data'][0]->location_destination!="")
                                    {{$data['data'][0]->location_destination}}
                                    @else
                                    {{$data['data'][0]->destination}}
                                    @endif 
                                </td>
                            </tr>
                            @if($data['data'][0]->request_no!="")
                            <tr>
                                <td>Traval No</td>
                                <td>:  {{$data['data'][0]->request_no}}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Payment Order</h6>

                        <table width="100%">
                            <tr>
                                <td>Payment Order Number</td>
                                <td>:  {{$data['data'][0]->payment_order_number}}</td>
                            </tr>
                            <tr>
                                <td>Email Date</td>
                                <td>:  
                                    @if($data['data'][0]->email_date)
                                    {{ date("d-M-Y", strtotime($data['data'][0]->email_date))}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>By Order of</td>
                                <td>:  {{$data['data'][0]->by_order_of}}</td>
                            </tr>
                            <tr>
                                <td>Payment Currency</td>
                                <td>:  {{$data['data'][0]->currency_name}}</td>
                            </tr>
                            <tr>
                                <td>On Account of</td>
                                <td>:  
                                    @if($data['data'][0]->location_account_of_name!="")
                                    {{$data['data'][0]->location_account_of_name}}
                                    @else
                                    {{$data['data'][0]->on_account_of_location}}
                                    @endif 
                                </td>
                            </tr>
                            <tr>
                                <td>Expense Authorization</td>
                                <td>: <a href="http://172.16.1.250:82/proaxive/public/line_manager_attachments/{{$data['data'][0]->expense_authorization_docs}}" target="_blank">{{$data['data'][0]->expense_authorization_docs}}</a></td>
                            </tr>
                        </table>
                    </div>  
                </div>
                <br/>
                <h5>Expense:</h5>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table display responsive nowrap members_table" width="100%" border="1px">
                            <thead>
                                <tr>
                                    <th class="wd-25p text-center">Type</th>
                                    <th class="wd-25p text-center">Date</th>
                                    <th class="wd-25p text-center">Description</th>
                                    <th class="wd-25p text-center">Receipt Number</th>
                                    <th class="wd-25p text-center">Amount ({{$data['data'][0]->currency_name}})</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['data'] as $value)
                                <tr>
                                    <td>{{$value->travel_expense_list_expense_name}}</td>
                                    <td>{{$value->travel_expense_list_date}}</td>
                                    <td>{{$value->travel_expense_list_description}}</td>
                                    <td>{{$value->travel_expense_list_receipt_number}}</td>
                                    <td>{{$value->travel_expense_list_amount}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <b>Total ({{$data['data'][0]->currency_name}}) : <input type="text" class="form-control col-md-3" value="{{$value->total_amount}}" readonly=""/></b>
                    </div>
                </div>
                <div class="row">
                    @if($data['hrapprovel_check']!=0)
                    @if($data['status_check']==0)
                    <div class="col-md-6">
                        <br>
                        <h5>Status Update</h5>
                        <form method="post" action="../../../../expense_status_update">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <input type="hidden" name="expense_id" value="{{ $data['data'][0]->id }}"/>
                            <table class="table" width="100%"  style="border: 1px #999 solid">
                                <tbody>
                                    <tr>
                                        <td> 
                                            <select class="form-control" name="status" id="approve_status" required="">
                                                <option value="" disabled="" selected="">Select Status</option>
                                                <option value="4">Approved</option>
                                                <option value="3">Rejected</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><textarea width="100%" placeholder="Type your comment" class="form-control" name="comment" id="comment"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td> <button class="btn btn-primary mg-r-5" type="submit" id="submit_approval"> Submit</button></td>
                                    </tr>                
                                </tbody>
                            </table>
                        </form>
                    </div>
                    @endif
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <br>
                        @if($data['approvals']['status']=="true")
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
                                @foreach($data['approvals']['data'] as $value)
                                <tr>
                                    <td>{{$value->user_name}} ({{$value->user_role}})</td>
                                    <td>{{$value->status}}</td>
                                    <td>{{$value->comment}}</td>
                                </tr>
                                @endforeach                    
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- card -->

    <!-- card -->
</div>


<script>
    $(document).ready(function () {
        $("#submit_approval").click(function () {
            $(this).hide();
        });
    })
</script>
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.js" ></script>
