@extends('layouts.hr.DashboardLayout')

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

	<div class="am-pagebody">
		<div class="card pd-20 pd-sm-40">
			<div class="row ">
				<div class="col-lg-8">
					<h6 class="card-body-title">
						Travel Request (My Approvals)</h6>
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
									<th class="wd-25p text-left">TR#</th>
									<th class="wd-25p text-left">Date</th>
									<th class="wd-25p text-left">Type</th>
									<th class="wd-25p text-left">Airline</th>
									<th class="wd-25p text-left">Employee</th>
									<th class="wd-25p text-center">Status</th>
									<th class="wd-25p text-center">Action</th>
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
		<!-- card -->

		<!-- card -->
	</div>
	<div id="modaldemo4" class="modal fade">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="tx-14 mg-b-0 tx-inverse tx-bold">Are you sure you want to approve <span id="approve_trNo" style="color:green;"></span>?</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" action="{{url('hr_approval')}}" id="approval_form_approved">
					<div class="modal-body">
						<h4 class="lh-3 mg-b-20" style="font-size:14px;"><a href="javascript:;" class="tx-inverse hover-primary">Comments</a></h4>
						@csrf
						<input type="hidden" value="1" id="status" name="status"/>
						<input type="hidden" value="" id="app_tr_no" name="request_id"/>
						<div class="validation_error_message" style="display:none;">Please Type Comment</div>
						<textarea class="form-control" style="width:600px;" name="comment" id="comment_approve"></textarea>
					</div><!-- modal-body -->
					<div class="modal-footer">
						<button type="submit" class="btn btn-info pd-x-20" id="submit_approved_btn">Approved</button>
						<button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
					</div>
				</form>

			</div>
		</div><!-- modal-dialog -->
	</div>

	<div id="modaldemo3" class="modal fade">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="tx-14 mg-b-0 tx-inverse tx-bold">Are you sure you want to Disapprove <span id="disapprove_trNo" style="color:red;"></span>?</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" action="{{url('hr_approval')}}" id="approval_form">
					<div class="modal-body">
						<h4 class="lh-5 mg-b-20" style="font-size:14px;"><a href="javascript:;" class="tx-inverse hover-primary">Comments</a></h4>
						@csrf
						<input type="hidden" value="2" id="status" name="status"/>
						<input type="hidden" value="" id="tr_no" name="request_id"/>
						<div class="validation_error_message" style="display:none;">Please Type Comment</div>
						<textarea class="form-control" style="width:600px;" name="comment" id="comment" required></textarea>
					</div><!-- modal-body -->
					<div class="modal-footer">
						<button type="submit" class="btn btn-info pd-x-20" id="submit_rejected_btn">Disapprove</button>
						<button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
					</div>
				</form>

			</div>
		</div><!-- modal-dialog -->
	</div>


@endsection
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
    $(document).ready(function(){
        $('.designation_table').DataTable({
            "order": [[0, 'desc' ]],
            processing: true,
            serverSide: true,
            ajax: "{{url('get_hr_approvals_list')}}",
            columnDefs: [{
                "orderSequence": ["desc"],
                targets: [0],
                className: 'mdl-data-table__cell--non-numeric'
            }],
            columns: [
                {data: 'request_no', name: 'request_no'},
                {data: 'created_date', name: 'created_date'},

                {data: 'travel_type', name: 'travel_type'},
                {data: 'airline', name: 'airline'},

                {data: 'full_name', name: 'full_name'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        $("#submit_rejected_btn").click(function(){

            var comment=$('#comment').val();

        	if(comment!=''){
                $("#submit_rejected_btn").attr('disabled', true);
                $('#submit_rejected_btn').html('Please wait');
                $('#approval_form')[0].submit();
            }
            else{
                $('.validation_error_message').slideDown().delay(1000).slideUp();
                //$('#comment').focus();
            }

        });

        $("#submit_approved_btn").click(function(){

                $("#submit_approved_btn").attr('disabled', true);
                $('#submit_approved_btn').html('Please wait');
                $('#approval_form_approved')[0].submit();
        });
    });

    function disapprove(id, name){

        $('#tr_no').val(id);
		$('#disapprove_trNo').html(name);
	}

    function approve(id, name){

        $('#app_tr_no').val(id);
        $('#approve_trNo').html(name);
    }
</script>