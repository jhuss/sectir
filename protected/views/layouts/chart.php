<?php
    /* @var $this Controller */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="language" content="es">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <?php Yii::app()->sass->register(Yii::getPathOfAlias('webroot.scss') . '/bootstrap.scss'); ?>
    <?php Yii::app()->sass->register(Yii::getPathOfAlias('webroot.scss') . '/main.scss'); ?>
    <?php
    if(isset($this->clips['Head'])) {
        echo $this->clips['Head'];
    }
    ?>
</head>

<body>
    <div class="container">
<?php if(constant('GOB_BANNER')): ?>
        <div class="row">
            <div class="col-xs-12 gob-banner"></div>
        </div>
<?php endif; ?>
<?php $this->renderPartial('//layouts/_usrbar', array('model'=>null)); ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="proj-title text-center">
                    <span>Sistema Estadístico en Ciencia, Tecnología e Innovación del Estado Trujillo</span>
                    <hr>
                </div>
            </div>
        </div>
        <div id="charts" class="row">
            <div class="col-xs-3"><?php
                $this->renderPartial('//layouts/_chart_menu', array(
                    'encId'=>$this->encId,
                    'actions'=>$this->actions
                )); ?></div>
            <div class="col-xs-9">
                <div class="row">
                    <div class="title-enc">
                        <h4 class="enc-te enc-<?php echo $this->encId; ?>"><?php
                        if ($this->encId == 1) {
                            echo "Encuesta de Universidades";
                        } elseif ($this->encId == 2) {
                            echo "Encuesta para laboratorios, centros y otros";
                        }
                        ?></h4>
                        <hr>
                    </div>
                </div>
                <?php echo $content; ?>
            </div>
        </div>
    </div>
<?php
    if(isset($this->clips['Footer'])) {
        echo $this->clips['Footer'];
    }
?>
</body>
</html>
