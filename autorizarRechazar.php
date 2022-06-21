<?php
    include("bd.php");
    $conexionbd=conectarbd();
    if($_POST['estatus']=='Autorizar'){
        $query="UPDATE informacion SET estatus='Autorizado' WHERE id=".$_GET['id'];
    }else{
        $query="UPDATE informacion SET estatus='Rechazado', comentarios='".$_POST['observaciones']."' WHERE id=".$_GET['id'];
    }
    mysqli_query($conexionbd,$query);
?>