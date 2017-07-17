@extends('layouts.admin')

@section('content')

{!! Breadcrumbs::render('template_delete') !!}

<div class="row">
  <div class="col-md-12 p-0">
    <div class="alert alert-warning"> <strong>Warning!</strong> This template Contains Widgets / Forms / Menues and Other Files.<br/>
      Unselect those you want to keep in system </div>
    <!-- begin panel -->
    <div class="panel panel-default">
      <div class="panel-heading bg-black-darker text-white">Delete Template </div>
      <div class="panel-body"> {!! Form::open(['url'=>'/admin/templates/delete']) !!}
        <div class="col-md-3">
          <table class="table">
            <th>
              <td rowspan="2">Widgets</td>
            </th>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
        </div>
        {!! Form::close() !!} </div>
    </div>
    <!-- end panel --> 
  </div>
</div>
@stop 
