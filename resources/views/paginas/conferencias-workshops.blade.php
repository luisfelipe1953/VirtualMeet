@extends('layout')

@section('contenido')

<main class="sm:container container-md mx-auto">
    <h1 class="titulo-front">Workshops & Conferencias</h1>
    <p class="subtitulo-front">Talleres y Conferencias dictados por expertos en desarrollo web</p>

    <div class="">
        <h1 class="agenda-titulo text-primarioDarken my-12 mx-0">&lt;Conferencias /></h1>
        <p class="text-gris mt-[30px] mb-[10px]">Viernes 5 de Octubre</p>

        <div class="slider swiper">
            <div class="swiper-wrapper">
                @foreach($eventos['conferencias_v'] as $evento )
                <!-- // puede ser un componente -->
                @component('components.evento', [
                'hora' => $evento->hora->hora,
                'nombre' => $evento->nombre,
                'descripcion' => $evento->descripcion,
                'ponente_imagen' => env('HOST') . '/storage/imagenes/speakers/' . $evento->ponente->imagen,
                'ponente_nombre' => $evento->ponente->nombre . " " . $evento->ponente->apellido
                ])
                @endcomponent
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <p class="text-gris mt-[30px] mb-[10px]">Sábado 6 de Octubre</p>

        <div class="slider swiper">
            <div class="swiper-wrapper">
                @foreach ($eventos['conferencias_s'] as $evento)
                @component('components.evento', [
                'hora' => $evento->hora->hora,
                'nombre' => $evento->nombre,
                'descripcion' => $evento->descripcion,
                'ponente_imagen' => env('HOST') . '/storage/imagenes/speakers/' . $evento->ponente->imagen,
                'ponente_nombre' => $evento->ponente->nombre . " " . $evento->ponente->apellido
                ])
                @endcomponent
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    <div class="">
        <h1 class="agenda-titulo text-secundarioDarken">&lt;Workshops /></h1>
        <p class="text-gris mt-[30px] mb-[10px]">Viernes 5 de Octubre</p>

        <div class="slider swiper specific-location">
            <div class="swiper-wrapper">
                @foreach ($eventos['workshops_v'] as $evento)
                @component('components.evento', [
                'hora' => $evento->hora->hora,
                'nombre' => $evento->nombre,
                'descripcion' => $evento->descripcion,
                'ponente_imagen' => env('HOST') . '/storage/imagenes/speakers/' . $evento->ponente->imagen,
                'ponente_nombre' => $evento->ponente->nombre . " " . $evento->ponente->apellido
                ])
                @endcomponent
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <p class="text-gris mt-[30px] mb-[10px]">Sábado 6 de Octubre</p>

        <div class="slider swiper specific-location">
            <div class="swiper-wrapper">
                @foreach ($eventos['workshops_s'] as $evento)
                @component('components.evento', [
                'hora' => $evento->hora->hora,
                'nombre' => $evento->nombre,
                'descripcion' => $evento->descripcion,
                'ponente_imagen' => env('HOST') . '/storage/imagenes/speakers/' . $evento->ponente->imagen,
                'ponente_nombre' => $evento->ponente->nombre . " " . $evento->ponente->apellido
                ])
                @endcomponent
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</main>


@stop