@if(count($ui_units))
    @foreach($ui_units as $unit)
        @if($unit->type!='files')
            <div class="col-xs-4">
                <div class="row templates m-b-10">
                    <div class="col-xs-12 p-l-0 p-r-0">
                        <img src="{!! url('resources/assets/images/template-3.png')!!}" class="img-responsive"/>
                        <div class="tempalte_icon">
                            @if(! isset($unit->is_core) or $unit->is_core == false)
                                <div>
                                    <button data-key="{!! $unit->slug !!}" type={!! $unit->type !!}""
                                            main_type="{!! @$unit->main_type !!}" class="addons-delete delete_layout"><i
                                                class="fa fa-trash-o f-s-14 "></i></button>
                                </div>
                            @endif

                            <div><a href="{!! url('admin/resources/units/units-variations',$unit->slug) !!}"
                                    class="m-r-10"><i class="fa fa-pencil f-s-14"></i> </a></div>

                        </div>
                    </div>
                    <div class="col-xs-12 templates-header p-t-10 p-b-10">
                        <span class="col-xs-12 templates-title f-s-15 text-center"><i class="fa fa-bars f-s-13 m-r-5"
                                                                                      aria-hidden="true"></i> {!! $unit->title or $unit->slug !!}</span>
                        <div class="col-xs-12 templates-buttons text-center ">
                            <i class="fa fa-user f-s-13 author-icon" aria-hidden="true"></i>
                            author, {!! BBgetDateFormat($unit->created_at) !!}

                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-xs-2">
                <div class="row templates m-b-10">
                    <div class="col-xs-12 p-l-0 p-r-0">
                        <img src="{!! url($unit->image)!!}" class="img-responsive"/>
                        <div class="tempalte_icon">
                            <div>
                                <button data-key="{!! $unit->slug !!}" type={!! $unit->type !!}""
                                        main_type="{!! @$unit->main_type !!}" class="addons-delete delete_layout"><i
                                            class="fa fa-trash-o f-s-14 "></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 templates-header p-t-10 p-b-10">
                        <span class="col-xs-12 templates-title f-s-15 text-center"><i class="fa fa-bars f-s-13 m-r-5"
                                                                                      aria-hidden="true"></i> {!! $unit->title or $unit->slug !!}</span>
                        <div class="col-xs-12 templates-buttons text-center ">
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@else
    <div class="col-xs-12 addon-item">
        NO Units
    </div>
@endif
