@extends('layouts.hr.DashboardLayout')
@section('content')
<div class="am-pagebody">
    @if(session()->has('error_message'))
    <div class="alert alert-success">
        {{ session()->get('error_message') }}
    </div>
    @endif
    <!-- Designer card -->
    <div class="card pd-20 pd-sm-40">
        <!--travel_expense_details start-->
        @include('hr/travelexpense/details', ['data' => $data])
        <!--travel_expense_details end-->
        <!--approvals start-->
        <div class="row">
            @if($data['status_check_hrsec']==1)
            @if($data['status_check']==0)
            <div class="col-md-12">
                <br>
                <h5>Approval</h5>
                <form method="post" action="../../../expense_status_update" id="status_form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <input type="hidden" name="expense_id" value="{{ $data['data'][0]->id }}"/>
                    <table class=" no-border" width="100%"  style=" border:0; background:none;">
                        <tbody>
                            <tr>
                                <td colspan="2"><textarea width="100%" placeholder="Type your comment" class="form-control" name="comment" id="comment"></textarea>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"> 
                                    <input type="hidden" value="" id="approve_status" name="status"/>
                                    <button class="btn btn-primary mg-r-5 btn_disable_submit" type="button" id="submit_approval"> Approve</button>
                                    <button class="btn btn-primary mg-r-5 btn_disable_submit" type="button" id="submit_rejected"> Disapprove</button>	
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            @endif
            @endif
        </div>
        <!--approvals end-->
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