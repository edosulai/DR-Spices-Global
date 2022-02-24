@props(['for'])

@error($for)
    <div {{ $attributes->merge(['class' => 'invalid-feedback']) }} role="alert">
        <strong>{{ $message }}</strong>
    </div>
@enderror
