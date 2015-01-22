<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
	'Estadisticas'=>array('/estadisticas'),
	'Infraestructura',
);
?>
<h1>Infraestructura en ciencia, tecnología e innovación</h1>
<?php $this->widget("SectirHorizontalChart",array(
    'data' => $datos
)); ?>
