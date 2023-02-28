@if ($errors->any())
@foreach ($errors->all() as $error)
<p class="alerta-error">{{ $error }}</p>
<br>
@endforeach
@endif
<div class="mb-6">
    <label for="nombre" class="label">Nombre</label>
    <input type="text" id="nombre" name="nombre" class="labelInput" placeholder="Tu Nombre" value="{{ old('nombre', $ponente->nombre)}}">
</div>
<div class="mb-6">
    <label for="apellido" class="label">Apellido</label>
    <input type="text" id="apellido" name="apellido" class="labelInput" placeholder="Tu Apellido" value="{{ old('apellido', $ponente->apellido)}}">
</div>
<div class="mb-6">
    <label for="ciudad" class="label">Ciudad</label>
    <input type="text" id="ciudad" name="ciudad" class="labelInput" placeholder="Tu ciudad" value="{{ old('ciudad', $ponente->ciudad) }}">
</div>
<div class="mb-6">
    <label for="pais" class="label">Pais</label>
    <input type="text" id="pais" name="pais" class="labelInput" placeholder="Tu pais" value="{{ old('pais', $ponente->pais) }}">
</div>
<div class="mb-6">
    <label for="imagen" class="label">Imagen</label>
    <input type="file" id="imagen" name="imagen" class="labelInput">
    @if(isset($ponente->imagenActual))
    <p class="">Imagen Actual:</p>
    <div class="max-w-[200px]">
        <picture>
            <source srcset="{{ env('HOST') . '/storage/imagenes/speakers/' . $ponente->imagen }}.webp" type="image/webp">
            <source srcset="{{ env('HOST') . '/storage/imagenes/speakers/' . $ponente->imagen }}.png" type="image/png">
            <img src="{{ env('HOST') . '/imagenes/speakers/' . $ponente->imagen }}.png" alt="Imagen Ponente">
        </picture>
    </div>
    @endif
</div>
<div>
    <p class="mb-2">Informacion Extra</p>
    <div class="mb-6">
        <label for="tags_input" class="label">Areas de Experiencia (separadas por coma)</label>
        <input type="text" id="tags_input" class="labelInput" placeholder="Ej. Node.js, PHP, CSS, Laravel, Deno, RUST">
    </div>
    <div id="tags" class="flex flex-wrap gap-3 list-none m-0 "></div>
    <input type="hidden" name="tags" value="{{ old('tags', $ponente->tags) }}">
</div>
<div>
    <p class="my-3">Redes Sociales</p>
    <div class="flex mt-2">
        <div class="bg-grisoscuro w-[40px] flex justify-center items-center rounded-l-lg">
            <i class="fa-brands fa-facebook text-white text-xl"></i>
        </div>
        <input type="text" name="redes[facebook]" class="labelInput rounded-l-none " placeholder="Facebook" value="{{ old('redes.facebook', $redes->facebook) }}">
    </div>
    <div class="flex  mt-2">
        <div class="bg-grisoscuro w-[40px] flex justify-center items-center rounded-l-lg">
            <i class="fa-brands fa-twitter text-white text-xl"></i>
        </div>
        <input type="text" name="redes[twitter]" class="labelInput rounded-l-none " placeholder="Twitter" value="{{ old('redes.twitter', $redes->twitter) }}">
    </div>
    <div class="flex mt-2">
        <div class="bg-grisoscuro w-[40px] flex justify-center items-center rounded-l-lg">
            <i class="fa-brands fa-youtube text-white text-xl"></i>
        </div>
        <input type="text" name="redes[youtube]" class="labelInput rounded-l-none " placeholder="Youtube" value="{{ old('redes.youtube', $redes->youtube) }}">
    </div>
    <div class="flex mt-2">
        <div class="bg-grisoscuro w-[40px] flex justify-center items-center rounded-l-lg">
            <i class="fa-brands fa-instagram text-white text-xl"></i>
        </div>
        <input type="text" name="redes[instagram]" class="labelInput rounded-l-none " placeholder="Instagram" value="{{ old('redes.instagram', $redes->instagram) }}">
    </div>
    <div class="flex mt-2">
        <div class="bg-grisoscuro w-[40px] flex justify-center items-center rounded-l-lg">
            <i class="fa-brands fa-tiktok text-white text-xl"></i>
        </div>
        <input type="text" name="redes[tiktok]" class="labelInput rounded-l-none " placeholder="Tiktok" value="{{ old('redes.tiktok', $redes->tiktok) }}">
    </div>
    <div class="flex mt-2">
        <div class="bg-grisoscuro w-[40px] flex justify-center items-center rounded-l-lg">
            <i class="fa-brands fa-github text-white text-xl"></i>
        </div>
        <input type="text" name="redes[github]" class="labelInput rounded-l-none " placeholder="Github" value="{{ old('redes.github', $redes->github) }}">
    </div>