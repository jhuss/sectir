<?php
/* @var $this ManagerController */
/* @var $model SearchForm */
/* @var $form CActiveForm */

$booleanData = array(Yii::t('UsrModule.manager', 'No'), Yii::t('UsrModule.manager', 'Yes'));
//$booleanOptions = array('empty'=>Yii::t('UsrModule.manager', 'Any'), 'separator' => '', 'labelOptions' => array('style'=>'display: inline; float: none;'));
$booleanOptions = array('empty'=>Yii::t('UsrModule.manager', 'Any'), 'template'=>'<label class="checkbox-inline">{input} {labelTitle}</label>', 'separator'=>'');
?>

<div class="col-xs-10 wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
    'htmlOptions' => array('class'=>'form-horizontal', 'role'=>'form'),
)); ?>

	<div class="form-group">
		<?php echo $form->label($model,'id', array('class'=>sprintf('col-xs-%s control-label',$labelSize))); ?>
        <div class="col-xs-<?php echo $controlSize; ?>">
            <?php echo $form->textField($model,'id', array('class'=>'form-control')); ?>
        </div>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'username', array('class'=>sprintf('col-xs-%s control-label',$labelSize))); ?>
        <div class="col-xs-<?php echo $controlSize; ?>">
            <?php echo $form->textField($model,'username',array('class'=>'form-control','maxlength'=>255)); ?>
        </div>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'email', array('class'=>sprintf('col-xs-%s control-label',$labelSize))); ?>
        <div class="col-xs-<?php echo $controlSize; ?>">
            <?php echo $form->textField($model,'email',array('class'=>'form-control','maxlength'=>255)); ?>
        </div>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'firstName', array('class'=>sprintf('col-xs-%s control-label',$labelSize))); ?>
        <div class="col-xs-<?php echo $controlSize; ?>">
            <?php echo $form->textField($model,'firstName',array('class'=>'form-control','maxlength'=>255)); ?>
        </div>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'lastName', array('class'=>sprintf('col-xs-%s control-label',$labelSize))); ?>
        <div class="col-xs-<?php echo $controlSize; ?>">
            <?php echo $form->textField($model,'lastName',array('class'=>'form-control','maxlength'=>255)); ?>
        </div>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'createdOn', array('class'=>sprintf('col-xs-%s control-label',$labelSize))); ?>
        <div class="col-xs-<?php echo $controlSize; ?>">
            <?php echo $form->textField($model,'createdOn', array('class'=>'form-control')); ?>
        </div>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'updatedOn', array('class'=>sprintf('col-xs-%s control-label',$labelSize))); ?>
        <div class="col-xs-<?php echo $controlSize; ?>">
            <?php echo $form->textField($model,'updatedOn', array('class'=>'form-control')); ?>
        </div>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'lastVisitOn', array('class'=>sprintf('col-xs-%s control-label',$labelSize))); ?>
        <div class="col-xs-<?php echo $controlSize; ?>">
            <?php echo $form->textField($model,'lastVisitOn', array('class'=>'form-control')); ?>
        </div>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'emailVerified', array('class'=>sprintf('col-xs-%s control-label',$labelSize))); ?>
        <div class="col-xs-<?php echo $controlSize; ?>">
            <?php echo $form->radioButtonList($model,'emailVerified', $booleanData, $booleanOptions); ?>
        </div>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'isActive', array('class'=>sprintf('col-xs-%s control-label',$labelSize))); ?>
        <div class="col-xs-<?php echo $controlSize; ?>">
            <?php echo $form->radioButtonList($model,'isActive', $booleanData, $booleanOptions); ?>
        </div>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'isDisabled', array('class'=>sprintf('col-xs-%s control-label',$labelSize))); ?>
        <div class="col-xs-<?php echo $controlSize; ?>">
            <?php echo $form->radioButtonList($model,'isDisabled', $booleanData, $booleanOptions); ?>
        </div>
	</div>

	<div class="form-group">
        <div class="col-xs-offset-<?php echo $labelSize; ?> col-xs-<?php echo $controlSize; ?>">
            <?php echo CHtml::submitButton(Yii::t('UsrModule.manager', 'Search'), array('class'=>'btn btn-primary btn-sm')); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
