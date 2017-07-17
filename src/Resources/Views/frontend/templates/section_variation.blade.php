@if($sections)

    <ul class="nav nav-tabs myTabs" role="tablist">
        @foreach($sections as $section)
            <li role="presentation"><a href="#{{ $section->blog_slug }}" aria-controls="{{$section->blog_slug}}"
                                       role="tab" data-toggle="tab">{!! $section->blog_slug !!}</a></li>
        @endforeach
    </ul>

    <div class="tab-content">
        @foreach($sections as $section)
                <!-- Tab panes -->
        <div role="tabpanel" class="tab-pane" id="{!! $section->blog_slug !!}">
            <div class="col-md-8 p-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Variations for [{{ $template->title }}] template

                            @if(!empty($variation))
                                <a href="{{URL('/admin/templates/variations/'.$template->id)}}"
                                   class="btn btn-xs btn-success pull-right" style="color:#fff;">New Variation</a>
                            @else
                                <a href="javascript:;" data-section="{{ $section->id }}"
                                   class="btn btn-xs btn-success pull-right new-variation-section" style="color:#fff;">New
                                    Variation</a>
                            @endif
                        </h4>
                    </div>
                    <div class="panel-body">
                        <table width="100%" class="table table-bordered m-0">
                            <thead>
                            <tr class="bg-black-darker text-white">
                                <th>Variation Name</th>
                                <th width="120">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($section->variations as $variation_data)
                                @if($variation_data->template_id == $template->id)
                                    <tr>
                                        <td><a href="#" class="editable" data-type="text"
                                               data-pk="{{$variation_data->id}}"
                                               data-title="Template Variation Title">{{$variation_data->variation_name}}</a>
                                        </td>
                                      
                                        <td>
                                            <a href="/admin/templates/mapping/{{$variation_data->id}}"
                                               class="btn btn-primary btn-xs">&nbsp;<i class="fa fa-desktop"></i>&nbsp;
                                            </a>

                                            <a href="/admin/templates/variations/{{$template->id}}/{{$variation_data->id}}"
                                               class="btn btn-info btn-xs">&nbsp;<i class="fa fa-pencil"></i>&nbsp;</a>

                                            @if($variation_data->type != 'core')
                                                <a href="/admin/templates/delete-variation/{{$variation_data->id}}/{{$template->id}}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete')"> &nbsp;<i class="fa fa-trash"></i> &nbsp;</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="col-md-4 p-10 new-variation @if(empty($variation)) hide @endif">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        @if(!empty($variation))
                            Edit Template Variation
                        @else
                            New Template Variation
                        @endif
                    </h4>
                </div>
                <div class="panel-body">
                    {!! Form::model('customiser',['method'=>'POST','url'=>'/admin/templates/variations/'.$template->id]) !!}
                    {!! Form::hidden('template_id',$template->id) !!}
                    @if(!empty($variation))
                        {!! Form::hidden('variation_id',$variation['id']) !!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('variation_name','Varitation Name') !!}
                        {!! Form::text('variation_name',issetReturn($variation, 'variation_name'), ['class' => 'form-control']) !!}
                    </div>
                    @if(isset($sections))
                        {!! Form::hidden('section',null,['id' => 'variation-section']) !!}

                        @if(empty($variation))
                            <div class="form-group">
                                {!! Form::label('make_active','Make active') !!}
                                {!! Form::checkbox('make_active','active', false) !!}
                            </div>
                        @endif
                    @endif
                    <button class="btn btn-sm btn-success mrg-btm-10" type="submit"><i class="fa fa-save"></i> Save
                        Variation
                    </button>
                    <button class="btn btn-sm btn-default mrg-btm-10 cancel" type="button">Cancel</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endif
