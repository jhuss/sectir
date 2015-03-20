<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
    'Estadisticas'=>array('/estadisticas'),
    'Proyectosinvestigacion',
);
?>
<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Universidades e Institutos por Actividades de Ciencia e Innovación</p>
        <?php
        $this->widget("SectirPointChart",array(
            'data' => $datos,
            'chartId' => "chart_proyabrob",
            "scriptId" => "chart_proyabrob"
        ));
        ?>
    </div>
</div>
