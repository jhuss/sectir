<?php /*
@var $this CController
@var $model ProfileForm
@var $passwordForm PasswordForm
 */
?>
<div class="form-group">
<div class="col-xs-10">
    <?php if ($model->getIdentity() instanceof IPictureIdentity && !empty($model->pictureUploadRules)): ?>
    <div class="col-xs-4 profile-avatar-form">
        <?php
            $picture = $model->getIdentity()->getPictureUrl(120,120);
            if ($picture !== null) {
                $url = $picture['url'];
                unset($picture['url']);
            }
        ?>
        <div>
            <div><?php echo $form->labelEx($model,'picture'); ?></div>
            <?php echo $picture === null ? '' : CHtml::image($url, Yii::t('UsrModule.usr', 'Profile picture'), $picture); ?><br/>
            <?php echo $form->fileField($model,'picture',array('class'=>'btn btn-default btn-xs')); ?>
            <?php echo $form->error($model,'picture', array('class'=>'text-danger')); ?>
        </div>
        <div class="checkbox">
            <?php echo $form->label($model,'removePicture', array('label'=>$form->checkBox($model,'removePicture').$model->getAttributeLabel('removePicture'))); ?>
            <?php echo $form->error($model,'removePicture', array('class'=>'text-danger')); ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="col-xs-8 profile-form">
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

    <?php if ($model->scenario !== 'register'): ?>
        <div class="form-group<?php echo ($model->hasErrors('password')) ? ' has-error' : ''; ?>">
            <?php echo $form->labelEx($model,'password', array('class'=>sprintf('col-xs-%s control-label',$labelSize))); ?>
            <div class="col-xs-<?php echo $controlSize; ?>">
                <?php echo $form->passwordField($model,'password', array('class'=>'form-control', 'autocomplete'=>'off')); ?>
                <?php echo $form->error($model,'password', array('class'=>'text-danger')); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($passwordForm) && $passwordForm !== null): ?>
    <?php $this->renderPartial('/default/_newpassword', array('form'=>$form, 'model'=>$passwordForm, 'labelSize'=>$labelSize, 'controlSize'=>$controlSize)); ?>
    <?php endif; ?>

        <div class="form-group<?php echo ($model->hasErrors('firstName')) ? ' has-error' : ''; ?>">
            <?php echo $form->labelEx($model,'firstName', array('class'=>sprintf('col-xs-%s control-label',$labelSize))); ?>
            <div class="col-xs-<?php echo $controlSize; ?>">
                <?php echo $form->textField($model,'firstName', array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'firstName', array('class'=>'text-danger')); ?>
            </div>
        </div>

        <div class="form-group<?php echo ($model->hasErrors('lastName')) ? ' has-error' : ''; ?>">
            <?php echo $form->labelEx($model,'lastName', array('class'=>sprintf('col-xs-%s control-label',$labelSize))); ?>
            <div class="col-xs-<?php echo $controlSize; ?>">
                <?php echo $form->textField($model,'lastName', array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'lastName', array('class'=>'text-danger')); ?>
            </div>
        </div>
    </div>
</div>
</div>