@extends('admin.admin_master')

@section('admin')
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Main content -->

            <section class="content">

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Add School Subject/h4>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form action="{{ route('store.school.subject') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="form-group">
                                                <h5>Subject Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input id="" type="text" name="name"
                                                        class="form-control">
                                                    @error('name')
                                                        <span class="alert-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>

                                    </div> {{--  end row --}}

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info mb-5" name="submit"
                                            value="Submit">
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
