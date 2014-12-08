<?php
/* @var $this EncuestaController */
/* @var $model Encuesta */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'encuesta-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tipoencuesta_id'); ?>
		<?php echo $form->textField($model,'tipoencuesta_id'); ?>
		<?php echo $form->error($model,'tipoencuesta_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enunciado'); ?>
		<?php echo $form->textField($model,'enunciado',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'enunciado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'identificador'); ?>
		<?php echo $form->textField($model,'identificador',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'identificador'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_inicial'); ?>
		<?php echo $form->textField($model,'fecha_inicial'); ?>
		<?php echo $form->error($model,'fecha_inicial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_final'); ?>
		<?php echo $form->textField($model,'fecha_final'); ?>
		<?php echo $form->error($model,'fecha_final'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'creado_en'); ?>
		<?php echo $form->textField($model,'creado_en'); ?>
		<?php echo $form->error($model,'creado_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'actualizado_en'); ?>
		<?php echo $form->textField($model,'actualizado_en'); ?>
		<?php echo $form->error($model,'actualizado_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->