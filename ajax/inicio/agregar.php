<?php 
date_default_timezone_set('America/Mexico_City');

require_once '../../include/funciones.php';
//require_once '../../../mensajes/agregar_contactos.php';

$db = new DB_Funciones();
$op = $_GET ['op'];
$fechaActual = date('Y-m-d H:i:s');

    switch ($op) {

        case 1: 
            $id_usuario = $_POST["id_usuario"];
            $id_articulo = $_POST["id_articulo"];
            $quantity = $_POST["quantity"];
            //$assembly = $_POST["assembly"];
            $stock = $_POST["stock"];
            $price = $_POST["price"];

            /*echo "ID de Usuario: " . $id_usuario . "<br>";
            echo "ID de Artículo: " . $id_articulo . "<br>";
            echo "Cantidad: " . $quantity . "<br>";
            echo "Assembly: " . $assembly . "<br>";
            echo "Stock: " . $stock . "<br>";
            echo "Precio: " . $price . "<br>";*/

            $insertar_carrito = $db->inserta_carrito_compras($id_usuario, $id_articulo, $fechaActual, $quantity, $stock, $price);

            if($insertar_carrito){
                echo 1;
            }else{
                echo 2;
            }

        break;
    }
?>