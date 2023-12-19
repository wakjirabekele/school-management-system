    @extends('admin.admin_master')
    @section('admin')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>

        <div class="content-wrapper">
            <div class="container-full">
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="box bb-3 border-warning">
                                <div class="box-header">
                                    <h4 class="box-title">Student <strong>Registration Fee</strong></h4>
                                </div>

                                <div class="box-body">

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
                                                        <option value="{{ $class->id }}">
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

                                    <!-- Student fee Table -->
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div id="DocumentResults">
                                                <script id="document-template"  type="text/x-handlebars-template">
                                              <table class="table table-bordered table-striped" style="width: 100%">
                                                    <thead>
                                                        <tr>
                                                            @{{{thsource}}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @{{#each this}}
                                                        <tr>
                                                            @{{{tdsource }}}
                                                        </tr>
                                                        @{{ /each }}
                                                    </tbody>
                                                </table>

                                               </script>
                                            </div>

                                        </div>
                                    </div> <!-- end row -->

                                </div>
                            </div>
                        </div> <!-- end first col-12 -->

                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->

            </div>
        </div>

        <!-- ============ Get Registration Fee Method And View Page =================== -->

        <script type="text/javascript">
            $(document).on('click', '#search', function() {
                var year_id = $('#year_id').val();
                var class_id = $('#class_id').val();
                $.ajax({
                    url: "{{ route('student.registration.fee.classwise.get') }}",
                    type: "get",
                    data: {
                        'year_id': year_id,
                        'class_id': class_id,
                    },
                    beforeSend: function() {},
                    success: function(data) {
                        var source = $('#document-template').html();
                        var template = Handlebars.compile(source);
                        var html = template(data);
                        $('#DocumentResults').html(html);
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            });
        </script>

        <!--============ End registration fee view ================= -->
    @endsection
