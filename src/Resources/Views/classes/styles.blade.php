@extends('btybug::layouts.mTabs',['index'=>'resources'])
<!-- Nav tabs -->
@section('tab')

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 cms_module_list">
            <h3 class="menuText f-s-17">
                <span class="module_icon_main"></span>
                <span class="module_icon_main_text"> Styles</span>
            </h3>
            <hr>
            <ul class="list-unstyled menuList" id="components-list">
                {{--main types--}}
                <li class="active_class">
                    <a href="#" main-type="text" class="tpl-left-items">
                        <span class="module_icon"></span> Text <a data-type="text" class="add-class-modal pull-right"><i
                                    class="fa fa-plus-circle"></i></a>
                    </a>
                @if(count(\App\Modules\Resources\Models\Classes::getSub('text')))
                    @foreach(\App\Modules\Resources\Models\Classes::getSub('text') as $sub)
                        <li class="active_class" style="margin-left: 15px">
                            <a href="#" main-type="text" class="tpl-left-items">
                                <span class="module_icon"></span> {{$sub->name}}
                            </a>
                        </li>
                        @endforeach
                        @endif
                        </li>

                        <li>
                            <a href="#" main-type="image" class="tpl-left-items">
                                <span class="module_icon"></span> Images <a data-type="image"
                                                                            class="add-class-modal pull-right"><i
                                            class="fa fa-plus-circle"></i></a>
                            </a>
                        @if(count(\App\Modules\Resources\Models\Classes::getSub('image')))
                            @foreach(\App\Modules\Resources\Models\Classes::getSub('image') as $sub)
                                <li class="active_class" style="margin-left: 15px">
                                    <a href="#" main-type="image" class="tpl-left-items">
                                        <span class="module_icon"></span> {{$sub->name}}
                                    </a>
                                </li>
                                @endforeach
                                @endif
                                </li>

                                <li>
                                    <a href="#" main-type="container" class="tpl-left-items">
                                        <span class="module_icon"></span> Container <a data-type="container"
                                                                                       class="add-class-modal pull-right"><i
                                                    class="fa fa-plus-circle"></i></a>
                                    </a>
                                @if(count(\App\Modules\Resources\Models\Classes::getSub('container')))
                                    @foreach(\App\Modules\Resources\Models\Classes::getSub('container') as $sub)
                                        <li class="active_class" style="margin-left: 15px">
                                            <a href="#" main-type="container" class="tpl-left-items">
                                                <span class="module_icon"></span> {{$sub->name}}
                                            </a>
                                        </li>
                                        @endforeach
                                        @endif
                                        </li>

                                        <li>
                                            <a href="#" main-type="animation" class="tpl-left-items">
                                                <span class="module_icon"></span> Animation <a data-type="animation"
                                                                                               class="add-class-modal pull-right"><i
                                                            class="fa fa-plus-circle"></i></a>
                                            </a>
                                        @if(count(\App\Modules\Resources\Models\Classes::getSub('animation')))
                                            @foreach(\App\Modules\Resources\Models\Classes::getSub('animation') as $sub)
                                                <li class="active_class" style="margin-left: 15px">
                                                    <a href="#" main-type="animation" class="tpl-left-items">
                                                        <span class="module_icon"></span> {{$sub->name}}
                                                    </a>
                                                </li>
                                                @endforeach
                                                @endif
                                                </li>
                                                <li>
                                                    <a href="#" main-type="fields" class="tpl-left-items">
                                                        <span class="module_icon"></span> Fields <a data-type="fields"
                                                                                                    class="add-class-modal pull-right"><i
                                                                    class="fa fa-plus-circle"></i></a>
                                                    </a>
                                                @if(count(\App\Modules\Resources\Models\Classes::getSub('fields')))
                                                    @foreach(\App\Modules\Resources\Models\Classes::getSub('fields') as $sub)
                                                        <li class="active_class" style="margin-left: 15px">
                                                            <a href="#" main-type="fields" class="tpl-left-items">
                                                                <span class="module_icon"></span> {{$sub->name}}
                                                            </a>
                                                        </li>
                                                        @endforeach
                                                        @endif
                                                        </li>
                                                        <li>
                                                            <a href="#" main-type="buttons" class="tpl-left-items">
                                                                <span class="module_icon"></span> Buttons <a
                                                                        data-type="buttons"
                                                                        class="add-class-modal pull-right"><i
                                                                            class="fa fa-plus-circle"></i></a>
                                                            </a>
                                                        @if(count(\App\Modules\Resources\Models\Classes::getSub('buttons')))
                                                            @foreach(\App\Modules\Resources\Models\Classes::getSub('buttons') as $sub)
                                                                <li class="active_class" style="margin-left: 15px">
                                                                    <a href="#" main-type="buttons"
                                                                       class="tpl-left-items">
                                                                        <span class="module_icon"></span> {{$sub->name}}
                                                                    </a>
                                                                </li>
                                                                @endforeach
                                                                @endif
                                                                </li>
                                                                <li>
                                                                    <a href="#" main-type="notification"
                                                                       class="tpl-left-items">
                                                                        <span class="module_icon"></span> Notifications
                                                                        <a data-type="notification"
                                                                           class="add-class-modal pull-right"><i
                                                                                    class="fa fa-plus-circle"></i></a>
                                                                    </a>
                                                                @if(count(\App\Modules\Resources\Models\Classes::getSub('notification')))
                                                                    @foreach(\App\Modules\Resources\Models\Classes::getSub('notification') as $sub)
                                                                        <li class="active_class"
                                                                            style="margin-left: 15px">
                                                                            <a href="#" main-type="notification"
                                                                               class="tpl-left-items">
                                                                                <span class="module_icon"></span> {{$sub->name}}
                                                                            </a>
                                                                        </li>
                                                                        @endforeach
                                                                        @endif
                                                                        </li>
                                                                        <li>
                                                                            <a href="#" main-type="menu"
                                                                               class="tpl-left-items">
                                                                                <span class="module_icon"></span> Menu
                                                                                <a data-type="menu"
                                                                                   class="add-class-modal pull-right"><i
                                                                                            class="fa fa-plus-circle"></i></a>
                                                                            </a>
                                                                        @if(count(\App\Modules\Resources\Models\Classes::getSub('menu')))
                                                                            @foreach(\App\Modules\Resources\Models\Classes::getSub('menu') as $sub)
                                                                                <li class="active_class"
                                                                                    style="margin-left: 15px">
                                                                                    <a href="#" main-type="menu"
                                                                                       class="tpl-left-items">
                                                                                        <span class="module_icon"></span> {{$sub->name}}
                                                                                    </a>
                                                                                </li>
                                                                                @endforeach
                                                                                @endif
                                                                                </li>
            </ul>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
            <div class="row template-search">
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 template-search-box m-t-10 m-b-10">
                    <form class="form-horizontal">
                        <div class="form-group m-b-0">
                            <label for="inputEmail3" class="col-sm-2 control-label">Sort By</label>
                            <div class="col-sm-4">
                                <select class="form-control">
                                    <option>Recently Added</option>
                                </select>
                            </div>
                            <div class="col-sm-2 pull-right">
                                <a class="btn btn-default"><i class="fa fa-search f-s-15" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 template-upload-button p-l-0 p-r-0">
                    <button class="btn btn-sm  pull-right m-b-10 " type="button" data-toggle="modal"
                            data-target="#uploadfile">
                        <span class="module_upload_icon m-l-20"></span> <span class="upload_module_text">Upload</span>
                    </button>
                </div>
            </div>
            <div class="templates-list  m-t-20 m-b-10">
                <div class="row templates m-b-10">
                    {!! HTML::image('public/img/ajax-loader5.gif', 'a picture', array('class' => 'thumb img-loader hide')) !!}
                    <div class="raw tpl-list">
                        @include('resources::classes._partials.list_cube')
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="uploadfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Upload</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url'=>'/admin/templates/upload-template','class'=>'dropzone', 'id'=>'my-awesome-dropzone']) !!}

                    {!! Form::close() !!} </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addSub" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create new Sub</h4>
                </div>
                <div class="modal-body">
                {!! Form::open(['url'=>'/admin//classes/add-sub']) !!}
                {!! Form::hidden('type',null,['id' => 'class-type']) !!}
                <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="name">Sub Name</label>
                        <div class="col-md-4">
                            {!! Form::text('name',null,['class' => 'form-control input-md']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="name"></label>
                        <div class="col-md-4">
                            {!! Form::submit('Create',['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!} </div>
            </div>
        </div>
    </div>
@stop
@section('CSS')
    {!! HTML::style('app/Modules/Resources/assets/css/new-store.css') !!}
    <style>
        .child-tpl {
            width: 95% !important;
        }

        .img-loader {
            width: 70px;
            height: 70px;
            position: absolute;
            top: 50px;
            left: 40%;
        }

        .active_class {
            background: #b3eac4 !important;
        }

        #addSub .modal-body {
            height: 150px;
        }

        .add-class-modal {
            cursor: pointer;
        }
    </style>
@stop
@section('JS')
    {!! HTML::script('public/libs/dropzone/js/dropzone.js') !!}
    <script>
        Dropzone.options.myAwesomeDropzone = {
            init: function () {
                this.on("success", function (file) {
                    location.reload();
                });
            }
        };

        $(document).ready(function () {

            $("body").on("click", ".add-class-modal", function () {
                $('#class-type').val($(this).attr('data-type'));
                $('#addSub').modal();
            });

            $("body").on("click", ".tpl-left-items", function () {
                var main_type = $(this).attr('main-type');
                $('.tpl-left-items').parent().removeClass('active_class');

                $('*[main-type="' + main_type + '"]').parent().addClass('active_class');

                $.ajax({
                    url: '/admin//classes/render-classes',
                    data: {
                        main_type: main_type,
                        _token: $('#token').val()
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        $('.tpl-list').html('');
                        $('.img-loader').removeClass('hide');
                    },
                    success: function (data) {
                        $('.img-loader').addClass('hide');
                        if (!data.error) {
                            $('.tpl-list').html(data.html);
                        }
                    },
                    type: 'POST'
                });
            });

        });
    </script>
@stop