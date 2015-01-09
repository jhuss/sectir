<?php
/* @var $this AgrupacionencController */
/* @var $data Agrupacionenc */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creado_en')); ?>:</b>
	<?php echo CHtml::encode($data->creado_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actualizado_en')); ?>:</b>
	<?php echo CHtml::encode($data->actualizado_en); ?>
	<br />


</div>