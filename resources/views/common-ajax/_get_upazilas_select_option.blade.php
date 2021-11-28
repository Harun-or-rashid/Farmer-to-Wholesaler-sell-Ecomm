<option value="">--Select District--</option>
@if(!empty($upazilas))
    @foreach($upazilas as $upazila)
        <option value="{!! $upazila->id !!}" {!! (old('upazila') == $upazila->id)?'selected':'' !!}>{!! $upazila->name !!} / {!! $upazila->bn_name !!}</option>
    @endforeach
@endif