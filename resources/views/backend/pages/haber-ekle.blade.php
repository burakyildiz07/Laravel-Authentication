@extends('backend.layouts.app')

@section('css')
    <link href="https://cdn.jsdelivr.net/sweetalert2/6.6.0/sweetalert2.min.css" rel="stylesheet">
    @endsection

@section('content')

        <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Haber Ekleme</h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Haber Ekleme Sayfası<small></small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form id="form" method="post" data-parsley-validate class="form-horizontal form-label-left">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Başlık<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="first-name" name="baslik" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">İçerik<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea type="text" id="last-name" name="icerik" required="required" class="ckeditor form-control col-md-7 col-xs-12"></textarea>
                                    </div>
                                </div>
                                <div id="button" class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">Kaydet</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

@section('js')

    <!--  Validate kodları  -->
    <script src="/js/jquery.validate.min.js"></script>
    <script src="/js/messages_tr.min.js"></script>
    <script src="/backend/vendors/ckeditor/ckeditor.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="https://cdn.jsdelivr.net/sweetalert2/6.6.0/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#form').validate();
            $('#form').ajaxForm({
                beforeSubmit:function () {
                    $('#button').fadeOut();
                },
                success:function (response) {
                    if (response.code==200){
                        swal(
                            response.baslik,
                            response.msg,
                            'success'
                        );
                        document.getElementById('form').reset();
                        $('#button').fadeIn();
                    }else{
                        swal(
                            response.baslik,
                            response.msg,
                            'error'
                        );
                        $('#button').fadeIn();
                    }

                },
                beforeSerialize:function () {
                    for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
                }
            });
        });

    </script>


    @endsection