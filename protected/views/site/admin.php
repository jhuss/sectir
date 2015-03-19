<?php
/* @var $this SiteController */

$this->setPageTitle(Yii::app()->name . ': ' . Yii::app()->params['defaultTitle']);
?>

<div class="container">
    <div id="sectir-site-titulo" class="row">
        <div class="col-md-12">
            <h2 class="text-center">Completar Encuesta:</h2>
        </div>
    </div>
    <div id="sectir-site-content" class="row">
        <div class="col-md-7 col-centered">
            <div class="row">
                <?php foreach ($encuestas as $c): ?>
                    <div class="col-md-6">
                        <?php echo CHtml::link($c['enunciado'],
                            array('/respuesta/default/responderencuesta','encuestaId' => $c['id']),
                            array('class' => 'btn-enc enc-te '.' enc-'.$c['tipoencuesta_id']));
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
