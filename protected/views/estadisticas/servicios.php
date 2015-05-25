<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
    'Estadisticas'=>array('/estadisticas'),
    'Servicios',
);
?>
<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Centros según servicios que ofrecen</p>
        <?php
        $this->widget("SectirChartBars",array(
            'data' => $datos
        ))
        ?>
    </div>
</div>
