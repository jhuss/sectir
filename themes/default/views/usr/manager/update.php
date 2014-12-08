<?php
/* @var $this ManagerController */
/* @var $profileForm ProfileForm */
/* @var $passwordForm PasswordForm */
/* @var $identity CUserIdentity */
/* @var $authManager CAuthManager */
$identity = $profileForm->getIdentity();
$authManager = Yii::app()->authManager;
$assignedRoles = $id === null ? array() : $authManager->getAuthItems(CAuthItem::TYPE_ROLE, $id);
$allRoles = $authManager->getAuthItems(CAuthItem::TYPE_ROLE);

$this->pageTitle = $id === null ? Yii::t('UsrModule.manager', 'Create user') : Yii::t('UsrModule.manager', 'Update user {id}', array('{id}' => $profileForm->username));

$this->menu=array(
	array('label'=>Yii::t('UsrModule.manager', 'List users'), 'url'=>array('index')),
);
if ($id !== null) {
	$this->menu[] = array('label'=>Yii::t('UsrModule.manager', 'Create user'), 'url'=>array('update'));
}


$this->beginClip('Footer');
    Yii::app()->sass->register(Yii::getPathOfAlias('webroot.scss') . '/profile.scss');

    if ($profileForm->getIdentity() instanceof IPictureIdentity && !empty($profileForm->pictureUploadRules)) {
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

$labelSize = 4;
$controlSize = 8;
?>
<div class="row">
    <h2><?php echo $this->pageTitle; ?></h2>
    <hr style="margin-top: 0;">
</div>

<div class="row">
    <div class="col-xs-10 usr-alert">
        <?php $this->widget('usr.components.UsrAlerts', array('cssClassPrefix'=>'alert alert-warning ')); ?>
    </div>
</div>

<div class="row <?php echo $this->module->formCssClass; ?>">
    <div class="col-xs-12">
<?php if ($id !== null): ?>
        <div class="col-xs-10">
<?php $this->widget($this->module->detailViewClass, array(
	'data' => $identity,
	'attributes' => array(
		array(
			'name' => 'createdOn',
			'type' => 'datetime',
			'label' => Yii::t('UsrModule.manager','Created On'),
			'value' => $identity->getTimestamps("createdOn"),
		),
		array(
			'name' => 'updatedOn',
			'type' => 'datetime',
			'label' => Yii::t('UsrModule.manager','Updated On'),
			'value' => $identity->getTimestamps("updatedOn"),
		),
		array(
			'name' => 'lastVisitOn',
			'type' => 'datetime',
			'label' => Yii::t('UsrModule.manager','Last Visit On'),
			'value' => $identity->getTimestamps("lastVisitOn"),
		),
		array(
			'name' => 'passwordSetOn',
			'type' => 'datetime',
			'label' => Yii::t('UsrModule.manager','Password Set On'),
			'value' => $identity->getTimestamps("passwordSetOn"),
		),
		array(
			'name'=>'emailVerified',
			'type'=>'raw',
			'label'=>Yii::t('UsrModule.manager', 'Email Verified'),
			'value'=>CHtml::link($identity->isVerified() ? Yii::t("UsrModule.manager", "Yes") : Yii::t("UsrModule.manager", "No"), array("verify", "id"=>$identity->id), array("class"=>"actionButton", "title"=>Yii::t("UsrModule.manager", "Toggle"))),
		),
		array(
			'name'=>'isActive',
			'type'=>'raw',
			'label'=>Yii::t('UsrModule.manager', 'Is Active'),
			'value'=>CHtml::link($identity->isActive() ? Yii::t("UsrModule.manager", "Yes") : Yii::t("UsrModule.manager", "No"), array("activate", "id"=>$identity->id), array("class"=>"actionButton", "title"=>Yii::t("UsrModule.manager", "Toggle"))),
		),
		array(
			'name'=>'isDisabled',
			'type'=>'raw',
			'label'=>Yii::t('UsrModule.manager', 'Is Disabled'),
			'value'=>CHtml::link($identity->isDisabled() ? Yii::t("UsrModule.manager", "Yes") : Yii::t("UsrModule.manager", "No"), array("disable", "id"=>$identity->id), array("class"=>"actionButton", "title"=>Yii::t("UsrModule.manager", "Toggle"))),
		),
	),
)); ?>
            <br>
        </div>
<?php endif; ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('class'=>'form-horizontal', 'role'=>'form', 'enctype' => 'multipart/form-data'),
	'focus'=>array($profileForm,'username'),
)); ?>

    <div class="form-group">
        <div class="col-xs-10">
            <div class="usr-err">
            <?php echo $form->errorSummary($profileForm, null, null, array('class'=>'alert alert-danger')); ?>
            <h5 class="text-right"><span class="label label-danger note"><?php echo Yii::t('UsrModule.manager', 'Fields with {asterisk} are required.', array('{asterisk}'=>'<span class="required">*</span>')); ?></span></h5>
            </div>
        </div>
    </div>

    <?php $this->renderPartial('/default/_form', array('form'=>$form, 'model'=>$profileForm, 'passwordForm'=>$passwordForm, 'labelSize'=>$labelSize, 'controlSize'=>$controlSize)); ?>

    <?php if (Yii::app()->user->checkAccess('usr.update.auth') && !empty($allRoles)): ?>
        <div class="form-group">
            <?php echo CHtml::label(Yii::t('UsrModule.manager', 'Authorization roles'), 'roles'); ?>
            <?php echo CHtml::checkBoxList('roles', array_keys($assignedRoles), CHtml::listData($allRoles, 'name', 'description'), array('template'=>'{beginLabel}{input}{labelTitle}{endLabel}')); ?>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <div class="col-xs-10 text-right">
        <?php echo CHtml::submitButton($id === null ? Yii::t('UsrModule.manager', 'Create') : Yii::t('UsrModule.manager', 'Save'), array('id'=>'profile-save', 'class'=>'btn btn-primary ' . $this->module->submitButtonCssClass)); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>
    </div>
</div><!-- form -->
