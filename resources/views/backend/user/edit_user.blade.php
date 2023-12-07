@extends('admin.admin_master')

@section('admin')
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Main content -->

            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit User</h4>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form action="{{ route('users.update',$editData->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>User Role <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="usertype" id="usertype" required=""
                                                                class="form-control">
                                                                <option value="" selected disabled>Select Role
                                                                </option>
                                                                <option value="Admin"
                                                                    {{ $editData->usertype == 'Admin' ? 'Selected' : '' }}>Admin
                                                                </option>
                                                                <option value="User"
                                                                    {{ $editData->usertype == 'User' ? 'Selected' : '' }}>User
                                                                </option>
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div> <!-- end col-md-6  -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>User Name <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="name" class="form-control"
                                                                required="" value="{{ $editData->name }}">
                                                        </div>

                                                    </div>
                                                </div><!-- end col-md-6  -->
                                            </div> {{--  end row --}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>User Email <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="email" name="email" class="form-control"
                                                                required="" value="{{ $editData->email }}">
                                                        </div>

                                                    </div>
                                                </div><!-- end col-md-6  -->

                                                {{-- passord updat 
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>User Passwword <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="password" name="password" class="form-control"
                                                                required="" value="{{$editData->password}}">
                                                        </div>

                                                    </div>
                                                </div><!-- end col-md-6  --> --}}

                                            </div> {{--  end row --}}

                                            <div class="text-xs-right">
                                                <input type="submit" class="btn btn-rounded btn-info mb-5"
                                                    name="submit" value="Upadate">
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
@endsection
