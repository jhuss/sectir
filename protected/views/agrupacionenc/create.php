<?php
/* @var $this AgrupacionencController */
/* @var $model Agrupacionenc */

$this->breadcrumbs=array(
	'Agrupacionencs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Agrupacionenc', 'url'=>array('index')),
	array('label'=>'Manage Agrupacionenc', 'url'=>array('admin')),
);
?>

<h1>Create Agrupacionenc</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>