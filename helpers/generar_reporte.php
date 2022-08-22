<?php
   require('../db/database.php');
   require('../fpdf16/fpdf.php');

   class MyPDF extends FPDF {

      function construct(){
          parent::construct();
      }

      function header() {
         $this->Image('../img/logo.jpg', 10, 6);
         $this->SetFont('Arial', 'B', 14);
         $this->Cell(276, 5, 'REPORTE DE USUARIOS REGISTRADOS EN LA PLATAFORMA', 0, 0, 'C');
         $this->Ln();
         $this->SetFont('Times', '', 12);
         $this->Cell(276, 10, 'Información y rutas por usuario', 0, 0, 'C');
         $this->Ln(20);
      }

      function footer() {
         $this->SetY(-15);
         $this->SetFont('Arial', '', 8);
         $this->Cell(0, 10, 'Page', $this->PageNo().'/{nb}', 0, 0, 'C');
      }

      function headerTable() {
         $this->SetFont('Times', 'B', 12);
         $this->Cell(20, 10, 'ID', 1, 0, 'C');
         $this->Cell(40, 10, 'Usuario', 1, 0, 'C');
         $this->Cell(40, 10, 'Fecha de registro', 1, 0, 'C');
         $this->Cell(60, 10, 'Correo electrónico', 1, 0, 'C');
         $this->Cell(80, 10, 'Cantidad de rutas creadas', 1, 0, 'C');
         $this->Ln();
      }

      function viewTable($conn) {
         $this->SetFont('Times', '', 12);
         $result = mysqli_query($conn, "SELECT id_usuario, usuario, correo, fecha_registro FROM usuario;");
         while ($row = mysqli_fetch_array($result)) {
            $id = $row['id_usuario'];
            $usuario = $row['usuario'];
            $correo = $row['correo'];
            $fecha_registro = $row['fecha_registro'];
            $this->Cell(20, 10, $id, 1, 0, 'L');
            $this->Cell(40, 10, $usuario, 1, 0, 'L');
            $this->Cell(40, 10, $fecha_registro, 1, 0, 'L');
            $this->Cell(60, 10, $correo, 1, 0, 'L');
            $result1 = mysqli_query($conn, "SELECT id_ruta FROM ruta WHERE id_usuario = '$id';");
            $nRutas = mysqli_num_rows($result1);
            $this->Cell(80, 10, $nRutas, 1, 0, 'L');
            $this->Ln();
         }
      }
   }

   $pdf = new MyPDF();
   $pdf->AliasNbPages();
   $pdf->AddPage('L', 'A4', 0);
   $pdf->headerTable();
   $pdf->viewTable($conn);
   $pdf->Output('D', 'reporte_usuarios.pdf');
   // $res = mysqli_query($link, "SELECT nombre FROM partido");
   // $n = 0;

   // $pdf->AddPage();
   // $pdf->SetFont('Arial', 'B', 16);
   // $pdf->Cell(150, 40, 'Cantidad de votos', 0, 1);
   // $pdf->SetFont('Arial', 'B', 14);
   // $pdf->Cell(0, 10,'Partido   Votos', 0, 1);
   // $pdf->Cell(0, 10,'___________________________________________________', 0, 1); 
   // $pdf->SetFont('Arial', '', 10);	
   // while($row = mysqli_fetch_array($res)) { 
   //    $id = $row["nombre"];
   //    $pdf->Cell(0, 10, $id.' --- '.$nVotos[$n], 0, 1);
   //    $n++;
   // } 
   // $pdf->SetTextColor(0, 0, 255);
   // $pdf->SetFont('', 'U');
   // if (file_exists("votos.pdf"))
   //    unlink("votos.pdf");
   // $pdf->Output("votos.pdf");
?>