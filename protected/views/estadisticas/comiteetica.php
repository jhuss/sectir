<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
    'Estadisticas'=>array('/estadisticas'),
    'Comité de ética',
);
?>
<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Universidades, Institutos tecnológicos y escuelas que cuentan con comité de ética</p>
        <?php
        $this->widget("SectirChartBars",array(
            'data' => $datosComiteEtica
        ));
        ?>
    </div>
</div>
