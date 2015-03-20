<?php

class SectirChartBars extends SectirChart
{
    public $varName = "barchart";
    public function run()
    {
        $this->render('SectirChart/bars',array('data'=>$this->data));
    }
}