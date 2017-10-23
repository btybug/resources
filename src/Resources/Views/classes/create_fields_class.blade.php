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
                                <label for="" class="col-sm-3">Fields Type</label>
                                <div class="col-sm-8 p-0">
                                    {!! Form::select('fieldsType',
                                    [
                                    'input'=>'Input',
                                    'textarea'=>'Textarea',
                                    'select'=>'Select',
                                    'radio'=>'radio',
                                    'checkbox'=>'Checkbox',
                                    ],null,
                                     ['class'=>'form-control',
                                    'data-role'=>'fieldsType',
                                    'data-width'=>'130px']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3">Css For</label>
                                <div class="col-sm-8 p-0">
                                    <div class="form-inline p-0">
                                        <div class="checkbox radio">
                                            <input type="radio" name="cssfor" value="0" data-rolecss="cssfor" checked>
                                            <label> Container </label>
                                        </div>
                                        <div class="checkbox radio ">
                                            <input type="radio" value="1" data-rolecss="cssfor" name="cssfor">
                                            <label> Input </label>
                                        </div>
                                    </div>
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

                                    ],null,
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
                            <div class="form-group">
                                <label for="color" class="col-sm-3">Label Position</label>
                                <div class="col-sm-8">
                                    <div aria-label="..." role="group" class="btn-group theme-btn-group label-Position">
                                        <button class="btn btn-default left active" type="button"><i
                                                    class="fa fa-arrow-left"></i></button>
                                        <button class="btn btn-default top" type="button"><i class="fa fa-arrow-up"></i>
                                        </button>
                                        <button class="btn btn-default right" type="button"><i
                                                    class="fa fa-arrow-right"></i></button>
                                        <button class="btn btn-default none" type="button"><i
                                                    class="fa fa-eye-slash"></i></button>
                                    </div>
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
                    <div class="" data-role="classview">
                        <div class="form-group datafrom" data-type="Singleline" data-size="col-sm-12">
                            <div class="row">
                                <label for="singleline" data-fcontrol="label"
                                       class="col-sm-12 control-label">Singleline</label>
                                <div data-fcontrol="input" class="col-sm-12">
                                    <input type="text" name="singleline" class="form-control" id="singleline"
                                           placeholder="singleline">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-role="previewElementView" class="hide">
                    <div data-field="input">
                        <div class="form-group datafrom" data-type="Singleline" data-size="col-sm-12">
                            <div class="row">
                                <label for="singleline" data-fcontrol="label"
                                       class="col-sm-12 control-label">Singleline</label>
                                <div data-fcontrol="input" class="col-sm-12">
                                    {!! Form::text('singleline',null,['class'=>'form-control', 'id'=>'singleline','placeholder'=>'singleline']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-field="select">
                        <div class="form-group datafrom" data-type="Select">
                            <div class="row">
                                <label for="Select" data-fcontrol="label" class="col-sm-12 control-label">Select</label>
                                <div class="col-sm-12" data-fcontrol="input">
                                    <select name="Select" class="form-control" data-content="Please select an option">
                                        <option value="0" selected="selected">--- Select ---</option>
                                        <option value="Option 1">Option 1</option>
                                        <option value="Option 2">Option 2</option>
                                        <option value="Option 3">Option 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-field="radio">
                        <div class="form-group  datafrom" data-type="rediobuttons">
                            <div class="row">
                                <label for="optionsRadios" data-fcontrol="label" class="col-sm-12 control-label">Redio
                                    buttons</label>
                                <div data-fcontrol="input" class="col-sm-12">
                                    <div class="radio checkbox">
                                        {!! Form::radio('optionsRadios','Redio 1',null,['name'=>'optionsRadios','id'=>'optionsRadios1']) !!}
                                        <label> Redio 1</label>
                                    </div>
                                    <div class="radio checkbox">
                                        {!! Form::radio('optionsRadios','Redio 2',null,['name'=>'optionsRadios','id'=>'optionsRadios2']) !!}
                                        <label> Redio 2 </label>
                                    </div>
                                    <div class="radio checkbox">
                                        {!! Form::radio('optionsRadios','Redio 3',null,['name'=>'optionsRadios','id'=>'optionsRadios3']) !!}
                                        <label> Redio 3 </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-field="checkbox">
                        <div class="form-group datafrom" data-type="checkbuttons">
                            <div class="row">
                                <label for="optionsrecheck" data-fcontrol="label" class="col-sm-12 control-label">Check
                                    buttons</label>
                                <div data-fcontrol="input" class="col-sm-12">
                                    <div class="checkbox">
                                        <input type="checkbox" value="checkbox 1">
                                        <label> checkbox 1 </label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" value="checkbox 2">
                                        <label> checkbox 1 </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-field="textarea">
                        <div class="form-group datafrom" data-type="Singleline" data-size="col-sm-12">
                            <div class="row">
                                <label for="" data-fcontrol="label" class="col-sm-12 control-label">Textarea</label>
                                <div data-fcontrol="input" class="col-sm-12">
                                    <textarea class="form-control" placeholder="singleline"></textarea>
                                </div>
                            </div>
                        </div>
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
    <input type="hidden" id="classes_links"
           value=@if(!isset($class)){!!url('/admin/resources/classes/edit-class-variation',$variation->
id)!!}@else{!! url('/admin/resources/classes/create-class-variation',$class->id) !!}@endif>
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
    {!! HTML::script('/public/js/class-fields-builder.js?v=0.4') !!}
@stop
