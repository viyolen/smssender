<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">

    @yield('css')

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index.html" class="nav-link">Analizler</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">İletişim</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route("logout")}}" class="nav-link">Çıkış Yap</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                   aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>

        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Sender</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                <div class="info">
                    <a href="#" class="d-block">Merhaba, {{Auth::user()->name}}</a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    @if (Auth::user()->role == 0)
                    <li class="nav-item {{(is_numeric(array_search(Route::currentRouteName(),['sms.send','sms.validate','sms.home'])))?"menu-open":""}}">
                        <a href="#"
                           class="nav-link {{(is_numeric(array_search(Route::currentRouteName(),['sms.send','sms.validate','sms.home'])))?"active":""}}">
                            <i class="nav-icon fas fa-bull"></i>
                            <p>
                                Sms Yönetimi
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item ">
                                <a href="{{route("sms.send")}}"
                                   class="nav-link {{(Route::currentRouteName() == "sms.send")?"active":""}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sms Gönder</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{route("sms.home")}}"
                                   class="nav-link {{(Route::currentRouteName() == "sms.home")?"active":""}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gönderilen SMS</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{route("sms.validate")}}"
                                   class="nav-link {{(Route::currentRouteName() == "sms.validate")?"active":""}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Numara Doğrula</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{(is_numeric(array_search(Route::currentRouteName(),['email.send','email.validate','email.home'])))?"menu-open":""}}">
                        <a href="#"
                           class="nav-link {{(is_numeric(array_search(Route::currentRouteName(),['email.send','email.validate','email.home'])))?"active":""}}">
                            <i class="nav-icon fas fa-mail-bulk"></i>
                            <p>
                                Mail Gönder & Doğrula
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item  ">
                                <a href="{{route("email.send")}}"
                                   class="nav-link {{(Route::currentRouteName() == "email.send")?"active":""}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Mail Gönder</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{route("email.home")}}"
                                   class="nav-link {{(Route::currentRouteName() == "email.home")?"active":""}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gönderilen Emailler</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{route("email.validate")}}"
                                   class="nav-link {{(Route::currentRouteName() == "email.validate")?"active":""}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Mail Doğrula</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item {{(is_numeric(array_search(Route::currentRouteName(),['email.lists.','email.lists.add'])))?"menu-open":""}}">
                        <a href="#"
                           class="nav-link {{(is_numeric(array_search(Route::currentRouteName(),['email.lists.','email.lists.add'])))?"active":""}}">
                            <i class="nav-icon fas fa-mail-bulk"></i>
                            <p>
                                Mail Grupları
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item ">
                                <a href="{{route("email.lists.add")}}"
                                   class="nav-link {{(Route::currentRouteName() == "email.lists.add")?"active":""}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Grup Ekle </p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{route("email.lists.")}}"
                                   class="nav-link {{(Route::currentRouteName() == "email.lists.")?"active":""}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Mail Grupları</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{(is_numeric(array_search(Route::currentRouteName(),['email.templates.','email.templates.add'])))?"menu-open":""}}">
                        <a href="#"
                           class="nav-link {{(is_numeric(array_search(Route::currentRouteName(),['email.templates.','email.templates.add'])))?"active":""}}">
                            <i class="nav-icon fas fa-mail-bulk"></i>
                            <p>
                                Mail Temaları
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item ">
                                <a href="{{route("email.templates.add")}}"
                                   class="nav-link {{(Route::currentRouteName() == "email.templates.add")?"active":""}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tema Ekle </p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{route("email.templates.")}}"
                                   class="nav-link {{(Route::currentRouteName() == "email.templates.")?"active":""}}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Mail Temaları</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @else
                        <li class="nav-item">
                            <a href="{{route("userManagement.")}}" class="nav-link">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>
                                    Üyeler
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("profile")}}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Hesabım
                                </p>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('CONTENT')
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2014-2021 <a href="https://sender">Sender</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/adminlte.min.js"></script>

@yield('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    function form_insert(form, url, reload = true, editor = false, process = false) {

        if (editor) {
            for (var instanceName in CKEDITOR.instances) {
                CKEDITOR.instances[instanceName].updateElement();
            }
        }

        var eklemedurumu = true;
        var form1 = $("#" + form);

        if (eklemedurumu) {

            var myForm = document.getElementById(form);
            var form_data = new FormData(myForm); //Creates new FormData object
            form_data.append('_token', '{{csrf_token()}}');

            $.ajax({
                url: url,
                type: "POST",
                data: form_data,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function (html) {
                    console.log(html)
                    if (html.state) {

                        if (process) {
                            // Function name to invoke
                            var fnName = process;

                            // Params to pass to the function
                            var params = html
                            window[fnName](params);
                        }
                        // Call function using Window object


                        if (reload == true) {
                            setTimeout(function () {
                                window.location.reload()
                            }, 1000);
                        } else {
                            $('#' + reload)
                                .DataTable().ajax.reload();
                        }

                    } else {
                        swal.fire({
                            title: "Hata",
                            html: html.message,
                            type: "warning",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                },
                error: function (error) {
                    errors(error);
                }
            })
            return false;
        } else {
            return false;
        }

    }


    function errors(error) {

        if (error.status == "422") {

            const list = document.createElement('ul');

            $.each(error.responseJSON.errors, function (index, value) {
                const listItem = document.createElement('li');
                listItem.innerHTML = value;
                list.appendChild(listItem);
            });


            swal.fire({
                title: "Hata",
                html: list,
                type: "warning",
                showConfirmButton: true
            });
        } else if (error.status == "500") {


            swal.fire({
                title: "Hata",
                text: error.responseJSON.message,
                type: "error",
                showConfirmButton: true
            });


            var form_data = new FormData(); //Creates new FormData object
            form_data.append('_token', '{{csrf_token()}}')
            form_data.append('list', error.responseJSON.message)
            form_data.append('file', error.responseJSON.file)
            form_data.append('line', error.responseJSON.line)
            form_data.append('exception', error.responseJSON.exception)
        }
    }
</script>

</body>
</html>
