<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
	'Estadisticas'=>array('/estadisticas'),
	'Problematicas',
);
?>

<h1>Universidades, Institutos y otros, según las instalaciones con las que cuentan</h1>

<?php

$this->widget("SectirPointChart",array(
    'data' => $datos,
));
?>
