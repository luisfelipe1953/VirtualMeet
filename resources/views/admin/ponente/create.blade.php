@extends('layouts.plantillaCrud')

@section('crud-header')
<h1 class="text-center">Registrar Ponente</h1>

@endsection

@section('crud')
<div class="sm:flex sm:justify-end">
    <a class="btn-crear block sm:inline " href="{{route('ponentes.index')}}">
        <i class="fa-solid fa-arrow-left"></i>
        Volver
    </a>
</div>

<div class="container-md mx-auto sm:shadow-form bg-white p-[20px] rounded-xl mt-12">
    <form action="{{route('ponentes.index')}}" method="POST" enctype="multipart/form-data">
        <p class="mb-2">Informacion Personal</p>
        @csrf
        @include('admin.ponente.formulario')

        <button href="{{route('ponentes.index')}}" type="submit" class="btn-crear w-full mt-4">Registrar Ponente</button>
    </form>
</div>
@section('script')


@vite('resources/js/tags.js')


@endsection
@endsection