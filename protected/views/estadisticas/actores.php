<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
	'Estadisticas'=>array('/estadisticas'),
	'Actores',
);
?>

<h1>Actores Involucrados en proyectos de investigación</h1>
<?php 
$this->widget("SectirPointChart",array(
    'data' => $datos,
    'chartId' => "chart_actores",
    "scriptId" => "chart_actores"
));
?>
