<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
	'Estadisticas'=>array('/estadisticas'),
	'Proyectosinvestigacion',
);

?>

<h1>Programas Existentes</h1>

<?php 
$this->widget("SectirPointChart",array(
    'data' => $datos,
    'chartId' => "chart_proyabrob",
    "scriptId" => "chart_proyabrob"
));
?>
<h1>Egresados de Programas Existentes</h1>

<?php 
$this->widget("SectirPointChart",array(
    'data' => $datosEgresados,
    'chartId' => "chart_egresados",
    "scriptId" => "chart_egresados"
));
?>
