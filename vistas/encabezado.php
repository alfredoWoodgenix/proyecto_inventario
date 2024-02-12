        <!-- Navigation-->
        <?php 
            $total_car = $db->contar_carrito($id_administrador);
            $numero_total = $total_car->fetch_object();
        ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-coffe">
            <div class="container px-4 px-lg-5">
                <div>
                <img src="../../imagenes/LogoWoodgenix.png" alt="imagen" style="height: 2.3rem;">
                <a class="navbar-brand" style="color: white; font-size: 1.7em; font-weight: bold;" href="../inicio/index.php"> Woodgenix</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" style="text-align: center;" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" style="color: white; font-size: 1.2em; " href="../inicio/index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="../orden_compra/vista_codigoOC.php" style="color: white; font-size: 1.2em;">Purchase orders</a></li>
                    </ul>
                    <form class="d-flex justify-content-center" action="../carrito_compras/carrito_compras.php">
                        <button class="btn btn-outline-white" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-white text-black ms-1 rounded-pill"><?php echo $numero_total->total; ?></span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <script src="../../js/encabezado.js"></script>