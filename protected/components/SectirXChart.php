<?php

/**
 * Class SectirChart
 * @author Me
 */
class SectirXChart extends SectirChart
{
    public function init()
    {
        parent::init();
        $cs = Yii::app()->clientScript;
        $cs->registerPackage("xcharts");
    }
}

