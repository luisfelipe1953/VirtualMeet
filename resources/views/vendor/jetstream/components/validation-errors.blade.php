@if ($errors->any())
    <div {{ $attributes }}>
            @foreach ($errors->all() as $error)
                <p class="alerta-error">{{ $error }}</p>
            @endforeach
    </div>
@endif
