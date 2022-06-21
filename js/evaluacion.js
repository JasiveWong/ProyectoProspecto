function mostrarTextArea(){
    const resultado = document.querySelector('.observaciones');
    if(document.getElementById("Rechazar").checked){
        resultado.classList.add("mostrar");
    }else{
        resultado.classList.remove("mostrar");
    }
}
function Salir(){
    let salir=confirm("Si sale perdera toda la captura ¿Seguro que quiere salir?");
    if(salir){
        location.href="listadoProspectos.php";
    }
}