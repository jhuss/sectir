<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
    'Estadisticas'=>array('/estadisticas'),
    'Tipo de Patrimonio',
);
?>
<div class="chart row">
    <div class="col-xs-12">
        <p class="title">Universidades, Institutos tecnológicos y escuelas por tipo de patrimonio</p>
        <?php
        $this->widget("SectirPointChart",array(
            'data' => $datosPorPatrimonio
        ));
        ?>
    </div>
</div>
