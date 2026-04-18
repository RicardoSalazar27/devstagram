// import './bootstrap';

import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,//permite eliminar imagenes
    dictRemoveFile: 'Eliminar Archivo',
    maxFiles: 1,
    uploadMultiple: false,

    init: function() {
        // alert('inicializando dropzone');
        //EN caso de que haya una imagen en el input oculto, mostrarla en dropzone
        if(document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;
            
            //agregamos la imagen a dropzone
            this.options.addedfile.call(this, imagenPublicada);
            
            //asignamos la imagen al thumbnail de dropzone
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);
            
            // Clases de dropzone para marcar la imagen como subida correctamente
            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});

// dropzone.on('sending', function(file, xhr, formData) {
//     console.log(file);//vemos la informacion del archivo
//     console.log(formData);//vemos la informacion del formulario
// })

dropzone.on('success', function(file, response) {
    //console.log(response.imagen);//vemos la respuesta del servidor
    //asignamos el valor de la imagen al input oculto
    document.querySelector('[name="imagen"]').value = response.imagen;
})

// dropzone.on('error', function(file, message) {
//     console.log(message);//vemos la respuesta del servidor si falla la subida
// })

dropzone.on('removedfile', function(){
    // console.log('archivo eliminado');
    //eliminar el valor del input oculto    
    document.querySelector('[name="imagen"]').value = '';
})