@extends('layouts.admin')

@section('content')

    {!! Breadcrumbs::render('assets_fonts') !!}

    <div class="row">
        <div class="form-group">
            <input type="text" id="filter-icons" placeholder="Search Icons" class="form-control"/>
        </div>
        <div class="icons-list">
            @foreach($list as $iconclass=>$iconname)
                <div class="col-md-2" data-font="{{$iconname}}">
                    <div class="icon-item">
                        <i class="@if(isset($config->prefix)) {{$config->prefix}} @endif {{$iconclass}}"></i>
                        <span>{{$iconname}}</span>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="icon-playground hide">
            <div class="icon-item-test">
                <i class="fa fa-facebook"></i>
            </div>
            <div>
                <label>Color:</label>
                <input type="text" id="icon-color" value="#FFFFFF" class="form-control"/>
            </div>
            <div>
                <label>Size:</label>

                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary">
                        <input type="radio" name="size" value="bb-xs" autocomplete="off"> xs
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="size" value="bb-1x" autocomplete="off"> 1x
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="size" value="bb-2x" autocomplete="off"> 2x
                    </label>
                    <label class="btn btn-primary active">
                        <input type="radio" name="size" value="bb-3x" autocomplete="off" checked> 3x
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="size" value="bb-4x" autocomplete="off"> 4x
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="size" value="bb-5x" autocomplete="off"> 5x
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="size" value="bb-6x" autocomplete="off"> 6x
                    </label>
                </div>
            </div>
            <div>
                <label>Animation:</label>

                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary active">
                        <input type="radio" name="animation" value="" autocomplete="off" checked> No
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="animation" value="bb-spin" autocomplete="off"> Spin
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="animation" value="bb-pulse" autocomplete="off"> Pulse
                    </label>
                </div>
            </div>
            <div>
                <label>Rotation:</label>

                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary active">
                        <input type="radio" name="rotation" value="" autocomplete="off" checked> No
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="rotation" value="bb-rotate-90" autocomplete="off"> 90
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="rotation" value="bb-rotate-180" autocomplete="off"> 180
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="rotation" value="bb-rotate-270" autocomplete="off"> 270
                    </label>
                </div>
            </div>
            <div>
                <label>Stack:</label>

                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary active">
                        <input type="radio" name="stack" value="" autocomplete="off" checked> No
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="stack" value="bb-border" autocomplete="off"> Border
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="stack" value="bb-square" autocomplete="off"> Square
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="stack" value="bb-rounded" autocomplete="off"> Rounded
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="stack" value="bb-circle" autocomplete="off"> Circle
                    </label>
                </div>
            </div>
            <div>
                <label>Border Color:</label>
                <input type="text" id="border-color" value="#6F6F6F" class="form-control"/>
            </div>
            <div>
                <label>Background Color:</label>
                <input type="text" id="background-color" value="#6F6F6F" class="form-control"/>
            </div>
        </div>
    </div>

@stop

