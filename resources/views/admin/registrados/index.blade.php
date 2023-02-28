@extends('layouts.plantillaCrud')

@section('crud-header')
<h1 class="text-center">Usuarios Registrados</h1>
@endsection

@section('style')

@endsection

@section('crud')
<div>
    @if(!empty($registros))
    <div class="mt-10 relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Nombre</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Plan</th>
                </tr>
            </thead>

            <tbody class="">
                @foreach ($registros as $registro)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        {{ $registro->usuario->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $registro->usuario->email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $registro->paquete->nombre }}
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>

    </div>
    @else
    <p class="text-center">No hay registros aun</p>
    @endif
    <div class="paginacion">
        {!! $paginacion->enlace_anterior() !!}
        <div class="pagina-numeros">
            {!! $paginacion->numeros_paginas() !!}
        </div>

        {!! $paginacion->enlace_siguiente() !!}
    </div>
</div>


@endsection