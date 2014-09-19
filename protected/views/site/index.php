<?php
    /* @var $this SiteController */

    $this->setPageTitle(Yii::app()->name . ': ' . Yii::app()->params['defaultTitle']);

    // ejemplo de "Clip" registrando angularjs
    $this->beginClip('Footer');
        $cs = Yii::app()->clientScript;
        $cs->coreScriptPosition=CClientScript::POS_END;

        $cs->registerCoreScript('angular');
        $cs->registerCoreScript('angular-ui-bootstrap');
    $this->endClip();
?>
<h1>Hello World</h1>