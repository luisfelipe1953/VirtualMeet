<footer class="bg-primario mt-[50px] pt-[30px] text-white">
    <div class="sm:container container-md mx-auto grid sm:grid-cols-2 sm:gap-x-[30px]  ">
        <div>
            <h1 class="logo-normal mt-0">
                &#60;VirtualMeet />
            </h1>
            <p class="leading-5 text-center sm:text-left">
                VirtualMeet es una conferencia para desarrolladores en todos los niveles, se lleva a cabo de forma precensial y en linea
            </p>
        </div>

        @component('components.nav')
        @endcomponent
    </div>
    <p class="bg-primarioDarken m-0 py-[20px] mt-[30px] mb-0 text-center text-base font-black ">
        VirtualMeet
        <span class="font-normal">
            - Todos los derechos reservados {{ date('Y') }}
        </span>
    </p>
</footer>