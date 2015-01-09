<?php
/* @var $this AgrupacionencController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Agrupacionencs',
);

$this->menu=array(
	array('label'=>'Create Agrupacionenc', 'url'=>array('create')),
	array('label'=>'Manage Agrupacionenc', 'url'=>array('admin')),
);
?>

<h1>Agrupacionencs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
