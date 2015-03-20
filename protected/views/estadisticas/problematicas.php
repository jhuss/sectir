<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
    'Estadisticas'=>array('/estadisticas'),
    'Problematicas',
);
?>
<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Problemáticas en los institutos de ciencia y tecnología</p>
        <?php
        $this->widget("SectirPointChart",array(
            'data' => $datos,
        ));
        ?>
    </div>
</div>
