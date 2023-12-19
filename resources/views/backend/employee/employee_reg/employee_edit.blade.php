@extends('admin.admin_master')
@section('admin')
    <!-- jquery to show edit image -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Main content -->

            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit Employee</h4>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form action="{{ route('update.employee.registration',$editData->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="row"> <!--start 1st row -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Employee Name <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input id="" type="text" name="name"
                                                                class="form-control"  required value="{{$editData->name}}">
                                                        </div>

                                                    </div>
                                                </div> <!--end col-md-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Father Name <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input id="" type="text" name="fname"
                                                                class="form-control" required value="{{$editData->fname}}">
                                                        </div>

                                                    </div>
                                                </div> <!--end col-md-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Mother Name <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input id="" type="text" name="mname"
                                                                class="form-control" required value="{{$editData->mname}}">
                                                        </div>

                                                    </div>
                                                </div> <!--end col-md-4 -->
                                            </div> <!--end 1st row -->
                                            <div class="row"> <!--start 2nd row -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Mobile Number <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input id="" type="text" name="mobile"
                                                                class="form-control" required value="{{$editData->mobile}}">
                                                        </div>

                                                    </div>
                                                </div> <!--end col-md-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Address <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input id="" type="text" name="address"
                                                                class="form-control" required value="{{$editData->address}}">
                                                        </div>

                                                    </div>
                                                </div> <!--end col-md-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Gender <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="gender" id="gender" required=""
                                                                class="form-control">
                                                                <option value="" selected disabled>Select Gender
                                                                </option>
                                                                <option value="Male" {{($editData->gender=='Male')? "selected":""}}>Male</option>
                                                                <option value="Female" {{($editData->gender=='Female')? "selected":""}}>Female</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div> <!--end col-md-4 -->
                                            </div> <!--end 2nd row -->
                                            <div class="row"> <!--start 3rd row -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Religion <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="religion" id="religion" required=""
                                                                class="form-control">
                                                                <option value="" selected disabled>Select Religion
                                                                </option>
                                                                <option value="Christian" {{($editData->religion=='Christian')? "selected":""}}>Christian</option>
                                                                <option value="Muslim" {{($editData->religion=='Muslim')? "selected":""}}>Islam</option>
                                                                <option value="Hindu" {{($editData->religion=='Hindu')? "selected":""}}>Hindu</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div> <!--end col-md-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Date of Birth <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input id="" type="date" name="dob"
                                                                class="form-control" required value="{{$editData->dob}}">
                                                        </div>

                                                    </div>
                                                </div> <!--end col-md-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Designation <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="designation_id" id="designation_id" required=""
                                                                class="form-control">
                                                                <option value="" selected disabled>Select Year
                                                                </option>
                                                                @foreach ($designation as $design)
                                                                <option value="{{$design->id}}" {{($editData->designation_id==$design->id)?'selected':''}}>{{$design->name}}</option>
                                                                @endforeach
                                                              
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div> <!--end col-md-4 -->
                                           
                                            </div> <!--end 3rd row -->
                                            <div class="row"> <!--start 4th row -->
                                                @if(!@$editData)
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <h5>Salary <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input id="" type="text" name="salary"
                                                                class="form-control" required value="{{$editData->salary}}">
                                                        </div>

                                                    </div>
                                                </div> <!--end col-md-3 -->
                                                @endif
                                                @if(!@$editData)
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <h5>Join Date<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input id="" type="date" name="join_date"
                                                                class="form-control" required value="{{$editData->join_date}}">
                                                        </div>

                                                    </div>
                                                </div> <!--end col-md-3 -->
                                                @endif
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <h5>Profile Image <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="file" name="image" class="form-control"
                                                                id="image">
                                                        </div>

                                                    </div>
                                                    
                                                </div> <!--end col-md-3 -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <img id="showImage"
                                                            src="{{ !empty($editData->image) ? url('upload/employee_images/' . $editData->image) : url('upload/no_image.jpg') }}"
                                                            style="width: 100px; height:100px;border:1px solid #000000">
                                                        </div>
                                                    </div>
                                                </div> <!--end col-md-3 -->
                                           
                                            </div> <!--end 4th row -->
                                           
                                        </div>

                                    </div> {{--  end row --}}

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info mb-5" 
                                            value="update">
                                    </div>
                                </form>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </section>


            <!-- /.content -->

        </div>
    </div>
    <!-- script for show edit image -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload=function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
