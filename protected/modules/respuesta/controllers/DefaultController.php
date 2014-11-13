<?php

class DefaultController extends Controller
{
	public function actionIndex()
    {
        Yii::app()->clientScript->registerPackage("sectir-input");
		$this->render('index');
	}
}
