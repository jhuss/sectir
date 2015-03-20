<?php

class SectirChart extends CWidget
{
    public $chartId = "chart";
    public $scriptId = "sectirchart";
    public $Width = "500";
    public $Height = "400";
    public $fillColor = "rgba(151,187,205,0.5)";
    public $strokeColor = "rgba(151,187,205,0.8)";
    public $highlightFill = "rgba(151,187,205,0.75)";
    public $highlightStroke = "rgba(151,187,205,1)";

    public $data;
    public $def_opts = array(
        'scaleLabel' => "<%=value%>",
        'responsive' => true
    );
    public $opts = array();

    public function init()
    {
        parent::init();
        $cs = Yii::app()->clientScript;
        $cs->registerPackage("jquery", CClientScript::POS_HEAD);
        $cs->registerPackage("chartjs", CClientScript::POS_HEAD);
        $cs->registerPackage("chartjs.horizontal", CClientScript::POS_HEAD);
    }
}
