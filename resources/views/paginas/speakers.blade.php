
@extends('layout')

@section('contenido')

<section class="sm:container container-md mx-auto">
<h1 class="titulo-front">Speakers</h1>
    <p  class="subtitulo-front">Conoce a nuestros expertos de Virtualmeet</p>
    <div class="sm:container container-md mx-auto grid grid-cols-1 gap-12 md:grid-cols-2 xl:grid-cols-3">
        @foreach($speakers as $speaker)
  <div {{ aos_animacion(); }}  class="border border-gray-600 p-8 m-3 bg-child bg-no-repeat bg-[length:350px] bg-top">
            <style>
                .bg-child:nth-child(4n + 1) {
                    background-image: url('/img/bg_1.png');
                }

                .bg-child:nth-child(4n + 2) {
                    background-image: url('/img/bg_2.png');
                }

                .bg-child:nth-child(4n + 3) {
                    background-image: url('/img/bg_3.png');
                }

                .bg-child:nth-child(4n + 4) {
                    background-image: url('/img/bg_4.png');
                }
            </style>
            <picture>
                <source srcset="{{ env('HOST') . '/storage/img/speakers/' . $speaker->image }}.png" type="image/png">
                <img class="w-full  m-0" loading="lazy" width="200" height="300" src="{ env('HOST') . '/storage/img/speakers/' . $speaker->image }}.png" alt="Imagen spe$speaker">
            </picture>

            <div class="speaker__informacion">
                <h4 class="text-2xl font-black my-[20px]">
                    {{ $speaker->name . ' ' . $speaker->lastname }}
                </h4>

                <p class="text-gris my-[10px] text-xl leading-normal ">
                    {{ $speaker->city . ', ' . $speaker->country }}
                </p>

                <nav class="flex text-xl gap-[20px] mx-0 mt-[20px] ">
                    @php
                    $redes = json_decode( $speaker->networks );
                    @endphp

                    @if(!empty($redes->facebook))
                    <a class="" rel="noopener noreferrer" target="_blank" href="{{ $redes->facebook }}">
                        <i class="fa-brands fa-facebook-f"></i>
                        <span class="sr-only">Facebook</span>
                    </a>
                    @endif

                    @if(!empty($redes->twitter))
                    <a class="" rel="noopener noreferrer" target="_blank" href="{{ $redes->twitter }}">
                        <i class="fa-brands fa-twitter"></i>
                        <span class="sr-only">Twitter</span>
                    </a>
                    @endif

                    @if(!empty($redes->youtube))
                    <a class="" rel="noopener noreferrer" target="_blank" href="{{ $redes->youtube }}">
                        <i class="fa-brands fa-youtube"></i>
                        <span class="sr-only">YouTube</span>
                    </a>
                    @endif

                    @if(!empty($redes->instagram))
                    <a class="" rel="noopener noreferrer" target="_blank" href="{{ $redes->instagram }}">
                        <i class="fa-brands fa-instagram"></i>
                        <span class="sr-only">Instagram</span>
                    </a>
                    @endif

                    @if(!empty($redes->tiktok))
                    <a class="" rel="noopener noreferrer" target="_blank" href="{{ $redes->tiktok }}">
                        <i class="fa-brands fa-tiktok"></i>
                        <span class="sr-only">TikTok</span>
                    </a>
                    @endif
                    @if(!empty($redes->tiktok))
                    <a class="" rel="noopener noreferrer" target="_blank" href="{{ $redes->tiktok }}">
                        <i class="fa-brands fa-github"></i>
                        <span class="sr-only">Github</span>
                    </a>
                    @endif
                </nav>
                <ul class="flex mt-6 gap-3 flex-wrap">
                    @foreach(explode(',', $speaker->tags) as $tag)
                    <li class="tag">{{ $tag }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        @endforeach
    </div>
</section>

@stop 