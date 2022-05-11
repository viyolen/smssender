@extends('app')
@section('title') Sender @endsection
@section('CONTENT')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Email Gönder</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Ana Sayfa</a></li>
                        <li class="breadcrumb-item active">Email Gönder</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form action="javascript:void(0);" role="form" method="post" id="form" class="validate"
                  onsubmit="form_insert('form','{{route("email.send.post")}}',true,false,false);">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">

                            <div class="card-body">
                                <div class="form-group">
                                    <label>Konu Giriniz</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="subject"
                                           placeholder="Subject">
                                </div>
                                <div class="form-group">
                                    <label>Grup Seçiniz</label>
                                    <select onchange="recalculate_plan()" class="form-control" name="group_id" id="group">
                                        <option value="">Seçiniz</option>
                                        @foreach($mail_groups as $row)
                                            <option value="{{$row->id}}">{{$row->group_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Şablon Seçiniz</label>
                                    <select class="form-control" name="template_id">
                                        <option value="">Seçiniz</option>
                                        @foreach($mail_templates as $row)
                                            <option value="{{$row->id}}">{{$row->template_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <div onclick="$('#timePicker').hide()" class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio1"
                                               name="customRadio" checked="">
                                        <label for="customRadio1" class="custom-control-label">Hemen Gönder</label>
                                    </div>
                                    <div onclick="$('#timePicker').show()" class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio2"
                                               name="customRadio">
                                        <label for="customRadio2" class="custom-control-label">İleri Zamanlı</label>
                                    </div>
                                    <div id="timePicker" style="display: none">
                                        <div class="form-group">
                                            <label>Date:</label>
                                            <div class="input-group date" id="reservationdate"
                                                 data-target-input="nearest">
                                                <input type="text" readonly class="form-control datetimepicker-input"
                                                       data-target="#reservationdate">
                                                <div class="input-group-append" data-target="#reservationdate"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card ">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header"><span id="credit">{{$remainder}}</span></h5>
                                            <span class="description-text">Krediniz</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header"><span id="used">0</span></h5>
                                            <span class="description-text">Kullanılacak Kredi</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4">
                                        <div class="description-block">
                                            <h5 class="description-header"><span id="send_number">0</span></h5>
                                            <span class="description-text">Gönderilecek Email</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </div>

                        </div>
                        <button type="submit" id="submitButton" disabled class="btn btn-block btn-success">Gönder
                        </button>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </form>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

@endsection

@section('js')
    <!-- date-range-picker -->
    <script src="/assets/plugins/moment/moment.min.js"></script>
    <script type="text/javascript" src="/assets/plugins/moment/locale/tr.js"></script>
    <script src="/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script type="text/javascript">
        //Date picker
        $('#reservationdate').datetimepicker({icons: {time: 'far fa-clock'}, locale: 'tr'});
        $.fn.datetimepicker.dates['en'] = {
            days: ["Sundasdday", "Modasdnday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
            daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            daysMin: ["1u", "Mo1", "Tu", "We", "Th", "Fr", "Sa", "Su"],
            months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            today: "Today"
        };

        function recalculate_plan() {
            var group = $("#group").val();


            var form_data = new FormData(); //Creates new FormData object

            form_data.append('group', group);
            form_data.append('_token', '{{csrf_token()}}');

            $.ajax({
                url: "{{route("email.send.creditValidate")}}",
                type: "POST",
                data: form_data,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function (html) {

                    $("#used").html(html.usedCredit)
                    $("#send_number").html(html.totalLines)

                    if (parseInt(html.usedCredit)) {
                        $("#submitButton").removeAttr("disabled");
                    } else {
                        $("#submitButton").attr("disabled", "disabled")
                    }
                },
                error: function (error) {
                    errors(error);
                }
            })
        }
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
@endsection
