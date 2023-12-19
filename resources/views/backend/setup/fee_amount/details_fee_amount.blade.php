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
                                    <h3 class="box-title">Fee Amount Details</h3>
                                    <a href="{{ route('fee.amount.add') }}" class="btn btn-rounded btn-success mb-5"
                                        style="float: right;">Add Fee Amount</a>

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <h4><strong>Fee Category : {{$detailsData[0]['fee_category']['name']}}</strong></h4>
                                    <div class="table-responsive">
                                        <table  class="table table-bordered table-striped">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Sno</th>
                                                    <th>Class Name</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($detailsData as $key => $detail)
                                                    <tr>
                                                        <td width="5%">{{ $key + 1 }}</td>
                                                        <td>{{ $detail['student_class']['name']}}</td>
                                                        <td width="20%"> {{ $detail->amount }} </td>
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
