@extends('layouts.admin')

@section('content')

    {!! Form::model($settings,['url'=>'/admin/resources/widgets/settings/'.$id, 'id'=>'add_custome_page','files'=>true]) !!}
    <div class="row">
        @if($ui->have_settings)
            {!! $ui->renderSettings(compact('settings')) !!}
        @else
            <div class="col-md-9">No Settings Available</div>
        @endif
    </div>
    @if(isset($ui->use_sys_save_btn))
        @if($ui->use_sys_save_btn == "yes")
            <div class="col-md-3">
                <button id="settings_savebtn" class="btn btn-success btn-block" type="submit">Save Changes</button>
            </div>
        @endif
    @else
        <div class="col-md-3">
            <button id="settings_savebtn" class="btn btn-success btn-block" type="submit">Save Changes</button>
        </div>
    @endif
    {!! Form::close() !!}
@stop

@section('JS')
    {!! HTML::script('/public/editor/tinymice/tinymce.min.js') !!}
    <script>
        tinymce.init({
            selector: '#content', // change this value according to your HTML
            height: 500,
            theme: 'modern',
            plugins: [

                'code fullscreen',


            ],

            image_advtab: true
        });
    </script>
@stop
