<?php
/* @var $this EncuestaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Encuestas',
);

$this->menu=array(
	array('label'=>'Create Encuesta', 'url'=>array('create')),
	array('label'=>'Manage Encuesta', 'url'=>array('admin')),
);
?>

<h1>Encuestas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
