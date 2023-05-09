@if (isset($errors) && $errors->any())
@foreach ($errors->all() as $error)
<p class="alerta-error">{{ $error }}</p>
<br>
@endforeach
@endif
<div class="mb-6">
    <label for="nombre" class="label">Nombre Evento</label>
    <input type="text" id="nombreEvento" name="name" class="labelInput" placeholder="Nombre del evento" value="{{ old('name', $evento->name)}}">
</div>
<div class="mb-6">
    <label for="descripcion" class="label">Descripcion</label>
    <textarea id="descripcion" name="description" class="labelInput" placeholder="Descripcion del Evento" rows="8">{{ old('description', $evento->description)}}</textarea>
</div>

<div class="mb-6">
    <label for="categoria" class="label">Categoria O Tipo de Evento</label>

    <select id="categoria" name="category_id" class="labelInput">
        <option value="">- Seleccionar -</option>
        @foreach($data['categories'] as $category)
        <option value="{{ $category->id }}" {{ old('category_id', $evento->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>

</div>

<div class="mb-6">
    <label for="" class="label">Seleccionar el Dia</label>
    <div class="flex items-center gap-4">
        @foreach($data['days'] as $day)
        <label class="label m-0" for="{{ strtolower($day->name)}}">{{ $day->name}}</label>
        <input type="radio" value="{{$day->id}}" id="{{ strtolower($day->name)}}" name="day" {{ old('day_id', $evento->day_id) == $day->id ? 'checked' : '' }}>
        @endforeach
        <input type="hidden" name="day_id" value="{{ old('day_id', $evento->day_id)}}">

    </div>
    <div class="mb-6">
        <label for="" class="label">Seleccionar Hora</label>
        <ul id="horas" class="grid sm:grid-cols-2 grid-cols-1 gap-4 text-center hover:cursor-pointer text-primarioDarken">
            @foreach($data['times'] as $time)
            <li data-hora-id="{{$time->id}}" class="border-2 rounded-lg p-[10px] hora-abilitada hora-desabilitada">{{$time->time}}</li>
            @endforeach
        </ul>
        <input type="hidden" name="time_id" value="{{ old('time_id', $evento->time_id)}}">
    </div>
    <p class="mb-2">Informacion Extra</p>
    <div class="mb-6">
        <label for="ponentes" class="label">Ponente</label>
        <input type="text" id="speaker" class="labelInput" placeholder="Buscar ponentes" value="{{ old('speaker_id', $evento->speakers_id)}}">

        <ul id="ul-ponentes" class="grid grid-cols-1 gap-[10px]  mt-[10px]">
            <!-- //js ponentes-->
        </ul>
        <input type="hidden" name="speaker_id" value="{{ old('speaker_id', $evento->speaker_id)}}">
    </div>
    <div class="mb-6">
        <label for="disponibles" class="label">Lugares Disponibles</label>
        <input type="number" id="disponibles" name="available" class="labelInput" placeholder="Ej. 20" min="1" value="{{ old('available', $evento->available)}}">
        </div>