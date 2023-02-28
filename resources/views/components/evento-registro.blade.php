<div class="">
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
        <button {{ $disponibles == 0 ? 'disabled' : ''}} class="evento-agregar disabled:opacity-75 disabled:cursor-not-allowed p-5 w-full rounded-xl mt-5 bg-white text-black hover:cursor-pointer" type="button" data-id="{{ $eventoId }}">
                {{ $disponibles == 0 ? 'Agotado' : 'Agregar - ' . $disponibles . ' disponibles'}}
            </button>
    </div>
</div>

