{{--{!! $htmlBody !!}--}}
        <!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <title>BB Admin Framework</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    {!! HTML::style("/css/bootstrap.css") !!}
    {!! HTML::style("/js/font-awesome/css/font-awesome.min.css") !!}
    {!! HTML::style("/resources/resources/js/jqueryui/css/jquery-ui.min.css") !!}
    {!! HTML::style("/css/core_styles.css") !!}
    {!! HTML::script("js/jquery-2.1.4.min.js") !!}
    {!! HTML::script("js/jqueryui/js/jquery-2.1.4.min.js") !!}
    {!! HTML::script("js/bootstrap.min.js") !!}
    {{ csrf_field() }}
    <style data-generatedcss="csss"></style>
    <style data-generatedcss="extra"></style>
</head>
<body>
{{--iframe--}}
<div class="bbifreampreview">
    <iframe data-reloadiframe="iframe1" id="layoutViewSetting"
            src="{!! url('/admin/templates/settings-iframe-layout',$layout) !!}"></iframe>
    <iframe data-reloadiframe="iframe2" class="hide"
            src="{!! url('/admin/templates/settings-iframe-layout',$layout) !!}"></iframe>
</div>
<input type="hidden" data-selectedlayout="" value="{!! url('/admin/templates/settings-iframe-layout',$layout) !!}">
<input type="hidden" data-url="{!! url('/admin/templates/front-layout-settings',$layout) !!}">
<div class="bbsettingheader">
    <button type="button" class="btn btn-info " data-bblayoutaction="setting"><i class="glyphicon glyphicon-cog"></i>
    </button>
</div>
<div class="layoutCoresetting animated bounceInRight hide" data-settinglive="settings">
    <div class="container-fluid">
        <form>
            {!! $htmlSettings !!}
        </form>
    </div>
</div>

{!! HTML::style("/js/animate/css/animate.css") !!}
{!! HTML::style("/css/preview-template.css") !!}
{!! HTML::script("js/UiElements/ui-previewlayout.js") !!}
</body>
</html>