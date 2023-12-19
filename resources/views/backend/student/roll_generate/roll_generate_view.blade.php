<div class="col-12">
    @extends('admin.admin_master')
    @section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <div class="content-wrapper">
            <div class="container-full">
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="box bb-3 border-warning">
                                <div class="box-header">
                                    <h4 class="box-title">Student <strong>Roll Generate</strong></h4>
                                </div>

                                <div class="box-body">
                                    <form method="post" action="{{ route('roll.generate.store') }}">
                                        @csrf
                                        <div class="row"> <!-- start row -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Year <span class="text-danger"></span></h5>
                                                    <div class="controls">
                                                        <select name="year_id" id="year_id" required=""
                                                            class="form-control">
                                                            <option value="" selected disabled>Select Year
                                                            </option>
                                                            @foreach ($years as $year)
                                                                <option value="{{ $year->id }}">
                                                                    {{ $year->name }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>

                                                </div>
                                            </div> <!--end col-md-4 -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Class <span class="text-danger"></span></h5>
                                                    <div class="controls">
                                                        <select name="class_id" id="class_id" required=""
                                                            class="form-control">
                                                            <option value="" selected disabled>Select Class
                                                                @foreach ($classes as $class)
                                                            <option
                                                                value="{{ $class->id }}">
                                                                {{ $class->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                            </div> <!--end col-md-4 -->
                                            <div class="col-md-4" style="padding-top: 20px;">
                                                <a id="search" class="btn btn-primary" name="search">Search</a>
                                            </div> <!--end col-md-4 -->

                                        </div> <!-- end row -->

                                        <!-- Role Generate Table -->
                                        <div class="row d-none" id="role-generate">
                                            <div class="col-md-12">
                                                <table class="table table-bordered table-striped" style="width: 100%">
                                                    <thead>
                                                        <th>ID No</th>
                                                        <th>Student Name</th>
                                                        <th>Student Father Name</th>
                                                        <th>Gender</th>
                                                        <th>Roll</th>
                                                    </thead>
                                                    <tbody id="role-generate-tr">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

<input type="submit" class="btn btn-info" value="Roll Generator">



                                    </form>
                                </div>
                            </div>
                        </div> <!-- end first col-12 -->

                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->

            </div>
        </div>

   <!-- Start Role Generated =========== -->

<script type="text/javascript">
  $(document).on('click','#search',function(){
    var year_id = $('#year_id').val();
    var class_id = $('#class_id').val();
     $.ajax({
      url: "{{ route('student.registration.getstudents')}}",
      type: "GET",
      data: {'year_id':year_id,'class_id':class_id},
      success: function (data) {
        $('#role-generate').removeClass('d-none');
        var html = '';
        $.each( data, function(key, v){
          html +=
          '<tr>'+
          '<td>'+v.student.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"></td>'+
          '<td>'+v.student.name+'</td>'+
          '<td>'+v.student.fname+'</td>'+
          '<td>'+v.student.gender+'</td>'+
          '<td><input type="text" class="form-control form-control-sm" name="roll[]" value="'+v.roll+'"></td>'+
          '</tr>';
        });
        html = $('#role-generate-tr').html(html);
      }
    });
  });

</script>

<!--============ End Script Roll Generate ================= -->

    @endsection
