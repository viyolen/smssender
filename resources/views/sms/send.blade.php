@extends('app')
@section('title') Sender @endsection
@section('CONTENT')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">SMS Gönder</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Ana Sayfa</a></li>
                        <li class="breadcrumb-item active">Sms Gönder</li>
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
                  onsubmit="form_insert('form','{{route("sms.send.post")}}',true,false,false);">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">SMS Metni</h5>
                        </div>
                        <div class="card-body">
                            <textarea class="form-control" onchange="recalculate_plan()"
                                      placeholder="Mesajınızı Giriniz" name="message" id="message" cols="30"
                                      rows="10"></textarea>
                            <td colspan="2" style="padding-left:65px">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>Karakter Sayısı :</td>
                                        <td width="30px">
                                            <div class="baslik_style" id="karak_sayi">0</div>
                                        </td>
                                        <td>Mesaj Sayısı (Boyu) :</td>
                                        <td width="30px">
                                            <div class="baslik_style" id="mesaj_boyu">0</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Gönderim</h5>
                        </div>
                        <div class="card-body">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>SMS Gönderici Adı</label>
                                <input type="text" class="form-control" name="from">
                            </div>
                            <textarea class="form-control" onkeyup="recalculate_plan()"
                                      placeholder="Alıcıları alt alta girebilirsiniz" name="sms_send_receivers"
                                      id="sms_send_receivers" cols="30" rows="10"></textarea>

                            <div class="mt-4">
                                <div onclick="$('#timePicker').hide()" class="custom-control custom-radio">
                                    <input class="custom-control-input" value="1" type="radio" id="customRadio1"
                                           name="scheduleDateCheck" checked="">
                                    <label for="customRadio1" class="custom-control-label">Hemen Gönder</label>
                                </div>
                                <div onclick="$('#timePicker').show()"  class="custom-control custom-radio">
                                    <input class="custom-control-input" value="0" type="radio" id="customRadio2"
                                           name="scheduleDateCheck">
                                    <label for="customRadio2" class="custom-control-label">İleri Zamanlı</label>
                                </div>
                                <div id="timePicker" style="display: none">
                                    <div class="form-group">
                                        <label>Date:</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" name="scheduleDate" readonly class="form-control datetimepicker-input"
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
                                        <span class="description-text">Gönderilecek Numara</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>

                    </div>
                    <button type="submit" disabled id="submitButton" class="btn btn-block btn-success">Gönder</button>
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
            var message = $("#message").val();
            var sms_send_receivers = $("#sms_send_receivers").val();


            var form_data = new FormData(); //Creates new FormData object
            form_data.append('message', message);
            form_data.append('sms_send_receivers', sms_send_receivers);
            form_data.append('_token', '{{csrf_token()}}');

            $.ajax({
                url: "{{route("sms.send.creditValidate")}}",
                type: "POST",
                data: form_data,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function (html) {
                    $("#mesaj_boyu").html(html.smsCount)
                    $("#karak_sayi").html(html.character)
                    $("#used").html(html.usedCredit)
                    $("#send_number").html(html.totalLines)

                    if(parseInt(html.usedCredit)){
                        $("#submitButton").removeAttr("disabled");
                    }else {
                        $("#submitButton").attr("disabled","disabled")
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
