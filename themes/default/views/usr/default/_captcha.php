            <div class="form-group<?php echo ($model->hasErrors('verifyCode')) ? ' has-error' : ''; ?>">
                <?php echo $form->labelEx($model,'verifyCode', array('class'=>sprintf('col-xs-%s control-label',$labelSize))); ?>
                <div class="col-xs-<?php echo $controlSize; ?>">
                    <?php $this->widget('CCaptcha', $this->module->captcha === true ? array() : $this->module->captcha); ?><br/>
                    <?php echo $form->textField($model,'verifyCode', array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'verifyCode', array('class'=>'text-danger')); ?>
                    <div class="hint">
                        <?php echo Yii::t('UsrModule.usr', 'Please enter the letters as they are shown in the image above.'); ?><br/>
                        <?php echo Yii::t('UsrModule.usr', 'Letters are not case-sensitive.'); ?>
                    </div>
                </div>
            </div>