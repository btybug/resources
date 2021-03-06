@extends('layouts.admin')

@section('content')
    <div class="row list_222">
        <div id="msg" style="background-color: #DFF2BF; color: #4F8A10; margin: 10px 0px; text-align: center; "></div>
        {!! HTML::image('resources/assets/images/ajax-loader5.gif', 'a picture', array('class' => 'thumb img-loader hide')) !!}
        <div class="tpl-list">
            @include('resources::styles._partials.list_cube')
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
                    {!! Form::hidden('style_id',$style->id,['id' => 'sub_item_upl']) !!}

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
    <style>
        #editor {
            width: 100%;
            height: 100px;
            margin-bottom: 20px;
        }
    </style>
    <style data-preview="css"></style>
@stop
@section('JS')
    {!! HTML::script('public/js/dropzone/js/dropzone.js') !!}
    {!! HTML::script("/resources/assets/js/code_editor/edit_area_full.js") !!}
    {!! HTML::script("https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js") !!}
    <script>
        Dropzone.options.myAwesomeDropzone = {
            init: function () {
                this.on("success", function (file) {
                    location.reload();
                });
            }
        };


        $(document).ready(function () {
            var scrollTop = $(window).scrollTop();
            $(window).resize(function () {
//                $('body').find('.popup_div').css({
//                    'height':$( window ).height()-227,
//                    "top":scrollTop
//                });
                var scrollTop = $(window).scrollTop();
                $('body').find(".popup_div_").css({
                    'height': (scrollTop < 182 ? $(window).height() - (182 - scrollTop) - 10 : $(window).height() - 20),
                    "top": (scrollTop < 182 ? 0 : scrollTop - 182 + 10)
                });
            });
            $("body").on("change", ".sort-items", function () {
                var ID = "{{ $style->id }}";
                var val = $(this).val();
                var main_type = $(this).attr('data-type');
                var sub = $(this).attr('data-sub');

                if (!sub) {
                    sub = false;
                }

                $.ajax({
                    url: '/admin/resources/styles/style_preview/' + ID,
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
                            $('.tpl-list').html(data.html);
                        } else {
                            alert(data.message);
                        }
                    },
                    type: 'POST'
                });
            });

            $("body").on("click", ".add-class-modal", function () {
                $('#class-type').val($(this).attr('data-type'));
                $('#addSub').modal();
            });

            $("body").on("click", ".tpl-left-items", function () {
                var main_type = $(this).attr('main-type');
                var sub = $(this).attr('sub');

                if (!sub) {
                    sub = false;
                }

                $('.tpl-left-items').parent().removeClass('active_class');

                $('*[main-type="' + main_type + '"]').parent().addClass('active_class');

                $.ajax({
                    url: '/admin/resources/styles/render-styles',
                    data: {
                        main_type: main_type,
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
            });
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
                var s_id = $(this).attr('data-styleId');
                var selector = ".popup_div_" + id;

                $.ajax({
                    url: '/admin/resources/styles/show_popup',
                    data: {
                        id: id,
                        s_id: s_id,
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
                            var myWidth = $(document).width();
                            if (myWidth > 765) {
                                $('body').find(selector).css({
                                    'height': (scrollTop < 182 ? $(window).height() - (182 - scrollTop) - 10 : $(window).height() - 20),
                                    "top": (scrollTop < 182 ? 0 : scrollTop - 182 + 10)
                                });
                                $('body').find(selector).slideToggle("slow");
                                $("body").css("overflow", "hidden");
                            }
                            else if (myWidth < 765) {
                                $('body').find(selector).css({
                                    'height': (scrollTop < 225 ? $(window).height() - (225 - scrollTop) - 10 : $(window).height() - 20),
                                    "top": (scrollTop < 225 ? 0 : scrollTop - 225 + 10)
                                });
                                $('body').find(selector).slideToggle("slow");
                                $("body").css("overflow", "hidden");
                            }

                            var editor = ace.edit("editor");
                            editor.setTheme("ace/theme/monokai");
                            editor.getSession().on('change', function () {
                                var getcss = editor.getSession().getValue();
                                var outgetcss = '.outputpreview .item-to-change{' + getcss + '}';
                                $('#css_editor').val(getcss);
                                $('[ data-preview="css"]').html(outgetcss);
                            });
                            var getcss = editor.getSession().getValue();
                            var outgetcss = '.outputpreview .item-to-change{' + getcss + '}';
                            $('[ data-preview="css"]').html(outgetcss);

                            $(".saveCss").on("click", function () {
                                var css = $('#css_editor').val();
                                var id = $('input[name="styleitom"]').val();
                                $.ajax({
                                    url: '/admin/resources/styles/style_preview/css',
                                    data: {
                                        css: css,
                                        id: id
                                    },
                                    dataType: 'json',
                                    headers: {
                                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                                    },
                                    success: function (data) {
                                        if (!data.error) {
                                            $('#msg').html(data).fadeIn('slow');
                                            $('#msg').html("Style updated successfully !").fadeIn('slow');
                                            $('#msg').delay(4000).fadeOut('slow');
                                        } else {
                                            alert(data.message);
                                        }
                                    },
                                    type: 'POST'
                                });
                            });

                        } else {
                            alert(data.message);
                        }
                        var css = $('#editor').text();
                        $('.item-to-change').attr('style', css)


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
