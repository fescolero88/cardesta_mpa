<option value="">Choose Model</option>
@foreach($model as $m)
    <option value="{{ $m->model }}">{{ $m->model }}</option>
@endforeach

