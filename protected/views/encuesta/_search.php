<?php
/* @var $this EncuestaController */
/* @var $model Encuesta */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipoencuesta_id'); ?>
		<?php echo $form->textField($model,'tipoencuesta_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'enunciado'); ?>
		<?php echo $form->textField($model,'enunciado',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'identificador'); ?>
		<?php echo $form->textField($model,'identificador',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_inicial'); ?>
		<?php echo $form->textField($model,'fecha_inicial'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_final'); ?>
		<?php echo $form->textField($model,'fecha_final'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'creado_en'); ?>
		<?php echo $form->textField($model,'creado_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'actualizado_en'); ?>
		<?php echo $form->textField($model,'actualizado_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->