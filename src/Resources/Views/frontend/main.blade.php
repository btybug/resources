@extends('btybug::layouts.mTabs',['index'=>'frontend'])
@section('tab')
    <div role="tabpanel" class="m-t-10" id="main">
        <div class="col-md-9">
            {!! Form::model($system,['class' => 'form-horizontal','files' => true]) !!}
            <fieldset>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="site_name">Site Name</label>
                    <div class="col-md-4">
                        {!! Form::text('site_name',null,['form-control input-md']) !!}
                    </div>
                </div>

                <!-- FILE -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="textarea">Site Logo</label>
                    <div class="col-md-4">
                        {!! Form::file('site_logo',['class' => 'form-control input-md']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="textarea">Site Description</label>
                    <div class="col-md-4">
                        {!! Form::textarea('site_desc',null,['class' => 'form-control input-md']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="textarea">Select Header</label>
                    <div class="col-md-4">
                        {!! BBbutton('templates','header_tpl','Select Header',['class' => 'form-control input-md btn-danger','data-type' => 'header','model' =>$system]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="textarea">Select Footer</label>
                    <div class="col-md-4">
                        {!! BBbutton('templates','footer_tpl','Select Footer',['class' => 'form-control input-md btn-danger','data-type' => 'footer','model' =>$system]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="textarea">Default layout</label>
                    <div class="col-md-4">
                        {!! BBbutton('templates','layout','Select Layout',['class' => 'form-control input-md btn-danger','data-type' => 'frontlayouts','model' =>$system]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="textarea">Default side bar 1</label>
                    <div class="col-md-4">
                        {!! BBbutton('templates','sidebar1','Select Sidebar 1',['class' => 'form-control input-md btn-danger','data-type' => 'sidebars','model' =>$system]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="textarea">Default side bar 2</label>
                    <div class="col-md-4">
                        {!! BBbutton('templates','sidebar2','Select Sidebar 2',['class' => 'form-control input-md btn-danger','data-type' => 'sidebars','model' =>$system]) !!}
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <div class="col-md-4 pull-right">
                        {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
                    </div>
                </div>

            </fieldset>
            {!! Form::close() !!}
            <div class="modal fade" id="magic-settings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                {{--{!! Form::open(['url'=>'/admin/backend/theme-edit/live-save', 'id'=>'magic-form']) !!}--}}
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            {{--{!! Form::submit('Save',['class' => 'btn btn-success pull-right m-r-10']) !!}--}}
                            <h4 class="modal-title" id="myModalLabel"></h4>
                        </div>
                        <div class="modal-body" style="min-height: 500px;">

                            <div id="magic-body">

                            </div>
                        </div>
                    </div>
                </div>
                {{--{!! Form::close() !!}--}}
            </div>
        </div>
    </div>
@stop
@section('JS')
    {!! HTML::script("/resources/assets/js/UiElements/bb_styles.js?v.5") !!}
@stop
