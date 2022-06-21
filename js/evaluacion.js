function mostrarTextArea(){
    const resultado = document.querySelector('.observaciones');
    if(document.getElementById("Rechazar").checked){
        resultado.classList.add("mostrar");
    }else{
        resultado.classList.remove("mostrar");
    }
}