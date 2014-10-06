<?php /*
@var $this DefaultController
@var $model RecoveryForm */

$title = Yii::t('UsrModule.usr', 'Username or password recovery');
if (isset($this->breadcrumbs))
	$this->breadcrumbs=array($this->module->id, $title);
$this->pageTitle = Yii::app()->name.' - '.$title;
$labelSize = 4;
$controlSize = 8;

$this->beginClip('Footer');
    Yii::app()->sass->register(Yii::getPathOfAlias('webroot.scss') . '/profile.scss');
$this->endClip();
?>
<div class="row">
    <h2><?php echo $title; ?></h2>
    <hr style="margin-top: 0;">
</div>

<div class="row">
    <div class="col-xs-8 usr-alert">
        <?php $this->widget('usr.components.UsrAlerts', array('cssClassPrefix'=>'alert alert-warning ')); ?>
    </div>
</div>

<div class="row <?php echo $this->module->formCssClass; ?>">
<?php $form=$this->beginWidget($this->module->formClass, array(
    'id'=>'recovery-form',
    'enableClientValidation'=>false,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
    'htmlOptions' => array('class'=>'form-horizontal', 'role'=>'form'),
    'focus'=>array($model,$model->scenario==='reset' ? 'newPassword' : 'username'),
)); ?>

    <div class="col-xs-8">
        <div class="form-group">
            <div class="col-xs-12">
                <?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>
                <h5 class="text-right"><span class="label label-danger note"><?php echo Yii::t('UsrModule.usr', 'Fields marked with <span class="required">*</span> are required.'); ?></span></h5>
            </div>
        </div>

    <?php if ($model->scenario === 'reset'): ?>
        <?php echo $form->hiddenField($model,'username'); ?>
        <?php echo $form->hiddenField($model,'email'); ?>
        <?php echo $form->hiddenField($model,'activationKey'); ?>

        <?php $this->renderPartial('_newpassword', array('form'=>$form, 'model'=>$model, 'labelSize'=>$labelSize, 'controlSize'=>$controlSize)); ?>
    <?php else: ?>
        <div class="form-group<?php echo ($model->hasErrors('username')) ? ' has-error' : ''; ?>">
            <?php echo $form->labelEx($model,'username', array('class'=>sprintf('col-xs-%s control-label',$labelSize))); ?>
            <div class="col-xs-<?php echo $controlSize; ?>">
                <?php echo $form->textField($model,'username', array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'username', array('class'=>'text-danger')); ?>
            </div>
        </div>

        <div class="form-group<?php echo ($model->hasErrors('email')) ? ' has-error' : ''; ?>">
            <?php echo $form->labelEx($model,'email', array('class'=>sprintf('col-xs-%s control-label',$labelSize))); ?>
            <div class="col-xs-<?php echo $controlSize; ?>">
                <?php echo $form->textField($model,'email', array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'email', array('class'=>'text-danger')); ?>
            </div>
        </div>

        <?php if($model->asa('captcha') !== null): ?>
            <?php $this->renderPartial('_captcha', array('form'=>$form, 'model'=>$model, 'labelSize'=>$labelSize, 'controlSize'=>$controlSize)); ?>
        <?php endif; ?>

    <?php endif; ?>

        <div class="form-group">
            <div class="col-xs-12 text-right">
                <?php echo CHtml::submitButton(Yii::t('UsrModule.usr', 'Submit'), array('class'=>'btn btn-primary ' . $this->module->submitButtonCssClass)); ?>
            </div>
        </div>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->
