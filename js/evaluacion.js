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
function Salir(){
    let salir=confirm("Si sale perdera toda la captura ¿Seguro que quiere salir?");
    if(salir){
        location.href="listadoProspectos.php";
    }
}
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