@extends('btybug::layouts.mTabs',['index'=>'themes_assest'])

@section('parag')
    {!! Breadcrumbs::render('core_css') !!}
@stop
@section('tab')

    @include('tools::common_inc')
@stop
