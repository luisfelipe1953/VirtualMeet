@extends('adminlte::page')

@section('title', 'VirtualMeet')

@section('content_header')
    @yield('crud-header')
@stop

@section('content')
    @yield('crud')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
    @vite('resources/css/app.css')
    @yield('style')
@stop

@section('js')
    @yield('script')
@stop