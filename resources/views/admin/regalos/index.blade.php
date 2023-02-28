@extends('layouts.plantillaCrud')

@section('crud-header')
<h1 class="text-center">Regalos</h1>
@endsection

@section('style')

@endsection

@section('crud')
<div class="container-md mx-auto">
    <canvas id="grafico-regalos"></canvas>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@vite('resources/js/regalos.js')
@endsection