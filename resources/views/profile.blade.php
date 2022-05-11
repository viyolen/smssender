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

                <div class="row">
                    <div class="col-lg-6">
                        <form action="javascript:void(0);" role="form" method="post" id="profil" class="validate"
                              onsubmit="form_insert('profil','{{route("profile.post")}}',true,false,false);">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="m-0">Profil</h5>
                            </div>
                            <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Adınız</label>
                                        <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Soyadınız</label>
                                        <input type="text" class="form-control" name="surname" value="{{Auth::user()->surname}}">
                                    </div>
                                </div>
                            </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="{{Auth::user()->email}}">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{Auth::user()->phone}}">
                                </div>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-success">Kaydet</button>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <form action="javascript:void(0);" role="form" method="post" id="passwordForm" class="validate"
                              onsubmit="form_insert('passwordForm','{{route("profile.password.post")}}',true,false,false);">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="m-0">Şifre Güncelle</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Mevcut Şifreniz</label>
                                    <input type="text" class="form-control" name="default_password">
                                </div>
                                <div class="form-group">
                                    <label>Yeni Şifre</label>
                                    <input type="text" class="form-control" name="password_ex">
                                </div>
                                <div class="form-group">
                                    <label>Yeni Şifre Tekrar</label>
                                    <input type="text" class="form-control" name="password_confirmation">
                                </div>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-success">Şifre Değiştir</button>
                        </form>
                    </div>

                </div>
                <!-- /.row -->

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

@endsection

@section('js')

@endsection

@section('css')

@endsection
