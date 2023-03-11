<!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
<div class="min-h-[600px]">
    <div class="">
        <img src="{{ url('img/header.jpg') }}" alt="" class="object-cover w-full absolute h-[600px] z-0">
        <img src="{{ url('img/2.png') }}" alt="" class="absolute z-20 w-[400px]">
        <a href="#paquetes" class="">
            <img src="{{ url('img/3.png') }}" alt="" class="transition-transform ease-in-out hover:scale-110  animate-slide absolute z-20 sm:w-[200px] w-[160px] sm:inset-x-3/4 inset-x-48 sm:inset-y-1/4 inset-y-2/4 invert  ">
        </a>

    </div>
    <div class="bg-gradient-to-r from-black min-h-[600px] absolute top-0 left-0 w-full z-10"></div>
    <div class="container mx-auto  text-white relative z-30">
        <div>
            @if (Route::has('login'))
            <nav class="py-[50px] flex justify-center sm:justify-end nav gap-[20px]">
                @auth
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="text-white uppercase text-sm font-bold hover:text-primario">Cerrar sesión</button>
                </form>
                @can('admin')
                <a href=" {{ url('dashboard') }}" class="text-white uppercase text-sm font-bold hover:text-primario mt-[3px]">Admin</a>
                @endcan

                @else
                <a href="{{ route('login') }}" class="text-white uppercase text-sm font-bold  hover:text-primario">Log in</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="text-white uppercase text-sm font-bold hover:text-primario mr-0">Register</a>
            </nav>
            @endif
            @endauth
            @endif
        </div>


        <div class="pt-[100px] sm:pt[50px]">
            <div class="">
                <a href="/">
                    <h1 class="logo ml-2 sm:ml-0 text-center sm:text-left inline-block bg-clip-text bg-gradient-to-r from-blue-500 to-green-500">
                        &#60;VirtualMeet />
                    </h1>
                </a>
                <p class="ttext-2xl ml-2 sm:ml-0 font-bold my-[20px]  uppercase">Octubre 5-6 2023</p>
                <p class="text-xl ml-2 sm:ml-0 font-bold my-[20px]  uppercase">En Linea - Precencial</p>
                <a href="/paquetes" class="ml-2 sm:ml-0 btn-primario">Comprar Pase</a>
            </div>
        </div>
    </div>

</div>


<div class="bg-primario">
    <div class="container mx-auto flex flex-col sm:flex-row justify-between text-white">
        <a href="/">
            <h1 class="logo-normal mt-2 sm:mb-0 mb-5">
                &#60;VirtualMeet />
            </h1>
        </a>
        <nav class="flex flex-col sm:flex-row">
            <a class="text-xl p-[20px] text-center font-black uppercase hover:bg-blanco hover:text-primario {{ request()->is('virtualmeet') ? 'bg-white text-primario' : '' }}" href="/virtualmeet">Evento</a>
            <a class="text-xl p-[20px] text-center font-black uppercase hover:bg-blanco hover:text-primario {{ request()->is('paquetes') ? 'bg-white text-primario' : '' }}" href="/paquetes">Paquetes</a>
            <a class="text-xl p-[20px] text-center font-black uppercase hover:bg-blanco hover:text-primario {{ request()->is('conferencias-workshops') ? 'bg-white text-primario' : '' }}" href="/conferencias-workshops">Workshops / Conferencias</a>
           <a class="text-xl p-[20px] text-center font-black uppercase hover:bg-blanco hover:text-primario {{ request()->is('speakers') ? 'bg-white text-primario' : '' }}" href="/Speakers">Speakers</a>
        </nav>
    </div>
</div>
</div>