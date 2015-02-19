<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
	'Estadisticas'=>array('/estadisticas'),
	isset($pageName) ? $pageName : "Chart",
);

?>

<?php foreach ($datos as $i=>$d): ?>
    <h1><?php echo $d["titulo"] ?></h1>
    <?php 
    $this->widget((isset($d["chartClass"]) ? $d["chartClass"] : "SectirPointChart"),array(
        'data' => $d["data"],
        'scriptId' => isset($d["scriptId"]) ? $d["scriptId"] : "script_$i",
        'chartId' => isset($d["scriptId"]) ? $d["scriptId"] : "script_$i",
    ));
    ?>
<?php endforeach; ?> 
