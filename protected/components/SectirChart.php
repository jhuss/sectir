<?php

/**
 * Class SectirChart
 * @author Me
 */
class SectirChart extends CWidget
{
    public $chartId = "chart";
    public $scriptId = "sectirchart";
    public $data;
    protected $encodedData;
    public function init()
    {
        parent::init();
        $cs = Yii::app()->clientScript;
        $cs->registerPackage("d3");
        $cs->registerPackage("jquery");
        $this->encodedData = CJSON::encode($this->data);
    }
}

