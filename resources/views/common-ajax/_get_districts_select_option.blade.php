<option value="">--Select District--</option>
@if(!empty($districts))
    @foreach($districts as $district)
        <option value="{!! $district->id !!}" {!! (old('district') == $district->id)?'selected':'' !!}>{!! $district->name !!} / {!! $district->bn_name !!}</option>
    @endforeach
@endif