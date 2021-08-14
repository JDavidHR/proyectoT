<?php
	session_start();
	include '../plantilla.php';
	require '../Modelo/conexion.php';

	mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_STRICT);

	$id_estudiante = $_SESSION['idEstudiante'];

	$query = "SELECT estudiante.id_estudiante, grupo.Estudiante_id_estudiante, materia.nombre as nombremateria, materia.id_materia, docente.nombres, aula.nombre as nombreaula, dias.nombre as nombredia, clase.hora FROM estudiante JOIN grupo on estudiante.id_estudiante = grupo.Estudiante_id_estudiante join clase on clase.Grupo_id_grupo = grupo.id_grupo join materia on materia.id_materia = clase.Materia_id_materia join docente on docente.id_docente = clase.Docente_id_docente join aula on aula.id_aula = clase.Aula_id_aula join dias on dias.id_dia = clase.Dias_id_dia where estudiante.id_estudiante = " . $id_estudiante . " order by clase.hora";
	$resultado = $mysqli->query($query);

	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->SetFillColor(232, 232, 232, 232);
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(70, 6, 'Asignatura', 1, 0, 'C', 1);
	$pdf->Cell(70, 6, 'Dia', 1, 0, 'C', 1);
	$pdf->Cell(50, 6, 'Hora', 1, 1, 'C', 1);
	//$pdf->Cell(20, 6, 'Hora', 1, 1, 'C', 1);

	$pdf->SetFont('Arial', '', 10);

	while ($row = $resultado->fetch_assoc()) {
	    $pdf->Cell(70, 6, utf8_decode($row['nombremateria']), 1, 0, 'C');
	    $pdf->Cell(70, 6, utf8_decode($row['nombredia']), 1, 0, 'C');
	    $pdf->Cell(50, 6, utf8_decode($row['hora']), 1, 1, 'C');
	    //$pdf->Cell(20, 6, utf8_decode($row['hora']), 1, 0, 'C');
	}
	$pdf->Output();
?>