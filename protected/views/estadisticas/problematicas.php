<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
	'Estadisticas'=>array('/estadisticas'),
	'Problematicas',
);
?>

<h1>Problemáticas en los institutos de ciencia y tecnología</h1>

<?php

$this->widget("SectirPointChart",array(
    'data' => $datos,
));
?>
