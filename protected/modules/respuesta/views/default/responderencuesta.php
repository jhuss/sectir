<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<div ng-app="sectirRespuestaApp">
        <div sectir-app>
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
    sectirRApp.config(["sectirRespuestaConfigProviderProvider", function(sectirRespuestaConfig){
    sectirRespuestaConfig.set($objeto); 
}]);
EOF;

Yii::app()->clientScript->registerScript("sectirRespuesta",$script,CClientScript::POS_END);
