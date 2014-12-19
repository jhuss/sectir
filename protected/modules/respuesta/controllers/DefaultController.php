<?php

class DefaultController extends Controller
{
    public function accessRules()
    {
        return array('allow',
            'actions' => array('index','preguntas','postrespuesta'),
            'users' => array('@')
        );
    }
    public function filters()
    {
        return array(
            //'ajaxOnly + postrespuesta'
        );
    }
	public function actionResponderencuesta($encuestaId)
    {
        Yii::app()->clientScript->registerPackage("sectir-input");
        $encuesta = Encuesta::model()->findByPk($encuestaId);
        $postRespuestaUrl = Yii::app()
            ->createAbsoluteUrl("/respuesta/default/postrespuesta",array(
                'encuestaId' => $encuestaId,
            ));
        $urlComienzo = Yii::app()->createAbsoluteUrl("/respuesta/default/preguntas",array(
            'idTE' => $encuesta->tipoencuesta_id
        )); 
        $anoFinal = $encuesta->ano;
        $anoComienzo = $encuesta->ano - Encuesta::ANOS_ENCUESTADOS;
        $this->render('responderencuesta',array(
            'idTE' => $encuesta->tipoencuesta_id,
            'urlPost' => $postRespuestaUrl,
            'urlComienzo' => $urlComienzo,
            'anoFinal' => $anoFinal,
            'anoComienzo' => $anoComienzo,
        ));
    }
    public function actionPreguntas($idTE)
    {
        $enc = Tipoencuesta::model()->findByPk($idTE);
        echo CJSON::encode($enc->getPreguntasEncuesta());
    }

    public function actionPostrespuesta($encuestaId)
    {
        $encuesta = Encuesta::model()->findByPk($encuestaId);
        $post = CJSON::decode(file_get_contents("php://input"));
        $encuesta->obtenerRespuestasEncuesta($post);
        $errores = $encuesta->validarColaPreguntas();
        $encuesta->insertarDatos();
        CVarDumper::dump($post);
        CVarDumper::dump($errores);

    }
}
