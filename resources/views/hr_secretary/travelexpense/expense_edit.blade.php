@extends('layouts.hr_secretary.DashboardLayout')
@section('content')
<div class="am-pagebody">
    <div class="card pd-20 pd-sm-40">
        <div class="row ">
            <div class="col-lg-8">
                <h6 class="card-body-title">
                    Resubmit  Expense Claim ({{$data['data'][0]->travelexpense_no}})</h6>
                <br>
            </div>
        </div>
        <div id="wizard1"> 
            <section>
                <div class="form-layout">
                    <form  class="ng-pristine ng-invalid ng-invalid-required" method="post" action="../../../expense/resubmit" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input type="hidden" name="user" id="user" value="hr_secretary"/>
                        <input type="hidden" name="last_id" id="last_id" value="@if($data['last_id']!=""){{$data['last_id']->id+=1}}@else 1 @endif"/>
                        <input type="hidden" name="expense_claim_no" value="{{$data['data'][0]->travelexpense_no}}" readonly=""/>
                        <input type="hidden" name="expense_claim_id" value="{{$data['data'][0]->id}}" readonly=""/>
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Employee: </label>
                                    <input class="form-control" type="text" name="employee" value="{{$data['name']}}"  placeholder="Employee Name" required="" readonly="">
                                    <input class="form-control" type="hidden" name="employee_id" value="{{$data['id']}}"   required="" readonly="">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force" >
                                    <label class="form-control-label">Expense Type: <span class="tx-danger">*</span></label>
                                    <select class="form-control  ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required"  name="expense_type_list" id='expense_type_list' required="">
                                        <option label="Select" value="general expense" <?php if ($data['data'][0]->expense_type == "general expense") { ?> selected="selected" <?php } ?> >General Expense</option>
                                        <option label="Select" value="travel expense" <?php if ($data['data'][0]->expense_type == "travel expense") { ?> selected="selected" <?php } ?>>Travel Expense</option>
                                    </select>
                                </div>
                            </div><!-- col-4 -->

                            <!-- col-4 dis_none -->
                            <div class="col-lg-4 <?php if($data['data'][0]->expense_type=="general expense"){?> dis_none <?php } ?> " id="travel_div" >
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Travel ID: <span class="tx-danger">*</span></label>
                                    <select class="form-control   ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" data-placeholder="Travel ID" name="travel_no" id='travel_no' <?php if($data['data'][0]->expense_type!="general expense"){?> required="" <?php } ?>>
                                        <option label="Select" value="" selected="selected">Select</option>
                                        @foreach($data['travel_id'] as $value)
                                        <option value="{{$value->id}}" <?php if($data['data'][0]->travel_id == $value->id) { ?> selected="selected" <?php } ?>>
                                            {{$value->request_no}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Expense Authorization:  <span class="tx-danger">  (.jpg, .png, .pdf, .zip, .docx)</span></label>
                                    <input class="form-control" type="file" name="authorization" />
                                    <input class="form-control" type="text" name="authorization_file_name" value="{{$data['data'][0]->expense_authorization_docs}}" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Travel Purpose: </label>
                                    <input class="form-control" type="text" id='travel_purpose' name='travel_purpose' value="{{$data['data'][0]->travel_purpose}}" maxlength="64" readonly/>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Destination: </label>
                                    <input class="form-control" type="text" id='destination' name='destination' value="{{$data['data'][0]->destination}}" maxlength="64" readonly/>
                                    <input class="form-control" type="hidden" readonly="" id='destination_id'  name='destination_id' value="{{$data['data'][0]->destination_id}}"/>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <h6>Payment Order:</h6><hr></div>
                            <hr>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Payment Order Number: </label>
                                    <input class="form-control" type="text" id="payment_order_no" name="payment_order_no"  readonly=""/>
                                    <input class="form-control" type="hidden" id="travel_expense_id" name="travel_expense_id"  readonly=""/>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">{{$data['data'][0]->by_order_of}}
                                    <label class="form-control-label">By Order of: <span class="tx-danger">*</span></label>
                                    <select class="form-control  ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" placeholder="By Order of" 
                                            name="by_order_of" required="">
                                        @foreach($data['users'] as $value)
                                        <option  value="{{$value->id}}" <?php if ($data['data'][0]->by_order_of == $value->id) { ?> selected="selected" <?php } ?>>
                                            {{$value->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Payment Currency: <span class="tx-danger">*</span></label>
                                    <select class="form-control  ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" placeholder="Expense Currency" name="expense_currency" id="expense_currency" required="">
                                        @foreach($data['payment_currency'] as $value)
                                        <option value="{{$value->id}}" <?php if ($data['data'][0]->currency_id == $value->id) { ?> selected="selected" <?php } ?>>
                                            {{$value->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">On Account of: </label>
                                    <input class="form-control" type="text"  value="{{$data['data'][0]->on_account_of_location}}" id="on_account_of" name="on_account_of" maxlength="64" />
                                    <input class="form-control" type="hidden" readonly="" value="{{$data['data'][0]->on_account_of_location}}"  id="on_account_of_id"  name="on_account_of_id"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <h6>Expenses:</h6><hr></div>
                            <div class="col-md-12" >
                                <table class="table" >
                                    <thead>
                                        <tr>
                                            <th>Type <span class="tx-danger">*</span></th>
                                            <th>Date <span class="tx-danger">*</span></th>
                                            <th>Description <span class="tx-danger">*</span></th>
                                            <th>Receipt Number <span class="tx-danger">*</span></th>
                                            <th>Amount <span class="currency_type_span"></span> <span class="tx-danger">*</span> </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table_rows">
                                        @foreach($data['expense'] as $expense)
                                        <tr>
                                            <td>
                                                <select class="form-control expense_type" placeholder="Type"  name="expense_types[]">
                                                    <option label="Select" value="" selected="selected" disabled="">Select</option>
                                                    @foreach($data['expense_type'] as $value)
                                                    <option value="{{$value->id}}" <?php if ($expense->expense_type == $value->id) { ?> selected="selected" <?php } ?> >
                                                        {{$value->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input class="form-control lightgraybg expense_date" type="text"  placeholder="(dd-mm-yyyy)"   autocomplete="off" name="expense_date[]" readonly value="{{date('d-M-Y', strtotime($expense->date))}}">
                                            </td>
                                            <td><textarea   class="form-control expense_Description" rows="1" name="expense_Description[]" >{{$expense->description}}</textarea></td>
                                            <td><input type="text" class="form-control expense_receipt_number" name="expense_receipt_number[]" value="{{$expense->receipt_number}}"  maxlength="30" ></td>
                                            <td><input type="text"  class="form-control expense_amount"  value="{{$expense->amount}}" name="expense_amount[]" maxlength="10" onkeypress="return isNumber(event)"></td>
                                            <td><button class="remove_btn">X</button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table hidden>
                                    <tbody class="expense_row">
                                        <tr>
                                            <td>
                                                <select class="form-control expense_type" placeholder="Type"  >
                                                    <option label="Select" value="" selected="selected" disabled="">Select</option>
                                                    @foreach($data['expense_type'] as $value)
                                                    <option value="{{$value->id}}">
                                                        {{$value->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input class="form-control lightgraybg expense_date" type="text"  placeholder="(dd-mm-yyyy)"   autocomplete="off" readonly value="">
                                            </td>
                                            <td><textarea   class="form-control expense_Description" rows="1" ></textarea></td>
                                            <td><input type="text" class="form-control expense_receipt_number"  maxlength="30" ></td>
                                            <td><input type="text"  class="form-control expense_amount"  value="" maxlength="10" onkeypress="return isNumber(event)"></td>
                                            <td><button class="remove_btn">X</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-12"><br>
                                <div class="form-layout-footer text-right">
                                    <input type="button" class="btn btn-info" id='add_more_expense' value="Add ">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <br>
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Total Amount <b><span class="currency_type_span"></span></b></label>
                                    <input type="text" id="total_amount" name="total_amount" value="{{$data['data'][0]->total_amount}}" class="form-control" readonly="">
                                </div>
                            </div>
                        </div><!-- row -->
                        <div class="form-layout-footer text-right">
                            <button class="btn btn-info mg-r-5 ng-binding btn_disable_submit"  type="submit"><span class="btn_text">Submit Claim</span></button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
<script src="{{ asset('lib/jquery/jquery.js')}}"></script>
<script>
                                                $(document).ready(function () {
                                                    $("#payment_order_no").val("EC-" + new Date().getFullYear() + "-1055" + $("#last_id").val().trim());
                                                    $("#travel_expense_id").val("TEN-" + new Date().getFullYear() + "-1055" + $("#last_id").val().trim());
                                                })
</script>
@endsection
<style>
    .dis_none{display: none;}
</style>