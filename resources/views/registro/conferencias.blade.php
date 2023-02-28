@extends('layout')

@section('contenido')
<section>
    <h1 class="titulo-front">Asistencia a VirtualMeet</h1>
    <p class="subtitulo-front">Elige hasta 5 eventos para asistir de forma presencial</p>

    <div class="sm:container container-md mx-auto sm:flex gap-5 items-start">
        <main class="flex-[0_0_60%]">
            <h1 class="agenda-titulo text-primarioDarken mt-12 mx-0 ">&lt;Conferencias /></h1>
            <p class="">Viernes 5 de Octubre</p>

            <div class="grid gap-7 sm:grid-cols-2 grid-cols-1">
                @foreach($eventos['conferencias_v'] as $evento )
                <!-- // puede ser un componente -->
                @component('components.evento-registro', [
                'hora' => $evento->hora->hora,
                'nombre' => $evento->nombre,
                'descripcion' => $evento->descripcion,
                'ponente_imagen' => env('HOST') . '/storage/imagenes/speakers/' . $evento->ponente->imagen,
                'ponente_nombre' => $evento->ponente->nombre . " " . $evento->ponente->apellido,
                'eventoId' => $evento->id,
                'disponibles' => $evento->disponibles
                ])
                @endcomponent
                @endforeach
            </div>

            <p class="mt-14 mb-8">Sabado 6 de Octubre</p>

            <div class="grid gap-7 sm:grid-cols-2 grid-cols-1">
                @foreach($eventos['conferencias_s'] as $evento )
                <!-- // puede ser un componente -->
                @component('components.evento-registro', [
                'hora' => $evento->hora->hora,
                'nombre' => $evento->nombre,
                'descripcion' => $evento->descripcion,
                'ponente_imagen' => env('HOST') . '/storage/imagenes/speakers/' . $evento->ponente->imagen,
                'ponente_nombre' => $evento->ponente->nombre . " " . $evento->ponente->apellido,
                'eventoId' => $evento->id,
                'disponibles' => $evento->disponibles
                ])
                @endcomponent
                @endforeach
            </div>

            <h1 class="agenda-titulo text-secundarioDarken mt-12 mx-0">&lt;Workshops /></h1>
            <p class="mt-14 mb-8">Viernes 5 de Octubre</p>

            <div class="grid gap-7 sm:grid-cols-2 grid-cols-1 specific-location">
                @foreach($eventos['workshops_v'] as $evento )
                <!-- // puede ser un componente -->
                @component('components.evento-registro', [
                'hora' => $evento->hora->hora,
                'nombre' => $evento->nombre,
                'descripcion' => $evento->descripcion,
                'ponente_imagen' => env('HOST') . '/storage/imagenes/speakers/' . $evento->ponente->imagen,
                'ponente_nombre' => $evento->ponente->nombre . " " . $evento->ponente->apellido,
                'eventoId' => $evento->id,
                'disponibles' => $evento->disponibles
                ])
                @endcomponent
                @endforeach
            </div>
            <p class="mt-14 mb-8">Sabado 6 de Octubre</p>
            <div class="grid gap-7 sm:grid-cols-2 grid-cols-1  specific-location">
                @foreach($eventos['workshops_s'] as $evento )
                <!-- // puede ser un componente -->
                @component('components.evento-registro', [
                'hora' => $evento->hora->hora,
                'nombre' => $evento->nombre,
                'descripcion' => $evento->descripcion,
                'ponente_imagen' => env('HOST') . '/storage/imagenes/speakers/' . $evento->ponente->imagen,
                'ponente_nombre' => $evento->ponente->nombre . " " . $evento->ponente->apellido,
                'eventoId' => $evento->id,
                'disponibles' => $evento->disponibles
                ])
                @endcomponent
                @endforeach
            </div>
        </main>

        <aside class="flex-[0_0_40%] bg-grisClaro p-8 rounded-xl sm:sticky sm:top-8">
            <h1 class="titulo-front">Tu registro</h1>

            <div id="mostrar-regitro" class="">

            </div>
            <div class="registro-regalo">
                <label for="regalo" class="label mt-5 font-black text-xl">Selecciona un regalo</label>
                <select id="regalo" class="w-full rounded">
                    <option value="" class="text-center">-- Selecciona tu regalo --</option>
                    @foreach ($regalos as $regalo)
                    <option value="{{ $regalo->id }}">{{ $regalo->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <form action="/finalizar-registro/conferencias" method="post" class="" id="registro">
                @csrf
                <div class="">
                    <input type="submit" class="btn-crear w-full mt-5" value="Registrarme">
                </div>
            </form>
        </aside>


    </div>
</section>
@stop

