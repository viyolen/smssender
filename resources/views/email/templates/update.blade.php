@extends('app')
@section('title') Sender @endsection
@section('CONTENT')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Email Template Düzenle</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Ana Sayfa</a></li>
                        <li class="breadcrumb-item"><a href="{{route("email.templates.")}}">Email Templates</a></li>
                        <li class="breadcrumb-item active">Düzenle</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form method="post" action="{{route("email.templates.update.post",$id)}}" >
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">

                            <div class="card-body">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>Tema Adı</label>
                                    <input type="text" class="form-control" name="template_name" value="{{$data->template_name}}">
                                </div>
                                <div>
                                    <label for="">Değişkenler</label>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <a href="#" onclick="myFunction('[email]')">[email]</a>

                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" onclick="myFunction('[ad_soyad]')">[ad_soyad]</a>
                                        </li>

                                        <!-- The text field -->
                                        <input type="text" value="" id="myInput" style="display:none;">
                                    </ul>
                                </div>
                                <label for="">Template</label>
                                <div class="form-group">
                                    <textarea id="editor1" class="form-control" name="html" style="height: 500px">{!! $data->html !!}</textarea>
                                </div>

                                <label for="">Önizle</label>
                               <iframe style="width: 100%;height: 50vh" src="{{route("email.templates.view",$id)}}"></iframe>

                            </div>
                        </div>
                        <button type="submit"  class="btn btn-block btn-success">Kaydet</button>
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

    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

    <script type="text/javascript">
        //Date picker
        $(function () {
            //Add text editor

            CKEDITOR.replace( 'editor1' );

        })

        function myFunction(text) {
            /* Get the text field */
            $("#myInput").val(text);
            var copyText = document.getElementById("myInput");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);
            document.execCommand("copy")

            /* Alert the copied text */

        }
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="/assets/plugins/summernote/summernote-bs4.min.css">
@endsection
