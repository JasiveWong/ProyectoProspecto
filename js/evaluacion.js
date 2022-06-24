//Muestra o no las observaciones de rechazo dependiendo de la opcion seleccionada (Rechazar o Autorizar)
function mostrarTextArea(){
    const resultado = document.querySelector('.observaciones');
    const textarea= document.querySelector('textarea');
    if(document.getElementById("Rechazar").checked){
        resultado.classList.add("mostrar");
        textarea.required = true;
    }else{
        resultado.classList.remove("mostrar");
        textarea.removeAttribute('required');
    }
}
//Boton salir de captura de prospecto
function Salir(){
    let salir=confirm("Si sale perdera toda la captura ¿Seguro que quiere salir?");
    if(salir){
        location.href="listadoProspectos.php";
    }
}
//Verifica que las contraseñas sean iguales en registro
function verificarPasswords() {
 
    // Obtenemos los valores de los campos de contraseñas 
    pass1 = document.getElementById('pass1');
    pass2 = document.getElementById('pass2');
 
    // Verificamos si las constraseñas no coinciden 
    if (pass1.value != pass2.value) {
 
        // Si las constraseñas no coinciden mostramos un mensaje 
        document.getElementById("error").classList.add("mostrar");
 
        return false;
    } else {
 
        // Si las contraseñas coinciden ocultamos el mensaje de error
        document.getElementById("error").classList.remove("mostrar");
        header('location:agregarinfo.php'); 
        return true;
    }
}
//Acepta insertar solo numeros, espacios y letras en un campo
function check(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patrón de entrada, en este caso solo acepta numeros, espacios y letras
    patron = /^[A-Za-zÁÉÍÓÚáéíóúñÑ0-9\s]+$/g;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
//Acepta insertar solo letras y espacios en un campo
function checkLetras(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patrón de entrada, en este caso solo acepta numeros y espacios
    patron = /^[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$/g;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}