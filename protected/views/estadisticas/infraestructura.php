<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
    'Estadisticas'=>array('/estadisticas'),
    'Infraestructura',
);
?>
<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Infraestructura en ciencia, tecnología e innovación</p>
        <?php
        $this->widget("SectirHorizontalChart",array(
            'data' => $datos
        ));
        ?>
    </div>
</div>
