<select id="template_variations" name="variation"
        style="position: absolute;z-index: 99999;background: #3c763d;right: 16%;top: 87%;">
    <option>Select Variation</option>
    @foreach($variations as $variation)

        <option value="{!! $variation->id !!}">{!! $variation->title !!}</option>

    @endforeach
</select>
