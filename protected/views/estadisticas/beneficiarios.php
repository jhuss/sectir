<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
	'Estadisticas'=>array('/estadisticas'),
	'Beneficiarios',
);
?>

<h1>Beneficiarios</h1>
<?php $this->widget("SectirPointChart",array(
    'data' => $benefNum
));  ?>
