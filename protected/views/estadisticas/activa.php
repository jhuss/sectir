<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
    'Estadisticas'=>array('/estadisticas'),
    'Problematicas',
);
?>
<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Universidades, Institutos y otros, según las instalaciones con las que cuentan</p>
        <?php
        $this->widget("SectirPointChart",array(
            'data' => $datos,
        ));
        ?>
    </div>
</div>
