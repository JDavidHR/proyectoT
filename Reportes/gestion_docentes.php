<?php

include '../plantilla.php';
require '../Modelo/conexion.php';

mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_STRICT);



$query = "SELECT asistencia.docente.id_docente, asistencia.docente.documento, asistencia.docente.nombres, asistencia.docente.apellidos from docente where asistencia.docente.estado = 1";
$resultado = $mysqli->query($query);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFillColor(232, 232, 232, 232);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(70, 6, 'ID', 1, 0, 'C', 1);
$pdf->Cell(70, 6, 'Nombre Completo', 1, 0, 'C', 1);
$pdf->Cell(50, 6, 'Documento', 1, 1, 'C', 1);
//$pdf->Cell(20, 6, 'Hora', 1, 1, 'C', 1);

$pdf->SetFont('Arial', '', 10);

while ($row = $resultado->fetch_assoc()) {
    $pdf->Cell(70, 6, utf8_decode($row['id_docente']), 1, 0, 'C');
    $pdf->Cell(70, 6, utf8_decode($row['nombres']. " " .$row['apellidos']), 1, 0, 'C');
    $pdf->Cell(50, 6, utf8_decode($row['documento']), 1, 1, 'C');
    //$pdf->Cell(20, 6, utf8_decode($row['hora']), 1, 0, 'C');
}
$pdf->Output();
?>