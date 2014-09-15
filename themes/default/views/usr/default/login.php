<?php /*
@var $this DefaultController
@var $model LoginForm */

$title = Yii::t('UsrModule.usr', 'Log in');
$this->pageTitle = Yii::app()->name . ' - ' . $title;
?>
    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-5 col-centered">
            <div class="row">
                <div class="proj-title text-center">
                    <span>Sistema Estadístico en Ciencia, Tecnología e Innovación del Estado Trujillo</span>
                    <hr>
                </div>
                <h2 class="text-center"><?php echo $title; ?></h2>

                <?php $this->widget('usr.components.UsrAlerts', array('cssClassPrefix' => $this->module->alertCssClassPrefix)); ?>

                <div class="<?php echo $this->module->formCssClass; ?>">

                <?php $form = $this->beginWidget($this->module->formClass, array(
                    'id' => 'login-form',
                    'enableClientValidation' => false,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                    'htmlOptions' => array(
                        'role' => 'form',
                    ),
                    'focus' => array($model, 'username'),
                )); ?>

                    <p class="note"><?php echo Yii::t('UsrModule.usr', 'Fields marked with <span class="required">*</span> are required.'); ?></p>

                    <?php echo $form->errorSummary($model, null, null, array('class'=>'error-summary bg-danger')); ?>

                    <div class="username form-group">
                        <?php echo $form->textField($model, 'username', array('class'=>'form-control', 'placeholder'=>$model->getAttributeLabel('username'))); ?>
                        <?php echo $form->error($model, 'username', array('class'=>'text-danger')); ?>
                    </div>

                    <div class="password form-group">
                        <?php echo $form->passwordField($model, 'password', array('class'=>'form-control', 'placeholder'=>$model->getAttributeLabel('password'))); ?>
                        <?php echo $form->error($model, 'password', array('class'=>'text-danger')); ?>
                    </div>

                    <?php if ($this->module->rememberMeDuration > 0): ?>
                        <div class="rememberMe form-group">
                                <div class="checkbox">
                                    <?php echo $form->label($model, 'rememberMe', array('label' => $form->checkBox($model, 'rememberMe') . $model->getAttributeLabel('rememberMe'))); ?>
                                </div>
                                <?php echo $form->error($model, 'rememberMe'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="text-right buttons form-group">
                            <?php echo CHtml::submitButton(Yii::t('UsrModule.usr', 'Log in'), array('class' => $this->module->submitButtonCssClass . ' btn btn-primary')); ?>
                    </div>

                <?php $this->endWidget(); ?>
                </div>
        <!-- form -->
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <?php if ($this->module->recoveryEnabled): ?>
                        <p>
                            <?php echo Yii::t('UsrModule.usr', 'Don\'t remember username or password?'); ?>
                            <?php echo Yii::t('UsrModule.usr', 'Go to {link}.', array(
                                '{link}' => CHtml::link(Yii::t('UsrModule.usr', 'password recovery'), array('recovery')),
                            )); ?>
                        </p>
                    <?php endif; ?>
                    <?php if ($this->module->registrationEnabled): ?>
                        <p>
                            <?php echo Yii::t('UsrModule.usr', 'Don\'t have an account yet?'); ?>
                            <?php echo Yii::t('UsrModule.usr', 'Go to {link}.', array(
                                '{link}' => CHtml::link(Yii::t('UsrModule.usr', 'registration'), array('register')),
                            )); ?>
                        </p>
                    <?php endif; ?>
                    <?php if ($this->module->hybridauthEnabled()): ?>
                        <p>
                            <?php //echo CHtml::link(Yii::t('UsrModule.usr', 'Sign in using one of your social sites account.'), array('hybridauth/login')); ?>
                            <?php $this->renderPartial('_login_remote'); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

<?php
$this->beginClip('Footer');

Yii::app()->sass->register(Yii::getPathOfAlias('webroot.scss') . '/login.scss');

$cs = Yii::app()->clientScript;
$cs->coreScriptPosition = CClientScript::POS_END;
$cs->registerScriptFile(Yii::app()->baseUrl . '/bootstrap/javascripts/bootstrap.js', CClientScript::POS_END);

$this->endClip();
?>