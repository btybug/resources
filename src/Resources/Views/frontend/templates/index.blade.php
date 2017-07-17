@extends('layouts.admin')
    @section('content')
<ol class="breadcrumb">
  <li><a href="/">Dashboard</a></li>
  <li class="active">&nbsp; Template</li>
</ol>
<div>

<a href="/admin/templates/start">
<button class="btn btn-sm btn-success mrg-btm-10" type="button"><i class="fa fa-wrench"></i>&nbsp; Start New Template</button>
</a>
 <button class="btn btn-sm btn-primary pull-right mrg-btm-10" type="button" data-toggle="modal" data-target="#uploadfile"><i class="fa fa-upload"></i>&nbsp; Upload </button>
 </div>
<div class="row">

  <div class="col-md-12 p-0">
  
      <table class="table table-bordered" id="tpl-table">
        <thead>
            <tr class="bg-black-darker text-white">
               @foreach($form_fields as $fld)
                <th  @if($fld=='Action') width="13%" @endif>{!! $fld !!}</th>
              @endforeach  
            </tr>
        </thead>
        
        <tfoot>
          <tr>
              @foreach($form_fields as $fld)
              <td>  
               
               @if($fld!='Action' && $fld!='Type')
                 <input type="text" class="form-control width-full" placeholder="{!! $fld !!}" />
               @endif
               
               @if($fld=='Type')
                  <select class="form-control width-full">
                    <option value="">All</option>
                    <option value="all_section">all_section</option>
                    <option value="footer">footer</option>
                    <option value="header">header</option>
                    <option value="general">general</option>
                    <option value="single_section">single_section</option>
                    <option value="all_texonomy">all_texonomy</option>
                    <option value="terms">terms</option>
                    <option value="email">email</option>
                </select>
               @endif
               
               
               </td>
              @endforeach  
            </tr>
        </tfoot>
        
      </table>
     
</div>

<div class="modal fade" id="uploadfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel">Upload</h4>

      </div>

      <div class="modal-body"> {!! Form::open(['url'=>'/admin/templates/upload','class'=>'dropzone', 'id'=>'my-awesome-dropzone']) !!}

        {!! Form::close() !!} </div>

    </div>

  </div>

</div>



@stop

@include('tools::common_inc')

@push('javascript')

   <script>
     Dropzone.options.myAwesomeDropzone = {
        headers: { "X-CSRF-TOKEN": $("#token").val() },
  		init: function() {
   		 	this.on("success", function(file) { 
	    		location.reload();
			});
  		}
	};

	$(function() {
		table = $('#tpl-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: '/admin/templates/data',
			dom: 'Bfrtip',
			buttons: [
				'colvis','copy', 'csv', 'excel', 'pdf', 'print'
			],
			columns: {!! $columns!!}
		});
		table.columns().every(function() {
			var string = this;
			$("input, select", this.footer()).on("keyup change", function() {
				if (string.search() !== this.value) {
					string.search(this.value).draw();
				}
			});
		});		
	});
   </script>
@endpush

