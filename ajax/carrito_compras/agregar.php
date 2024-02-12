<?php 
date_default_timezone_set('America/Mexico_City');

require_once '../../include/funciones.php';
//require_once '../../../mensajes/agregar_contactos.php';

$db = new DB_Funciones();
$op = $_GET ['op'];
$fechaActual = date('Y-m-d H:i:s');

$ano = date('Y');
$mes = date('m');
$dia = date('d');
$hora = date('H');
$minutos = date('i');
$segundos = date('s');

// Generar un número aleatorio de 2 dígitos
$numero_random = rand(10, 99);

    switch ($op) {

        case 1: 

            $codigoOC = $_POST["codigoOC"];
            $id_usuario = $_POST["id_usuario"];
            $id_usuario_clientes = $_POST["id_usuario_clientes"];

            $codigo_resul = $db->inserta_codigoOC($codigoOC, $id_usuario, $fechaActual);

            if($codigo_resul === 1){
                echo 2;
            }else{
                $row = $codigo_resul->fetch_object();

                $id_codigo_OC = $row->id_codigo_OC;
                //$codigo = $row->codigo;
                $folio = $row->codigo; 
                $descripcion = 'Purchase order for hr';
                $OC_interna = $ano . $mes . $dia . $hora . $minutos . $segundos . $id_usuario .$numero_random;

                $insertar_oc = $db->inserta_orden_compra($folio, $descripcion, $id_codigo_OC, $fechaActual, $OC_interna);

                if ($insertar_oc !== false) {
                    $listar_carrito_compras = $db->listar_carrito_compras($id_usuario, $id_usuario_clientes);
                    $id_orden_compra = $insertar_oc;

                    while($fila = $listar_carrito_compras->fetch_object()){
                        
                        $id_carrito_compras = $fila->id_carrito_compras;
                        $id_articulos = $fila->id_articulos;
                        $cantidad = $fila->cantidad;
                        $id_color_articulo = $fila->id_color_articulo;
                        $nombre_color = $fila->nombre_color;
                        $id_precio_articulos = $fila->id_precio_articulos;
                        $nombre_presentacion = $fila->nombre_presentacion; 
                        $precio = $fila->precio;

                        $suma_total = $precio * $cantidad;
                        $total = $suma_total;

                        $listar_color = $db->listar_color($id_color_articulo);
                        $cantidad_color = $listar_color->fetch_object();

                        $total_stock = $cantidad_color->cantidad;

                        $resultado_resta = $total_stock - $cantidad;

                        $inserta_listado_compras = $db->inserta_listado_compra($id_orden_compra, $id_articulos, $cantidad, $id_color_articulo, $nombre_color, $id_precio_articulos, $nombre_presentacion, $precio, $total, $fechaActual);

                            if($inserta_listado_compras){
                                $eliminar_carrito = $db->eliminar_carrito_compras($id_carrito_compras);
                                $actualizar_stock = $db->actualizar_stock($resultado_resta, $id_color_articulo);
                                $actualiza_fecha = $db->actualiza_fecha($fechaActual, $id_articulos);

                                if($eliminar_carrito === false || $actualizar_stock === false){
                                    echo 2;
                                }
                            }else{
                                echo 2;
                            }
                    }
                    //echo "Se insertó correctamente, ID: " . $resultado;
                    echo 1;
                } else {
                    echo 2;
                }

            }

        break;
    }