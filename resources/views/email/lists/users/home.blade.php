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
                        <li class="breadcrumb-item active"><a href="{{route("email.lists.")}}">Email Listleleri</a></li>
                        <li class="breadcrumb-item active">{{$first->group_name}}</li>
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
                                <div class="col-md-3"></div>
                                <div class="col-md-3 text-right">
                                    <button type="button" data-toggle="modal" data-target="#modal-default"
                                            class="btn mr-2 btn-sm btn-warning pull-right"><i
                                            class="fa fa-file-excel"></i> Excel ile toplu yükle
                                    </button>
                                    <a
                                        href="{{route("email.lists.users.add",$id)}}"
                                        type="button"
                                        class="btn btn-sm btn-info pull-right"><i
                                            class="fa fa-plus"></i> Ekle</a></div>
                            </div>
                        </div>
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Ad Soyad</th>
                                    <th style="width: 25%">İşlem</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $row)
                                    <tr>
                                        <td>{{$row->email}}</td>
                                        <td>{{$row->name_surname}}</td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-info btn-sm"
                                               href="{{route("email.lists.users.update",['group'=>$id,'id'=>$row->id])}}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Düzenle
                                            </a>
                                            <a class="btn btn-danger btn-sm"
                                               href="{{route("email.lists.users.delete",['group'=>$id,'id'=>$row->id])}}">
                                                <i class="fas fa-trash">
                                                </i>
                                                Sil
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

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <form action="javascript:void(0);" role="form" method="post" id="excelUpload" class="validate"
                  onsubmit="form_insert('excelUpload','{{route("email.lists.users.excel.add.post",$id)}}',true,false,false);">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Excel ile toplu yükle</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="file" class="form-control" name="file">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Yükle</button>
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
