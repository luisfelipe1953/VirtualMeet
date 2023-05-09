(function () {

    const inputPonentes = document.querySelector('#speaker');

    if (inputPonentes) {
        let ponentes = [];
        let ponentesFiltrados = [];

        const listadoPonentes = document.querySelector('#ul-ponentes')
        const inputHiddenPonente = document.querySelector('[name="speaker_id"]');

        obtenerPonentes()
        inputPonentes.addEventListener('input', buscarPonentes)

        // edit eventos ponente
        if(inputHiddenPonente.value) {
            (async() => {
                const ponente = await obtenerPonente(inputHiddenPonente.value)

                //insertar en el html
                const ponenteDOM = document.createElement('LI')
                ponenteDOM.classList.add('li-ponentes', 'ponente-seleccionado')
                ponenteDOM.textContent = `${ponente.name} ${ponente.lastname}`

                listadoPonentes.appendChild(ponenteDOM)
            })()
        }

        async function obtenerPonentes() {
            const url = `/api/ponentes`

            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            formaterPonentes(resultado)
        }

        async function obtenerPonente(id){
            const url = `/api/ponente?id=${id}`;

            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            return resultado;
        }

        function formaterPonentes(ArrayPonentes = []) {
            ponentes = ArrayPonentes.map(ponente => {
                return {
                    name: `${ponente.name.trim()} ${ponente.lastname.trim()}`,
                    lastname: ponente.id
                }
            })
        }

        function buscarPonentes(e) {
            const busqueda = e.target.value

            if (busqueda.length > 3) {
                const expresion = new RegExp(busqueda, 'i');
                ponentesFiltrados = ponentes.filter(ponente => {
                    if (ponente.name.toLowerCase().search(expresion) !== -1) {
                        return ponente;
                    }
                })
            } else {
                ponentesFiltrados = [];
            }
            mostrarPonentes();
        }

        function mostrarPonentes() {

            while (listadoPonentes.firstChild) {
                listadoPonentes.removeChild(listadoPonentes.firstChild);
            }

            if (ponentesFiltrados.length > 0) {
                ponentesFiltrados.forEach(ponente => {
                    const ponenteHtml = document.createElement('LI')
                    ponenteHtml.classList.add('li-ponentes')
                    ponenteHtml.textContent = ponente.name
                    ponenteHtml.dataset.ponenteId = ponente.id
                    ponenteHtml.onclick = seleccionarPonente


                    //añadir al dom 
                    listadoPonentes.appendChild(ponenteHtml);

                })
            } else {
                const noResultados = document.createElement('P')
                noResultados.classList.add('no-resultados')
                noResultados.textContent = 'No Hay Resultados para tu busqueda'

                listadoPonentes.appendChild(noResultados);
            }

            function seleccionarPonente(e) {
                const ponente = e.target;

                // evitar dos elecciones
                const ponentePrevio = document.querySelector('.ponente-seleccionado')
                if (ponentePrevio) {
                    ponentePrevio.classList.remove('ponente-seleccionado')
                }

                ponente.classList.add('ponente-seleccionado')


                // agregar el ponente a el valuehidden
                inputHiddenPonente.value = ponente.dataset.ponenteId
            }

        }
    }
})();