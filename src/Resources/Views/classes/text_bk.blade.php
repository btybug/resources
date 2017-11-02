@extends('btybug::layouts.mTabs',['index'=>'classes'])
@section('parag')
    {!! Breadcrumbs::render('classes_text') !!}
@stop

<!-- Nav tabs -->
@section('tab')
    <div class="row">
        <div class="col-md-12 p-10">
            <div class="text-right">
                <button class="btn btn-warning btnadd" data-action="addnew" data-toggle="collapse"
                        data-target="#addnewform"><i class="fa fa-plus"></i> New Text Class
                </button>
            </div>
            {!! Form::open(['url' => '/admin/resources/classes/create-class', 'method' => 'post']) !!}
            {!! Form::hidden('type','text') !!}
            <div id="edit_class_id">

            </div>
            <div id="addnewform" class="addnewitems collapse" aria-expanded="true">
                <div class="panel panel-default" style="margin-top: 10px;">
                    <div class="panel-heading  bg-black-darker text-white">New Class</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="addtext" class="">Class Name</label>
                                    <input id="addtext" name="className" type="text" placeholder="Class Name"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group datafrom" data-type="uploadmedia" data-size="col-sm-12"
                                     data-fields="core">
                                    <div class="row">
                                        <div data-fcontrol="input" class="col-sm-12 p-0">
                                            <div class="col-md-6  p-0 p-b-10">
                                                <label for="singleline" data-fcontrol="label"
                                                       class="col-sm-12 control-label p-l-0">Upload Media</label>
                                                <button data-role="browseMedia" class="btn btn-default" type="button">
                                                    Select Image
                                                </button>
                                            </div>
                                            <div class="col-md-6 p-0">
                        <span class="imagepreview filehtml">

                        </span>
                                                {!! Form::text('image', null ,['class' => 'form-control fileParth hide']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success save m-l-10" data-action="save" data-role="addnew">
                            Save
                        </button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!} </div>
    </div>
    <div class="container col-md-12"> {{--<a href="{!! url('/admin/resources/classes/create-text-class') !!}" class="btn btn-success" style="float: right;">+new--}}
        {{--text class</a>--}}
        <table class="table table-bordered m-0">
            <thead>
            <tr class="bg-black-darker text-white">
                <th width="15%">image</th>
                <th width="15%">Class name</th>
                <th>Option</th>
                <th width="200">Action</th>
            </tr>
            </thead>
            <tbody>

            @foreach($classes as $class)
                <tr>
                    <td>
                        <div style="display: block;overflow: hidden;max-width: 50%;max-height: 100px;"><img
                                    src="{!! $class->image !!}"></div>
                    </td>
                    <td><a data-pk="{{$class->id}}" style="cursor: pointer;"
                           class="editable editable-click">{!! $class->name !!}</a></td>
                    <td>boold,17,arial..ect</td>
                    <td>
                        @if($class->role)
                            <a href="{!! url('/admin/resources/classes/delete',$class->id)!!}" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>

                            <button data-id="{!! $class->id !!}"
                                    data-name="{!! $class->name !!}"
                                    data-image="{!! $class->image !!}"
                                    class="btn btn-info edit-class"
                                    data-action="addnew" data-toggle="collapse"
                                    data-target="#addnewform"
                            >
                                <i class="fa fa-edit"></i>
                            </button>
                        @endif
                        <a href="{!! url('/admin/resources/classes/variation-class',$class->id)!!}"
                           class="btn btn-success">
                            <i class="fa fa-crop">variation</i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="AddNewClass" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            {!! Form::open(['url' => '/admin/resources/classes/create-text-class', 'method' => 'post']) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add New Text Class</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="class-name">Class Name</label>
                        {!! Form::text('class',null,['class' => 'form-control class-name']) !!} </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="addNews">Save</button>
                </div>
                {!! Form::close() !!} </div>
        </div>
    </div>
@stop
@section('CSS')
    {!! HTML::style('/public/libs/bootstrap-editable/css/bootstrap-editable.css') !!}
@stop
@section('JS')
    {!! HTML::script('/public/libs/bootstrap-editable/js/bootstrap-editable.min.js') !!}
    <script>

        $('document').ready(function () {
            $.fn.editable.defaults.mode = 'inline';
            $('.editable').editable({
                url: '/admin/resources/classes/edit',
                params: function (params) {
                    params._token = $('#token').val();
                    return params;
                },
                send: 'always',
                ajaxOptions: {
                    dataType: 'html'
                }, success: function (response, newValue) {
                    response = JSON.parse(response);
                    if (response.result == false) return response.msg; //msg will be shown in editable form
                }
            });

//    $('.new-text-style').click(function(){
//        $('#AddNewClass').modal();
//    });
            $('.edit-class').on('click', function () {
                var id = $(this).attr('data-id');
                var name = $(this).attr('data-name');
                var image = $(this).attr('data-image');
                $('.imagepreview').empty();
                $('#edit_class_id').empty();
                $('#addtext').val(name);
                $('.imagepreview').append($('<img/>', {
                    src: image
                }));
                $('input[name=image]').val(image);
                $('#edit_class_id').append($('<input/>', {
                    type: 'hidden',
                    name: 'id',
                    value: id
                }));

            })
        });
    </script>
@stop
