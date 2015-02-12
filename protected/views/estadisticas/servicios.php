<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
	'Estadisticas'=>array('/estadisticas'),
	'Servicios',
);
?>
<h1>Centros según servicios que ofrecen</h1>
<?php $this->widget("SectirPointChart",array(
    'data' => $datos
)); ?>
