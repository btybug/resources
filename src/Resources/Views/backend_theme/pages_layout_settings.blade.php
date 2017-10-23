@extends('layouts.uiPreview')

@section('content')
    <div class="center-block" id="widget_container">
        {!! $html !!}
    </div>
    <input type="hidden" value={!! $json !!} id="hidden_data">
@stop

@section('settings')
    {!! Form::model($model,['id'=>'add_custome_page']) !!}
    @include($settingsHtml)
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

@stop
@section('JS')
    {!! HTML::script('js/UiElements/content-layout-settings.js') !!}
@stop
