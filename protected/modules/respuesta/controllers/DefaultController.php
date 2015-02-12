<?php

class DefaultController extends Controller
{
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index','preguntas',
                "responderEncuesta",'postrespuesta',
                "exito"
            ),
                'users' => array('@')
            ),
            array('deny'),
        );
    }
    public function filters()
    {
        return array(
            'accessControl',
            array(
                'SectirEncuestaFilter + responderEncuesta, postrespuesta',
                'encuestaParam' => 'encuestaId',
            ),
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
        $urlRetorno = Yii::app()
            ->createAbsoluteUrl('/respuesta/default/exito');
        $anoFinal = $encuesta->ano;
        $anoComienzo = $encuesta->ano - Encuesta::ANOS_ENCUESTADOS;
        $this->render('responderencuesta',array(
            'idTE' => $encuesta->tipoencuesta_id,
            'urlPost' => $postRespuestaUrl,
            'urlComienzo' => $urlComienzo,
            'urlRetorno' => $urlRetorno,
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
        /* CVarDumper::dump($post); */
        /* CVarDumper::dump($errores); */

    }
    public function actionExito()
    {
        $this->render("exito");
    }
}
