@extends('layouts.customer.DashboardLayout')
@section('content')
<div class="am-pagebody">
    <div class="card pd-20 pd-sm-40">
        <!--travel_expense_details start-->
        @include('hr/travelexpense/details', ['data' => $data])
        <!--travel_expense_details end-->
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
    $(document).ready(function () {
        $(".status_tag").click(function () {
            $(".approval_workflow").fadeToggle();
        });
    });
</script>


