<div class="col-md-12  alert alert-info">
    @if(! empty($settings))
        @foreach($settings as $key => $value)
            <div class="row">
                <b>{{ str_replace('_',' ',$key) }} : </b> {{ $value }}
            </div>
        @endforeach
    @else
        No Settings
    @endif
</div>
