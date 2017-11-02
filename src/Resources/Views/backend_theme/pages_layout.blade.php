@extends('btybug::layouts.mTabs',['index'=>'backend_settings'])
<!-- Nav tabs -->
@section('tab')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pages_layout">
            <div class="row template-search div_top_31">
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 template-search-box m-t-10 m-b-10">
                    <form class="form-horizontal form_sort_31">
                        <div class="form-group m-b-0">
                            <label for="inputEmail3" class="col-xs-12 col-sm-2 control-label">Sort By</label>
                            <div class="col-xs-12 col-sm-6 col-md-4 for_select_11">
                                <select class="form-control sort-items">
                                    <option>Recently Added</option>
                                </select>
                            </div>
                            <div class="col-sm-2 pull-right for_search_20">
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
            <div class="templates-list m-t-20 m-b-10">
                @if(!is_null($layouts))
                    @foreach($layouts as $layout)
                        <div class="row templates m-b-10 row_template">
                            {!! HTML::image('public/img/ajax-loader5.gif', 'a picture', array('class' => 'thumb img-loader hide')) !!}
                            <div class="raw tpl-list">
                                <div class="row templates m-b-10 template_div_111">
                                    <div class="col-xs-12 p-l-0 p-r-0 for_img_112">
                                        <img src="{!! url('resources\assets\images\template-2.png')!!}"
                                             class="img-responsive"/>
                                    </div>
                                    <div class="col-xs-12 templates-header p-t-10 p-b-10 for_header_112">
                                <span class="pull-left templates-title f-s-15 col-xs-12 col-sm-12 col-md-6 col-lg-6 p-l-0 for_title_111">
                                    <i class="fa fa-bars f-s-13 m-r-5"
                                       aria-hidden="true"></i> {!! $layout->name !!} </span>
                                        <div class="pull-right templates-buttons col-xs-12 col-sm-12 col-md-6 col-lg-6 p-r-0 text-right for_author_111">
                                            <i class="fa fa-user f-s-13 author-icon" aria-hidden="true"></i>
                                            <span class="name_111">author:{!! $layout->author !!}
                                                , {!! BBgetDateFormat($layout->created_at) !!}</span>
                                            <span class="for_icons_111">
                                        <a href="#" class="addons-deactivate  m-r-10 edit_111"><i
                                                    class="fa fa-pencil f-s-14"></i> </a>
                                        <a href="{!! url('/admin/settings/pages-layout/settings',$layout->slug) !!}"
                                           class="addons-deactivate  m-r-10 settings_111"><i
                                                    class="fa fa-cog f-s-14"></i> </a>
                                        <a href="{!! url('/admin/settings/pages-layout/delete',$layout->slug) !!}"
                                           data-href="{!! url('/admin/settings/pages-layout/delete',$layout->slug) !!}"
                                           slug="#" class="addons-delete del-tpl"><i class="fa fa-trash-o f-s-14 "></i> </a>
                                    </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
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
                    {!! Form::open(['url'=>'/admin/settings/upload-layout','class'=>'dropzone', 'id'=>'my-awesome-dropzone']) !!}

                    {!! Form::close() !!} </div>
            </div>
        </div>
    </div>
@stop
@section('CSS')
    {!! HTML::style('/app/Modules/Resources/Resources/assets/css/new-store.css') !!}
    {!! HTML::style('app\Modules\Resources\Resources\assets\css\style_cube.css') !!}
@stop
@section('JS')
    {!! HTML::script('public/libs/dropzone/js/dropzone.js') !!}

    <script>
        $(document).ready(function () {
            Dropzone.options.myAwesomeDropzone = {
                init: function () {
                    this.on("success", function (file) {
                        location.reload();
                    });
                }
            };
        });
    </script>

@stop
