<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
	'Estadisticas'=>array('/estadisticas'),
	'Proyectosinvestigacion',
);

?>

<h1>Universidades e Institutos por Actividades de Ciencia e Innovación</h1>

<?php 
//TODO Acomodar CSS
$this->widget("SectirPointChart",array(
    'data' => $datos,
    'chartId' => "chart_proyabrob",
    "scriptId" => "chart_proyabrob"
));
?>
