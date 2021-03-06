<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
    'Estadisticas'=>array('/estadisticas'),
    'Proyectosinvestigacion',
);
?>
<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Recursos aprobados por ente de financiamiento</p>
        <?php
        $this->widget("SectirChartBars",array(
            'data' => $proyectosaprob,
            'chartId' => 'chart_proyabrob',
            'scriptId' => 'chart_proyabrob',
            'opts' => array(
                'scaleLabel' => "<%=value%> Bs"
            )
        ));
        ?>
    </div>
</div>

<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Recursos aprobados por área de experiencia</p>
        <?php
        $this->widget("SectirChartBars",array(
            'data' => $proyectosaprobArea,
            'chartId' => 'chart_area',
            'scriptId' => 'chart_area',
            'opts' => array(
            'scaleLabel' => "<%=value%> Bs"
        )
        ));
        ?>
    </div>
</div>