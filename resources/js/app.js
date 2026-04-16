// import './bootstrap';

import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,//permite eliminar imagenes
    dictRemoveFile: 'Eliminar Archivo',
    maxFiles: 1,
    uploadMultiple: false
});

dropzone.on('sending', function(file, xhr, formData) {
    console.log(file);//vemos la informacion del archivo
    console.log(formData);//vemos la informacion del formulario
})

dropzone.on('success', function(file, response) {
    console.log(response);//vemos la respuesta del servidor
})

dropzone.on('error', function(file, message) {
    console.log(message);//vemos la respuesta del servidor si falla la subida
})

dropzone.on('removedfile', function(){
    console.log('archivo eliminado');
})