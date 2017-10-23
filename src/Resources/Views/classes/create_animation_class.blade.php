@extends('layouts.admin')
@section('content')
    <div class="row toolbarNav" style="padding-bottom:0px;">
        <div class="row">
            <div class="col-md-6">
                <div class="form-horizontal">
                    <div class="form-group p-l-20">
                        <label for="classname" class=" col-xs-3 control-label text-left">Variation Name</label>

                        <div class="col-xs-7">
                            <input type="text" class="form-control" value="{!! $classes->name or 'classname' !!}"
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
                                <label for="animationname" class="col-sm-3">Animation Name</label>
                                <div class="col-sm-8">
                                    <select class="form-control" data-css="animation-name" data-selector="animationname"
                                            data-width="130px">
                                        <option value="none">No Animation</option>
                                        <option value="bounce">bounce</option>
                                        <option value="flash">flash</option>
                                        <option value="pulse">pulse</option>
                                        <option value="rubberBand">rubberBand</option>
                                        <option value="shake">shake</option>
                                        <option value="headShake">headShake</option>
                                        <option value="swing">swing</option>
                                        <option value="tada">tada</option>
                                        <option value="wobble">wobble</option>
                                        <option value="jello">jello</option>
                                        <option value="bounceIn">bounceIn</option>
                                        <option value="bounceInDown">bounceInDown</option>
                                        <option value="bounceInLeft">bounceInLeft</option>
                                        <option value="bounceInRight">bounceInRight</option>
                                        <option value="bounceInUp">bounceInUp</option>
                                        <option value="bounceOut">bounceOut</option>
                                        <option value="bounceOutDown">bounceOutDown</option>
                                        <option value="bounceOutLeft">bounceOutLeft</option>
                                        <option value="bounceOutRight">bounceOutRight</option>
                                        <option value="bounceOutUp">bounceOutUp</option>
                                        <option value="fadeIn">fadeIn</option>
                                        <option value="fadeInDown">fadeInDown</option>
                                        <option value="fadeInDownBig">fadeInDownBig</option>
                                        <option value="fadeInLeft">fadeInLeft</option>
                                        <option value="fadeInLeftBig">fadeInLeftBig</option>
                                        <option value="fadeInRight">fadeInRight</option>
                                        <option value="fadeInRightBig">fadeInRightBig</option>
                                        <option value="fadeInUp">fadeInUp</option>
                                        <option value="fadeInUpBig">fadeInUpBig</option>
                                        <option value="fadeOut">fadeOut</option>
                                        <option value="fadeOutDown">fadeOutDown</option>
                                        <option value="fadeOutDownBig">fadeOutDownBig</option>
                                        <option value="fadeOutLeft">fadeOutLeft</option>
                                        <option value="fadeOutLeftBig">fadeOutLeftBig</option>
                                        <option value="fadeOutRight">fadeOutRight</option>
                                        <option value="fadeOutRightBig">fadeOutRightBig</option>
                                        <option value="fadeOutUp">fadeOutUp</option>
                                        <option value="fadeOutUpBig">fadeOutUpBig</option>
                                        <option value="flip">flip</option>
                                        <option value="flipInX">flipInX</option>
                                        <option value="flipInY">flipInY</option>
                                        <option value="flipOutX">flipOutX</option>
                                        <option value="flipOutY">flipOutY</option>
                                        <option value="lightSpeedIn">lightSpeedIn</option>
                                        <option value="lightSpeedOut">lightSpeedOut</option>
                                        <option value="rotateIn">rotateIn</option>
                                        <option value="rotateInDownLeft">rotateInDownLeft</option>
                                        <option value="rotateInDownRight">rotateInDownRight</option>
                                        <option value="rotateInUpLeft">rotateInUpLeft</option>
                                        <option value="rotateInUpRight">rotateInUpRight</option>
                                        <option value="rotateOut">rotateOut</option>
                                        <option value="rotateOutDownLeft">rotateOutDownLeft</option>
                                        <option value="rotateOutDownRight">rotateOutDownRight</option>
                                        <option value="rotateOutUpLeft">rotateOutUpLeft</option>
                                        <option value="rotateOutUpRight">rotateOutUpRight</option>
                                        <option value="hinge">hinge</option>
                                        <option value="rollIn">rollIn</option>
                                        <option value="rollOut">rollOut</option>
                                        <option value="zoomIn">zoomIn</option>
                                        <option value="zoomInDown">zoomInDown</option>
                                        <option value="zoomInLeft">zoomInLeft</option>
                                        <option value="zoomInRight">zoomInRight</option>
                                        <option value="zoomInUp">zoomInUp</option>
                                        <option value="zoomOut">zoomOut</option>
                                        <option value="zoomOutDown">zoomOutDown</option>
                                        <option value="zoomOutLeft">zoomOutLeft</option>
                                        <option value="zoomOutRight">zoomOutRight</option>
                                        <option value="zoomOutUp">zoomOutUp</option>
                                        <option value="slideInDown">slideInDown</option>
                                        <option value="slideInLeft">slideInLeft</option>
                                        <option value="slideInRight">slideInRight</option>
                                        <option value="slideInUp">slideInUp</option>
                                        <option value="slideOutDown">slideOutDown</option>
                                        <option value="slideOutLeft">slideOutLeft</option>
                                        <option value="slideOutRight">slideOutRight</option>
                                        <option value="slideOutUp">slideOutUp</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="animationduration" class="col-sm-3">Animation Duration</label>
                                <div class="col-sm-8">
                                    <div class="fullSliderw settingSlider greenSlider m-t-5"
                                         data-css="animation-duration" data-css-after="s" data-slide-min="0"
                                         data-slide-max="10" data-slide-step="0.1" data-slide-val="1"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="animationdelay" class="col-sm-3">Animation Delay</label>
                                <div class="col-sm-8">
                                    <div class="fullSliderw settingSlider greenSlider m-t-5" data-css="animation-delay"
                                         data-css-after="s" data-slide-min="0" data-slide-max="10" data-slide-step="0.1"
                                         data-slide-val="0.1"></div>
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
                        <div class="well">
                            <h1>Preview Animation</h1>
                        </div>
                    </div>
                </div>

            </div>
            <h5>jsonData</h5>
            <textarea class="form-control" data-export="json">    @if(isset($variation)) {!! $variation->json_data
                !!}@else{"class":"classname","savedcss":".classname{animation-name:flash; animation-duration:1.2s;
                animation-delay:0.6s;
                }","classname":".classname","css":{"animation-name":"flash","animation-duration":"1.2s","animation-delay":"0.7s"}}@endif</textarea>
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
    {!! HTML::style('public/css/tool-css.css?v=0.23') !!}
@stop
@section('JS')
    {!! HTML::script('/public/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') !!}
    {!! HTML::script('/public/libs/bootbox/js/bootbox.min.js') !!}
    {!! HTML::script('/public/libs/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('/public/js/class-animation-builder.js?v=0.3') !!}
@stop
