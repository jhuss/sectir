<?php
/* @var $this EstadisticasController */

$this->breadcrumbs=array(
	'Estadisticas'=>array('/estadisticas'),
	'Gastosactividades',
);

$lang = Yii::app()->language;

$data = array(array(
    'x' => 1,
    'y' => 2,
),
array('x' => 3, 'y' => 4)
);

$this->widget("SectirHorizontalChart",array("data"=>$data));
