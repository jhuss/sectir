<?php

class DefaultController extends Controller
{
    public function accessRules()
    {
        return array('allow',
            'actions' => array('index','preguntas'),
            'users' => array('@')
        );
    }
	public function actionIndex()
    {
        Yii::app()->clientScript->registerPackage("sectir-input");
		$this->render('index');
    }
    public function actionPreguntas($idTE)
    {
        $enc = Tipoencuesta::model()->findByPk($idTE);
        echo CJSON::encode($enc->getPreguntasEncuesta());
    }
}
