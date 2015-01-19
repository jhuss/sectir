<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
	'Estadisticas'=>array('/estadisticas'),
	'Recursoshumanos',
);
?>

<h1>Recursos Humanos</h1>


<h2>Talento humano por categoría PEI</h2>
<?php 
$this->widget("SectirPointChart",array(
    'data' => $datosPorCat,
    'chartId' => "chart_cat",
    "scriptId" => "chart_cat"
));
?>

<h2>Talento humano por experiencia PEI</h2>
<?php 
$this->widget("SectirPointChart",array(
    'data' => $datosExp,
    'chartId' => "chart_exp",
    "scriptId" => "chart_exp"
));
?>
