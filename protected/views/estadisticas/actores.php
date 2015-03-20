<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
    'Estadisticas'=>array('/estadisticas'),
    'Actores',
);
?>
<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Actores Involucrados en proyectos de investigación</p>
        <?php
        $this->widget("SectirPointChart",array(
            'data' => $datos,
            'chartId' => "chart_actores",
            "scriptId" => "chart_actores"
        ));
        ?>
    </div>
</div>
