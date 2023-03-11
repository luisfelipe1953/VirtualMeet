@extends('layouts.plantillaCrud')

@section('crud-header')
<h1 class="text-center">Panel de Administracion</h1>
@endsection

@section('style')

@endsection

@section('crud')

<section class="container mx-auto">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 ">
        <div class="bg-gradient-to-r from-cyan-500 to-blue-500 opacity-75 rounded text-white pt-5 pb-20 px-5">
            <h3 class="text-center font-black text-3xl">Últimos Registros</h3>
            <div class="mt-5">
            @if(!empty($registros))
                @foreach ($registros as $registro)
                <p class="">
                    {{ $registro->usuario->name }}
                </p>
                @endforeach
            @endif
            </div>
        </div>

        <div class="bg-secundario opacity-75 rounded text-white pt-5 pb-20 px-5">
            <h3 class="text-center font-black text-3xl">Ingresos</h3>
            <p class="text-center font-black text-5xl mt-5">$ {{ $ingresos }}</p>
        </div>

        <div class="bg-primario opacity-75 rounded text-white pt-5 pb-20 px-5">
            <h3 class="text-center font-black text-3xl">Eventos Con Menos Lugares Disponibles</h3>
            <div class="mt-5">
            @if(!empty($menos_disponibles))
                @foreach ($menos_disponibles as $evento)
                <p class="bloque__texto">
                    {{ $evento->nombre . " - " . $evento->disponibles . ' Disponibles' }}
                </p>
                @endforeach
            @endif
            </div>
        </div>

        <div class="bg-grisoscuro opacity-75 rounded text-white pt-5 pb-20 px-5">
            <h3 class="text-center font-black text-3xl">Eventos Con Más Lugares Disponibles</h3>
            <div class="mt-5">
            @if(!empty($mas_disponibles))
                @foreach ($mas_disponibles as $evento)
                <p class="bloque__texto">
                    {{ $evento->nombre . " - " . $evento->disponibles . ' Disponibles' }}
                </p>
                @endforeach
            @endif
            </div>
        </div>
    </div>
</section>


@endsection