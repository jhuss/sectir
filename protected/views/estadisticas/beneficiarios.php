<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
    'Estadisticas'=>array('/estadisticas'),
    'Beneficiarios',
);
?>
<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Beneficiarios</p>
        <?php
        $this->widget("SectirChartBars",array(
            'data' => $benefNum
        ));
        ?>
    </div>
</div>
