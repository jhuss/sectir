<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
    'Estadisticas'=>array('/estadisticas'),
    'Cooperación',
);
?>
<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Participación en redes temáticas de cooperación</p>
        <?php
        $this->widget("SectirChartBars",array(
            'data' => $datos,
            'chartId' => "chart_cooperacion",
            "scriptId" => "chart_cooperacion"
        ));
        ?>
    </div>
</div>
