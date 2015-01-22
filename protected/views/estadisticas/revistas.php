<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
	'Estadisticas'=>array('/estadisticas'),
	'Revistas',
);

?>

<h1>Publicaciones en vistas arbitradas e Indexadas</h1>

<?php 
$this->widget("SectirPointChart",array(
    'data' => $datos,
));
?>
<h1>Cantidad de revistas por área</h1>
<?php 
$this->widget("SectirPointChart",array(
    'data' => $datosPorArea,
    'scriptId' => "datosArea",
    'chartId' => "datosArea",
));
?>
