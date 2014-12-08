<?php
/* @var $this EncuestaController */
/* @var $model Encuesta */

$this->breadcrumbs=array(
	'Encuestas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Encuesta', 'url'=>array('index')),
	array('label'=>'Manage Encuesta', 'url'=>array('admin')),
);
?>

<h1>Create Encuesta</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>