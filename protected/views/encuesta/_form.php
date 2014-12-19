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
		<?php echo $form->dropDownList($model,'tipoencuesta_id',(new Tipoencuesta)->identificadoresTE); ?>
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
		<?php echo $form->labelEx($model,'ano'); ?>
		<?php echo $form->textField($model,'ano'); ?>
		<?php echo $form->error($model,'ano'); ?>
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
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
