<?php
/* @var $this EncuestaController */
/* @var $model Encuesta */

$this->breadcrumbs=array(
	'Encuestas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Encuesta', 'url'=>array('index')),
	array('label'=>'Create Encuesta', 'url'=>array('create')),
	array('label'=>'Update Encuesta', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Encuesta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Encuesta', 'url'=>array('admin')),
);
?>

<h1>View Encuesta #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'tipoencuesta_id',
		'enunciado',
		'identificador',
		'fecha_inicial',
		'fecha_final',
		'creado_en',
		'actualizado_en',
		'user_id',
	),
)); ?>
