<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
	'Estadisticas'=>array('/estadisticas'),
	'Internet',
);

?>

<h1>Universidades, Institutos Tecnológicos y Escuelas técnicas con servicio de internet</h1>
<?php 
$this->widget("SectirPointChart",array(
    'data' => $datosTieneInternet,
    'scriptId' => "datosTieneInternet",
    'chartId' => "datosTieneInternet",
));
?>
<h1>Universidades, Institutos Tecnológicos y Escuelas técnicas según nivel de satisfacción del servicio de internet</h1>

<?php 
$this->widget("SectirPointChart",array(
    'data' => $datosSatisfaccion,
    'scriptId' => "datosSatisfaccion",
    'chartId' => "datosSatisfaccion",
));
?>
<h1>Universidades, Institutos Tecnológicos y Escuelas técnicas según tipo de conexión a internet</h1>
<?php 
$this->widget("SectirPointChart",array(
    'data' => $datosProveedor,
    'scriptId' => "datosProveedor",
    'chartId' => "datosProveedor",
));
?>
