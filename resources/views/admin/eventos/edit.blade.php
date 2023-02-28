@extends('layouts.plantillaCrud')

@section('crud-header')
<h1 class="text-center">Conferencias y Workshop</h1>
@endsection

@section('style')

@endsection

@section('crud')

<div class="sm:flex sm:justify-end">
    <a class="btn-crear block sm:inline " href="{{route('eventos.index')}}">
        <i class="fa-solid fa-arrow-left"></i>
        Volver
    </a>
</div>


<div class="container-md mx-auto sm:shadow-form bg-white p-[20px] rounded-xl mt-12">
    <form action="/eventos/{{$evento->id}}" method="POST" enctype="multipart/form-data">
        <p class="mb-2">Informacion Evento</p>
        @csrf
        @method('PUT')
        @include('admin.eventos.formulario')
        <button type="submit" class="btn-crear w-full mt-4">Guardar</button>
    </form>
</div>




@section('script')

@vite('resources/js/horas.js')
@vite('resources/js/ponentes.js')

@endsection


@endsection