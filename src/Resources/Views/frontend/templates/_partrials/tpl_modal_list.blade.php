@if(count($templates))
    @foreach($templates as $tpl)

        <div class="row templates m-b-10">
            <button type="button" class="btn btn-info">{!! $tpl->title !!}</button>
        </div>

    @endforeach
@else
    <div class="col-xs-12 addon-item">
        NO Templates
    </div>
@endif
