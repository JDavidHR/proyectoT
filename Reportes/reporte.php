<?php
session_start();
include '../plantilla.php';
require '../Modelo/conexion.php';

mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_STRICT);

$id_docente = $_SESSION['idDocente'];

$query = "SELECT docente.id_docente, clase.hora, dias.id_dia, dias.nombre as nombrediaM, materia.nombre as nombremateria, clase.codigo FROM docente join clase on clase.Docente_id_docente = docente.id_docente join dias on dias.id_dia = clase.Dias_id_dia join materia on materia.id_materia = clase.Materia_id_materia where docente.id_docente = " . $id_docente . " order by dias.id_dia";
$resultado = $mysqli->query($query);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFillColor(232, 232, 232, 232);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(70, 6, 'Dia', 1, 0, 'C', 1);
$pdf->Cell(70, 6, 'Materia', 1, 0, 'C', 1);
$pdf->Cell(50, 6, 'Codigo', 1, 1, 'C', 1);
//$pdf->Cell(20, 6, 'Hora', 1, 1, 'C', 1);

$pdf->SetFont('Arial', '', 10);

while ($row = $resultado->fetch_assoc()) {
    $pdf->Cell(70, 6, utf8_decode($row['nombrediaM']), 1, 0, 'C');
    $pdf->Cell(70, 6, utf8_decode($row['nombremateria']), 1, 0, 'C');
    $pdf->Cell(50, 6, utf8_decode($row['codigo']), 1, 1, 'C');
    //$pdf->Cell(20, 6, utf8_decode($row['hora']), 1, 0, 'C');
}
$pdf->Output();
?>