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

$urlComienzo = Yii::app()->createAbsoluteUrl("respuesta/default/preguntas",array(
    'idTE' => $idTE
)); 

$urlPost = Yii::app()->createAbsoluteUrl("respuesta/default/postrespuesta");

//TODO Esto se hace por motivos de pruebas, el año debe venir de encuesta
$anoFinal = 2014;
$anoComienzo = $anoFinal - 12;

$objeto = CJSON::encode(array(
    'anoFinal' => $anoFinal,
    'anoComienzo' => $anoComienzo,
    'url' => $urlComienzo,
    'urlPost'=>$urlPost,
));




$script = <<<EOF
    console.log(sectirRApp);
    sectirRApp.config(["sectirRespuestaConfigProviderProvider", function(sectirRespuestaConfig){
    sectirRespuestaConfig.set($objeto); 
}]);
EOF;

Yii::app()->clientScript->registerScript("sectirRespuesta",$script,CClientScript::POS_END);
