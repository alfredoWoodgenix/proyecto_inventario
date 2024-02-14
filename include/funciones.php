<?php

class DB_Funciones
{
    private $conn;

    // Constructor
    public function __construct()
    {
        require_once 'conexion.php';
        // Conecta a database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }

    // Destructor
    public function __destruct()
    {

    }

        //Función para listar articulos
        public function listar_articulos($id_cliente, $id_usuario_cliente)
        {
    
            $stmt = $this->conn->prepare("SELECT 
            articulos.id_articulos, 
            nombre_articulo.nombre,
            articulos.descripcion, 
            articulos.modelo,
            foto_producto.ruta, 
            foto_producto.ruta_miniatura, 
            cliente.nombre AS cliente, 
            articulos.fecha_actualizacion,
            MAX(carrito_compras.id_carrito_compras) AS id_carrito_compras,
            MAX(carrito_compras.fecha_creacion) AS fecha_creacion
            FROM articulos
            INNER JOIN foto_producto ON articulos.id_articulos = foto_producto.id_articulos
            INNER JOIN articulos_clientes ON articulos.id_articulos = articulos_clientes.id_articulos
            LEFT JOIN carrito_compras ON articulos.id_articulos = carrito_compras.id_articulos
            INNER JOIN cliente ON articulos_clientes.id_cliente = cliente.id_cliente 
            INNER JOIN nombre_articulo ON articulos.id_articulos = nombre_articulo.id_articulo
            WHERE cliente.id_cliente = ? AND nombre_articulo.id_usuario_cliente = ?
            GROUP BY 
                    articulos.id_articulos, 
                    nombre_articulo.nombre, 
                    articulos.descripcion, 
                    articulos.modelo,
                    foto_producto.ruta, 
                    foto_producto.ruta_miniatura, 
                    cliente.nombre, 
                    articulos.fecha_actualizacion;");
            $stmt->bind_param("ss", $id_cliente, $id_usuario_cliente);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $stmt->close();
    
            return $resultado;
        }

                //Función para listar articulos
                public function listar_stock($id_articulos)
                {
            
                    $stmt = $this->conn->prepare("SELECT * FROM color 
                    INNER JOIN color_articulo ON color.id_color = color_articulo.id_color
                    INNER JOIN articulos ON color_articulo.id_articulos = articulos.id_articulos
                    WHERE articulos.id_articulos = ?;");
                    $stmt->bind_param("s", $id_articulos);
                    $stmt->execute();
                    $resultado = $stmt->get_result();
                    $stmt->close();
            
                    return $resultado;
                }

                //Función para listar articulos
                public function listar_price($id_cliente, $id_articulos)
                    {
                     
                             $stmt = $this->conn->prepare("SELECT * FROM precio_articulos
                             INNER JOIN articulos_clientes ON precio_articulos.id_articulos_clientes = articulos_clientes.id_articulos_clientes
                             INNER JOIN presentacion ON precio_articulos.id_presentacion = presentacion.id_presentacion
                             INNER JOIN articulos ON articulos_clientes.id_articulos = articulos.id_articulos
                             INNER JOIN cliente ON articulos_clientes.id_cliente = cliente.id_cliente
                             WHERE cliente.id_cliente = ? AND articulos.id_articulos = ?");
                             $stmt->bind_param("ss", $id_cliente, $id_articulos);
                             $stmt->execute();
                             $resultado = $stmt->get_result();
                             $stmt->close();
                     
                             return $resultado;
                    }
                
                    //Función para insertar incidencias a tabla temporal
                    public function inserta_carrito_compras($id_usuario, $id_articulos, $fecha_creacion, $cantidad, $id_color_articulo, $id_precio_articulos)
                    {

                        $stmt = $this->conn->prepare("INSERT INTO carrito_compras(id_usuarios, id_articulos, fecha_creacion, cantidad, id_color_articulo, id_precio_articulos) 
                        VALUES (?, ?, ?, ?, ?, ?);");
                        $stmt->bind_param("ssssss", $id_usuario, $id_articulos, $fecha_creacion, $cantidad, $id_color_articulo, $id_precio_articulos);
                        $result = $stmt->execute();
                        $stmt->close();

                        if ($result) {
                            return true;
                        } else {
                            return false;
                        }

                    }    

                       //Función para listar articulos
                public function listar_carrito_compras($id_usuarios, $id_usuario_cliente)
                {
                 
                         $stmt = $this->conn->prepare("SELECT carrito_compras.id_carrito_compras, articulos.id_articulos, nombre_articulo.nombre AS nombre_producto, foto_producto.ruta AS foto_producto, articulos.descripcion, color_articulo.id_color_articulo,color.nombre_color, presentacion.nombre_presentacion,precio_articulos.id_precio_articulos,precio_articulos.precio, carrito_compras.cantidad FROM carrito_compras
                         INNER JOIN  articulos ON carrito_compras.id_articulos = articulos.id_articulos
                         INNER JOIN foto_producto ON articulos.id_articulos = foto_producto.id_articulos
                         INNER JOIN color_articulo ON carrito_compras.id_color_articulo = color_articulo.id_color_articulo
                         INNER JOIN color ON color_articulo.id_color = color.id_color
                         INNER JOIN precio_articulos ON carrito_compras.id_precio_articulos = precio_articulos.id_precio_articulos 
                         INNER JOIN presentacion ON precio_articulos.id_presentacion = presentacion.id_presentacion
                         INNER JOIN nombre_articulo ON carrito_compras.id_articulos = nombre_articulo.id_articulo
                         WHERE carrito_compras.id_usuarios = ? AND nombre_articulo.id_usuario_cliente = ?");
                         $stmt->bind_param("ss", $id_usuarios, $id_usuario_cliente);
                         $stmt->execute();
                         $resultado = $stmt->get_result();
                         $stmt->close();
                 
                         return $resultado;
                }


                        //Función para listar articulos
                        public function get_carrito_compras($id_color_articulo)
                        {
                                             
                            $stmt = $this->conn->prepare("SELECT * FROM carrito_compras WHERE id_color_articulo = ?");
                            $stmt->bind_param("s", $id_color_articulo);
                            $stmt->execute();
                            $resultado = $stmt->get_result();
                            $stmt->close();
                                             
                            return $resultado;
                        }

                        //Función para listar articulos
                        public function eliminar_carrito_compras($id_carrito_compras)
                        {
                                                       
                            $stmt = $this->conn->prepare("DELETE FROM carrito_compras
                            WHERE id_carrito_compras = ?;");
                            $stmt->bind_param("s", $id_carrito_compras);
                            $result = $stmt->execute();
                            $stmt->close();
    
                            if ($result) {
                                return true;
                            } else {
                                return false;
                            }
                        }

                        //Función para listar articulos
                        public function contar_carrito($id_usuarios)
                            {
                                                  
                                 $stmt = $this->conn->prepare("SELECT COUNT(*) AS total FROM carrito_compras WHERE id_usuarios = ?");
                                 $stmt->bind_param("s", $id_usuarios);
                                 $stmt->execute();
                                 $resultado = $stmt->get_result();
                                 $stmt->close();
                                                  
                                 return $resultado;
                            }
                        
                         //Función para registrar supervisor
                        public function inserta_codigoOC($codigoOC, $id_usuario, $fechaActual, $id_almacen)
                        {

                            $stmt = $this->conn->prepare("SELECT * FROM codigo_oc WHERE codigo = ?;");
                            $stmt->bind_param("s", $codigoOC);
                            $stmt->execute();
                            $result_c = $stmt->get_result();
                            $stmt->close();

                            // Comprueba si existe el supervisor
                            if ($result_c->num_rows <= 0) {

                                $stmt = $this->conn->prepare("INSERT INTO codigo_oc(codigo, id_usuarios, fecha_actualizacion, id_almacen) VALUES (?, ?, ?, ?);");
                                $stmt->bind_param("ssss", $codigoOC, $id_usuario, $fechaActual, $id_almacen);
                                $result = $stmt->execute();
                                $stmt->close();

                                // Comprueba si se insertó correctamente
                                if ($result) {
                                    $stmt = $this->conn->prepare("SELECT * FROM codigo_oc WHERE codigo = ?;");
                                    $stmt->bind_param("s", $codigoOC);
                                    $stmt->execute();
                                    $result_i = $stmt->get_result();
                                    $stmt->close();

                                    return $result_i;

                                } else {
                                    // Error al insertar
                                    return 1;
                                }
                            } else {
                                return $result_c;
                            }

                        }    

                                            //Función para insertar incidencias a tabla temporal
                    public function inserta_orden_compra($folio, $descripcion, $id_codigo_oc, $fecha_creacion, $OC_interna)
                    {

                        $stmt = $this->conn->prepare("INSERT INTO orden_compra(folio, descripcion, id_codigo_oc, fecha_creacion, OC_interna) 
                        VALUES (?, ?, ?, ?, ?);");
                        $stmt->bind_param("sssss", $folio, $descripcion, $id_codigo_oc, $fecha_creacion, $OC_interna);
                        $result = $stmt->execute();
                         // Obtiene el id del último registro insertado
                        $lastInsertedId = $this->conn->insert_id;
                        $stmt->close();

                        if ($result) {
                            return $lastInsertedId;
                        } else {
                            return false;
                        }

                    } 

                    //Función para insertar incidencias a tabla temporal
                    public function inserta_listado_compra($id_orden_compra, $id_articulos, $cantidad, $id_color_articulo, $nombre_color, $id_precio_articulos, $nombre_presentacion, $precio, $total, $fecha_creacion)
                    {
                                            
                        $stmt = $this->conn->prepare("INSERT INTO listado_compra(id_orden_compra, id_articulos, cantidad, id_color_articulo, nombre_color, id_precio_articulos,
                        nombre_presentacion, precio, total, fecha_creacion) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
                        $stmt->bind_param("ssssssssss", $id_orden_compra, $id_articulos, $cantidad, $id_color_articulo, $nombre_color, $id_precio_articulos, $nombre_presentacion, $precio, $total, $fecha_creacion);
                        $result = $stmt->execute();
                        $stmt->close();
                                            
                        if ($result) {
                            return true;
                        } else {
                            return false;
                        }
                                            
                    } 


                    //Funciones para ver y actualizar el stock de colores

                       //Función para listar un color
                       public function listar_color($id_color_articulo)
                       {
                                             
                            $stmt = $this->conn->prepare("SELECT * FROM color_articulo WHERE id_color_articulo = ?;");
                            $stmt->bind_param("s", $id_color_articulo);
                            $stmt->execute();
                            $resultado = $stmt->get_result();
                            $stmt->close();
                                             
                            return $resultado;
                       }

                    //Función para insertar incidencias a tabla temporal
                    public function actualizar_stock($cantidad, $id_color_articulo)
                    {

                        $stmt = $this->conn->prepare("UPDATE color_articulo
                        SET cantidad = ?
                        WHERE id_color_articulo = ?;");
                        $stmt->bind_param("ss", $cantidad, $id_color_articulo);
                        $result = $stmt->execute();
                        $stmt->close();

                        if ($result) {
                            return true;
                        } else {
                            return false;
                        }

                    } 

                    //Función para listar un color
                    public function listar_clave($id_usuarios)
                    {
                                                         
                        $stmt = $this->conn->prepare("SELECT codigo_oc.id_codigo_OC, codigo_oc.codigo, codigo_oc.fecha_actualizacion, usuarios.nombres, usuarios.apellido_paterno FROM codigo_oc
                        INNER JOIN usuarios ON codigo_oc.id_usuarios = usuarios.id_usuarios
                        WHERE codigo_oc.id_usuarios = ?");
                        $stmt->bind_param("s", $id_usuarios);
                        $stmt->execute();
                        $resultado = $stmt->get_result();
                        $stmt->close();
                                                            
                        return $resultado;
                    }

                    public function listar_ordenes_compra($id_codigo_OC)
                    {
                                                         
                        $stmt = $this->conn->prepare("SELECT * FROM orden_compra 
                        INNER JOIN codigo_oc ON codigo_oc.id_codigo_OC = orden_compra.id_codigo_oc
                        WHERE orden_compra.id_codigo_oc = ?");
                        $stmt->bind_param("s", $id_codigo_OC);
                        $stmt->execute();
                        $resultado = $stmt->get_result();
                        $stmt->close();
                                                            
                        return $resultado;
                    }

                    public function listar_articulos_oc($id_codigo_OC, $id_usuario_cliente)
                    {
                                                         
                        $stmt = $this->conn->prepare("SELECT nombre_articulo.nombre, foto_producto.ruta, articulos.descripcion, listado_compra.nombre_color, listado_compra.nombre_presentacion, listado_compra.precio, listado_compra.cantidad, listado_compra.total, orden_compra.OC_interna, usuarios.nombres, usuarios.apellido_paterno FROM listado_compra
                        INNER JOIN articulos ON listado_compra.id_articulos = articulos.id_articulos
                        INNER JOIN foto_producto ON articulos.id_articulos = foto_producto.id_articulos
                        INNER JOIN orden_compra ON orden_compra.id_orden_compra = listado_compra.id_orden_compra
                        INNER JOIN codigo_oc ON orden_compra.id_codigo_oc = codigo_oc.id_codigo_OC
                        INNER JOIN usuarios ON codigo_oc.id_usuarios = usuarios.id_usuarios
                        INNER JOIN nombre_articulo ON articulos.id_articulos = nombre_articulo.id_articulo
                        WHERE codigo_oc.id_codigo_OC = ? AND nombre_articulo.id_usuario_cliente = ?
                        ORDER BY orden_compra.OC_interna ASC");
                        $stmt->bind_param("ss", $id_codigo_OC, $id_usuario_cliente);
                        $stmt->execute();
                        $resultado = $stmt->get_result();
                        $stmt->close();
                                                            
                        return $resultado;
                    }

                         //Función para insertar incidencias a tabla temporal
                         public function actualiza_fecha($fecha, $id_articulo)
                         {
     
                             $stmt = $this->conn->prepare("UPDATE articulos
                             SET fecha_actualizacion = ?
                             WHERE id_articulos = ?");
                             $stmt->bind_param("ss", $fecha, $id_articulo);
                             $result = $stmt->execute();
                             $stmt->close();
     
                             if ($result) {
                                 return true;
                             } else {
                                 return false;
                             }
     
                         } 

                                                //Función para listar un color
                       public function codigo_oc($codigo)
                       {
                                             
                            $stmt = $this->conn->prepare("SELECT usuarios.nombres AS nombre_usuario, 
                            usuarios.apellido_paterno AS apellido_usuario,
                            codigo_oc.codigo,
                            codigo_oc.id_codigo_OC,
                            usuarios.correo,
                            almacen.nombre,
                            almacen.direccion,
                            almacen.CP
                            FROM codigo_oc 
                            INNER JOIN usuarios ON codigo_oc.id_usuarios = usuarios.id_usuarios
                            INNER JOIN almacen ON codigo_oc.id_almacen = almacen.id_almacen
                            WHERE codigo_oc.codigo = ?");
                            $stmt->bind_param("s", $codigo);
                            $stmt->execute();
                            $resultado = $stmt->get_result();
                            $stmt->close();
                                             
                            return $resultado;
                       }

                       public function listaralmacenes($id_usuario_clientes)
                       {
                   
                           $stmt = $this->conn->prepare("SELECT * FROM almacen WHERE id_usuario_clientes = ? ORDER BY nombre ASC");
                           $stmt->bind_param("s", $id_usuario_clientes);
                           $stmt->execute();
                           $resultado = $stmt->get_result();
                           $stmt->close();
                   
                           // Devuelve el resultado de la consulta
                           return $resultado;
                   
                       }
}

?>