(function () {
    let eventos = [];

    const mostrarRegistro = document.querySelector("#mostrar-regitro");
    if (mostrarRegistro) {
        const eventosBoton = document.querySelectorAll(".evento-agregar");
        eventosBoton.forEach((boton) =>
            boton.addEventListener("click", seleccionarEvento)
        );

        const formuarioRegistro = document.querySelector("#registro");
        formuarioRegistro.addEventListener("submit", submitFormulario);

        mostrarEventos();

        function seleccionarEvento(e) {
            if (eventos.length < 5) {
                e.target.disabled = true;
                eventos = [
                    ...eventos,
                    {
                        id: e.target.dataset.id,
                        titulo: e.target.parentElement
                            .querySelector("h4")
                            .textContent.trim(),
                    },
                ];
                mostrarEventos();
            } else {
                Swal.fire({
                    title: "Error",
                    text: "Máximo 5 eventos por registro",
                    icon: "error",
                    confirmButtonText: "OK",
                });
            }
        }

        function mostrarEventos() {
            limipiarEventos();

            if (eventos.length > 0) {
                eventos.forEach((evento) => {
                    const eventosDOM = document.createElement("DIV");
                    eventosDOM.classList.add("registro-mostrar");

                    const eventoTitulo = document.createElement("H1");
                    eventoTitulo.classList.add("registro-titulo");
                    eventoTitulo.textContent = evento.titulo;

                    const botonEliminar = document.createElement("BUTTON");
                    botonEliminar.classList.add("registro-eliminar");
                    botonEliminar.innerHTML = `<i class="fa-solid fa-trash"></i>`;
                    botonEliminar.onclick = function () {
                        eliminarRegistro(evento.id);
                    };

                    eventosDOM.appendChild(eventoTitulo);
                    eventosDOM.appendChild(botonEliminar);
                    mostrarRegistro.appendChild(eventosDOM);
                });
            } else {
                const noRegistro = document.createElement("P");
                noRegistro.textContent =
                    "No hay eventos, añade hasta 5 del lado izquierdo";
                noRegistro.classList.add("text-center");
                mostrarRegistro.appendChild(noRegistro);
            }
        }

        function limipiarEventos() {
            while (mostrarRegistro.firstChild) {
                mostrarRegistro.removeChild(mostrarRegistro.firstChild);
            }
        }

        function eliminarRegistro(id) {
            eventos = eventos.filter((evento) => evento.id != id);
            const botonAgregar = document.querySelector(`[data-id="${id}"]`);
            botonAgregar.disabled = false;
            mostrarEventos();
        }

        async function submitFormulario(e) {
            e.preventDefault();

            //obtener regalo
            const regaloId = document.querySelector("#regalo").value;

            const eventosId = eventos.map((evento) => evento.id);

            if (eventosId.length === 0 || regaloId === "") {
                Swal.fire({
                    title: "Error",
                    text: "Elige almenos un evento y un regalo",
                    icon: "error",
                    confirmButtonText: "OK",
                });
                return;
            }

            //objeto de formdata

            const datos = new FormData();
            datos.append('eventos', eventosId)
            datos.append('regalo_id', regaloId)


            // Obtener el token CSRF del formulario
            const token = document.querySelector('input[type="hidden"]').getAttribute("value");

            // Construir la solicitud POST con el token CSRF
            const url = "/finalizar-registro/conferencias";
            const respuesta = await fetch(url, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": token,
                },
                body: datos
            });

            const resultado = await respuesta.json();

            console.log(resultado);

            if(resultado.resultado) {
                Swal.fire(
                    'Registro Exitoso',
                    'Tus conferencias se han almacenado y tu registro fue exitoso, te esperamos en VirtualMeet',
                    'success'
                ).then( () => location.href = `/boleto?id=${resultado.token}`) 
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un error',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then( () => location.reload() )
            }

        }
    }
})();
