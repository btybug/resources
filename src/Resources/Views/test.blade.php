@extends('layouts.admin')

@section('content')

    <button class="btn" data-role="browseMedia">Broser Media</button>



    <button class="btn" data-role="browseicon">Broser Icon <span class="iconView"></span></button>


@stop

@section('CSS')
    {!! HTML::style('/public/css/icon-buttons.css') !!}
@stop

@section('JS')
    <script type="text/javascript">
        $(function () {

            $('[data-role="browseicon"]').icon();

        })
    </script>
    {!! HTML::script('/public/js/icon-plugin.js') !!}
@stop