@extends('layouts.admin')
@section('content')
    <div class="row toolbarNav" style="padding-bottom:0px;">
        <div class="row">
            <div class="col-md-6">
                <div class="form-horizontal">
                    <div class="form-group p-l-20">
                        <label for="classname" class=" col-xs-3 control-label text-left">Variation Name</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" value="{!! $containers->name or 'classname' !!}"
                                   id="classname" data-role="classname" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-right"><a href="/admin/resources/classes/notification"
                                                class="btn btn-default btn-default-gray">Discard</a> <a href="#"
                                                                                                        class="btn btn-danger btn-danger-red"
                                                                                                        data-save="class">Save</a>
                <input type="hidden" id="classID" value="">
            </div>
        </div>
    </div>

    <div class="row toolrowsection bootbox">
        <div class="col-md-6 tooleditsection">
            <div id="panelTool">
                <div class="tab-content p-t-40 ">
                    <div role="tabpanel" class="tab-pane active style" id="style">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="borderStyle" class="col-sm-3">Border Style</label>
                                <div class="col-sm-8">
                                    <select class="form-control" data-css="border-style" data-selector="fontfamily"
                                            data-width="130px">
                                        <option value="solid" selected>Solid</option>
                                        <option value="dashed">Dashed</option>
                                        <option value="dotted">Dotted</option>
                                        <option value="double">Double</option>
                                        <option value="groove">Groove</option>
                                        <option value="hidden">Hidden</option>
                                        <option value="inset">Inset</option>
                                        <option value="none">None</option>
                                        <option value="outset">Outset</option>
                                        <option value="ridge">Ridge</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="borderwidth" class="col-sm-3">Border width</label>
                                <div class="col-sm-8">
                                    <div class="fullSliderw settingSlider greenSlider m-t-5" data-css="border-width"
                                         data-css-after="px" data-slide-min="1" data-slide-max="100" data-slide-step="1"
                                         data-slide-val="0"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="borderradius" class="col-sm-3">Border Radius</label>
                                <div class="col-sm-8">
                                    <div class="fullSliderw settingSlider greenSlider m-t-5" data-css="border-radius"
                                         data-css-after="px" data-slide-min="1" data-slide-max="100" data-slide-step="1"
                                         data-slide-val="0"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="border-color" class="col-sm-3">Border Color</label>
                                <div class="col-sm-8">
                                    <div class="input-group color-picker input-color input-color-inblock"
                                         data-textcolor="border-color">
                                        <input type="text" class="form-control hide" id="" value="#000" name=""
                                               data-css="border-color">
                                        <span class="input-group-addon"><i></i></span></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="backgound-color" class="col-sm-3">background-color</label>
                                <div class="col-sm-8">
                                    <div class="input-group color-picker input-color input-color-inblock"
                                         data-textcolor="background-color">
                                        <input type="text" class="form-control hide" id="" value="#000" name=""
                                               data-css="background-color">
                                        <span class="input-group-addon"><i></i></span></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="color" class="col-sm-3">Color</label>
                                <div class="col-sm-8">
                                    <div class="input-group color-picker input-color input-color-inblock"
                                         data-textcolor="color">
                                        <input type="text" class="form-control hide" id="" value="#000" name=""
                                               data-css="color">
                                        <span class="input-group-addon"><i></i></span></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="padding" class="col-sm-3">Padding</label>
                                <div class="col-sm-8">
                                    <div class="fullSliderw settingSlider greenSlider m-t-5" data-css="padding"
                                         data-css-after="px" data-slide-min="1" data-slide-max="100" data-slide-step="1"
                                         data-slide-val="0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 p-t-15 p-r-15">
            <div class="text-left p-t-40 p-b-40 m-b-40" data-tool="preview">
                <div role="alert" class="" data-notify="container" data-role="classview">
                    <button data-notify="dismiss" class="close" aria-hidden="true" type="button">×</button>
                    You can not close me!
                </div>


            </div>
            <h5>jsonData</h5>
            <textarea class="form-control"
                      data-export="json">    @if(isset($variation)) {!! $variation->json_data !!}@else
                    {"class":"classname","savedcss":".classname{border-radius:7px; border-width:1px; border-style:solid;
                    border-color:#e59898; background-color:#ffdcdc; padding:11px; color:#ce4444;
                    }","classname":".classname","css":{"border-radius":"7px","border-width":"1px","border-style":"solid","border-color":"#e59898","background-color":"#ffdcdc","padding":"12px","color":"#ce4444"}}@endif</textarea>
            <h5>css</h5>
            <textarea class="form-control" data-export="css">{!! $variation->css_data or 'ss'!!}</textarea>
        </div>
        <div class="cssCode collapse" data-css-view="css" id="codeCss"></div>
    </div>

    <input type="hidden" id="classes_links"
           value=@if(!isset($class)){!!url('/admin/resources/classes/edit-class-variation',$variation->id)!!}@else{!! url('/admin/resources/classes/create-class-variation',$class->id) !!}@endif>

@stop

@section('CSS')
    <style id="savedcss" data-role="savedcss">
    </style>
    {!! HTML::style('public/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') !!}
    {!! HTML::style('public/libs/bootstrap-select/css/bootstrap-select.min.css') !!}
    {!! HTML::style('public/libs/animate/css/animate.css') !!}
    {!! HTML::style('public/css/tool-css.css?v=0.22') !!}
@stop
@section('JS')
    {!! HTML::script('/public/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') !!}
    {!! HTML::script('/public/libs/bootbox/js/bootbox.min.js') !!}
    {!! HTML::script('/public/libs/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('/public/js/class-notification-builder.js') !!}
@stop
