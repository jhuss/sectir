<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
    'Estadisticas'=>array('/estadisticas'),
    'Condiciones',
);
?>
<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Condiciones de los Espacios de las Universidades</p>
        <?php
        $this->widget("SectirPointChart",array(
            'data' => $datosEspacios,
            'scriptId' => "datosEspacios",
            'chartId' => "datosEspacios",
        ));
        ?>
    </div>
</div>

<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Condiciones del equipamiento de las universidades</p>
        <?php
        $this->widget("SectirPointChart",array(
            'data' => $datosEquipamiento,
            'scriptId' => "datosEquipamiento",
            'chartId' => "datosEquipamiento",
        ));
        ?>
    </div>
</div>
