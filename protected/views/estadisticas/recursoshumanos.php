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
<h2>Talento humano por formación universitaria</h2>
<?php 
$this->widget("SectirPointChart",array(
    'data' => $datosUni,
    'chartId' => "chart_uni",
    "scriptId" => "chart_uni"
));
?>
<h2>Talento humano por fuente de financiamiento</h2>
<?php 
$this->widget("SectirPointChart",array(
    'data' => $datosFuenteFin,
    'chartId' => "chart_fuentefin",
    "scriptId" => "chart_fuentefin"
));
?>
