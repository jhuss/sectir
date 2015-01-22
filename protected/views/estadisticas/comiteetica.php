<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
	'Estadisticas'=>array('/estadisticas'),
	'Comité de ética',
);
?>
<h1>Universidades, Institutos tecnológicos y escuelas que cuentan con comité de ética</h1>
<?php $this->widget("SectirPointChart",array(
    'data' => $datosComiteEtica
)); ?>
