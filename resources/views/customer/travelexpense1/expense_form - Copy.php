@extends('layouts.customer.DashboardLayout')
@section('content')
<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
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
                    <form  class="ng-pristine ng-invalid ng-invalid-required">
                        <div class="row mg-b-25">

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Employee: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="employee" value="{{$data['name']}}"  placeholder="Employee Name" required="" readonly="">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Travel ID: <span class="tx-danger">*</span></label>
                                    <select class="form-control  ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" data-placeholder="Travel ID" name="travel_id" id='travel_id' required="">
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
                                    <label class="form-control-label">Expense Authorization: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="file"/>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Travel Purpose: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" id='travel_purpose' readonly/>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Attachment: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="file"/>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Destination: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" id='destination' readonly/>
                                    <input class="form-control" type="hidden" readonly="" id='destination_id'/>

                                </div>
                            </div>
                            <div class="col-md-12"><h6>Payment Order:</h6><hr></div>
                            <hr>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Payment Order Number: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text"/>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Email Date <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="date"/>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">By Order of: </label>
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
                                    <label class="form-control-label">Local Currency: </label>
                                    <select class="form-control  ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" placeholder="Local Currency" name="local_currency" id="local_currency" required="">
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Foreign Currency: </label>
                                    <select class="form-control  ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" placeholder="Foreign Currency" name="foreign_currency" id="foreign_currency" required="">
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">On Account of: </label>
                                    <input class="form-control" type="text"  id="on_account_of"/>
                                    <input class="form-control" type="hidden" readonly=""  id="on_account_of_id"/>
                                </div>
                            </div>
                            <div class="col-md-12"><h6>Expense:</h6><hr></div>
                            <div class="col-md-12" style="  overflow-y: scroll">
                                <table class="table" >
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Receipt Number</th>
                                            <th>Amount in Local currency</th>
                                            <th>Amount in Foreign currency</th>
                                            <th>Amount in USD currency</th>
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
                                                <select class="form-control expense_type" placeholder="Type" name="expense_type" required="">
                                                    <option label="Select" value="" selected="selected" disabled="">Select</option>
                                                    @foreach($data['expense_type'] as $value)
                                                    <option value="{{$value->id}}">
                                                        {{$value->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input  type="date"  name="expense_date"  class="form-control expense_date" ></td>
                                            <td><textarea name="expense_Description"  class="form-control expense_Description" rows="1" ></textarea></td>
                                            <td><input type="text" class="form-control expense_receipt_number" name="expense_receipt_number" ></td>
                                            <td><input type="text"  class="form-control expense_local_currency" name="expense_local_currency" ></td>
                                            <td><input type="text"  class="form-control expense_foreign_currency" name="expense_foreign_currency" ></td>
                                            <td><input type="text" class="form-control expense_usd_currency" name="expense_usd_currency" ></td>
                                            <td><button class="remove_btn">X</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-12"><br>
                                <div class="form-layout-footer text-right">
                                    <button class="btn btn-info" id='add_more_expense' >Add More Expense</button>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <br>
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Total Amount</label>
                                    <input type="text" class="form-control" readonly="">
                                </div>
                            </div>
                        </div><!-- row -->
                        <div class="form-layout-footer text-right">
                            <button class="btn btn-info mg-r-5 ng-binding" type="submit" ng-disabled="submit_disabled" ng-bind="submit_text">Create Request</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#travel_id").change(function () {
            $("#travel_purpose").val("");
            $("#destination").val("");
            $("#destination_id").val("");
            if ($("#travel_id").val() != '') {
                $.ajax({
                    url: '../travel_details',
                    type: 'post',
                    data: {id: $("#travel_id").val(), _token: $("input[name='_token']").val()},
                    success: function (data) {
                        if (data['status'] == true) {
                            $("#travel_purpose").val(data['data']['purpose']);
                            $("#destination").val(data['data']['Destination']);
                            $("#destination_id").val(data['data']['Destination_id']);
                            $("#on_account_of").val(data['on_account_of']['on_account_of']);
                            $("#on_account_of_id").val(data['on_account_of']['on_account_of_id']);

                            console.log(data['on_account_of']['on_account_of_id']);
                        }
                    }
                });
            }
        });
        $("#add_more_expense").click(function () { //alert();
               var unqid = new Date().valueOf()
            var table_tr = $(".expense_row").children().clone();
             table_tr.find('.expense_type').attr('data-id', 'ext-' + unqid);
             
             table_tr.find('.expense_date').attr('data-id', 'exd-' + unqid);
             table_tr.find('.expense_Description').attr('data-id', 'expd-' + unqid);
             table_tr.find('.expense_receipt_number').attr('data-id', 'ern-' + unqid);
             table_tr.find('.expense_local_currency').attr('data-id', 'elc-' + unqid);
             table_tr.find('.expense_foreign_currency').attr('data-id', 'efc-' + unqid);
             table_tr.find('.expense_usd_currency').attr('data-id', 'euc-' + unqid);
            
             
            $(".table_rows").append(table_tr);
           
            //   console.log(   table_tr.find('.table_rows') );   
            // console.log(table_tr);
            //  appendTo(".table_rows");
            // $(".table_rows").removeClass(".expense_row");
        });

        $('.table_rows').delegate('.remove_btn', 'click', function () {
            $(this).parent().parent().remove();
        });

        $.ajax({
            url: 'http://www.apilayer.net/api/live?access_key=1bef4cf79569bce3bbc70e7ae02f2512&format=1',
            type: 'get',
            success: function (data) {
                var html = '<option label="Select" value="" selected="selected" disabled="" >Select</option>';
                for (var k in data['quotes']) {
                    if (data['quotes'].hasOwnProperty(k)) {
                        html += `<option value='` + data['quotes'][k] + `'>` + k + `</option>`;
                    }
                }
                $("#local_currency").html(html);
                $("#foreign_currency").html(html);

            }
        });





    });
</script>
