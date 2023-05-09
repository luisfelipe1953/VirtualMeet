@extends('layout')

@section('contenido')


<main>
    <h1 class="titulo-front">Asistencia a VirtualMeet</h1>
    <p class="subtitulo-front">Tu Boleto - Te recomendamos almacenarlo, puedes compartirlo en redes sociales.</p>

    <div>
        <div class="grid grid-cols-1 gap-[50px] max-w-[800px] mx-auto">
            <div class="boleto boleto-{{ $registro->package->name }}">
                <div class="boleto-decoration top-[45%] right-[-14px]"></div>
                <div class="boleto-decoration top-[45%] left-[-14px]"></div>
                <h1 class="logo-normal font-black">&#60; VirtualMeet /></h1>
                <p class="uppercase mt-[30px] text-sm sm:text-xl">{{ $registro->package->name }}</p>
                <p class="text-2xl uppercase font-black mb-5 mr-10">{{ $registro->user->name }}</p>
                <p class="codigo"> {{'#' . $registro->token }}</p>
            </div>

        </div>
    </div>
</main>
@stop