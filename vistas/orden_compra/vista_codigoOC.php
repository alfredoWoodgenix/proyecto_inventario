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

        <!-- Section-->
        <section class="py-5">

            <div class="container-fluid" >
                    <!-- Table -->
                    
                    <div class="row" id="table-wrapper">

                        <div class="col-md-10 mx-auto">
                        <div class="card shadow">
                            <div class="card-header border-0" style="background-color: #deb277;">
                            <h3 class="mb-0 text-white">Purchase orders</h3>
                            </div>
                            <div class="table-responsive p-2">

                                <table id="table" class="table align-items-center table-flush" style="width:100%;">
                                    <thead class="thead-light " >
                                    <tr>
                                        <th scope="col" class="text-white" style="text-align: center; background-color: #deb277;">Code</th>
                                        <th scope="col" class="text-white" style="text-align: center; background-color: #deb277;">Update date</th>
                                        <th scope="col" class="text-white" style="text-align: center; background-color: #deb277;">User</th>
                                        <th scope="col" class="text-white" style="text-align: center; background-color: #deb277;">Total</th>
                                        <th scope="col" class="text-white" style="text-align: center; background-color: #deb277;">Show</th>
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
        <script src="../../js/orden_compra/vista_codigoOC.js"></script>
         <!--<script src="../../js/carrito_compras/carrito_compras.js"></script>-->
    </body>
</html>