@extends('layout')

@section('contenido')
<h1 class="titulo-front">Paquetes VirtualMeet</h1>
<p class="subtitulo-front">Compra los Paquetes de VirtualMeet</p>

<div class="sm:container container-md mx-auto grid xl:grid-cols-3 grid-cols-1 gap-x-10">
    <a class="mx-auto" href="/finalizar-registro/gratis">
        <div class="w-[20rem]  mt-10 py-[10rem] px-[2rem] text-center border-2 border-white rounded-lg 
            transform transition-transform duration-300 ease-in-out hover:scale-110 bg-gray-500 hover:bg-gray-200 p-[60px] order-[-1]">
            <h2>Pase gratis</h2>
            <p>Acceso Virtual A VirtualMeet</p>
            <p class="mt-10 text-5xl font-bold hover:text-white">$0</p>
        </div>

    </a>
    <div href="/finalizar-registro/presencial" class="mx-auto">
        <div class=" w-[20rem] mt-10 pt-[6.2rem] px-[2rem] text-center border-2 border-white rounded-lg 
                              transform transition-transform duration-300 ease-in-out hover:scale-110 bg-gradient-to-b from-yellow-800 to-pink-800 hover:from-yellow-500 hover:to-pink-500 xl:order-none order-first">
            <h2>Pase Presencial</h2>
            <p>Acceso Precensial A VirtualMeet</p>
            <p>Pase por 2 dias</p>
            <p>Acceso a Talleres y Conferencias</p>
            <p>Acceso a las Grabaciones</p>
            <p>Camisa del Evento</p>
            <p>Comida y Bebida</p>
            <p class="mt-10 text-5xl font-bold hover:text-white">$199</p>

            <div id="smart-button-container">
                <div class="my-10" style="text-align: center;">
                    <div class="" id="paypal-button-container"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="mx-auto">
        <div class="w-[20rem] mt-10 pt-[7.5rem] px-[2rem] text-center border-2 border-white rounded-lg transform transition-transform duration-300 ease-in-out hover:scale-110 bg-gradient-to-b to-green-800 from-blue-800 hover:to-blue-500 hover:from-green-400">
            <h2>Pase Virtual</h2>
            <p>Acceso Virtual A VirtualMeet</p>
            <p>Pase por 2 dias</p>
            <p>Enlace a Talleres y Conferencias</p>
            <p>Acceso a las Grabaciones</p>
            <p class="mt-10 text-5xl font-bold hover:text-white">$49</p>

            <div id="smart-button-container">
                <div class="my-10" style="text-align: center;">
                    <div class="" id="paypal-button-container-virtual"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


<script src="https://www.paypal.com/sdk/js?client-id=Af7qjdmXe7sD7kL3bigiWxWWLftIEZc1P6IMlaKTOJYlNC4eHujvhp3vLdsDUenuhHJjP_VeUA1796TA&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
<script>
    function initPayPalButton() {
        paypal.Buttons({
            style: {
                shape: 'rect',
                color: 'gold',
                layout: 'horizontal',
                label: 'paypal',
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        "description": "1",
                        "amount": {
                            "currency_code": "USD",
                            "value": 199
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    const datos = new FormData();
                    datos.append('_token', '{{ csrf_token() }}');
                    datos.append('package_id', orderData.purchase_units[0].description);
                    datos.append('payment_id', orderData.purchase_units[0].payments.captures[0].id);
                    fetch('/finalizar-registro/pagar', {
                        method: 'POST',
                        body: datos
                    }).then(respuesta => respuesta.json()).then(resultado => {
                        if (resultado) {
                            actions.redirect('https://virtualmeet-production.up.railway.app/finalizar-registro/conferencias')
                        }
                    })
                });
            },
            onError: function(err) {
                console.log(err);
            }
        }).render('#paypal-button-container');
        paypal.Buttons({
            style: {
                shape: 'rect',
                color: 'blue',
                layout: 'horizontal',
                label: 'paypal',
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        "description": "2",
                        "amount": {
                            "currency_code": "USD",
                            "value": 49
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    const datos = new FormData();
                    datos.append('_token', '{{ csrf_token() }}');
                    datos.append('package_id', orderData.purchase_units[0].description);
                    datos.append('payment_id', orderData.purchase_units[0].payments.captures[0].id);
                    fetch('/finalizar-registro/pagar', {
                        method: 'POST',
                        body: datos
                    }).then(respuesta => respuesta.json()).then(resultado => {
                        if (resultado) {
                            actions.redirect('https://virtualmeet-production.up.railway.app/finalizar-registro/conferencias')
                        }
                    })
                });
            },
            onError: function(err) {
                console.log(err);
            }
        }).render('#paypal-button-container-virtual');
    }
    initPayPalButton();
</script>