@section('CSS')
    {!! HTML::style($css_link) !!}
    <style>
        .icon-item {
            text-align: center;
            border: 1px solid #dfdfdf;
            margin-bottom: 15px;
            height: 98px;
            position: relative;
            z-index: 2;
            background: #fff;
            cursor: pointer;
        }

        .icon-item.active {
            border-color: #8BC9FF;
        }

        .icon-item span {
            display: table;
            width: 100%;
            font-size: 13px;
            margin-top: 11px;
        }

        .icon-item i {
            font-size: 35px;
            margin-top: 20px;
        }

        .icons-list {
            width: 100%;
            height: calc(100vh - 170px);
            overflow-y: auto;
            float: right;
        }

        .icon-playground {
            background: #2D2D2D;
            color: #fff;
            width: 300px;
            position: relative;
            padding: 15px 10px;
        }

        .icon-item-test {
            width: 280px;
            height: 130px;
            text-align: center;
            vertical-align: middle;
            display: table-cell;
        }

        .icon-playground > div > label {
            margin-top: 10px;
            display: table;
            margin-bottom: 4px;
        }

        .icon-playground .form-control {
            border-radius: 0;
            font-size: 12px;
            height: 25px;
        }

        .icon-playground .btn-group .btn {
            font-size: 12px;
        }

        .icon-playground .btn-group label {
            display: table;
        }

        .cp-color-picker {
            z-index: 99999;
        }
    </style>


    <style>
        /* Icon helper classes */
        .bb-spin {
            -webkit-animation: fa-spin 2s infinite linear;
            animation: fa-spin 2s infinite linear;
        }

        .bb-pulse {
            -webkit-animation: fa-spin 1s infinite steps(8);
            animation: fa-spin 1s infinite steps(8);
        }

        .bb-rotate-90 {
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=1)";
            -webkit-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            transform: rotate(90deg);
        }

        .bb-rotate-180 {
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=2)";
            -webkit-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        .bb-rotate-270 {
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=3)";
            -webkit-transform: rotate(270deg);
            -ms-transform: rotate(270deg);
            transform: rotate(270deg);
        }

        .bb-xs {
            font-size: 1em;
        }

        .bb-1x {
            font-size: 1.33333333em;
            line-height: 0.75em;
            vertical-align: -15%;
        }

        .bb-2x {
            font-size: 2em;
        }

        .bb-3x {
            font-size: 3em;
        }

        .bb-4x {
            font-size: 4em;
        }

        .bb-5x {
            font-size: 5em;
        }

        .bb-6x {
            font-size: 6em;
        }

        .bb-border {
            border: 2px solid #6F6F6F;
            padding: 2%;
        }

        .bb-square {
            background: #6F6F6F;
            padding: 2%;
        }

        .bb-rounded {
            background: #6F6F6F;
            border-radius: 5px;
            padding: 2%;
        }

        .bb-circle {
            background: #6F6F6F;
            border-radius: 5px;
            padding: 2%;
        }
    </style>
@stop

@section('JS')
    <!-- Color Picker -->
    <script src="{{ asset("public/customiser/colorpicker/jqColorPicker.min.js") }}" type="text/javascript"></script>
    <!-- Number Slider -->
    <link rel="stylesheet" href="{{ asset("/public/customiser/slider/rangeslider.css?v=1") }}"/>
    <script src="{{ asset("public/customiser/slider/rangeslider.min.js") }}" type="text/javascript"></script>

    <script language="javascript" type="text/javascript">
        var iconTest = $('.icon-item-test > i');
        var iconItem = $('.icon-item');

        var firstIcon = iconItem.first().addClass('active').find('i').attr('class');
        iconTest.addClass(firstIcon + ' bb-3x');

        // Filter on typing
        $('#filter-icons').focus().keyup(function () {
            var $this = $(this);
            var value = $this.val();
            $('.icons-list > div').each(function () {
                if ($(this).attr('data-font').toLowerCase().search(value) > -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // On icon click
        iconItem.click(function () {
            var classes = $(this).find('i').attr('class');
            $('.icon-item').removeClass('active');
            $(this).addClass('active');
            iconTest.attr('class', classes + ' ' + $('[name=size]:checked').val());
        });

        // Range slider
        $('input[type="range"]').rangeslider({
            polyfill: false,
            onSlide: function (position, value) {
                console.log(value);
                iconTest.css('font-size', value);
            }
        });

        // Color Picker
        $('#icon-color, #border-color, #background-color').colorPicker({
            renderCallback: function ($elm, toggled) {
                var value = $elm.val();
                var id = $elm.attr('id');
                if (id == 'icon-color') {
                    iconTest.css('color', value);
                }
                else if (id == 'background-color') {
                    iconTest.css('background', value);
                }
                else if (id == 'border-color') {
                    iconTest.css('border-color', value);
                }
            }
        });

        // Option selection
        var customClasses = [
            ['animation', 'bb-spin bb-pulse'],
            ['rotation', 'bb-rotate-90 bb-rotate-180 bb-rotate-270'],
            ['stack', 'bb-circle bb-square bb-border'],
            ['size', 'bb-xs bb-1x bb-2x bb-3x bb-4x bb-5x bb-6x']
        ];

        $(customClasses).each(function (i, $class) {
            $('[name=' + $class[0] + ']').change(function () {
                var value = $('[name=' + $class[0] + ']:checked').val();

                iconTest.removeClass($class[1]);
                iconTest.addClass(value);
            });
        });
    </script>
@stop
