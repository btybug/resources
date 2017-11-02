@extends('btybug::layouts.mTabs',['index'=>'assets'])
<!-- Nav tabs -->
@section('tab')
    <div class="row list_222">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 cms_module_list module_list_1">
            <h3 class="menuText f-s-17">
                <span class="module_icon_main"></span>

                <span class="module_icon_main_text"> Styles <a href="{!! url('admin/resources/styles/optimize') !!}"
                                                               class="btn btn-warning">Optimize</a></span>
            </h3>
            <hr>
            <ul class="list-unstyled menuList" id="components-list">
                {{--main types--}}
                @foreach(\App\Modules\Resources\Models\Styles::$stylesTypes as $type)
                    @if($loop->first)
                        <li class="active_class">
                    @else
                        <li>
                            @endif
                            <a href="?p={{$type}}" main-type="{{$type}}" rel="tab" class="tpl-left-items">
                                <span class="module_icon"></span> {{$type}}
                                <a data-type="{{$type}}" class="add-class-modal pull-right gettype"></a>
                            </a>
                        </li>
                        @endforeach
            </ul>
        </div>
        {!! HTML::image('resources/assets/images/ajax-loader5.gif', 'a picture', array('class' => 'thumb img-loader hide')) !!}
        <div class="tpl-list">
            @include('resources::styles._partials.subs_list')
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
                    {!! Form::open(['url'=>'/admin/resources/styles/upload','class'=>'dropzone', 'id'=>'my-awesome-dropzone']) !!}
                    {!! Form::hidden('style_id',null,['id' => 'sub_item_upl']) !!}

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
                {!! Form::open(['url'=>'/admin/resources/styles/add-sub','class' => 'form-horizontal']) !!}
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
    <div class="modal fade" id="edit_delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create new Sub</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    @include('resources::assests.deleteModal',['title'=>'Delete Style'])
@stop
@section('CSS')
    {!! HTML::style('app/Modules/Resources/Resources/assets/css/new-store.css') !!}
    {!! HTML::style('app/Modules/Resources/Resources/assets/css/style_cube.css') !!}
@stop
@section('JS')
    {!! HTML::script('js/dropzone/js/dropzone.js') !!}
    <script>
        Dropzone.options.myAwesomeDropzone = {
            init: function () {
                this.on("success", function (file) {
//                    location.reload();
                });
            }
        };


        $(document).ready(function () {
            var p = "{!! $_GET['p'] or null !!}";
            var scrollTop = $(window).scrollTop();
            $(window).resize(function () {
                $('body').find('.popup_div').css({
                    'height': $(window).height() - 227,
                    "top": scrollTop
                });
            });
            $("body").on("change", ".sort-items", function () {
                var val = $(this).val();
                var main_type = $(this).attr('data-type');
                var sub = $(this).attr('data-sub');

                if (!sub) {
                    sub = false;
                }

                $.ajax({
                    url: '/admin/resources/styles/render-styles',
                    data: {
                        main_type: main_type,
                        sub: sub,
                        sort: val,
                        sorting: true
                    },
                    dataType: 'json',
                    beforeSend: function () {
//                        $('.tpl-list').html('');
                        $('.img-loader').removeClass('hide');

                    },
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    success: function (data) {
                        $('.img-loader').addClass('hide');
                        if (!data.error) {
                            $('#sub_item_upl').val(sub);
                            $('.tpl-list').html(data.html);
                        } else {
                            alert(data.message);
                        }
                    },
                    type: 'POST'
                });
            });

            $("body").on("click", ".add-class-modal", function () {
                $('#class-type').val($('.active_class').find($('.gettype')).attr('data-type'));
                $('#addSub').modal();
            });

            $('.list-unstyled').on('click', '.tpl-left-items', function (e) {
                e.preventDefault();
                var main_type = $(this).attr('main-type');
                var sub = $(this).attr('sub');
                var pageurl = $(this).attr('href');

                if (!sub) {
                    sub = false;
                }

                $('.tpl-left-items').parent().removeClass('active_class');

                $('*[main-type="' + main_type + '"]').parent().addClass('active_class');

                $.ajax({
                    url: '/admin/resources/styles/render-styles',
                    data: {
                        main_type: main_type,
                        url: pageurl + '?rel=tab',
                        sub: sub
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        $('.tpl-list').html('');
                        $('.img-loader').removeClass('hide');
                    },
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    success: function (data) {
                        $('.img-loader').addClass('hide');
                        if (!data.error) {
                            if (sub) {
                                $('#sub_item_upl').val(sub);
                            }

                            $('.tpl-list').html(data.html);
                        } else {
                            alert(data.message);
                        }
                    },
                    type: 'POST'
                });
                if (pageurl != window.location) {
                    window.history.pushState({path: pageurl}, '', pageurl);
                }
                return false;
            });

            $("a[main-type=" + p + "]").click();

            $('body').on('click', 'button[data-action]', function () {
                if ($(this).attr('data-action') == 'edit') {
                    var divForm = $('<div/>', {
                        class: "form-horizontal",
                    });
                    var divFormGroup = $('<div/>', {
                        class: "form-group",
                    });
                    var div = $('<div/>', {
                        class: "col-md-4"
                    });
                    var lable = $('<lable/>', {
                        class: "col-md-4 control-label",
                        text: "Enter Sub Name"
                    });
                    var input = $('<input/>', {
                        class: "form-control",
                        value: $(this).attr('data-edit'),
                        "data-id": $(this).attr('data-id')
                    });
                    var row = divForm.append(divFormGroup.append(lable).append(div.append(input))).clone();

                    $('#edit_delete_modal .modal-body').empty();
                    $('#edit_delete_modal .modal-body').append(row);
                    $('#edit_delete_modal').modal();
                }

            })

            $('.tpl-list').on("click", '.button_title', function () {
//                var id = $(this).attr('data-id');
//                 $(".popup_div_" + id).slideToggle("slow");
                var id = $(this).attr('data-id');
                $.ajax({
                    url: '/admin/resources/styles/show_popup',
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        $('.add_popup').html('');
                    },
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    success: function (data) {
                        $('.add_popup').html(data.html);
                        if (!data.error) {
                            var scrollTop = $(window).scrollTop();
                            $('body').find(".popup_div_" + id).css({
                                'height': (scrollTop < 227 ? $(window).height() - (227 - scrollTop) : $(window).height()),
                                "top": (scrollTop < 227 ? 0 : scrollTop - 227)
                            });
                            $('body').find(".popup_div_" + id).slideToggle("slow");
                            $("body").css("overflow", "hidden");
                        } else {
                            alert(data.message);
                        }
                    },
                    type: 'POST'
                });


            });


            $('.tpl-list').on("click", '.close_icon', function () {
                var id = $(this).attr('data-id');
                $(".popup_div_" + id).slideToggle("slow");
                $("body").css("overflow", "visible");
            });

        });
    </script>
@stop
