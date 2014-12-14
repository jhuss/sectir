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

$url = addslashes(Yii::app()->createAbsoluteUrl("respuesta/default/preguntas",array(
    'idTE' => $idTE
))); 

$script = <<<EOF
    console.log(sectirRApp);
    sectirRApp.config(["sectirRespuestaConfigProviderProvider", function(sectirRespuestaConfig){
    sectirRespuestaConfig.set("$url");
}]);
EOF;

Yii::app()->clientScript->registerScript("sectirRespuesta",$script,CClientScript::POS_END);
