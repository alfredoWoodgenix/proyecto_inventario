<?php 
date_default_timezone_set('America/Mexico_City');

require_once '../../include/funciones.php';
//require_once '../../../mensajes/agregar_contactos.php';

$db = new DB_Funciones();
$op = $_GET ['op'];
$id_usuarios = 1;
$id_usuario_clientes = 1;

    switch ($op) {

        case 1: 

        // Manda a llamar la funcion para enlistar los datos
        $resultado = $db->listar_carrito_compras($id_usuarios, $id_usuario_clientes);
        $data = array();
        
        //Recorre los resultados obtenidos y lo manda a la tabla en formato json
        while ($row = $resultado->fetch_object()) { 

            $total = $row->precio * $row->cantidad;
            $total_formateado = number_format($total, 2, '.', ',');
            $precio_formateado = number_format($row->precio, 2, '.', ',');

            $data[] = array(
            "0"=>$row->nombre_producto,
            "1"=>'<img width= "80px" heigth="80px" class="btn" onclick="ver_perfil(' . "'$row->foto_producto'" . ',' . "'$row->nombre_producto '" .')" src="../../' . $row->foto_producto . '"/>',
            "2"=>$row->descripcion, 
            "3"=>$row->nombre_color,
            "4"=>$row->nombre_presentacion,
            //"5"=> $armado, 
            "5"=>'$' . $precio_formateado, 
            "6"=>$row->cantidad,
            "7"=>'$' .  $total_formateado,
            "8"=>'<button class="btn btn-danger btn-sm" onclick="eliminar(' . "'$row->id_carrito_compras'" . ')"><i  class="fa fa-times"></i></button>'
            //substr($row->monto_bono_c,  0, -7),
            //"9"=>'<button class="btn btn-warning btn-sm" onclick="abrir_modal_e('."'$row->id_bono_c'".')"><i  class="fa-solid fa-pen-to-square"></i></button>',
            //"9" =>'<button class="btn btn-danger btn-sm" onclick="eliminar(' . "'$row->id_bono_c'"  .  ',' . "'$id_administrador'" .  ')"><i  class="fa fa-times"></i></button>'
            /*"7"=>'<button class="btn btn-warning btn-sm" onclick="abrir_modal_e('."'$row->id_area'".')"><i  class="fa-solid fa-pen-to-square"></i></button>',*/
            /*"7"=>'<a class="btn btn-warning btn-sm"
            href="editar_subreporte.php?id_administrador=' . $row->id_administrador . '"><i
                class="fa fa-edit"></i></a>',*/
            );
            
            
        }
        $results = array(
            "draw"=>0,//info para datatables
            "recordsTotal"=>count($data),//enviamos el total de registros al datatable
            "data"=>$data); 

        echo json_encode($results); 


        break;

        case 2: 

            // Manda a llamar la funcion para enlistar los datos
            $resultado = $db->listar_clave($id_usuarios);
            $data = array();
            
            //Recorre los resultados obtenidos y lo manda a la tabla en formato json
            while ($row = $resultado->fetch_object()) { 

                $contar = $db->listar_articulos_oc($row->id_codigo_OC, $id_usuario_clientes);

                $total_fin = 0;

                while($count = $contar->fetch_object()){
                    $total_fin += $count->total;
                }

                $total_total_fin = number_format($total_fin, 2, '.', ',');
    
                $data[] = array(
                "0"=>$row->codigo,
                "1"=>$row->fecha_actualizacion,
                "2"=>$row->nombres . ' ' . $row->apellido_paterno,
                "3"=>'$' . $total_total_fin, 
                "4"=>'<a class="btn btn-primary btn-sm" href="listado_articulos.php?id_codigo_OC=' . $row->id_codigo_OC . '&code=' . $row->codigo . '"><i class="fa-solid fa-eye"></i></a>',
                );
                
                
            }
            $results = array(
                "draw"=>0,//info para datatables
                "recordsTotal"=>count($data),//enviamos el total de registros al datatable
                "data"=>$data); 
    
            echo json_encode($results); 
    
    
            break;

            
        case 3: 
            $id_codigo_OC = $_GET ['id_codigo_OC'];

            // Manda a llamar la funcion para enlistar los datos
            $resultado = $db->listar_ordenes_compra($id_codigo_OC);
            $data = array();
            $count = mysqli_num_rows($resultado);
            
            //Recorre los resultados obtenidos y lo manda a la tabla en formato json
            while ($row = $resultado->fetch_object()) { 
    
                $data[] = array(
                "0"=>$row->folio,
                "1"=>$row->descripcion,
                "2"=>$row->codigo, 
                "3"=>$count,
                "4"=>'<a class="btn btn-primary btn-sm" href="listado_articulos.php?id_orden_compra=' . $row->id_orden_compra . '"><i class="fa-solid fa-eye"></i></a>',
                );
                
                
            }
            $results = array(
                "draw"=>0,//info para datatables
                "recordsTotal"=>count($data),//enviamos el total de registros al datatable
                "data"=>$data); 
    
            echo json_encode($results); 
    
    
            break;

            case 4: 

                $id_codigo_OC = $_GET ['id_codigo_OC'];
                // Manda a llamar la funcion para enlistar los datos
                $resultado = $db->listar_articulos_oc($id_codigo_OC, $id_usuario_clientes);
                $data = array();
                
                //Recorre los resultados obtenidos y lo manda a la tabla en formato json
                while ($row = $resultado->fetch_object()) { 

                    $total_formateado = number_format($row->total, 2, '.', ',');
                    $precio_formateado = number_format($row->precio, 2, '.', ',');
        
                    $data[] = array(
                    "0"=>$row->nombre,
                    "1"=>'<img width= "80px" heigth="80px" class="btn" onclick="ver_perfil(' . "'$row->ruta'" . ',' . "'$row->nombre'" .')" src="../../' . $row->ruta . '"/>',
                    "2"=>$row->descripcion, 
                    "3"=>$row->nombre_color,
                    "4"=>$row->nombre_presentacion,
                    //"5"=> $armado, 
                    "5"=>'$' . $precio_formateado, 
                    "6"=>$row->cantidad,
                    "7"=>'$' . $total_formateado,
                    "8"=>$row->OC_interna,
                    "9"=>$row->nombres . ' ' . $row->apellido_paterno,
                    );
                    
                    
                }
                $results = array(
                    "draw"=>0,//info para datatables
                    "recordsTotal"=>count($data),//enviamos el total de registros al datatable
                    "data"=>$data); 
        
                echo json_encode($results); 
        
        
                break;
    }
?>