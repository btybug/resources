@extends('layouts.admin')

@section('content')
{!! Breadcrumbs::render('template_settings') !!}

{!! Form::open(['url'=>'/admin/templates/setting', 'id'=>'add_custome_page','files'=>true]) !!}
  {!! Form::hidden('id', $template->id) !!}			
   <div class="row">
    <div class="col-md-12"> 
      <ul class="nav nav-tabs" role="tablist" data-tab-action="tabs">
      <li role="presentation" class="active"><a data-toggle="tab" role="tab" class="p-l-20 p-r-20" href="#Contents">Contents</a></li>
      <li role="presentation"><a data-toggle="tab" role="tab" class="p-l-20 p-r-20" href="#Settings">Settings</a></li>
    </ul>
    </div>
   </div> 
  
   <div class="tab-content m-10 p-15 bg-white overflow-y-hidden">
      <div role="tabpanel" class="tab-pane active" id="Contents">
         {!! Form::textarea('content', $file, ['id' => 'content','class'=>'form-control']) !!}
      </div>
      <div role="tabpanel" class="tab-pane" id="Settings">
           @if($have_setting==1)
             @include($path)
           @else
            <div class="col-md-9">No Settings Availaable</div>  
           @endif
      </div>
   </div>
   <div class="col-md-3">
    <button id="settings_savebtn" class="btn btn-success btn-block" type="submit">Save Changes</button>
   </div>
{!! Form::close() !!}

@stop 

@section('JS')
{!! HTML::script('/public/editor/tinymice/tinymce.min.js') !!}
<script>
tinymce.init({
  selector: '#content' , // change this value according to your HTML
   height: 500,
  theme: 'modern',
  plugins: [
    
    'code fullscreen',
  ],
  
  image_advtab: true
});
</script>
@stop 
