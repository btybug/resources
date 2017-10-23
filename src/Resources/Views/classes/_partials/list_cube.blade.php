@if(count($classes))
    @foreach($classes as $class)

        <div class="col-xs-4">
            <div class="row templates m-b-10">
                <div class="col-xs-12 p-l-0 p-r-0">
                    <img src="{!! url('public/img/template-3.png')!!}" class="img-responsive"/>
                    <div class="tempalte_icon">
                        <div><a href="{!! url('admin/resources/classes/variation-class',$class->id) !!}" class="m-r-10"><i
                                        class="fa fa-desktop f-s-14"></i> </a></div>
                        <div><a href="{!! url('admin/resources/classes/settings',$class->id) !!}" class="m-r-10"><i
                                        class="fa fa-cog f-s-14"></i> </a></div>
                        {{--<div><a href="javascript:void(0)" slug="slug" class="addons-delete del-tpl"><i class="fa fa-trash-o f-s-14 "></i> </a></div>--}}
                    </div>
                </div>
                <div class="col-xs-12 templates-header p-t-10 p-b-10">
                    <span class="col-xs-12 templates-title f-s-15 text-center"><i class="fa fa-bars f-s-13 m-r-5"
                                                                                  aria-hidden="true"></i> {!! $class->name !!}</span>
                    <div class="col-xs-12 templates-buttons text-center ">
                        <i class="fa fa-user f-s-13 author-icon" aria-hidden="true"></i>
                        author, {!! BBgetDateFormat($class->created_at) !!}

                    </div>
                </div>
            </div>
        </div>

    @endforeach
@else
    <div class="col-xs-12 addon-item">
        NO Classes
    </div>
@endif
