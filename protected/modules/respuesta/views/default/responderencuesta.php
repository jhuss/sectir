<?php
    /* @var $this DefaultController */

    $this->breadcrumbs=array(
        $this->module->id,
    );

    Yii::app()->sass->register(Yii::getPathOfAlias('webroot.scss') . '/forms.scss');
    $this->beginClip('Footer');
        $cs = Yii::app()->clientScript;
        $cs->coreScriptPosition=CClientScript::POS_END;

        $cs->registerPackage("sectir-input");
    $this->endClip();
?>
<div id="fill-enc">
    <div class="row">
        <div class="title-enc">
            <h4 class="enc-te enc-<?php echo $idTE; ?>"><?php echo $nameTE; ?></h4>
            <hr>
        </div>
        <div class="col-md-12">
            <div ng-app="sectirRespuestaApp">
                <div sectir-app>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

$objeto = CJSON::encode(array(
    'anoFinal' => $anoFinal,
    'anoComienzo' => $anoComienzo,
    'url' => $urlComienzo,
    'urlPost'=>$urlPost,
    'urlRetorno'=>$urlRetorno,
));

$script = <<<EOF
    console.log(sectirRApp);
    sectirRApp.config(["sectirRespuestaConfigProviderProvider", "\$compileProvider",
    function (sectirRespuestaConfig, \$compileProvider) {
        sectirRespuestaConfig.set($objeto);

        \$compileProvider.directive('sectirTableModule.table', {scope: {addlabel:'+'}});
    }]);
EOF;

Yii::app()->clientScript->registerScript("sectirRespuesta",$script,CClientScript::POS_END);
