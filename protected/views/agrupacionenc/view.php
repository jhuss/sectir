<?php
/* @var $this AgrupacionencController */
/* @var $model Agrupacionenc */

$this->breadcrumbs=array(
	'Agrupacionencs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Agrupacionenc', 'url'=>array('index')),
	array('label'=>'Create Agrupacionenc', 'url'=>array('create')),
	array('label'=>'Update Agrupacionenc', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Agrupacionenc', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Agrupacionenc', 'url'=>array('admin')),
);
?>

<h1>View Agrupacionenc #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'user_id',
		'creado_en',
		'actualizado_en',
	),
)); ?>
