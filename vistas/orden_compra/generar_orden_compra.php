<?php 
require_once '../../include/funciones.php';
require_once '../../libs/fpdf186/fpdf.php';

date_default_timezone_set('America/Mexico_City');

$get_code = $_POST['get_code'];

class OrdenCompraPDF extends FPDF {
    function header(){
        $get_code = $_POST['get_code'];
        $get_id_codigoOC = $_POST['get_id_codigoOC'];
        $fechaActual = date("Y-m-d");

        $this->SetFont('Arial','B', 22);
        $this->Cell(0,18,'Purchase Order',0,1,'R');

     // Agregar información adicional en celdas al lado
        $this->SetFont('Arial','',10);
        $this->Cell(135,3,'',0,0,'L');

        $this->SetFont('Arial','B',10);
        $this->Cell(18,3,'PO Date:',0,0,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(60,3,$fechaActual,0,1,'L');

        $this->SetFont('Arial','',10);
        $this->Cell(135,8,'',0,0,'L');

        $this->SetFont('Arial','B',10);
        $this->Cell(16,8,'PO No.:',0,0,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(60,8,$get_code ,0,1,'L');

        $this->SetFont('Arial','',10);
        $this->Cell(135,5,'',0,0,'L');

        $this->SetFont('Arial','B',10);
        $this->Cell(23,5,'Account No.:',0,0,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(60,5, $get_id_codigoOC ,0,1,'L');
    }

    function footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ' . $this->PageNo()), 0, 0, 'C');
    }

    function chapterTitle(){
        $db = new DB_Funciones();
        $get_code = $_POST['get_code'];
        $fila_codigoOC = $db->codigo_oc($get_code);
        $fila = $fila_codigoOC->fetch_object();

        $this->SetFont('Arial','B', 11);
        $this->Cell(90,10,'Vendor Information:',0,0,'L');
        $this->SetFont('Arial','B', 11);
        $this->Cell(0,10,'Ship To Information:',0,1,'L');

        $this->SetFont('Arial','', 11);
        $this->Cell(90,2,'LAINEKRAFT',0,0,'L');

        $this->SetFont('Arial','', 11);
        $this->Cell(0,2,$fila->nombre,0,1,'L');

        $this->SetFont('Arial','',11);
        $this->Cell(90,10,'',0,0,'L');

        $this->SetFont('Arial','',11);
        $this->Cell(0,10,$fila->direccion,0,1,'L');

        $this->SetFont('Arial','',11);
        $this->Cell(90,2,'',0,0,'L');

        $this->SetFont('Arial','',11);
        $this->Cell(0,2,$fila->CP,0,1,'L');

        $this->Ln(5);

      // Configurar la fuente y tamaño para ambas celdas
        $this->SetFont('Arial', 'B', 11);

        // Celda 1: Buyer
        $this->Cell(20, 7, 'Buyer:', 'LTB', 0, 'L');

        // Cambiar a la fuente regular para la segunda celda
        $this->SetFont('Arial', '', 11);

        // Celda 2: Nombre del comprador (Alfredo Ku)
        $this->Cell(60, 7, $fila->nombre_usuario . ' ' . $fila->apellido_usuario, 'TRB', 0, 'L');

         // Celda 
         $this->SetFont('Arial', 'B', 11);
         $this->Cell(35, 7, 'Sales Order No:', 'LTB', 0, 'L');
         $this->SetFont('Arial', '', 11);
         $this->Cell(0, 7, '', 'TRB', 1, 'L');

         //Salto de linea

         $this->SetFont('Arial', 'B', 11);
         $this->Cell(30, 7, 'Phone No.:', 'LTB', 0, 'L');
         $this->SetFont('Arial', '', 11);
         $this->Cell(50, 7, '', 'TRB', 0, 'L');

         $this->SetFont('Arial', 'B', 11);
         $this->Cell(35, 7, 'Customer Name:', 'LTB', 0, 'L');
         $this->SetFont('Arial', '', 11);
         $this->Cell(0, 7, '', 'TRB', 1, 'L');

            //Salto de linea

            $this->SetFont('Arial', 'B', 11);
            $this->Cell(20, 7, 'Email:', 'LTB', 0, 'L');
            $this->SetFont('Arial', '', 11);
            $this->Cell(60, 7, $fila->correo, 'TRB', 0, 'L');
      
            $this->SetFont('Arial', 'B', 11);
            $this->Cell(35, 7, 'Customer Type:', 'LTB', 0, 'L');
            $this->SetFont('Arial', '', 11);
            $this->Cell(0, 7, '', 'TRB', 1, 'L');

            //Salto de linea

            $this->SetFont('Arial', 'B', 11);
            $this->Cell(30, 7, 'Salesperson:', 'LTB', 0, 'L');
            $this->SetFont('Arial', '', 11);
            $this->Cell(50, 7, '', 'TRB', 0, 'L');
                
            $this->SetFont('Arial', 'B', 11);
            $this->Cell(35, 7, 'Payment Terms:', 'LTB', 0, 'L');
            $this->SetFont('Arial', '', 11);
            $this->Cell(0, 7, 'PAID IN FULL', 'TRB', 1, 'L');

        $this->Ln(4);
    }

    function chapterBody(){
        // Celda 
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 7, 'Prod. name', 'B', 0, 'C');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(40, 7, 'Description', 'B', 0, 'C');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(18, 7, 'Color', 'B', 0, 'C');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(33, 7, 'RIA', 'B', 0, 'C');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(22, 7, 'PO', 'B', 0, 'C');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(22, 7, 'Price unit', 'B', 0, 'C');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(10, 7, 'Qty', 'B', 0, 'C');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 7, 'Total', 'B', 1, 'C');

        $db = new DB_Funciones();
        $get_id_codigoOC = $_POST['get_id_codigoOC']; 
        $id_usuario_clientes = $_POST['id_usuario_clientes'];
        $fila_articulos = $db->listar_articulos_oc($get_id_codigoOC, $id_usuario_clientes);

        $total_fin = 0;
        $count = 5;
        $contador = 1;
        $multiplicador = 1;

        while ($row = $fila_articulos->fetch_object()) {

            $this->SetFont('Arial', '', 10);

            $x = $this->GetX();
            $y = $this->GetY();

            $altura = $y + $count;

            if($contador >= 3){
                $resta_altura = 15 * $multiplicador;
                $multiplicador++;
            }else{
                $resta_altura = 0;
            }

            $resta_al_ttl = $altura - $resta_altura;

            $this->SetXY($x, $resta_al_ttl);
            $this->MultiCell(20, 5, $row->nombre, 0,'C');
            
            $this->SetXY($x + 25, $resta_al_ttl);
            $this->MultiCell(30, 5, $row->descripcion, 0, 'C');

            $this->SetXY($x + 45, $resta_al_ttl); 
            $this->MultiCell(48, 5, $row->nombre_color, 0, 'C');

            $this->SetXY($x + 80, $resta_al_ttl);  
            $this->MultiCell(30, 5, $row->nombre_presentacion, 0, 'C');

            $this->SetXY($x + 110, $resta_al_ttl); 
            $this->MultiCell(25, 5, $row->OC_interna, 0, 'C');

            $this->SetXY($x + 135, $resta_al_ttl); 
            $precio_formateado = number_format($row->precio, 2, '.', ',');
            $this->MultiCell(20, 5, '$' . $precio_formateado, 0,'C');
            
            $this->SetXY($x + 155, $resta_al_ttl); 
            $this->MultiCell(10, 5, $row->cantidad, 0, 'C');
            
            $this->SetXY($x + 165, $resta_al_ttl); 
            $total_formateado = number_format($row->total, 2, '.', ',');
            $this->MultiCell(0, 5, '$' . $total_formateado, 0, 'C'); // 1 indica que se debe pasar a la siguiente línea al final de esta celda
            
            $total_fin += $row->total;
            $count += 15;
            $contador ++;
        }
        
        $this->Ln();

        $this->SetFont('Arial','',1);
        $this->Cell(145,1,'',0,0,'L');
        
        $totalAmount_formateado = number_format( $total_fin, 2, '.', ',');

        $this->SetFont('Arial','',10);
        $this->Cell(0,35,'Total Amount:  $' . $totalAmount_formateado ,0,1,'L');
    }
}

// Crear instancia de la clase PDF
$pdf = new OrdenCompraPDF();

// Agregar una página
$pdf->AddPage();

// Añadir título
$pdf->chapterTitle();

// Añadir contenido
//$detalles = "Fecha: 2024-02-08\nProveedor: Proveedor XYZ\nProducto 1: Producto A - Cantidad: 10 - Precio unitario: $20.00\nProducto 2: Producto B - Cantidad: 5 - Precio unitario: $15.00\nTotal: $275.00";
$pdf->chapterBody();

// Guarda el PDF en el servidor y proporciona un enlace para descargarlo
$numero_random = rand(10, 99);
$pdfFileName = $get_code . '.pdf';
$pdf->Output($pdfFileName, 'D');

?>