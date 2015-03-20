<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
    'Estadisticas'=>array('/estadisticas'),
    'Proyectosinvestigacion',
);
?>
<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Programas Existentes</p>
        <?php
        $this->widget("SectirPointChart",array(
            'data' => $datos,
            'chartId' => "chart_proyabrob",
            "scriptId" => "chart_proyabrob"
        ));
        ?>
    </div>
</div>

<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Egresados de Programas Existentes</p>
        <?php
        $this->widget("SectirPointChart",array(
            'data' => $datosEgresados,
            'chartId' => "chart_egresados",
            "scriptId" => "chart_egresados"
        ));
        ?>
    </div>
</div>
