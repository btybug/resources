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
    <title>Avatarbug TEST</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <link rel="stylesheet" href="{{ asset("/public/libs/font-awesome/css/font-awesome.min.css") }}"/>
    <link rel="stylesheet" href="{{ asset("/public/css/bootstrap.css") }}"/>
    <link rel="stylesheet" id="stylecolor" href="{{ asset("public/css/admin-theme.css?v2.9") }}"/>

    <script src="{{ asset("public/js/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("public/libs/jqueryui/js/jquery-ui.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("public/js/bootstrap.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("public/js/admin.js?v=6.1") }}" type="text/javascript"></script>

    <!--======== Customiser ========-->

    <!-- Color Picker -->
    <script src="{{ asset("public/customiser/colorpicker/jqColorPicker.min.js") }}" type="text/javascript"></script>
    <!-- Number Slider -->
    <link rel="stylesheet" href="{{ asset("/public/customiser/slider/rangeslider.css?v=1") }}"/>
    <script src="{{ asset("public/customiser/slider/rangeslider.min.js") }}" type="text/javascript"></script>
    <!-- Inline Editor -->
    <link rel="stylesheet" href="{{ asset("/public/customiser/inline-editor/css/medium-editor.min.css?v=1") }}"/>
    <link rel="stylesheet" href="{{ asset("/public/customiser/inline-editor/css/themes/default.min.css?v=1") }}"/>
    <script src="{{ asset("public/customiser/inline-editor/js/medium-editor.min.js") }}"
            type="text/javascript"></script>
    <!-- Image Uploader -->
    <script src="{{ asset("public/customiser/image-uploader/dropzone.js") }}" type="text/javascript"></script>


    <style>
        body {
            overflow-y: hidden;
        }

        .no-padding {
            padding: 0;
        }

        .margin-bottom {
            margin-bottom: 15px;
        }

        .customise-tools {
            background: #EEEEEE;
            border-right: 1px solid #dfdfdf;
            position: relative;
        }

        .panel {
            border-radius: 0;
        }

        .customisation-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: #F5F5F5;
            padding: 10px;
            border-top: 1px solid #dfdfdf;
        }

        .customise-panel {
            height: calc(100vh - 116px);
            overflow-y: auto;
        }

        .panel-group {
            margin-bottom: 0;
            border-bottom: 1px solid #dfdfdf;
        }

        .panel.panel-default {
            border: 0;
        }

        #template-area {
            overflow-y: auto;
        }

        .widgets-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .widgets-list > li a {
            border: 1px solid #E0E0E0;
            background: #ECECEC;
            display: table;
            width: 100%;
            padding: 10px;
            cursor: move;
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 10px;
            z-index: 9999999;
        }

        .widgets-list > li a i {
            color: #F17C11;
            margin-right: 10px;
        }

        .customiser-panel {
            display: none;
        }
    </style>

</head>
<body>

