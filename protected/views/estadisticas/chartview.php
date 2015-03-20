<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
    'Estadisticas'=>array('/estadisticas'),
    isset($pageName) ? $pageName : "Chart",
);
?>
<?php if(!empty($datos)): ?>
<?php foreach ($datos as $i=>$d): ?>
<div class="chart row">
    <div class="col-xs-12">
        <p class="title"><?php echo $d["titulo"] ?></p>
        <?php
        $this->widget((isset($d["chartClass"]) ? $d["chartClass"] : "SectirPointChart"),array(
            'data' => $d["data"],
            'scriptId' => isset($d["scriptId"]) ? $d["scriptId"] : "script_$i",
            'chartId' => isset($d["scriptId"]) ? $d["scriptId"] : "script_$i",
        ));
        ?>
    </div>
</div>
<?php endforeach; ?>
<?php else: ?>
<div class="no-data">Sin Información</div>
<?php endif; ?>