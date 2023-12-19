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
                                    <h3 class="box-title">Fee Amount List</h3>
                                    <a href="{{route('fee.amount.add')}}" class="btn btn-rounded btn-success mb-5"  style="float: right;">Add Fee Amount</a>
                                
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sno</th>
                                                    <th>Fee Category</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allData as $key => $amount)
                                                    <tr>
                                                        <td width="5%">{{ $key + 1 }}</td>
                                                        <td>{{ $amount['fee_category']['name'] }}</td>
                                                        <td width="20%">
                                                            <a href="{{ route('fee.amount.edit', $amount->fee_category_id) }}"
                                                                class="btn btn-warning">Edit</a>
                                                                {{-- {{ route('fee.amount.delete', $amount->fee_category_id) }} --}}
                                                            <a href=""
                                                                class="btn btn-danger" id="delete">Delete</a>
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