<div id="wrapper">

    <div class="container-fluid">
        <div class="row">
            {!! Form::model('customiser',['method'=>'POST','url'=>'/admin/templates/update-customiser', 'id'=>'customiser-form']) !!}
            {!! Form::hidden('variation_id',$variation_id) !!}
            {!! Form::hidden('template',$template_id) !!}
            <input type="hidden" id="token" value="{{ csrf_token() }}">
            <div class="col-md-3 no-padding customise-tools" data-settings='{!!$serializedSettings!!}'>
                <div class="panel panel-default">
                    <div class="panel-body no-padding customise-panel">
                        <!-- Widgets Area -->
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <strong>Available Widgets</strong>
                                        <a href="{{ url('/admin/templates/variations/'.$template_id) }}"
                                           class="pull-right">Back</a>
                                    </h4>
                                </div>
                                <div id="widgets" class="panel-collapse">
                                    <div class="panel-body">
                                        <ul class="widgets-list">
                                            @foreach(BBGetWidgets() as $widget)
                                                <li data-id="{{$widget->id}}">
                                                    <a href="javascript:;">
                                                        <i class="fa fa-map"></i>
                                                        {{ $widget->title }}
                                                    </a>
                                                    <script type="template/html" class="widget-template">
                                                        {{ $widget->content }}
                                                    </script>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Widgets Area -->
                    {{--*/ $selectors = [] /*--}}
                    @foreach($customiser as $tab)
                        @if(isset($tab['selector']))
                            {{--*/  $selectors[] = $tab['selector'] /*--}}
                        @endif
                        <!-- Accordion Group -->
                            <div class="panel-group customiser-panel" id="{{ base64_encode($tab['title']) }}"
                                 role="tablist" data-selector="{{issetReturn($tab, 'selector')}}"
                                 aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#styling"
                                               href="#{{ md5($tab['title']) }}" aria-expanded="true"
                                               aria-controls="colorsBackgrounds">
                                                {{ $tab['title'] }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="{{ md5($tab['title']) }}" class="panel-collapse collapse in"
                                         role="tabpanel">
                                        <div class="panel-body">
                                            @foreach($tab['groups'] as $group)
                                                <fieldset>
                                                    <legend>{{ issetReturn($group, 'title') }}</legend>
                                                @foreach($group['fields'] as $field)
                                                    <!-- Set Data -->
                                                        {{--*/ $fieldData = '' /*--}}
                                                        @if(isset($tab['selector']))
                                                            {{--*/  $fieldData .= ' data-el="'.$tab['selector'].'"' /*--}}
                                                        @endif
                                                        @if(isset($field['css']))
                                                            {{--*/  $fieldData .= ' data-css="'.$field['css'].'"' /*--}}
                                                        @endif

                                                        <div class="form-group">
                                                            <label>{{ $field['title'] }}:</label>
                                                            @if($field['type'] == 'colorpicker')
                                                                <input type="text" class="color-picker form-control"
                                                                       id="{{ $field['name'] }}"
                                                                       name="{{ $field['name'] }}"
                                                                       value="{{ isset($settings[$field['name']]) ? $settings[$field['name']] : '' }}" {!!$fieldData!!}/>
                                                            @endif

                                                            @if($field['type'] == 'select')
                                                                <select class="form-control"
                                                                        name="{{ $field['name'] }}">
                                                                    <option></option>
                                                                    @if($field['options'] == 'BBMenus')
                                                                        @foreach(BBGetMenus() as $menu)
                                                                            <option value="{{$menu['id']}}"{!! BBSelectChoose($menu['id'], $settings[$field['name']])!!}>{{$menu['title']}}</option>
                                                                        @endforeach
                                                                    @elseif($field['options'] == 'BBMenus')

                                                                    @else
                                                                        @foreach($field['options'] as $option)
                                                                            <option>{{$option}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            @endif

                                                            @if($field['type'] == 'text')
                                                                <input type="text" class="form-control"
                                                                       id="{{ $field['name'] }}"
                                                                       name="{{ $field['name'] }}"
                                                                       value="{{ isset($settings[$field['name']]) ? $settings[$field['name']] : '' }}"{!!$fieldData!!}/>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </fieldset>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END Accordion Group -->
                        @endforeach
                    </div>
                </div>
                <div class="customisation-footer">
                    <button type="button" class="btn btn-primary save-variation">Save Template</button>
                    <button type="button" class="btn btn-warning pull-right general-settings">General Settings</button>
                </div>
            </div>
            {!! Form::close() !!}
            <div class="col-md-9 no-padding" id="template-area">
                <iframe src="{{ url('/admin/templates/preview-template/'.$template_id.'/'.$variation_id) }}"
                        width="100%" style="border:0;height:100vh;" id="template-frame"></iframe>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var settings = $('.customise-tools').data('settings');

    $('.save-variation').click(function () {
        postAjax('/admin/templates/update-customiser', {
            variationSettings: JSON.stringify($('#customiser-form').serializeArray())
        }, function (data) {
            document.getElementById('template-frame').contentDocument.location.reload(true);
        });
    });

    $('#template-frame, .customise-tools, #template-area').height($(window).height());

    /* Form fields JS */
    $('input[type="range"]').rangeslider({
        polyfill: false
    });

    /* Live Updating */

    // Colors and backgrounds
    $('.color-picker').colorPicker({
        renderCallback: function ($el) {
            var $targetEl = $el.data('el'),
                $targetCSS = $el.data('css'),
                colors = this.color.colors;

//            $($targetEl).css($targetCSS, '#' + colors.HEX);
        }
    });

    // CSS styles
    $('.css').change(function () {
        var $el = $(this),
            $targetEl = $el.data('el'),
            $targetCSS = $el.data('css'),
            $targetUnit = $el.data('unit'),
            $value = $el.val();

        $($targetEl).css($targetCSS, $value + $targetUnit);
    });

    // Numbered values
    $(document).on('input', 'input[type="range"]', function (e) {
        var $el = $(e.target),
            $targetEl = $el.data('el'),
            $targetCSS = $el.data('css'),
            $targetUnit = $el.data('unit'),
            $value = $el.val();

        $el.parent('div').find('.slider-value').text(e.target.value);

        $($targetEl).css($targetCSS, $value + $targetUnit);
    });

    // Inline editor
    var editor = new MediumEditor('.editable');

    // Image upload
    if ($('.uploadable').length > 0) {
        var myDropzone = new Dropzone(".uploadable", {
            url: "/file/post",
            thumbnailWidth: 900,
            thumbnailHeight: 300
        });

        myDropzone.on("thumbnail", function (i, data) {
            var imgElement = $($(this)[0].element);
            imgElement.attr('src', data)
        });
    }

    // Widgets
    $(".widgets-list li a").draggable({
        helper: "clone"
    });

    $("#template-frame").load(function () {
        var $this = $(this);
        var contents = $this.contents();

        // Inject CSS & JS
        var decodedInjectables = $('<div/>').html($('#injectable-css').html()).text();
        contents.find('head').prepend(decodedInjectables);

        // Drop in iframe
        contents.find('.droppable-area').droppable({
            iframeFix: true,
            activeClass: "bg-warning",
            accept: ".widgets-list li a",
            drop: function (event, ui) {
                var widgetTemplate = $(ui.draggable).parent('li').find('.widget-template').html();
                var $this = $(this);
                var decodedWidgetTemplate = $('<div/>').html(widgetTemplate).text();
                $this.html(decodedWidgetTemplate);
                $this.append('<a href="javascript:;" class="remove-widget"><i class="fa fa-close"></i></a>');

                contents.find('.remove-widget').click(function () {
                    $(this).parent('.droppable-area').html('');
                });

                // Fill widget input values
                var widgetID = $(ui.draggable).parent('li').data('id');
                $('[name=' + $this.attr('id') + ']').val(widgetID);
            }
        });

        @foreach($selectors as $selector)
        contents.find('{{$selector}}').attr('data-selector', '{{$selector}}');
        @endforeach

        // Show relevant tab
        contents.find('{{implode(', ',$selectors)}}').click(function () {
            var elClass = $(this).data('selector');
            $('.customiser-panel').hide();
            $('[data-selector="' + elClass + '"]').show();
        });

        // Add droppable areas to main form
        contents.find('.droppable-area').each(function () {
            var $this = $(this);
            $('[name=' + $this.attr('id') + ']').remove();
            $('#customiser-form').append($('<input/>').attr('name', $this.attr('id')).attr('type', 'hidden'));
            $('[name=' + $this.attr('id') + ']').val(settings[$this.attr('id')]);
        });
    });

    $('.general-settings').click(function () {
        $('.customiser-panel').hide();
    });

</script>

<!-- Injectable CSS -->
<script type="template/html" id="injectable-css">
    &lt;link rel=&quot;stylesheet&quot; href=&quot;{{ asset('/public/libs/font-awesome/css/font-awesome.min.css') }}&quot;/&gt;
    &lt;link rel=&quot;stylesheet&quot; href=&quot;{{ asset('/public/css/bootstrap.css') }}&quot;/&gt;

    &lt;script src=&quot;{{ asset('public/js/jquery-2.1.4.min.js') }}&quot; type=&quot;text/javascript&quot;&gt;&lt;/script&gt;
    &lt;script src=&quot;{{ asset('public/libs/jqueryui/js/jquery-ui.min.js') }}&quot; type=&quot;text/javascript&quot;&gt;&lt;/script&gt;
    &lt;script src=&quot;{{ asset('public/js/bootstrap.min.js') }}&quot; type=&quot;text/javascript&quot;&gt;&lt;/script&gt;
    &lt;script src=&quot;{{ asset('public/js/admin.js?v=6.1') }}&quot; type=&quot;text/javascript&quot;&gt;&lt;/script&gt;
    &lt;style&gt;
    .droppable-area {
    min-height: 120px;
    border: 1px dashed #c0c0c0;
    margin-top: 20px;
    margin-bottom: 20px;
    position: relative;
    }

    .remove-widget {
    font-size: 23px;
    color: #CA0000;
    position: absolute;
    left: 5px;
    top: -34px;
    background: #000;
    width: 35px;
    height: 35px;
    text-align: Center;
    line-height: 33px;
    border: 1px solid #dfdfdf;
    box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.35);
    padding-top: 5px;
    }
    @foreach($customiser as $tab)
    @if(isset($tab['selector']))
    {{$tab['selector']}}{
    position: relative;
    min-height: 50px;
    }
    {{$tab['selector']}}:before {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    background: rgba({{rand(0,255)}}, {{rand(0,255)}}, {{rand(0,255)}}, 0.23);
    border: 1px dashed rgb(1, 163, 255);
    cursor: pointer;
    display:none;
    }
    {{$tab['selector']}}:hover:before{
    display:block;
    }
    @endif
    @endforeach
    &lt;/style&gt;
</script>

</body>
</html>
