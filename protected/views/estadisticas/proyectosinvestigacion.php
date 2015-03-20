<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
    'Estadisticas'=>array('/estadisticas'),
    'Proyectosinvestigacion',
);
?>
<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Proyectos aprobados por ente de financiamiento</p>
        <?php
        $this->widget("SectirPointChart",array(
            'data' => $proyectosaprob,
            'chartId' => "chart_proyabrob",
            "scriptId" => "chart_proyabrob"
        ));
        ?>
    </div>
</div>

<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Proyectos aprobados por área de experiencia</p>
        <?php
        $this->widget("SectirPointChart",array(
            'data' => $proyectosaprobArea,
            'chartId' => "chart_area",
            "scriptId" => "chart_area"
        ));
        ?>
    </div>
</div>
