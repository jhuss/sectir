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
<?php echo $content; ?>
    </div>
<?php
    if(isset($this->clips['Footer'])) {
        echo $this->clips['Footer'];
    }
?>
</body>
</html>
