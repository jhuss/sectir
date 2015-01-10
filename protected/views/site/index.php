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

<div class="container">
	<div id="sectir-site-titulo" class="row">
		<div class="col-md-12">Encuestas</div>
	</div>
    <div id="sectir-site-content">
        <?php foreach ($encuestas as $c): ?>
            <div class="row">
                    <div class="row col-md-4 col-md-offset-4">
                        <?php echo CHtml::link($c['enunciado'],
                            array('/respuesta/default/responderencuesta','encuestaId' => $c['id']),
                        array('class' => 'btn btn-primary'));
?>                  </div>
            </div>
        <?php endforeach; ?> 
	</div>
</div>
