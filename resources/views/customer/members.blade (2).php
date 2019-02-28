@extends('layouts.customer.DashboardLayout')

@section('content')





    <div class="am-pagebody" ng-app="myApp" ng-controller="myCtrl">
        <div class="card pd-20 pd-sm-40">
            <div class="row ">
                <div class="col-lg-8">
                    <h6 class="card-body-title">
                        New Traveller</h6>
                    <p class="mg-b-20 mg-sm-b-30">
                        </p>
                </div>

            </div>
            <div id="wizard1">
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

                    <div class="alert alert-danger show_error_message_file" style="display: none;">

                    </div>



                <section>


                    <div class="form-layout">
                        <form method="post" action="{{url('/create_member')}}" enctype="multipart/form-data">
                            <div class="row mg-b-25">
                                @csrf
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">First Name: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_name" required>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Last Name: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="last_name" required>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Passport Number: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="passport_no" required>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Passport Attachment: <span class="tx-danger">* jpeg, jpg, png, pdf, docx</span></label>
                                        <input class="form-control" type="file" name="passport_attachment" id="passport_attachment" accept=".jpg,.jpeg,.png,.doc,.docx,.pdf" required>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Relation: <span class="tx-danger">*</span></label>


                                        <select class="form-control " data-placeholder="relation" name="relation" required>
                                            <option label="Select" value="" selected>Select</option>

                                                @foreach($relation as $key => $data)
                                                    <option value="{{$data->id}}">
                                                        {{$data->name}}
                                                    </option>

                                                @endforeach
                                            </select>
                                        </select>
                                    </div>
                                </div><!-- col-4 -->


                                <!-- col-4 -->
                            </div><!-- row -->
                            <div class="form-layout-footer text-right">
                                <button class="btn btn-info mg-r-5" type="submit"> Submit</button>
                            </div><!-- form-layout-footer -->
                        </form>

                    </div><!-- form-layout -->

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
        $('#passport_attachment').change(function(){
            var fileExtension = ['jpeg', 'jpg', 'png', 'pdf', 'docx'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $('#passport_attachment').val("");

                $(".show_error_message_file").html('Please provide valid attachment file');
                $(".show_error_message_file").fadeIn().delay(3000).fadeOut();
            }
        });
    });
</script>

