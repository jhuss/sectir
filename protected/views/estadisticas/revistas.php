<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
    'Estadisticas'=>array('/estadisticas'),
    'Revistas',
);
?>
<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Publicaciones en vistas arbitradas e Indexadas</p>
        <?php
        $this->widget("SectirChartBars",array(
            'data' => $datos,
        ));
        ?>
    </div>
</div>

<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Cantidad de revistas por área</p>
        <?php
        $this->widget("SectirChartBars",array(
            'data' => $datosPorArea,
            'scriptId' => "datosArea",
            'chartId' => "datosArea",
        ));
        ?>
    </div>
</div>
