<?php 
require_once '../../include/funciones.php';
require_once '../../libs/fpdf186/fpdf.php';

date_default_timezone_set('America/Mexico_City');

$get_code = $_POST['get_code'];

class OrdenCompraPDF extends FPDF {
    function header(){
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
        $this->Cell(60,8,'991618',0,1,'L');

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
        $this->SetFont('Arial','B', 11);
        $this->Cell(90,10,'Vendor Information:',0,0,'L');
        $this->SetFont('Arial','B', 11);
        $this->Cell(0,10,'Ship To Information:',0,1,'L');

        $this->SetFont('Arial','', 11);
        $this->Cell(90,2,'LAINEKRAFT USA:',0,0,'L');

        $this->SetFont('Arial','', 11);
        $this->Cell(0,2,'MARKRAFT CABINETS, LLC (MF):',0,1,'L');

        $this->SetFont('Arial','',11);
        $this->Cell(90,10,'',0,0,'L');

        $this->SetFont('Arial','',11);
        $this->Cell(0,10,'536 CASTLE HAYNE ROAD, UNIT 9:',0,1,'L');

        $this->SetFont('Arial','',11);
        $this->Cell(90,2,'',0,0,'L');

        $this->SetFont('Arial','',11);
        $this->Cell(0,2,'WILMINGTON, NC 28405 USA',0,1,'L');

        $this->Ln(5);

      // Configurar la fuente y tamaño para ambas celdas
        $this->SetFont('Arial', 'B', 11);

        // Celda 1: Buyer
        $this->Cell(20, 7, 'Buyer:', 'LTB', 0, 'L');

        // Cambiar a la fuente regular para la segunda celda
        $this->SetFont('Arial', '', 11);

        // Celda 2: Nombre del comprador (Alfredo Ku)
        $this->Cell(60, 7, 'Alfredo Ku', 'TRB', 0, 'L');

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
            $this->Cell(60, 7, 'alfredo@woodgenix.com.mx', 'TRB', 0, 'L');
      
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
        $this->Cell(30, 7, 'Description', 'B', 0, 'C');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(48, 7, 'Color', 'B', 0, 'C');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(30, 7, 'RIA', 'B', 0, 'C');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 7, 'PO WGNX', 'B', 0, 'C');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 7, 'Price unit', 'B', 0, 'C');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(10, 7, 'Qty', 'B', 0, 'C');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(10, 7, 'Total', 'B', 1, 'C');

        $db = new DB_Funciones();
        $get_id_codigoOC = $_POST['get_id_codigoOC']; 
        $id_usuario_clientes = $_POST['id_usuario_clientes'];
        $fila_articulos = $db->listar_articulos_oc($get_id_codigoOC, $id_usuario_clientes);

        $total_fin = 0;

        while ($row = $fila_articulos->fetch_object()) {
            $this->Ln(2);
        
            $this->SetFont('Arial', '', 7);
            $this->Cell(20, 5, $row->nombre, 0, 0, 'C');
        
            $this->SetFont('Arial', '', 7);
            $this->Cell(30, 5, $row->descripcion, 0, 0, 'C');
        
            $this->SetFont('Arial', '', 7);
            $this->Cell(48, 5, $row->nombre_color, 0, 0, 'C');
        
            $this->SetFont('Arial', '', 7);
            $this->Cell(30, 5, $row->nombre_presentacion, 0, 0, 'C');
        
            $this->SetFont('Arial', '', 7);
            $this->Cell(20, 5, $row->OC_interna, 0, 0, 'C');
            
            $precio_formateado = number_format($row->precio, 2, '.', ',');
        
            $this->SetFont('Arial', '', 7);
            $this->Cell(20, 5, '$' . $precio_formateado, 0, 0, 'C');
        
            $this->SetFont('Arial', '', 7);
            $this->Cell(10, 5, $row->cantidad, 0, 0, 'C');
            
            $total_formateado = number_format($row->total, 2, '.', ',');
        
            $this->SetFont('Arial', '', 7);
            $this->Cell(10, 5, '$' . $total_formateado, 0, 1, 'C'); // 1 indica que se debe pasar a la siguiente línea al final de esta celda
            
            $total_fin += $row->total;
        }
        
        $this->Ln();

        $this->SetFont('Arial','',1);
        $this->Cell(145,1,'',0,0,'L');
        
        $totalAmount_formateado = number_format( $total_fin, 2, '.', ',');

        $this->SetFont('Arial','',10);
        $this->Cell(0,10,'Total Amount:  $' . $totalAmount_formateado ,0,1,'L');
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