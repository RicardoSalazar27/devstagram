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
