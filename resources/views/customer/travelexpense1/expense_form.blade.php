@extends('layouts.customer.DashboardLayout')
@section('content')
<div class="am-pagebody">
    <div class="card pd-20 pd-sm-40">
        <div class="row ">
            <div class="col-lg-8">
                <h6 class="card-body-title">
                    Create Travel Expense</h6>
                <p class="mg-b-20 mg-sm-b-30">
                    You can submit your travel Expense your trip.</p>
            </div>
        </div>
        <div id="wizard1">
            <section>
                <div class="form-layout">
                    <form  class="ng-pristine ng-invalid ng-invalid-required" method="post" action="save" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
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
                                        <option label="Select" value="" selected="selected" disabled="">Choose one</option>
                                        <option label="Select" value="general expense">General Expense</option>
                                        <option label="Select" value="travel expense">Travel Expense</option>
                                    </select>
                                </div>
                            </div><!-- col-4 -->

                            <!-- col-4 -->
                            <div class="col-lg-4 dis_none" id="travel_div" >
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Travel ID: <span class="tx-danger">*</span></label>
                                    <select class="form-control   ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" data-placeholder="Travel ID" name="travel_no" id='travel_no' >
                                        <option label="Select" value="" selected="selected">Choose one</option>
                                        @foreach($data['travel_id'] as $value)
                                        <option value="{{$value->id}}">
                                            {{$value->request_no}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Expense Authorization:  <span class="tx-danger">* (Filesize Max 5mb)</span></label>
                                    <input class="form-control" type="file" name="authorization" required=""/>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Travel Purpose: </label>
                                    <input class="form-control" type="text" id='travel_purpose' name='travel_purpose' maxlength="64" readonly/>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Destination: </label>
                                    <input class="form-control" type="text" id='destination' name='destination' maxlength="64" readonly/>
                                    <input class="form-control" type="hidden" readonly="" id='destination_id'  name='destination_id'/>

                                </div>
                            </div>
                            <div class="col-md-12"><h6>Payment Order:</h6><hr></div>
                            <hr>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Payment Order Number: </label>
                                    <input class="form-control" type="text" id="payment_order_no" name="payment_order_no"  readonly=""/>
                                    <input class="form-control" type="hidden" id="travel_expense_id" name="travel_expense_id"  readonly=""/>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Email Date </label>
                                    <input class="form-control" type="date" id="email_date" name="email_date"/>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">By Order of: <span class="tx-danger">*</span></label>
                                    <select class="form-control  ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" placeholder="By Order of" 
                                            name="by_order_of" required="">
                                        <option label="Choose one" value="" selected="selected">Choose one</option>
                                        @foreach($data['users'] as $value)
                                        <option value="{{$value->id}}">
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
                                        <option label="Choose one" value="" selected="selected" disabled="">Choose one</option>
                                        @foreach($data['payment_currency'] as $value)
                                        <option value="{{$value->id}}">
                                            {{$value->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">On Account of: </label>
                                    <input class="form-control" type="text"  id="on_account_of" name="on_account_of" maxlength="64" readonly/>
                                    <input class="form-control" type="hidden" readonly=""  id="on_account_of_id"  name="on_account_of_id"/>
                                </div>
                            </div>
                            <div class="col-md-12"><h6>Expense:</h6><hr></div>
                            <div class="col-md-12" >
                                <table class="table" >
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Receipt Number</th>
                                            <th>Amount <span class="currency_type_span"></span></th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table_rows">
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
                                            <td><input  type="date" class="form-control expense_date" ></td>
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
                                    <input type="button" class="btn btn-info" id='add_more_expense' value="Add More Expense">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <br>
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Total Amount <b><span class="currency_type_span"></span></b></label>
                                    <input type="text" id="total_amount" name="total_amount" value="0" class="form-control" readonly="">
                                </div>
                            </div>
                        </div><!-- row -->
                        <div class="form-layout-footer text-right">
                            <button class="btn btn-info mg-r-5 ng-binding" type="submit" >Create Travel Expense</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
<style>
    .dis_none{display: none;}
</style>