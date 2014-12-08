<?php /*
@var $this DefaultController
@var $model ProfileForm */

$title = Yii::t('UsrModule.usr', 'User profile');
if (isset($this->breadcrumbs)) {
	$this->breadcrumbs=array($this->module->id, $title);
}
$this->pageTitle = Yii::app()->name.' - '.$title;

?>
<div class="row">
    <h2><?php echo $title . CHtml::link(Yii::t('UsrModule.usr', 'update'), array('profile', 'update'=>true), array('class'=>'btn btn-primary update')); ?></h2>
    <hr style="margin-top: 0;">
</div>

<div class="row">
    <div class="col-xs-12 usr-alert">
        <?php $this->widget('usr.components.UsrAlerts', array('cssClassPrefix'=>'alert alert-success ')) ?>
    </div>
</div>

<?php
$attributes = array('username', 'email', 'firstName', 'lastName');
if ($this->module->oneTimePasswordMode === UsrModule::OTP_TIME || $this->module->oneTimePasswordMode === UsrModule::OTP_COUNTER) {
	$attributes[] = array(
		'name'=>'twoStepAuth',
		'type'=>'raw',
		'label'=>Yii::t('UsrModule.usr', 'Two step authentication'),
		'value'=>$model->getIdentity()->getOneTimePasswordSecret() === null ? CHtml::link(Yii::t('UsrModule.usr', 'Enable'), array('toggleOneTimePassword')) : CHtml::link(Yii::t('UsrModule.usr', 'Disable'), array('toggleOneTimePassword')),
	);
}
if ($model->getIdentity() instanceof IPictureIdentity) {
	$picture = $model->getIdentity()->getPictureUrl(120,120);
	/*$url = $picture['url'];
	unset($picture['url']);
	array_unshift($attributes, array(
		'name'=>'picture',
		'type'=>'raw',
		'label'=>Yii::t('UsrModule.usr', 'Profile picture'),
		'value'=>CHtml::image($url, Yii::t('UsrModule.usr', 'Profile picture'), $picture),
	));*/
}
//$this->widget($this->module->detailViewClass, array('data' => $model, 'attributes' => $attributes));
?>
<div class="row">
    <div class="col-xs-2 profile-avatar">
        <?php echo CHtml::image($picture['url'], Yii::t('UsrModule.usr', 'Profile picture'), array('height' => $picture['height'], 'width' => $picture['width'])); ?>
    </div>
    <div class="col-xs-10 profile">
        <div class="row block">
            <div class="col-xs-3 attr">Nombre: </div>
            <div class="col-xs-9"><?php echo $model->firstName; ?></div>
        </div>
        <div class="row block">
            <div class="col-xs-3 attr">Apellido: </div>
            <div class="col-xs-9"><?php echo $model->lastName; ?></div>
        </div>
        <div class="row block">
            <div class="col-xs-3 attr">Usuario: </div>
            <div class="col-xs-9"><?php echo $model->username; ?></div>
        </div>
        <div class="row block">
            <div class="col-xs-3 attr">Correo Electrónico: </div>
            <div class="col-xs-9"><?php echo $model->email; ?></div>
        </div>
    </div>
</div>
<?php
if ($this->module->hybridauthEnabled()) {
    echo '<p>';
    $this->renderPartial('_login_remote', array('model'=>$model));
    echo '</p>';
}

$this->beginClip('Footer');

    Yii::app()->sass->register(Yii::getPathOfAlias('webroot.scss') . '/profile.scss');

$this->endClip();
