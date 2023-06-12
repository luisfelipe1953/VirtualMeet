@extends('layouts.plantillaCrud')

@section('crud-header')
<h1 class="text-center">Ponentes / Conferencias</h1>
@endsection

@section('style')

@endsection

@section('crud')

<div class="sm:flex sm:justify-end">
    <a class="btn-crear block sm:inline " href="{{route('speakers.create')}}">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Ponente
    </a>
</div>

@if (session('success'))
<div class="alerta-exito my-5">
    {{ session('success') }}
</div>
@endif

<div>
    @if(!empty($ponentes))

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>

                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ubicuacion
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach( $ponentes as $ponente)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="w-10 h-10 rounded-full" srcset="{{ env('HOST') . '/storage/imagenes/speakers/' . $ponente->imagen }}.webp" alt="">
                        <div class="pl-3">
                            <div class="text-base font-semibold">{{$ponente->name}}</div>
                            <div class="font-normal text-gray-500">{{$ponente->lastname}}</div>
                        </div>
                    </th>
                    <td class="px-6 py-4">
                        {{$ponente->city . ", ". $ponente->country}}
                    </td>
                    <td class="py-4 flex text-base">
                        <a href="{{route('speakers.edit', $ponente)}}" class="hover:text-primarioDarken font-bold mr-2 text-primario">
                            <i class="fa-solid fa-user-pen text-primario"></i>
                            Editar</a>
                        <form action="{{route('speakers.destroy', $ponente->id)}}" method="POST" class="text-red font-bold ">
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
    <p class="text-center">No hay ponentes aun</p>
    @endif
    <div class="paginacion">
        <span>Página {{ $ponentes->currentPage() }} de {{ $ponentes->lastPage() }}:</span>
        <ul class="pagina-numeros">
            @if ($ponentes->currentPage() > 1)
            <li><a href="{{ $ponentes->previousPageUrl() }}" rel="prev">&laquo;</a></li>
            @endif

            @for ($i = 1; $i <= $ponentes->lastPage(); $i++)
                <li class="{{ ($ponentes->currentPage() == $i) ? ' active' : '' }}">
                    <a href="{{ $ponentes->url($i) }}">{{ $i }}</a>
                </li>
                @endfor

                @if ($ponentes->hasMorePages())
                <li><a href="{{ $ponentes->nextPageUrl() }}" rel="next">&raquo;</a></li>
                @endif
        </ul>
    </div>
</div>


@section('script')

@vite('resources/js/tags.js')

@endsection


@endsection