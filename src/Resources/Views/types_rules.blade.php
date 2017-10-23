@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <div class="col-md-3">
            <div class="navbar navbar-inverse navbar-fixed-left">
                <a class="navbar-brand" href="#">Types</a>
                <ul id="rules_menu" class="nav navbar-nav">
                    <li><a href="#" data-id="text_rules">Text</a></li>
                    <li><a href="#" data-id="password_rules">Password</a></li>
                    <li><a href="#" data-id="file_rules">File</a></li>
                    <li><a href="#" data-id="numeryc_rules">Numeryc</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-4 rules_select" id="text_rules">
            <div class="form-group">
                <label for="sel1">Text Rules</label>
                <select class="form-control">
                    <option>Required</option>
                    <option>Unique</option>
                    <option>Maximum</option>
                    <option>Minimum</option>
                </select>
            </div>
        </div>
        <div class="col-md-4 rules_select" id="password_rules">
            <div class="form-group">
                <label for="sel1">Password Rules</label>
                <select class="form-control">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
            </div>
        </div>
        <div class="col-md-4 rules_select" id="file_rules">
            <div class="form-group">
                <label for="sel1">File Rules</label>
                <select class="form-control">
                    <option>Minimum size</option>
                    <option>Maximum size</option>
                    <option>No.filel</option>
                    <option>extensions</option>
                </select>
            </div>
        </div>
        <div class="col-md-4 rules_select" id="numeryc_rules">
            <div class="form-group">
                <label for="sel1">Numeric Rules</label>
                <select class="form-control">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
            </div>
        </div>
    </div>

@stop
@section('JS')
    <script>
        $(document).ready(function () {
            $('#rules_menu').on('click', 'a', function () {
                $(".rules_select").hide();
                var id = $(this).attr('data-id');
                $('#' + id).show();
            })
        })
    </script>
@stop

@section('CSS')
    <style>
        .navbar-fixed-left {
            width: 140px;
            /*position: fixed;*/
            border-radius: 0;
        }

        .rules_select {

            display: none;
        }

        .navbar-fixed-left .navbar-nav > li {
            float: none; /* Cancel default li float: left */
            width: 139px;
        }

        .navbar-fixed-left + .container {
            padding-left: 160px;
        }

        /* On using dropdown menu (To right shift popuped) */
        .navbar-fixed-left .navbar-nav > li > .dropdown-menu {
            margin-top: -50px;
            margin-left: 140px;
        }
    </style>
@stop