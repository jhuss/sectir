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
	public function actionIndex($idTE=1)
    {
        Yii::app()->clientScript->registerPackage("sectir-input");
        $this->render('index',array(
            'idTE' => $idTE,
        ));
    }
    public function actionPreguntas($idTE)
    {
        $enc = Tipoencuesta::model()->findByPk($idTE);
        echo CJSON::encode($enc->getPreguntasEncuesta());
    }
}
