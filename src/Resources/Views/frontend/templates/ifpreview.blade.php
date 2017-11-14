{!! HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css') !!}
{!! HTML::style("/resources/views/layouts/themes/admintheme/css/font-awesome/css/font-awesome.min.css") !!}

{!! HTML::script('public/js/jquery-2.1.4.min.js') !!}
{!! HTML::script('public/js/bootstrap.min.js') !!}

@if($edit)
    <style>
        [data-layoutplaceholders] {
            cursor: cell
        }
    </style>
@endif
<body>
{!! csrf_field() !!}
{!! Form::open(['url'=>'/admin/resources/templates/settings/'.$id, 'id'=>'add_custome_page','files'=>true]) !!}
<div class="body_ui previewlivesettingifream" id="widget_container">
    {!! $htmlBody !!}
</div>
{!! Form::close() !!}
@include('resources::assests.magicModal')
<body>
@if($edit)
    {!! HTML::script("public/js/UiElements/bb_styles.js?v.5") !!}
    {!! HTML::script("public/js/UiElements/ui-preview-setting.js") !!}
    {!! HTML::script("public/js/UiElements/ui-settings.js") !!}
@endif