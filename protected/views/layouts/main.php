<?php
    /* @var $this Controller */
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="es">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <?php Yii::app()->sass->register(Yii::getPathOfAlias('webroot.scss') . '/main.scss'); ?>
</head>

<body>
    <?php echo $content; ?>
</body>
</html>
