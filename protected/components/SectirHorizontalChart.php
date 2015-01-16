<?php
/**
 * Class SectirHorizontalChart
 * @author Me
 */
class SectirHorizontalChart extends CWidget
{
    public $chartId = "chart";
    public $scriptId = "sectirchart";
    public $valueLabelWidth = 100;
    public $barHeight = 40;
    public $barLabelWidth = 100;
    public $barLabelPadding = 5;
    public $gridLabelHeight = 18;
    public $gridChartOffset = 3;
    public $maxBarWidth = 580;
    public $barLabelFn = "function(d) {return d['x'];}";
    public $barValueFn = "function(d) {return d['y'];}";
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
    public function run()
    {
        $this->render("sectirhorizontal",array(
            'data' => $this->encodedData,
        ));
    }
}
