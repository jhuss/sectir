<?php
/* @var $this AgrupacionencController */
/* @var $model Agrupacionenc */

$this->breadcrumbs=array(
	'Agrupacionencs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Agrupacionenc', 'url'=>array('index')),
	array('label'=>'Create Agrupacionenc', 'url'=>array('create')),
	array('label'=>'View Agrupacionenc', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Agrupacionenc', 'url'=>array('admin')),
);
?>

<h1>Update Agrupacionenc <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>