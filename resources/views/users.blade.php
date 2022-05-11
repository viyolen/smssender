@extends('app')
@section('title') Sender @endsection
@section('CONTENT')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kullanıcılar</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Ana Sayfa</a></li>
                        <li class="breadcrumb-item active">Kullanıcılar</li>
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
                                <div class="col-md-2 text-right">
                                    <button data-toggle="modal" data-target="#modal-default" type="button"
                                            class="btn btn-sm btn-info pull-right"><i
                                            class="fa fa-plus"></i> Ekle
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Adı</th>
                                    <th>Soyadı</th>
                                    <th>Email</th>
                                    <th>Telefon</th>
                                    <th style="width: 25%">İşlem</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($data as $row)
                                    <tr>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->surname}}</td>
                                        <td>{{$row->email}}</td>
                                        <td>{{$row->phone}}</td>

                                        <td class="project-actions text-right">
                                            @if(Auth::id() != $row->id)
                                                <a class="btn btn-primary btn-sm"
                                                   href="{{route("email.lists.users.",$row->id)}}">
                                                    <i class="fas fa-sign">
                                                    </i>
                                                    Giriş Yap
                                                </a>
                                                <a class="btn btn-primary btn-sm"
                                                   href="{{route("email.lists.users.",$row->id)}}">
                                                    <i class="fas fa-users-cog">
                                                    </i>
                                                    Krediler
                                                </a>

                                                <a class="btn btn-danger btn-sm"
                                                   href="{{route("userManagement.delete",$row->id)}}">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    Sil
                                                </a>
                                            @else
                                                <a href="#">
                                                    <i class="fas fa-minus-circle"></i>
                                                    İşlem yok
                                                </a>
                                            @endif
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

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <form action="javascript:void(0);" role="form" method="post" id="userAdd" class="validate"
                  onsubmit="form_insert('userAdd','{{route("userManagement.add.post")}}',true,false,false);">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Kullanıcı Ekle</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Ad</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>Soyad</label>
                            <input type="text" class="form-control" name="surname">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label>Telefon</label>
                            <input type="text" class="form-control" name="phone">
                        </div>
                        <div class="form-group">
                            <label>Şifre</label>
                            <input type="text" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </form>
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

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
