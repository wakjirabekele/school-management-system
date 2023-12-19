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
                                    <h3 class="box-title">Assigned Subject Details</h3>
                                    <a href="{{ route('assign.subject.add') }}" class="btn btn-rounded btn-success mb-5"
                                        style="float: right;">Assign Subject</a>

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <h4><strong>Assigned Subject : {{$detailsData[0]['student_class']['name']}}</strong></h4>
                                    <div class="table-responsive">
                                        <table  class="table table-bordered table-striped">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th width="5%">Sno</th>
                                                    <th width="20%">Subject Name</th>
                                                    <th width="20%">Full Mark</th>
                                                    <th width="20%">Pass Mark</th>
                                                    <th width="20%">Subjective Mark</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($detailsData as $key => $detail)
                                                    <tr>
                                                        <td width="5%">{{ $key + 1 }}</td>
                                                        <td>{{ $detail['school_subject']['name']}}</td>
                                                        <td width="20%"> {{ $detail->full_mark }} </td>
                                                        <td width="20%"> {{ $detail->pass_mark }} </td>
                                                        <td width="20%"> {{ $detail->subjective_mark }} </td>
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
