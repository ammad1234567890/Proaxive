@extends('layouts.hr_secretary.DashboardLayout')

@section('content')





    <div class="am-pagebody">
        <div class="card pd-20 pd-sm-40">
            <div class="row ">
                <div class="col-lg-8">
                    <h6 class="card-body-title">
                        Project Management</h6>
                    <p class="mg-b-20 mg-sm-b-30">
                        Add new Project.</p>
                </div>

            </div>
            <div id="wizard1">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <section>


                    <div class="form-layout">
                        <form method="post" action="{{url('/create_department')}}">
                            <div class="row mg-b-25">
                                @csrf
                                <div class="col-lg-4">
                                    <div class="form-group">

                                        <input class="form-control" type="text" name="name"   placeholder="Type New Project Name" required>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-12">
                                    <button class="btn btn-info" type="submit">Submit</button>
                                </div><!-- form-layout-footer -->

                                <!-- col-4 -->
                            </div><!-- row -->

                        </form>
                    </div><!-- form-layout -->
                    <hr/>
                    <h6 class="card-body-title">Project List</h6>


                    <div class="table-wrapper">
                        <table class="table display responsive nowrap department_table" width="100%">
                            <thead>
                            <tr>


                                <th class="wd-25p text-center">Project</th>
                                <th class="wd-25p text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div><!-- table-wrapper -->


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
        $('.department_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{url('view_departments')}}",
            columnDefs: [{
                targets: [0],
                className: 'mdl-data-table__cell--non-numeric'
            }],
            columns: [
                {data: 'department_name', name: 'department_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>