
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="/assets/index2.html"><b>SENDER</b> IO</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Giriş Yap</p>

            <form action="javascript:void(0);" role="form" method="post" id="form" class="validate"
                  onsubmit="form_insert('form','{{route("login.post")}}',true,false,false);">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Beni Hatırla
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


            <p class="mb-1">
                <a href="{{route("forgotPassword.post")}}">Şifre mi unuttum!</a>
            </p>
            <p class="mb-0">
                <a href="register.html" class="text-center">Register a new membership</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/adminlte.min.js"></script>
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
                            icon: "warning",
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
