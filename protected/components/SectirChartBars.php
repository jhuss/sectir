<?php

class SectirChartBars extends SectirChart
{
    public $varName = "barchart";
    public $Mode = "vertical"; // horizontal

    public function run()
    {
        $this->opts = array_merge($this->def_opts, $this->opts);
        $this->render('SectirChart/bars',array('data'=>$this->data));
    }
}