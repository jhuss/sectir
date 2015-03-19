<?php
    /* @var $this SiteController */

    $this->setPageTitle(Yii::app()->name . ': ' . Yii::app()->params['defaultTitle']);
?>

<?php if(is_null($this->encId)): ?>
<div id="sectir-site-titulo" class="row">
    <div class="col-xs-12">
        <div class="proj-title text-center">
            <span>Sistema Estadístico en Ciencia, Tecnología e Innovación del Estado Trujillo</span>
            <hr>
        </div>
    </div>
</div>
<div id="sectir-site-content" class="row">
    <div class="col-xs-7 col-centered">
        <div class="row">
            <div class="col-md-6">
                <?php echo CHtml::link('Univ',
                    $this->createUrl("$this->uniqueId/index/id/1"),
                    array('class' => 'btn-enc enc-te enc-1'));
                ?>
            </div>
            <div class="col-md-6">
                <?php echo CHtml::link('Laboratorios',
                    $this->createUrl("$this->uniqueId/index/id/2"),
                    array('class' => 'btn-enc enc-te enc-2'));
                ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>