<?php

/**
 * Class SectirPointChart
 * @author Me
 */
class SectirPointChart extends SectirXChart
{
    public $textMouseOver = "d3.time.format('%A')(d.x) + ': ' + d.y";
    public $varName = "pointchar";
    public function run()
    {
        $this->render('pointchart',array('data'=>$this->encodedData));
    }
}

