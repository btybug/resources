@if(count($templates))
    @foreach($templates as $tpl)

        <div class="row templates m-b-10 row_template">
            <div class="col-xs-12 p-l-0 p-r-0">
                @if(isset($tpl->image))
                    <img src="{!! url('resources/templates/'.$tpl->type.'/'.$tpl->slug. '/images/'. $tpl->image)!!}"
                         style="height: 167px;" class="img-responsive"/>
                @else
                    <img src="{!! url('resources/assets/images/template-2.png')!!}" class="img-responsive"/>
                @endif
            </div>
            <div class="col-xs-12 templates-header p-t-10 p-b-10">
                <span class="pull-left templates-title f-s-15 col-xs-12 col-sm-6 col-md-6 col-lg-6 p-l-0  "><i
                            class="fa fa-bars f-s-13 m-r-5"
                            aria-hidden="true"></i> {!! $tpl->title or $tpl->slug !!}</span>
                <div class="pull-right templates-buttons col-xs-12 col-sm-6 col-md-6 col-lg-6 p-r-0 text-right ">
                    <span class="for_author_111">
                        <i class="fa fa-user f-s-13 author-icon" aria-hidden="true"></i>
                        {!! @$tpl->author !!}, {!! BBgetDateFormat($tpl->created_at) !!}
                    </span>
                    @if(@$tpl->have_settings)
                        <a href="{!! url('admin/packeges/setting',$tpl->slug) !!}"
                           class="addons-settings  m-l-10 m-r-10"><i class="fa fa-eye f-s-14"></i> </a>
                    @endif
                    @if(isset($front_layout))
                        @if(BBgetActiveLayout()==$tpl->slug)
                            <span class="label label-success m-r-10"><i class="fa fa-check"></i> Active</span>
                        @else
                            <a href="{!! url('/admin/templates/front-themes-activate',$tpl->slug) !!}"
                               class="label label-info m-r-10 activate-theme" style="cursor: pointer;">Activate</a>
                        @endif
                    @endif
                    <span class="for_icons_111">
                        <a href="{!! url('admin/templates/tpl-variations',$tpl->slug) !!}"
                           class="addons-deactivate  m-r-10"><i class="fa fa-pencil f-s-14"></i> </a>
                        <a href="javascript:void(0)" slug="{!! $tpl->slug !!}" class="addons-delete del-tpl"><i
                                    class="fa fa-trash-o f-s-14 "></i> </a>
                    </span>

                </div>
            </div>
        </div>

    @endforeach
@else
    <div class="col-xs-12 addon-item">
        NO Templates
    </div>
@endif
