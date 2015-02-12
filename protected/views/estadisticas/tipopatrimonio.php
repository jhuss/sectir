<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
	'Estadisticas'=>array('/estadisticas'),
	'Tipo de Patrimonio',
);
?>
<h1>Universidades, Institutos tecnológicos y escuelas por tipo de patrimonio</h1>
<?php $this->widget("SectirPointChart",array(
    'data' => $datosPorPatrimonio
)); ?>
