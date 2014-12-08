<?php
/* @var $this EncuestaController */
/* @var $data Encuesta */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipoencuesta_id')); ?>:</b>
	<?php echo CHtml::encode($data->tipoencuesta_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enunciado')); ?>:</b>
	<?php echo CHtml::encode($data->enunciado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('identificador')); ?>:</b>
	<?php echo CHtml::encode($data->identificador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_inicial')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_inicial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_final')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_final); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creado_en')); ?>:</b>
	<?php echo CHtml::encode($data->creado_en); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('actualizado_en')); ?>:</b>
	<?php echo CHtml::encode($data->actualizado_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	*/ ?>

</div>