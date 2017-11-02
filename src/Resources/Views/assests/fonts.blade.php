@extends('btybug::layouts.mTabs',['index'=>'assets'])
<!-- Nav tabs -->
@section('tab')
    <div class="row">
        <div class="col-sm-12 p-0">

            <button class="btn btn-sm btn-primary pull-right m-b-10" type="button" data-toggle="modal"
                    data-target="#uploadfile">
                <i class="fa fa-upload"></i>
                &nbsp; Upload Font Package
            </button>

            <table width="100%" class="table table-bordered">
                <thead>
                <tr class="bg-black-darker text-white">
                    <th>Title</th>
                    <th width="100">Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($assets as $asset)
                    <tr>
                        <td>{{$asset['title']}}</td>
                        <td>
                            <a href="/admin/resources/core_assest/font-preview/{{$asset['folder']}}"
                               class="btn btn-default btn-info btn-xs">
                                &nbsp;<i class="fa fa-eye"></i>&nbsp;
                            </a>
                            <a href="/admin/resources/core_assest/delete-font/{{$asset['folder']}}"
                               class="btn btn-danger btn-primary btn-xs"
                               onclick="return confirm('Are you sure to delete')">
                                &nbsp;<i class="fa fa-trash"></i> &nbsp;
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="uploadfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Upload</h4>
                </div>
                <div class="modal-body"> {!! Form::open(['url'=>'/admin/resources/core_assest/uploadfont','class'=>'dropzone', 'id'=>'my-awesome-dropzone']) !!}

                    {!! Form::close() !!} </div>
            </div>
        </div>
    </div>
@stop

@section('CSS')
    {!! HTML::style('/public/libs/bootstrap-switch/css/bootstrap-switch.min.css') !!}
@stop

@section('JS')

    {!! HTML::script('public/libs/dropzone/js/dropzone.js') !!}
    {!! HTML::script('public/libs/bootstrap-switch/js/bootstrap-switch.min.js') !!}
    <script>

        Dropzone.options.myAwesomeDropzone = {

            init: function () {

                this.on("success", function (file) {

                    location.reload();

                });

            }

        };

    </script>
@stop