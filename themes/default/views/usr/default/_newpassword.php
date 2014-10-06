	<div class="form-group<?php echo ($model->hasErrors('newPassword')) ? ' has-error' : ''; ?>">
		<?php echo $form->labelEx($model,'newPassword', array('class'=>sprintf('col-xs-%s control-label',$labelSize))); ?>
        <div class="col-xs-<?php echo $controlSize; ?>">
		<?php echo $form->passwordField($model,'newPassword', array('class'=>'form-control', 'autocomplete'=>'off')); ?>
		<?php echo $form->error($model,'newPassword', array('class'=>'text-danger')); ?>
<?php if ($this->module->dicewareEnabled): ?>
		<span><a id="Users_generatePassword" href="#"><?php echo Yii::t('UsrModule.usr', 'Generate a password'); ?></a></span>
<?php
$diceUrl = $this->createUrl('password');
$diceLabel = Yii::t('UsrModule.usr', 'Use this password?\nTo copy it to the clipboard press Ctrl+C.');
$passwordId = CHtml::activeId($model, 'newPassword');
$verifyId = CHtml::activeId($model, 'newVerify');
$script = <<<JavaScript
$('#Users_generatePassword').on('click',function(){
	$.getJSON('{$diceUrl}', function(data){
		var text = window.prompt("{$diceLabel}", data);
		if (text != null) {
			$('#{$passwordId}').val(text);
			$('#{$verifyId}').val(text);
        }
	});
	return false;
});
JavaScript;
Yii::app()->getClientScript()->registerScript(__CLASS__.'#diceware', $script);
?>
<?php endif; ?>
        </div>
	</div>

	<div class="form-group<?php echo ($model->hasErrors('newVerify')) ? ' has-error' : ''; ?>">
		<?php echo $form->labelEx($model,'newVerify', array('class'=>sprintf('col-xs-%s control-label',$labelSize))); ?>
        <div class="col-xs-<?php echo $controlSize; ?>">
            <?php echo $form->passwordField($model,'newVerify', array('class'=>'form-control', 'autocomplete'=>'off')); ?>
            <?php echo $form->error($model,'newVerify', array('class'=>'text-danger')); ?>
        </div>
	</div>
