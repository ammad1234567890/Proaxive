@extends('layouts.hr.DashboardLayout')
@section('content')
    <div class="am-pagebody">
        <div class="card pd-20 pd-sm-40">
            <div class="row ">
                <div class="col-lg-8">
                    <h6 class="card-body-title">
                        Expense Claim List</h6>
                    <br>
                </div>
            </div>
            <div id="wizard1">
                <section>
                    <div class="table-wrapper">
                        <div class="">
                            <table class="table-responsive table display responsive nowrap designation_table" width="100%">
                                <thead>
                                <tr>
                                    <th class="wd-25p text-left">TEN#</th>
                                    <th class="wd-25p text-left">Date</th>
                                     <th class="wd-25p text-left">Expense Type</th>
                                    <th class="wd-25p text-left">Travel Purpose</th>
                                    <th class="wd-25p text-left">Total Amount</th>
                                    <th class="wd-25p text-left">Status</th>
                                    <th class="wd-25p text-left">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- table-wrapper -->
                </section>
            </div>
        </div>
    </div>



@endsection
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
    $(document).ready(function(){
        $('.designation_table').DataTable({
			"order": [[ 1, "desc" ]],
            processing: true,
            serverSide: true,
            ajax: '../../get_all_customers_expense_list',
            columnDefs: [{
                targets: [0],
                className: 'mdl-data-table__cell--non-numeric'
            }],
            columns: [
              {data: 'travelexpense_no', name: 'travelexpense_no'},
                {data: 'created_at', name: 'created_at'},
                {data: 'expense_type', name: 'expense_type'},
                {data: 'travel_purpose', name: 'travel_purpose'},
                {data: 'total_amount', name: 'total_amount'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>