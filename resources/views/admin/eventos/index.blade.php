@extends('layouts.plantillaCrud')

@section('crud-header')
<h1 class="text-center">Conferencias y Workshop</h1>
@endsection

@section('style')

@endsection

@section('crud')

<div class="sm:flex sm:justify-end">
    <a class="btn-crear block sm:inline " href="{{route('eventos.create')}}">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Evento
    </a>
</div>
@if (session('success'))
        <div class="alerta-exito my-5">
            {{ session('success') }}
        </div>
@endif

<div>
    @if(!empty($eventos))

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Evento
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tipo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Dia y Hora
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ponente
                    </th>
                    <th scope="col" class="px-6 py-3">

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach( $eventos as $evento)

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th class="px-6 py-4">
                        {{$evento->nombre}}
                    </th>
                    <td class="px-6 py-4">
                        {{ $evento->categoria->nombre }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $evento->dia->nombre . ", " . $evento->hora->hora }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $evento->ponente->nombre . ", " . $evento->ponente->apellido }}
                    </td>
                    <td class="px-6 py-4 flex text-base">
                        <a href="{{route('eventos.edit', $evento)}}" class="hover:text-primarioDarken font-bold mr-2 text-primario">
                            <i class="fa-solid fa-pencil text-primario"></i>
                            Editar</a>
                        <form action="{{route('eventos.destroy', $evento->id)}}" method="POST" class="text-red font-bold ">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="hover:text-red-800">
                                <i class="fa-solid fa-circle-xmark text-red"></i>
                                Eliminar</button>
                        </form>
                    </td>

                </tr>

                @endforeach
            </tbody>
        </table>

    </div>

    @else
    <p class="text-center">No hay eventos aun</p>
    @endif
    <div class="paginacion">
        {!! $paginacion->enlace_anterior() !!}
        <div class="pagina-numeros">
            {!! $paginacion->numeros_paginas() !!}
        </div>

        {!! $paginacion->enlace_siguiente() !!}
    </div>
</div>


@section('script')



@endsection


@endsection