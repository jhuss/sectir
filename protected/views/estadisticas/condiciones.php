<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
	'Estadisticas'=>array('/estadisticas'),
	'Condiciones',
);

?>

<h1>Condiciones de los Espacios de las Universidades</h1>

<?php 
$this->widget("SectirPointChart",array(
    'data' => $datosEspacios,
    'scriptId' => "datosEspacios",
    'chartId' => "datosEspacios",
));
?>
<h1>Condiciones del equipamiento de las universidades</h1>
<?php 
$this->widget("SectirPointChart",array(
    'data' => $datosEquipamiento,
    'scriptId' => "datosEquipamiento",
    'chartId' => "datosEquipamiento",
));
?>
