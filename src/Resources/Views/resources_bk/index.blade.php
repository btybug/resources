@extends('layouts.admin')
@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Dashboard</a></li>
        <li class="active">All Assets</li>
    </ol>


    <div class="row">
        <div class="col-md-12">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist" data-tab-action="tabs">
                @foreach($groups as $key=>$group)
                    <li role="presentation" @if($key==0)class="active" @endif><i
                                class="fa  fa-trash-o tabdelete text-danger" data-tab-delete="{{$group['id']}}"></i><a
                                href="#{{$group['id']}}" data-id="{{$group['id']}}" class="p-l-20 p-r-20"
                                aria-controls="general" role="tab" data-toggle="tab">{{$group['term_name']}}</a></li>
                @endforeach


                <li role="actionAddNew" class="pull-right"><a href="#"
                                                              class="btn btn-success btn-xs text-white p-10 p-t-5 p-b-5 m-t-10"
                                                              title="Add New section" data-toggle="modal"
                                                              data-target="#AddNewSection"><i
                                class="fa fa-plus"></i></a></li>
                <!--<li role="presentation"><a href="#test" aria-controls="notifications" role="tab" data-toggle="tab">Test</a></li>-->
            </ul>

            <!-- Tab panes -->
            <div class="p-10 bg-silver  overflow-y-hidden">
                <div class="tab-content m-10 p-15 bg-white overflow-y-hidden" id="sectioncontainer">

                    <div class="row">
                        <a href="/admin/resources/core_resources/create" class="hide">
                            <button class="btn btn-default btn-sm btn-success pull-right m-b-5" type="button"><i
                                        class="fa fa-plus"></i>&nbsp; Add New
                            </button>
                        </a>
                        <button class="btn btn-default btn-success pull-right m-b-5" type="button"
                                data-toggle="collapse" href=".uploadplugins"><i class="fa fa-plus"></i> Upload New
                            Plugin
                        </button>
                    </div>
                    <div class="uploadplugins collapse">
                        {!! Form::open(['url'=>'/admin/resources/core_resources/upload', 'id'=>'myAwesomeDropzone','class'=>'dropzone dz-clickable fileUploadsbox m-b-15']) !!}
                        {!! Form::hidden('group_id', '', array('id' => 'group_id')) !!}
                        <div class="fallback">
                            <input name="file" type="file" multiple/>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    @foreach($groups as $key=>$group)
                        <div role="tabpanel" class="tab-pane @if($key==0) active @endif" id="{{$group['id']}}">
                        </div>
                    @endforeach
                </div>

                <!-- <div role="tabpanel" class="tab-pane" id="test">
                    <div class="m-10 p-15 bg-white">
                    This is for test
                        </div>
                 </div> -->

            </div>


        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="AddNewSection" tabindex="-1" role="dialog" aria-labelledby="AddnewsectionLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add New section</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="SectionTitle" class="sr-only">Title</label>
                        <input type="text" class="form-control" id="Sectiontitle" placeholder="Enter Section Title">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addNews">Save</button>
                </div>
            </div>
        </div>
    </div>
@section('CSS')
    {!! HTML::style('/public/libs/dropzone/css/dropzone.min.css') !!}
@stop

@section('JS')
    {!! HTML::script('public/libs/dropzone/js/dropzone.js') !!}
    <script>
        myzone = Dropzone.options.myAwesomeDropzone = {
            paramName: "file", // The name that will be used to transfer the file
            success: function (file, response) {
                location.reload();
            }
        };


        $(function () {
            $('.actionshow').click(function (e) {
                e.preventDefault();
                thisharf = $(this).data('id');
                $(this).closest('.details').children('[data-show-id]').removeClass('show');
                $(this).closest('.details').children('[data-show-id="' + thisharf + '"]').addClass('show');
            })


            $('#addNews').click(function () {
                getsectionname = $('#Sectiontitle').val();
                if (getsectionname != '') {
                    $.ajax({
                        url: '/admin/resources/core_resources/addgroup',
                        data: {
                            title: getsectionname,
                            _token: $('#token').val()
                        },
                        dataType: 'json',
                        success: function (data) {
                            $('#AddNewSection').modal('hide');
                            location.reload();
                        },
                        type: 'POST'
                    });
                } else {
                    $('#Sectiontitle').focus()
                }
            });
            /* For Get Id */
            $('[data-tab-action="tabs"] a').click(function () {
                getactiveId = $(this).data('id');
                getAssets(getactiveId);
            })

            $('#addNews').click(function () {
                getsectionname = $('#Sectiontitle').val();
                $('#AddNewSection').modal('hide');
                if (getsectionname != '') {
                    $.ajax({
                        url: '/admin/resources/core_resources/addgroup',
                        data: {
                            title: getsectionname,
                            _token: $('#token').val()
                        },
                        dataType: 'html',
                        type: 'POST',
                        success: function (data) {

                            $('#AddNewSection').modal('hide');
                            location.reload();

                        },
                        type: 'POST'
                    });


                } else {
                    $('#Sectiontitle').focus()
                }
            });
            /* For Get Id */
            $('[data-tab-action="tabs"] a').click(function () {
                getactiveId = $(this).data('id');
                getAssets(getactiveId);

            })


            getactiveId = $('#sectioncontainer').find('[role="tabpanel"].active').attr('id');
            getAssets(getactiveId);

            function getAssets(id) {
                $('#group_id').val(id);
                $('#' + id).html('<div class="text-center"><img src="/public/img/ajax-loader5.gif"></div>');
                $.ajax({
                    type: "GET",
                    url: '/admin/resources/core_resources/resources/' + id,
                    success: function (data) {
                        $('#' + id).html(data)
                    }
                });
            }


            $('body').on('click', '[data-install]', function () {
                activeType = $(this).data('install');
                active = $(this);
                id = $(this).data('id');
                if (activeType == 'install') {
                    installPlugin(id, active);
                }
                if (activeType == 'uninstall') {
                    uninstallPlugin(id, active);
                }

            });

            var installPlugin = function (id, th) {
                $.ajax({
                    url: '/admin/resources/core_resources/install',
                    data: {
                        id: id,
                        _token: $('#token').val()
                    },
                    dataType: 'html',
                    type: "POST",
                    success: function (data) {
                        th.removeClass('btn-success');
                        th.html('Un Install').addClass('btn-danger');
                        th.data('install', 'uninstall');
                    }
                });
            }
            var uninstallPlugin = function (id, th) {
                $.ajax({
                    type: "POST",
                    url: '/admin/resources/core_resources/uninstall',
                    data: {
                        id: id,
                        _token: $('#token').val()
                    },
                    success: function (data) {
                        th.removeClass('btn-danger');
                        th.html('Install Me!!').addClass('btn-success');
                        th.data('install', 'install');
                    }
                });
            }


            $('[data-tab-delete]').click(function () {
                var currentid = $(this).data('tab-delete');
                alert(currentid)
            })

        });

    </script>

@stop
@stop
