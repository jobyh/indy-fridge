@props(['options'])
<select {{ $attributes }}>
    @foreach($options as $option)
        <option value="{{ $option->value }}">{{ $option->label }}</option>
    @endforeach
</select>
