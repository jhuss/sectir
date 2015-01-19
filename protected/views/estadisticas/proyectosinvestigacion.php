<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
	'Estadisticas'=>array('/estadisticas'),
	'Proyectosinvestigacion',
);

?>

<h1>Proyectos aprobados por ente de financiamiento</h1>

<?php 
$this->widget("SectirPointChart",array(
    'data' => $proyectosaprob,
    'chartId' => "chart_proyabrob",
    "scriptId" => "chart_proyabrob"
));
?>
<h1>Proyectos aprobados por área de experiencia</h1>
<?php 
$this->widget("SectirPointChart",array(
    'data' => $proyectosaprobArea,
    'chartId' => "chart_area",
    "scriptId" => "chart_area"
));
?>
