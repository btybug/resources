<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#General" aria-controls="General" role="tab" data-toggle="tab">General</a>
    </li>
    <li role="presentation"><a href="#Snippts" aria-controls="Snippts" role="tab" data-toggle="tab">Snippts</a></li>
</ul>
<div class="tab-content p-10 bg-silver overflow-y-hidden form-horizontal">
    <div role="tabpanel" class="tab-pane active" id="General">
        <div class="m-10 p-15 bg-white overflow-y-hidden">
            <div class="form-group">
                <label class="col-sm-2 control-label f-w-100 text-left width-xs">Title</label>
                <div class="col-sm-9"> {!! Form::text('title',null,['class'=>'form-control']) !!} </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label f-w-100 text-left width-xs">Description</label>
                <div class="col-sm-9"> {!! Form::textarea('description', null, ['class' => 'form-control']) !!} </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label f-w-100 text-left width-xs">Site Link</label>
                <div class="col-sm-9"> {!! Form::text('site_link',null,['class'=>'form-control']) !!} </div>
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="Snippts">
        <div class="m-10 p-15 bg-white overflow-y-hidden">
            <div class="row">

                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-success" id="addNewbox"><i class="fa fa-plus"></i> Add New
                        Layout
                    </button>
                </div>

                <div id="snipptsGroup">
                    @if($tot_snippts > 0 )
                        @foreach(@$snippts as $key => $snipt)
                            <div class="form-group p-b-20">
                                <div class="col-sm-6">
                                    <button type="button" class="btn buttonShiftcode  btn-primary btn-xs pull-right"
                                            data-id="{{$key+1}}">See Result <i class="fa fa-angle-double-right"></i>
                                    </button>
                                    <label>Edit The
                                        Code</label>{!! Form::textarea('snippt[]', $snipt, ['size' => '30x5','class'=>'form-control col-sm-12','id'=>$key+1+'_container']) !!}
                                </div>
                                <div class="col-sm-6 " id="{{$key+1}}_viewer"><label>Result</label>
                                    <div class="codeviews border1 p-10 min-height130">{!! $snipt !!}</div>
                                </div>
                            </div>
                        @endforeach

                    @endif
                </div>

            </div>
        </div>
    </div>
    <div class="col-sm-12 text-center">
        <button type="submit" class="btn btn-success">{{$submitButtonText}}</button>
        <button type="button" class="btn btn-danger" onclick="location.href='/admin//core_assest';">Cancel</button>
    </div>
</div>
<div id="counter" class="hide">{{$tot_snippts}}</div>
@section('JS')
    <script>
        $(function () {
            var newid = Number(<?php echo $tot_snippts ?>);

            /*Add New Snippt*/
            function addnewSnippt(ids) {
                var snippt = '<div class="form-group p-b-20">' +
                    '<div class="col-sm-6"><button type="button" class="btn buttonShiftcode btn-primary btn-xs pull-right" data-id="' + ids + '">See Result <i class="fa fa-angle-double-right"></i> </button><label>Edit The Code</label> <textarea name="snippt[]" class="form-control col-sm-12"  rows="5" cols="30" id="' + ids + '_container"></textarea></div>' +
                    '<div class="col-sm-6" id="' + ids + '_viewer"><label>Result</label><div class="codeviews border1 p-10 min-height130"></div>  </div>' +
                    '</div>';
                $('#snipptsGroup').append(snippt);
            };
            /* add New Snippt event */
            $('#addNewbox').click(function (e) {
                e.preventDefault();
                newid = newid + 1;
                addnewSnippt(newid);
            });
            /* Shift Code to view */
            $('body').on('click', '.buttonShiftcode', function (e) {
                e.preventDefault();
                gid = $(this).data('id');
                $('[id="' + gid + '_viewer"] > .codeviews').html($('[id="' + gid + '_container"]').val());
            });
        });


    </script>
@stop
