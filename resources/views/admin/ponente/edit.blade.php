@extends('layouts.plantillaCrud')

@section('crud-header')
<h1 class="text-center">Editar articulo</h1>
@endsection

@section('crud')
<div class="sm:flex sm:justify-end">
    <a class="btn-crear block sm:inline " href="{{route('ponentes.index')}}">
        <i class="fa-solid fa-arrow-left"></i>
        Volver
    </a>
</div>

<form action="/speakers/{{$ponente->id}}" method="POST" class="container-md mx-auto sm:shadow-form bg-white p-[20px] rounded-xl mt-12" enctype="multipart/form-data">
    @csrf
    @method('PUT')  
    @include('admin.ponente.formulario')

        <button type="submit" class="btn-crear w-full mt-4">Guardar</button>

</form>

@section('script')

@vite('resources/js/tags.js')

@endsection

@endsection