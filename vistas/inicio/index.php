<?php  
    $nombreadmin = 'Alfredo Ku Sabido';
    $id_administrador = 1;
    $id_cliente = 1;
    $id_usuario_clientes = 1;

    require_once '../../include/funciones.php';
    $db = new DB_Funciones();

    $lista_articulos = $db->listar_articulos($id_cliente, $id_usuario_clientes);
?>  

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Woodgenix Inventario</title>

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../../imagenes/logowoodgenix-96x96.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../../css/styles.css" rel="stylesheet" />
        <!-- Jquery -->
        <script type="text/javascript" src="../../public/js/jquery-3.6.0.min.js"></script>

        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

          <!-- Bootbox -->
        <script type="text/javascript" src="../../public/bootbox/bootbox.min.js"></script>
        <script type="text/javascript" src="../../public/bootbox/bootbox.locales.min.js"></script>
    </head>
    <body>
            <?php 
                include '../encabezado.php';
            ?>
        <!-- Header-->
        <header class="bg-header">
            <div class="header-overlay">
                <div class="container px-4 px-lg-5 my-5 header-content">
                <h1 class="display-4 fw-bolder" style="font-size: 4em;"><span style="font-size: 1.3em;">W</span>oodgenix</h1>
                <p class="lead fw-normal text-white-50 mb-0">Quality that endures, design that inspires.</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <div class="mt-3 text-center">
            <label for="productSearch" class="form-label">Search Product:</label>
            <input type="text" id="productSearch" class="form-control" oninput="searchProducts()" placeholder="Search..." style="width: 200px; display: inline-block;">
        </div>

        <div id="noResultsMessage" class="mt-3 text-center" style="display: none;">
            <p style="font-size: 1.5em;"><i class="bi bi-search"></i> Not found.</p>
        </div>

        <section class="py-6" >
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-2 gx-lg-3 row-cols-1 row-cols-md-1 row-cols-xl-2 justify-content-center">

                <?php
                while ($row = $lista_articulos->fetch_object()) {
                ?>
                    <div class="col mb-5">
                        <div class="card h-100" id="<?php echo $row->id_articulos?>">
                            <!-- Product image-->
                            <img class="card-img-top" src="<?php echo '../../' . $row->ruta ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $row->nombre ?></h5>
                                    <!-- Product price-->
                
                                    <div class="mt-3 d-flex align-items-center">
                                        <label for="price" class="form-label me-2">Price:</label>
                                        <select id="price<?php echo $row->id_articulos?>" name="price" class="form-select">
                                            <option value="null">Select</option>
                                            <!-- Traer colores con stock-->
                                            <?php $lista_price = $db->listar_price($id_cliente, $row->id_articulos); ?>
                                                <?php
                                                    while ($fila2 = $lista_price->fetch_object()) {
                                                ?>
                                                    <option value="<?php echo $fila2->id_precio_articulos?>"> <?php echo $fila2->nombre_presentacion . ' - $' . $fila2->precio?></option>
                                            <?php
                                                    }
                                            ?>

                                            <!-- Puedes agregar más opciones según sea necesario -->
                                        </select>
                                    </div>
                                    
                                    <div class="mt-3 d-flex align-items-center">
                                        <label for="stock" class="form-label me-2">Stock:</label>
                                        <select id="stock<?php echo $row->id_articulos?>" name="stock" class="form-select select-option">
                                            <option value="null">Select a color</option>
                                            

                                            <!-- Traer colores con stock-->
                                            <?php $lista_stock = $db->listar_stock($row->id_articulos); ?>
                                                <?php
                                                    while ($fila = $lista_stock->fetch_object()) {

                                                    $total_carrito = $db->get_carrito_compras($fila->id_color_articulo);
                                                    
                                                    $total_stock = 0;
                                                    while ($sum_total = $total_carrito->fetch_object()) {
                                                        $total_stock += $sum_total->cantidad;
                                                    }

                                                    $total_final = $fila->cantidad - $total_stock;
                                                ?>
                                                    <option value="<?php echo $fila->id_color_articulo ?>"> <?php echo $fila->nombre_color . ' - ' . $total_final?></option>
                                            <?php
                                                    }
                                            ?>

                                            <!-- Puedes agregar más opciones según sea necesario -->
                                        </select>
                                    </div>
                                
                                    <!--                
                                    <div class="mt-3 d-flex align-items-center">
                                        <label for="assembly" class="form-label me-2">Assembly:</label>
                                        <select id="assembly// echo $row->id_articulos" name="assembly" class="form-select">
                                            <option disabled>Select an option</option>
                                            <option value="1">assembly</option>
                                            <option value="0">RTA</option>
                                            
                                        </select>
                                    </div> -->
                                


                                    <div class="mt-3">
                                        <label for="quantity" class="form-label">Quantity:</label>
                                        <input type="number" id="quantity<?php echo $row->id_articulos?>" name="quantity" class="form-control" value="1" min="1">
                                    </div>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <button class="btn btn-outline-success mt-auto" onclick="addToCart({
                                    id_usuario: '<?php echo $id_administrador?>',
                                    id_articulo: '<?php echo $row->id_articulos?>',
                                    nombre: '<?php echo $row->nombre ?>',
                                    price: document.getElementById('price<?php echo $row->id_articulos?>').value,
                                    stock: document.getElementById('stock<?php echo $row->id_articulos?>').value,
                                    quantity: document.getElementById('quantity<?php echo $row->id_articulos?>').value,
                                })">Buy</button>
                            </div>
                                <div class="mt-3 text-center">
                                    Last Updated: <?php 
                                        if(is_null($row->fecha_creacion)){
                                            echo $row->fecha_actualizacion;
                                        }else{
                                            if($row->fecha_creacion >= $row->fecha_actualizacion){
                                                echo $row->fecha_creacion;
                                            }else{
                                                echo $row->fecha_actualizacion;
                                            }
                                        }
                                    ?> <!-- Reemplaza con la fecha actualizada -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>

    <div class="col mb-5">
    </div>
    <div class="col mb-5">
    </div>

                    <!-- entrada -->
                    
                    <!-- salida -->
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-4 bg-coffe">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Woodgenix 2024</p></div>
        </footer>
        <!-- Core theme JS-->
        <script src="../../js/scripts.js"></script>
        <script src="../../js/inicio/index.js"></script>
        
        
    </body>
</html>
