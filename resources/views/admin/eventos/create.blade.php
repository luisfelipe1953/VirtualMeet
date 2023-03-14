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

@if (session('success'))
        <div class="alerta-exito my-5">
            {{ session('success') }}
        </div>
@endif



<div class="container-md sm:shadow-form bg-white p-[20px] rounded-xl mt-12">
    <form action="{{route('eventos.index')}}" method="POST" enctype="multipart/form-data">
        <p class="mb-2">Informacion Evento</p>
        @csrf
        @include('admin.eventos.formulario')
        <button href="{{route('eventos.index')}}" type="submit" class="btn-crear w-full mt-4">Registrar Evento</button>
    </form>
</div>


@section('script')


@vite('resources/js/horas.js')
@vite('resources/js/ponent.js')


@endsection


@endsection