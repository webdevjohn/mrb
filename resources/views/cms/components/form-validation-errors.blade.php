@props(['errors'])

@if ($errors->any())
    <div id="form-validation-errors">
        <h2>
            {{ __('There are errors on the form!') }}
        </h2>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
