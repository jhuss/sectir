<?php
    if(!Yii::app()->user->isGuest):

    $this->beginClip('Footer');
        $cs = Yii::app()->clientScript;
        $cs->coreScriptPosition = CClientScript::POS_END;
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile(Yii::app()->baseUrl . '/bootstrap/javascripts/bootstrap.js', CClientScript::POS_END);
    $this->endClip();

    $module = Yii::app()->getModule('usr');
    $model = $module->createFormModel('ProfileForm');
    $model->detachBehavior('captcha');
    $identity = $model->getIdentity(Yii::app()->user->id);
    $model->setIdentity($identity);
    //FB::info($model->getIdentity(Yii::app()->user->id)->getPictureUrl(16,16), 'application.views.layouts');

    if ($model->getIdentity() instanceof IPictureIdentity) {
        $picture = $model->getIdentity(Yii::app()->user->id)->getPictureUrl(80,80);
    }

    $home = CHtml::image(Html::imageUrl('icons/home.png'));
    $avatar = CHtml::image($picture['url'], Yii::t('UsrModule.usr', 'Profile picture'), array('height' => 16, 'width' => 16));
    $salir = CHtml::image(Html::imageUrl('icons/door_out.png'), 'salir', array('height' => 16, 'width' => 16));
?>
<div class="row usr-bar">
    <div class="col-xs-10 bar">
        <ul class="nav nav-pills">
            <li class="item"><?php echo CHtml::link($home . CHtml::tag('span', array('class'=>'nav-title'), 'Inicio', true), $this->createUrl('/'), array('class'=>'home')); ?></li>
            <li class="item dropdown">
                <?php echo CHtml::link($avatar . CHtml::tag('span', array('class'=>'nav-title'), $model->firstName . ' ' . $model->lastName, true) . CHtml::tag('span', array('class'=>'caret'), '', true), '#', array('class'=>'avatar dropdown-toggle', 'data-toggle'=>'dropdown')); ?>
                <ul class="dropdown-menu" role="menu">
                    <li><?php echo CHtml::link('Ver Perfil', array('/usr/profile')); ?></li>
                    <li><?php echo CHtml::link('Actualizar Perfil', array('/usr/profile', 'update'=>true)); ?></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="col-xs-2 exit">
        <ul class="nav nav-pills pull-right">
            <li class="item"><?php echo CHtml::link($salir . CHtml::tag('span', array('class'=>'nav-title'), 'Salir', true), $this->createUrl('/usr/logout')); ?></li>
        </ul>
    </div>
</div>
<?php endif; ?>