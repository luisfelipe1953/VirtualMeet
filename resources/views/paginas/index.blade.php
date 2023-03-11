@extends('layout')

@section('contenido')

<main class="sm:container container-md mx-auto">
    <h1 class="titulo-front">Workshops & Conferencias</h1>
    <p class="subtitulo-front">Talleres y Conferencias dictados por expertos en desarrollo web</p>

    <div class="">
        <h1 class="agenda-titulo text-primarioDarken my-12 mx-0">&lt;Conferencias /></h1>
        <p class="text-gris mt-[30px] mb-[10px]">Viernes 5 de Octubre</p>

        <div class="slider swiper">
            <div class="swiper-wrapper">
                @foreach($eventos['conferencias_v'] as $evento )
                <!-- // puede ser un componente -->
                @component('components.evento', [
                'hora' => $evento->hora->hora,
                'nombre' => $evento->nombre,
                'descripcion' => $evento->descripcion,
                'ponente_imagen' => $evento->ponente->imagen,
                'ponente_nombre' => $evento->ponente->nombre . " " . $evento->ponente->apellido
                ])
                @endcomponent
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <p class="text-gris mt-[30px] mb-[10px]">Sábado 6 de Octubre</p>

        <div class="slider swiper">
            <div class="swiper-wrapper">
                @foreach ($eventos['conferencias_s'] as $evento)
                @component('components.evento', [
                'hora' => $evento->hora->hora,
                'nombre' => $evento->nombre,
                'descripcion' => $evento->descripcion,
                'ponente_imagen' => $evento->ponente->imagen,
                'ponente_nombre' => $evento->ponente->nombre . " " . $evento->ponente->apellido
                ])
                @endcomponent
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    <div class="">
        <h1 class="agenda-titulo text-secundarioDarken">&lt;Workshops /></h1>
        <p class="text-gris mt-[30px] mb-[10px]">Viernes 5 de Octubre</p>

        <div class="slider swiper specific-location">
            <div class="swiper-wrapper">
                @foreach ($eventos['workshops_v'] as $evento)
                @component('components.evento', [
                'hora' => $evento->hora->hora,
                'nombre' => $evento->nombre,
                'descripcion' => $evento->descripcion,
                'ponente_imagen' => $evento->ponente->imagen,
                'ponente_nombre' => $evento->ponente->nombre . " " . $evento->ponente->apellido
                ])
                @endcomponent
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <p class="text-gris mt-[30px] mb-[10px]">Sábado 6 de Octubre</p>

        <div class="slider swiper specific-location">
            <div class="swiper-wrapper">
                @foreach ($eventos['workshops_s'] as $evento)
                @component('components.evento', [
                'hora' => $evento->hora->hora,
                'nombre' => $evento->nombre,
                'descripcion' => $evento->descripcion,
                'ponente_imagen' => $evento->ponente->imagen,
                'ponente_nombre' => $evento->ponente->nombre . " " . $evento->ponente->apellido
                ])
                @endcomponent
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</main>


<section>
    <img src="{{ url('img/bg_numeros.jpg') }}" alt="" class="object-cover w-full absolute h-[450px]  z-10">
    <div class="bg-gradient-to-r from-secundario to-primario opacity-75 h-[450px] absolute w-full z-20">
    </div>
    <div class="sm:container container-md mx-auto grid grid-cols-2 text-center items-center mt-[30px] h-[450px] leading-none text-2xl uppercase relative text-white z-30 font-black ">
        <div {{ aos_animacion(); }}>
            <p class="text-7xl">{{ $ponentes }}</p>
            <p>Speakers</p>
        </div>
        <div {{ aos_animacion(); }}>
            <p class="text-7xl">{{ $conferencias }}</p>
            <p>Conferecias</p>
        </div>
        <div {{ aos_animacion(); }}>
            <p class="text-7xl">{{ $workshops }}</p>
            <p>Worshops</p>
        </div>
        <div {{ aos_animacion(); }}>
            <p class="text-7xl">500</p>
            <p>Asistentes</p>
        </div>
    </div>
</section>

<section>
    <h1 class="text-center text-4xl font-black m-12">Speakers</h1>
    <p class="text-center mb-12">Conoce a nuestros expertos de DevWebCamp</p>
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
                <source srcset="{{ env('HOST') . '/storage/imagenes/speakers/' . $speaker->imagen }}.png" type="image/png">
                <img class="w-full  m-0" loading="lazy" width="200" height="300" src="{ env('HOST') . '/storage/imagenes/speakers/' . $speaker->imagen }}.png" alt="Imagen spe$speaker">
            </picture>

            <div class="speaker__informacion">
                <h4 class="text-2xl font-black my-[20px]">
                    {{ $speaker->nombre . ' ' . $speaker->apellido }}
                </h4>

                <p class="text-gris my-[10px] text-xl leading-normal ">
                    {{ $speaker->ciudad . ', ' . $speaker->pais }}
                </p>

                <nav class="flex text-xl gap-[20px] mx-0 mt-[20px] ">
                    @php
                    $redes = json_decode( $speaker->redes );
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
        <a href="/speakers" class="btn-crear">Ver mas </a>
    </div>
</section>

<div id="mapa" class="h-[450px] mt-10">
    <!-- mapaaaa -->
</div>

<section id="paquetes">
    <h2 class="text-4xl text-center font-black m-12">Boletos & Precios</h2>
    <p class="text-center mb-12">Precios para ViertualMeet</p>

    <div  class="grid grid-cols-1 gap-[50px] max-w-[800px] mx-auto">
        <div  class="boleto boleto-Presencial">
            <div class="boleto-decoration top-[45%] right-[-14px]"></div>
            <div class="boleto-decoration top-[45%] left-[-14px]"></div>
            <h4 class="logo-normal font-black">&#60;ViertualMeet /></h4>
            <p class="uppercase mt-[30px] text-sm sm:text-xl">Presencial</p>
            <p class="mt-[30px] font-black text-xl sm:text-[40px]">$199</p>

        </div>

        <div class="boleto boleto-Virtual">
            <div class="boleto-decoration top-[45%] right-[-14px]"></div>
            <div class="boleto-decoration top-[45%] left-[-14px]"></div>
            <h4 class="logo-normal font-black">&#60;ViertualMeet /></h4>
            <p class="uppercase mt-[30px] text-sm sm:text-xl">Virtual</p>
            <p class="mt-[30px] font-black text-xl sm:text-[40px]">$49</p>
        </div>

        <div class="boleto boleto-Gratis">
            <div class="boleto-decoration top-[45%] right-[-14px]"></div>
            <div class="boleto-decoration top-[45%] left-[-14px]"></div>
            <h4 class="logo-normal font-black">&#60;ViertualMeet /></h4>
            <p class="uppercase mt-[30px]  text-sm sm:text-xl">Gratis</p>
            <p class="mt-[30px] font-black text-xl sm:text-[40px]">Gratis - $0</p>
        </div>
    </div>

    <div class="text-center mt-10">
        <a href="/paquetes" class="btn-crear ">Ver Paquetes</a>
    </div>
</section>


@stop