@if(count($templates))
    @foreach($templates as $tpl)

        <div class="col-xs-4">
            <div class="row templates m-b-10">
                <div class="col-xs-12 p-l-0 p-r-0">
                    @if(isset($tpl->image))
                        <img src="{!! url('resources/templates/body/'.$tpl->type.'/'.$tpl->slug. '/images/'. $tpl->image)!!}"
                             style="height: 195px;" class="img-responsive"/>
                    @else
                        <img src="{!! url('resources/resources/images/template-3.png')!!}" class="img-responsive"/>
                    @endif

                    <div class="tempalte_icon">
                        @if(@$tpl->have_settings)
                            <div><a href="{!! url('admin/packeges/setting',$tpl->slug) !!}"
                                    class="addons-settings  m-r-10"><i class="fa fa-eye f-s-14"></i> </a></div>
                        @endif
                        <div><a href="{!! url('admin/templates/tpl-variations',$tpl->slug) !!}"
                                class="addons-deactivate  m-r-10"><i class="fa fa-pencil f-s-14"></i> </a></div>
                        <div><a href="javascript:void(0)" slug="{!! $tpl->slug !!}" class="addons-delete del-tpl"><i
                                        class="fa fa-trash-o f-s-14 "></i> </a></div>
                    </div>
                </div>
                <div class="col-xs-12 templates-header p-t-10 p-b-10">
                    <span class="col-xs-12 templates-title f-s-15 text-center"><i class="fa fa-bars f-s-13 m-r-5"
                                                                                  aria-hidden="true"></i> {!! $tpl->title or $tpl->slug !!}</span>
                    <div class="col-xs-12 templates-buttons text-center ">
                        <i class="fa fa-user f-s-13 author-icon" aria-hidden="true"></i>
                        {!! @$tpl->author !!}, {!! BBgetDateFormat($tpl->created_at) !!}

                    </div>
                </div>
            </div>
        </div>

    @endforeach
@else
    <div class="col-xs-12 addon-item">
        NO Templates
    </div>
@endif
