<?php
/* @var $this EncuestaController */
/* @var $model Encuesta */

$this->breadcrumbs=array(
	'Encuestas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Encuesta', 'url'=>array('index')),
	array('label'=>'Create Encuesta', 'url'=>array('create')),
	array('label'=>'View Encuesta', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Encuesta', 'url'=>array('admin')),
);
?>

<h1>Update Encuesta <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>