<?php /*
@var $this DefaultController
@var $model ProfileForm
@var $passwordForm PasswordForm
 */

$title = $model->scenario == 'register' ? Yii::t('UsrModule.usr', 'Registration') : Yii::t('UsrModule.usr', 'User profile');
if (isset($this->breadcrumbs))
	$this->breadcrumbs=array($this->module->id, $title);
$this->pageTitle = Yii::app()->name.' - '.$title;
$labelSize = 4;
$controlSize = 8;


$this->beginClip('Footer');
    Yii::app()->sass->register(Yii::getPathOfAlias('webroot.scss') . '/profile.scss');

    if ($model->getIdentity() instanceof IPictureIdentity && !empty($model->pictureUploadRules)) {
        $cs = Yii::app()->clientScript;
        $cs->registerCssFile(Html::cssUrl('fileinput.min.css'));
        $cs->registerScriptFile(Html::jsUrl('fileinput.min.js'), CClientScript::POS_END);
        $cs->registerScript('fileInput', "$('#ProfileForm_picture').fileinput({
            browseClass: 'btn btn-primary',
            showCaption: false,
            showRemove: false,
            showUpload: false,
            browseLabel: 'Buscar imagen',
            browseIcon: ''
        });", CClientScript::POS_READY);
    }
$this->endClip();
?>
<div class="row">
    <h2><?php echo $title; ?></h2>
    <hr style="margin-top: 0;">
</div>

<div class="row">
    <div class="col-xs-7 col-xs-offset-3 usr-alert">
        <?php $this->widget('usr.components.UsrAlerts', array('cssClassPrefix'=>'alert alert-danger ')); ?>
    </div>
</div>

<div class="row <?php echo $this->module->formCssClass; ?>">
<?php $form=$this->beginWidget($this->module->formClass, array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('class'=>'form-horizontal', 'enctype' => 'multipart/form-data', 'role'=>'form'),
	'focus'=>array($model,'username'),
)); ?>

    <div class="form-group">
        <div class="col-xs-10">
            <div class="usr-err">
                <?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>
                <h5 class="text-right"><span class="label label-danger note"><?php echo Yii::t('UsrModule.usr', 'Fields marked with <span class="required">*</span> are required.'); ?></span></h5>
            </div>
        </div>
    </div>

<?php $this->renderPartial('_form', array('form'=>$form, 'model'=>$model, 'passwordForm'=>$passwordForm, 'labelSize'=>$labelSize, 'controlSize'=>$controlSize)); ?>

<?php if(Yii::app()->user->isGuest): ?>
    <div class="form-group">
    <div class="col-xs-10">
        <div class="col-xs-4"></div>
        <div class="col-xs-8">
        <?php if($model->asa('captcha') !== null): ?>
            <?php $this->renderPartial('_captcha', array('form'=>$form, 'model'=>$model, 'labelSize'=>$labelSize, 'controlSize'=>$controlSize)); ?>
        <?php endif; ?>
        </div>
    </div>
    </div>
<?php endif; ?>

	<div class="form-group">
        <div class="col-xs-7 col-xs-offset-3 text-right">
		    <?php echo CHtml::submitButton(Yii::t('UsrModule.usr', 'Submit'), array('id'=>'profile-save', 'class'=>'btn btn-primary ' . $this->module->submitButtonCssClass)); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
