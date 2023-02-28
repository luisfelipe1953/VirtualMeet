@extends('layout')

@section('contenido')
<h1 class="titulo-front">Sobre VirtualMeet</h1>
<p class="subtitulo-front">Conoce la conferencia mas importante de latinoamerica</p>
<div class="sm:container container-md mx-auto grid sm:grid-cols-2 grid-cols-1 gap-x-14 items-center">
    <img {{ aos_animacion(); }} src="img/sobre_devwebcamp.jpg" alt="imagen sobre virtualmeet">
    <div {{ aos_animacion(); }} class="leading-loose">
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum impedit aspernatur expedita libero delectus ad,
             ea nesciunt tempore at eum molestiae ullam porro aperiam? Magni maxime repudiandae mollitia hic quia!
            Enim maiores voluptatum ut officia repellendus exercitationem recusandae ducimus?
        </p>
        <p class="mt-4">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque commodi quibusdam facere ipsum alias sunt fugiat expedita delectus, 
            tempora recusandae amet veniam aspernatur quidem ipsa animi quasi culpa adipisci perferendis!
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellendus in, iste provident quis architecto necessitatibus eum, placeat, 
            sapiente rem iusto ratione ipsum dolorem inventore hic quas illum. Enim, libero ipsa.
        </p>
    </div>

</div>

@stop