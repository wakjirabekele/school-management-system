<div class="col-12">
    @extends('admin.admin_master')

    @section('admin')
        <div class="content-wrapper">
            <div class="container-full">
                <!-- Main content -->
                <section class="content">
                    <div class="row">

                        <div class="col-12">

                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">User List</h3>
                                    <a href="{{route('users.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5">Add User</a>

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sno</th>
                                                    <th>Role</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Code</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allData as $key => $user)
                                                    <tr>
                                                        <td width="5%">{{ $key + 1 }}</td>
                                                        <td>{{ $user->role }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->code }}</td>
                                                        <td width="20%">
                                                            <a href="{{route('users.edit',$user->id)}}" class="btn btn-warning">Edit</a>
                                                            <a href="{{route('users.delete',$user->id)}}" class="btn btn-danger" id="delete">Delete</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->

            </div>
        </div>
    @endsection
