@extends('app')
@section('title') Sender @endsection
@section('CONTENT')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Email Listeleri</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Ana Sayfa</a></li>
                        <li class="breadcrumb-item active">Email Listleleri</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">

                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-4"></div>
                                <div class="col-md-2 text-right"><a href="{{route("email.lists.add")}}" type="button"
                                                                    class="btn btn-sm btn-info pull-right"><i
                                            class="fa fa-plus"></i> Ekle</a></div>
                            </div>
                        </div>
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Grup Adı</th>
                                    <th>Kayıtlı Kişi</th>
                                    <th style="width: 25%">İşlem</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($data as $row)
                                    <tr>
                                        <td>{{$row->group_name}}</td>
                                        <td>{{$row->d}}</td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-sm" href="{{route("email.lists.users.",$row->id)}}">
                                                <i class="fas fa-folder">
                                                </i>
                                                Kişiler
                                            </a>
                                            <a class="btn btn-info btn-sm" href="{{route("email.lists.update",$row->id)}}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Grup Düzenle
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="{{route("email.lists.delete",$row->id)}}">
                                                <i class="fas fa-trash">
                                                </i>
                                                Grubu Sil
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- /.col-md-6 -->
            </div>
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
