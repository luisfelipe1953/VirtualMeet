@if ($errors->any())
@foreach ($errors->all() as $error)
<p class="alerta-error">{{ $error }}</p>
<br>
@endforeach
@endif
<div class="mb-6">
    <label for="nombre" class="label">Nombre Evento</label>
    <input type="text" id="nombreEvento" name="nombre" class="labelInput" placeholder="Nombre del evento" value="{{ old('nombre', $evento->nombre)}}">
</div>
<div class="mb-6">
    <label for="descripcion" class="label">Descripcion</label>
    <textarea id="descripcion" name="descripcion" class="labelInput" placeholder="Descripcion del Evento" rows="8">{{ old('descripcion', $evento->descripcion)}}</textarea>
</div>

<div class="mb-6">
    <label for="categoria" class="label">Categoria O Tipo de Evento</label>

    <select id="categoria" name="categoria_id" class="labelInput">
        <option value="">- Seleccionar -</option>
        @foreach($categorias as $categoria)
        <option value="{{ $categoria->id }}" {{ old('categoria_id', $evento->categoria_id) == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
        @endforeach
    </select>

</div>

<div class="mb-6">
    <label for="" class="label">Seleccionar el Dia</label>
    <div class="flex items-center gap-4">
        @foreach($dias as $dia)
        <label class="label m-0" for="{{ strtolower($dia->nombre)}}">{{ $dia->nombre}}</label>
        <input type="radio" value="{{$dia->id}}" id="{{ strtolower($dia->nombre)}}" name="dia" {{ old('dia', $evento->dia_id) == $dia->id ? 'checked' : '' }} @endforeach </div>
        <input type="hidden" name="dia_id" value="{{ old('dia_id', $evento->dia_id)}}">

    </div>
    <div class="mb-6">
        <label for="" class="label">Seleccionar Hora</label>
        <ul id="horas" class="grid sm:grid-cols-2 grid-cols-1 gap-4 text-center hover:cursor-pointer text-primarioDarken">
            @foreach($horas as $hora)
            <li data-hora-id="{{$hora->id}}" class="border-2 rounded-lg p-[10px] hora-abilitada hora-desabilitada">{{$hora->hora}}</li>
            @endforeach
        </ul>
        <input type="hidden" name="hora_id" value="{{ old('hora_id', $evento->hora_id)}}">
    </div>
    <p class="mb-2">Informacion Extra</p>
    <div class="mb-6">
        <label for="ponentes" class="label">Ponente</label>
        <input type="text" id="ponentes" class="labelInput" placeholder="Buscar ponentes" value="{{ old('ponente_id', $evento->ponentes_id)}}">

        <ul id="ul-ponentes" class="grid grid-cols-1 gap-[10px]  mt-[10px]">
            <!-- //js ponentes-->
        </ul>
        <input type="hidden" name="ponente_id" value="{{ old('ponente_id', $evento->ponente_id)}}">
    </div>
    <div class="mb-6">
        <label for="disponibles" class="label">Lugares Disponibles</label>
        <input type="number" id="disponibles" name="disponibles" class="labelInput" placeholder="Ej. 20" min="1" value="{{ old('disponibles', $evento->disponibles)}}"">
        </div>