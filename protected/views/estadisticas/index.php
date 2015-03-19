<?php
    /* @var $this SiteController */

    $this->setPageTitle(Yii::app()->name . ': ' . Yii::app()->params['defaultTitle']);
?>

<div class="container">
    <div id="sectir-site-titulo" class="row">
        <div class="col-md-12">
            <h2 class="text-center">Estadísticas</h2>
        </div>
    </div>
    <div id="sectir-site-content" class="row">
        <div class="col-md-7 col-centered">
            <div class="row">
                <?php if (is_null($enc)): ?>
                    <a href="<?php echo $this->createUrl("$this->uniqueId/index/id/1") ?>">Univ</a>
                    <a href="<?php echo $this->createUrl("$this->uniqueId/index/id/2") ?>">Laboratorios</a>
                <? else: ?>
                <ul>
                <?php foreach ($actions as $a): ?>
                <?php
                    $name = $a['name'];
                    $title = $a['title'];
                ?>
                    <li><a href="<?php echo $this->createUrl("$this->uniqueId/$name/id/$enc") ?>"><?php echo $title; ?></a></li>
                <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
