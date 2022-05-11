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
                        <li class="breadcrumb-item"><a href="{{route("email.lists.")}}">Email Listeleri</a></li>
                        <li class="breadcrumb-item active">Ekle</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form method="post" action="{{route("email.lists.users.add.post",$id)}}">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="m-0">{{$first->group_name}} Ekle</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Ad Soyad</label>
                                    <input type="text" class="form-control" name="name_surname">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email">

                                </div>
                                {{csrf_field()}}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-success">Kaydet</button>
                    </div>

                    <!-- /.col-md-6 -->
                </div>
            </form>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

@endsection

@section('js')
    <!-- date-range-picker -->
    <script src="/assets/plugins/moment/moment.min.js"></script>
    <script type="text/javascript" src="/assets/plugins/moment/locale/tr.js"></script>
    <script src="/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-boot strap-4.min.js"></script>
    <script type="text/javascript">
        //Date picker
        $('#reservationdate').datetimepicker({icons: {time: 'far fa-clock'}, locale: 'tr'});

    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
@endsection
