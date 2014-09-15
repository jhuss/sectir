<?php
    /* @var $this SiteController */

    // ejemplo de "Clip" registrando angularjs
    $this->beginClip('Footer');
        $cs = Yii::app()->clientScript;
        $cs->coreScriptPosition=CClientScript::POS_END;

        $cs->registerCoreScript('angular');
        $cs->registerCoreScript('angular-ui-bootstrap');
    $this->endClip();
?>
<h1>Hello World</h1>
