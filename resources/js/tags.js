(function(){
    const tagsInput = document.querySelector('#tags_input');

    if(tagsInput) {

        const  tagsDiv = document.querySelector('#tags');
        const  tagsInputHidden = document.querySelector('[name = "tags"]');

        let tags = [];

        // recuperar del input oculto

        if(tagsInputHidden.value !== '') {
            tags = tagsInputHidden.value.split(',');
            mostrarTags()
        }

        // escucha los cambios
        tagsInput.addEventListener('keypress', guardarTag)

        function guardarTag(e) {

            if(e.keyCode === 44 || e.keyCode === 13){
                
                if(e.target.value === '' || e.target.value < 1){
                    return
                }
                e.preventDefault();

                tags = [...tags, e.target.value.trim()]

                tagsInput.value = '';

                mostrarTags()
            }
        }

        function mostrarTags(){
            tagsDiv.textContent = '';
            tags.forEach(tag =>{
                const etiqueta = document.createElement('LI')
                etiqueta.classList.add('tag');
                etiqueta.textContent = tag;
                etiqueta.ondblclick = eliminarTag;
                tagsDiv.appendChild(etiqueta)    
            })
            actualizarInputHidden();
        }

        function eliminarTag(e){
            e.target.remove();
            tags = tags.filter(tag => tag !== e.target.textContent)
            actualizarInputHidden();
        }

        function actualizarInputHidden() {
            tagsInputHidden.value = tags.toString();
        }
    }
})() //IFIE