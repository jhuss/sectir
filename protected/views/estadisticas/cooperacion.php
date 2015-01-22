<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
	'Estadisticas'=>array('/estadisticas'),
	'Cooperación',
);
?>

<h1>Participación en redes temáticas de cooperación</h1>
<?php 
$this->widget("SectirPointChart",array(
    'data' => $datos,
    'chartId' => "chart_cooperacion",
    "scriptId" => "chart_cooperacion"
));
?>
