<?php  
    $nombreadmin = 'Alfredo Ku Sabido';
    $id_administrador = 1;
    $id_cliente = 1;
    $id_usuario_clientes = 1;

    require_once '../../include/funciones.php';
    $db = new DB_Funciones();
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
         <!-- Iconos fontawesome -->
         <link href="../../public/fontawesome/css/all.css" rel="stylesheet">
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

        <!-- DataTable -->
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js">
        </script>

          <!-- Bootbox -->
        <script type="text/javascript" src="../../public/bootbox/bootbox.min.js"></script>
        <script type="text/javascript" src="../../public/bootbox/bootbox.locales.min.js"></script>
        <!-- Core theme CSS (includes Bootstrap)-->
    </head>
    <body>
            <?php 
                include '../encabezado.php';
            ?>
    

    <!-- mostrar perfil -->
    <div class="modal fade" id="modal_perfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="text-center modal-title" id="nombrecompleto_tres"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <img src="" class="img-thumbnail mx-auto d-block" width="300px" heigth="350px" alt="Perfil"
                        id="perfil_empleado" />
                </div>

                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>    

<div class="modal fade" id="modal_codigo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100 text-center" id="exampleModalLabel">Generate purchase order</h4>
                </div>

                <form method="POST" id="formulario_c">  

                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col">
                        <!--<p class="font-weight-light">Ingrese el codigo.</p> -->
                                <label for="codigoOC">Code purchase order:</label>
                                <input class="form-control" name="codigoOC" type="text" id="codigoOC"
                                    placeholder="Write the purchase order code" required  maxlength="10">
                            </div>
                    </div>

                    <input class="form-control" value="<?php echo $id_administrador; ?>" name="id_usuario" type="hidden"
                        id="id_usuario">
                    
                    <input class="form-control" value="<?php echo $id_usuario_clientes; ?>" name="id_usuario_clientes" type="hidden"
                        id="id_usuario_clientes">    

                    </div>

                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger" onclick="Confirma_reingreso()">Confirmar</button> -->
                        <input class="btn btn-success" type="submit" name="registro1" value="Guardar">
                        <button class="btn btn-danger" onclick="cerrar_modal_a()">Cancelar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>


        <!-- Section-->
        <section class="py-5">
            
<div class="container-fluid" style="margin-top: 10px;">
        <div class="row">
            <div class="col-md-12">
                <div class="form-row text-center">
                    <div class="form-group col">
                        <button id="boton" type="button" class="btn btn-primary float-right" onclick="abrir_modal_a()"><i
                                class="fa fa-plus" aria-hidden="true"></i> Generate purchase order</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

            <div class="container-fluid" >
                    <!-- Table -->
                    
                    <div class="row" id="table-wrapper">

                        <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header border-0 text-white" style="background-color: #deb277;">
                            <h3 class="mb-0">Shopping Cart</h3>
                            </div>
                            <div class="table-responsive p-2">

                                <table id="table" class="table align-items-center table-flush" style="width:100%;">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="text-white" scope="col" style="text-align: center; background-color: #deb277;">Product Name</th>
                                        <th class="text-white" scope="col" style="text-align: center; background-color: #deb277;">Photo</th>
                                        <th class="text-white" scope="col" style="text-align: center; background-color: #deb277;">Description</th>
                                        <th class="text-white" scope="col" style="text-align: center; background-color: #deb277;">Color</th>
                                        <th class="text-white" scope="col" style="text-align: center; background-color: #deb277;">RIA</th>
                                        <th class="text-white" scope="col" style="text-align: center; background-color: #deb277;">Price Unit</th>
                                        <th class="text-white" scope="col" style="text-align: center; background-color: #deb277;">Quantity</th>
                                        <th class="text-white" scope="col" style="text-align: center; background-color: #deb277;">Total</th>
                                        <th class="text-white" scope="col" style="text-align: center; background-color: #deb277;">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>
            </div>
     
        </section>
        <!-- Footer-->
        <footer class="py-4 bg-coffe" style="margin-top: auto;">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Woodgenix 2024</p></div>
        </footer>
        <!-- Core theme JS-->
        <script src="../../js/scripts.js"></script>
        <script src="../../js/carrito_compras/carrito_compras.js"></script>
    </body>
</html>