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
            <div class="col-md-6 text-right"><a href="/admin/Resources/classes/buttons"
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
                                <label for="" class="col-sm-3">Css For</label>
                                <div class="col-sm-8 p-0">
                                    <div class="form-inline p-0">
                                        <div class="checkbox radio">
                                            <input type="radio" name="cssfor" value="0" data-value=""
                                                   data-rolecss="cssfor" checked>
                                            <label> Normal </label>
                                        </div>
                                        <div class="checkbox radio ">
                                            <input type="radio" value="1" data-value=":hover" data-rolecss="cssfor"
                                                   name="cssfor">
                                            <label> Hover </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="display" class="col-sm-3">Display</label>
                                <div class="col-sm-8">
                                    {!! Form::select('fontfamily',
                                    ['none'=>'none',
                                    'block'=>'block',
                                    'inline'=>'inline',
                                    'inline-block'=>'inline-block',
                                    'inline-table'=>'inline-table',
                                    'inline-flex'=>'inline-flex',
                                    'flex'=>'flex'
                                    ],'none',
                                    ['class'=>'form-control',
                                    'data-css'=>'display',
                                    'data-selector'=>'display',
                                    'data-width'=>'130px']) !!}

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="borderStyle" class="col-sm-3">Border Style</label>
                                <div class="col-sm-8">
                                    {!! Form::select('fontfamily',
                                    ['none'=>'None',
                                    'solid'=>'Solid',
                                    'dashed'=>'Dashed',
                                    'dotted'=>'Dotted',
                                    'double'=>'Double',
                                    'groove'=>'Groove',
                                    'hidden'=>'Hidden',
                                    'inset'=>'Inset',
                                    'outset'=>'Outset',
                                    'ridge'=>'Ridge',

                                    ],'none',
                                    ['class'=>'form-control',
                                    'data-css'=>'border-style',
                                    'data-selector'=>'fontfamily',
                                    'data-width'=>'130px']) !!}

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="borderwidth" class="col-sm-3">Border width</label>
                                <div class="col-sm-8">
                                    <div class="fullSliderw settingSlider greenSlider m-t-5" data-css="border-width"
                                         data-css-after="px" data-slide-min="0" data-slide-max="100" data-slide-step="1"
                                         data-slide-val="0"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="borderradius" class="col-sm-3">Border Radius</label>
                                <div class="col-sm-8">
                                    <div class="fullSliderw settingSlider greenSlider m-t-5" data-css="border-radius"
                                         data-css-after="px" data-slide-min="0" data-slide-max="100" data-slide-step="1"
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
                                <label for="labelposition" class="col-sm-3">Text-color</label>
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
                                         data-css-after="px" data-slide-min="0" data-slide-max="100" data-slide-step="1"
                                         data-slide-val="0"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="font-size" class="col-sm-3">font-size</label>
                                <div class="col-sm-8">
                                    <div class="fullSliderw settingSlider greenSlider m-t-5" data-css="font-size"
                                         data-css-after="px" data-slide-min="0" data-slide-max="100" data-slide-step="1"
                                         data-slide-val="15"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="line-height" class="col-sm-3">line-height</label>
                                <div class="col-sm-8">
                                    <div class="fullSliderw settingSlider greenSlider m-t-5" data-css="line-height"
                                         data-css-after="px" data-slide-min="0" data-slide-max="100" data-slide-step="1"
                                         data-slide-val="15"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="textalign" class="col-sm-3">Text Alignment</label>
                                <div class="col-sm-8">
                                    <select class="form-control" data-css="text-align" data-selector="textalign"
                                            data-width="130px">
                                        <option value="left" selected>left</option>
                                        <option value="center">center</option>
                                        <option value="right">right</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 p-t-15 p-r-15">
            <div class="text-left p-t-40 p-b-40 m-b-40" data-tool="preview">
                <div class="previewimageview">
                    <div>
                        <a href="#" class="" data-role="classview">Button</a>
                    </div>
                </div>

            </div>
            <h5>jsonData</h5>
            <textarea class="form-control" data-export="json">    @if(isset($variation)) {!! $variation->json_data
                !!}@else
                    {"class":"classname","savedcss":".classname{}","classname":".classname","css":{}}@endif</textarea>
            <h5>css</h5>
            <textarea class="form-control" data-export="css">{!! $variation->css_data or 'ss'!!}</textarea>
        </div>
        @if(isset($variation))
            <input type="hidden" id="class_type" value="{!! $variation->classe->extra_key !!}">
        @else
            <input type="hidden" id="class_type" value="{!! $class->extra_key !!}">
        @endif
        <div class="cssCode collapse" data-css-view="css" id="codeCss"></div>
    </div>
@stop


@section('CSS')
    <style id="savedcss" data-role="savedcss">
    </style>
    {!! HTML::style('public/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') !!}
    {!! HTML::style('public/libs/bootstrap-select/css/bootstrap-select.min.css') !!}
    {!! HTML::style('public/libs/animate/css/animate.css') !!}
    {!! HTML::style('public/css/tool-css.css?v=0.25') !!}
@stop
@section('JS')
    {!! HTML::script('/public/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') !!}
    {!! HTML::script('/public/libs/bootbox/js/bootbox.min.js') !!}
    {!! HTML::script('/public/libs/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('/public/js/class-button-builder.js?v=0.4') !!}
@stop
