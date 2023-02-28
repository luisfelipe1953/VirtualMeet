<div class="swiper-slide">
    <p class="font-bold m-4">{{ $hora }}</p>
    <div class="p-[20px] rounded-[10px] bg-primario text-white transform transition-transform duration-300 ease-in-out hover:bg-primarioDarken bg-secundarioSpecific">
        <h4 class="text-xl font-bold mb-3 evento-nombre">{{ $nombre }}</h4>
        <p class="text-base evento-introduccion">{{ $descripcion }}</p>
        <div class="flex gap-[20px] justify-between items-center mt-4">
            <picture>
                <source srcset="{{ $ponente_imagen }}.png" type="image/png">
                <img class="w-[50px] bg-white rounded-full" loading="lazy" width="200" height="300" src="{{ $ponente_imagen }}.png" alt="Imagen Ponente">
            </picture>
            <p class="font-bold">
                {{ $ponente_nombre }}
            </p>
        </div>
    </div>
</div>

