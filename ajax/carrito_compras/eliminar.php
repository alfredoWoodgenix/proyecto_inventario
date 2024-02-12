<?php 
date_default_timezone_set('America/Mexico_City');

require_once '../../include/funciones.php';
//require_once '../../../mensajes/agregar_contactos.php';

$db = new DB_Funciones();

    $id_carrito_compras = $_POST["id_carrito_compras"];

    $eliminar_carrito = $db->eliminar_carrito_compras($id_carrito_compras);

    if($eliminar_carrito){
        echo 1;
    }else{
        echo 2;
    }

?>