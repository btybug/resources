@extends('layouts.admin')
@section('content')
    <div class="row toolbarNav" style="padding-bottom:0px;">
        <div class="row">
            <div class="col-md-6">
                <div class="form-horizontal">
                    <div class="form-group p-l-20">
                        <label for="classname" class=" col-xs-3 control-label text-left">Variation Name</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" value="{!! $variation->title or 'classname' !!}"
                                   id="classname" data-role="classname" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-right"><a href="/admin/resources/classes/text"
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
                                <label for="fontFamily" class="col-sm-3">Font Family</label>
                                <div class="col-sm-8">
                                    <select class="form-control" data-css="font-family" data-selector="fontfamily"
                                            data-width="130px">
                                        <option value="Georgia, serif">Georgia, serif</option>
                                        <option value="Times New Roman">Times New Roman</option>
                                        <option value="Arial, Helvetica, sans-serif">Arial</option>
                                        <option value="Helvetica, sans-serif">Helvetica</option>
                                        <option value="Tahoma, Geneva, sans-serif">Tahoma</option>
                                        <option value="Trebuchet MS, Helvetica, sans-serif">Trebuchet MS</option>
                                        <option value="Verdana, Geneva, sans-serif">Verdana</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fontFamily" class="col-sm-3">size</label>
                                <div class="col-sm-8">
                                    <div class="fullSliderw settingSlider greenSlider m-t-5" data-css="font-size"
                                         data-css-after="px" data-slide-min="1" data-slide-max="100" data-slide-step="1"
                                         data-slide-val="12"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fontFamily" class="col-sm-3">Color</label>
                                <div class="col-sm-8">
                                    <div class="input-group color-picker input-color input-color-inblock"
                                         data-textcolor="color">
                                        <input type="text" class="form-control hide" id="" value="#000" name=""
                                               data-css="color">
                                        <span class="input-group-addon"><i></i></span></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fontweight" class="col-sm-3">Font Weight</label>
                                <div class="col-sm-8">
                                    <select class="form-control" data-css="font-weight" data-selector="fontweight"
                                            data-width="130px">
                                        <option value="normal">normal</option>
                                        <option value="lighter">lighter</option>
                                        <option value="bolder">bolder</option>
                                        <option value="bold">bold</option>
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                        <option value="300">300</option>
                                        <option value="400">400</option>
                                        <option value="500">500</option>
                                        <option value="600">600</option>
                                        <option value="700">700</option>
                                        <option value="800">800</option>
                                        <option value="900">900</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fontstyle" class="col-sm-3">Font Style</label>
                                <div class="col-sm-8">
                                    <select class="form-control" data-css="font-style" data-selector="fontstyle"
                                            data-width="130px">
                                        <option value="normal">normal</option>
                                        <option value="italic">italic</option>
                                        <option value="oblique">oblique</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fontvariant" class="col-sm-3">Font Variant</label>
                                <div class="col-sm-8">
                                    <select class="form-control" data-css="font-variant" data-selector="fontvariant"
                                            data-width="130px">
                                        <option value="normal">normal</option>
                                        <option value="small-caps">small-caps</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="textdecoration" class="col-sm-3">Text Decoration</label>
                                <div class="col-sm-8">
                                    <select class="form-control" data-css="text-decoration"
                                            data-selector="textdecoration" data-width="130px">
                                        <option value="none">none</option>
                                        <option value="blink">blink</option>
                                        <option value="line-through">line-through</option>
                                        <option value="overline">overline</option>
                                        <option value="underline">underline</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="texttransform" class="col-sm-3">Text Transform</label>
                                <div class="col-sm-8">
                                    <select class="form-control" data-css="text-transform" data-selector="texttransform"
                                            data-width="130px">
                                        <option value="none">none</option>
                                        <option value="capitalize">capitalize</option>
                                        <option value="lowercase">lowercase</option>
                                        <option value="uppercase">uppercase</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="textalign" class="col-sm-3">Text Align</label>
                                <div class="col-sm-8">
                                    <select class="form-control" data-css="text-align" data-selector="textalign"
                                            data-width="130px">
                                        <option value="left">left</option>
                                        <option value="right">right</option>
                                        <option value="center">center</option>
                                        <option value="justify">justify</option>
                                        <option value="end">end</option>
                                        <option value="start">start</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="letterspacing" class="col-sm-3">Letter Spacing</label>
                                <div class="col-sm-8">
                                    <div class="fullSliderw settingSlider greenSlider m-t-5" data-css="letter-spacing"
                                         data-css-after="px" data-slide-min="-50" data-slide-max="50"
                                         data-slide-step="0.1" data-slide-val="0"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="textindent" class="col-sm-3">Text Indent</label>
                                <div class="col-sm-8">
                                    <div class="fullSliderw settingSlider greenSlider m-t-5" data-css="text-indent"
                                         data-css-after="px" data-slide-min="-500" data-slide-max="500"
                                         data-slide-step="1" data-slide-val="0"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 p-t-15 p-r-15">
            <div class="text-left p-t-40 p-b-40 m-b-40" data-tool="preview">
                <div class="" data-role="classview">Lorem ipsum dolor sit amet,</div>
            </div>
            <h5>jsonData</h5>
            <textarea class="form-control" data-export="json">@if(isset($variation)) {!! $variation->json_data !!}@else
                    {"class":"classname","savedcss":".classname{font-family:Times New Roman; font-size:18px;
                    color:#3e37d2; }","classname":".classname","css":{"font-family":"Times New
                    Roman","font-size":"18px","color":"#3e37d2"}}@endif</textarea>
            <h5>css</h5>
            <textarea class="form-control"
                      data-export="css">@if(isset($variation)) {!! $variation->css_data !!}@endif</textarea>
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
    {!! HTML::style('public/css/tool-css.css?v=0.19') !!}
@stop
@section('JS')
    {!! HTML::script('/public/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') !!}
    {!! HTML::script('/public/libs/bootbox/js/bootbox.min.js') !!}
    {!! HTML::script('/public/libs/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('/public/js/class-builder.js?v=0.19') !!}
@stop
