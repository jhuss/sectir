<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
    'Estadisticas'=>array('/estadisticas'),
    'Internet',
);
?>
<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Universidades, Institutos Tecnológicos y Escuelas técnicas con servicio de internet</p>
        <?php
        $this->widget("SectirPointChart",array(
            'data' => $datosTieneInternet,
            'scriptId' => "datosTieneInternet",
            'chartId' => "datosTieneInternet",
        ));
        ?>
    </div>
</div>

<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Universidades, Institutos Tecnológicos y Escuelas técnicas según nivel de satisfacción del servicio de internet</p>
        <?php
        $this->widget("SectirPointChart",array(
            'data' => $datosSatisfaccion,
            'scriptId' => "datosSatisfaccion",
            'chartId' => "datosSatisfaccion",
        ));
        ?>
    </div>
</div>

<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Universidades, Institutos Tecnológicos y Escuelas técnicas según tipo de conexión a internet</p>
        <?php
        $this->widget("SectirPointChart",array(
            'data' => $datosProveedor,
            'scriptId' => "datosProveedor",
            'chartId' => "datosProveedor",
        ));
        ?>
    </div>
</div>
