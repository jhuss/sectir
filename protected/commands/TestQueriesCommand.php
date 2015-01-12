<?php

/**
 * Class TestQueriesCommand
 * @author Me
 */
class TestQueriesCommand extends CConsoleCommand
{
    public function actionProyectosInn($id)
    {
        $encuesta = Encuesta::model()->findByPk($id);
        $inn = $encuesta->getProyectosInnovacion("opc.id");
        CVarDumper::dump($inn);
    }
    public function actionRevistasTest($id)
    {
        $encuesta = Encuesta::model()->findByPk($id);
        $inn = $encuesta->getPublicacionesRevista();
        CVarDumper::dump($inn);
    }
    public function actionOpcionTest($id)
    {
        $encuesta = Encuesta::model()->findByPk($id);
        $data = $encuesta->getEstadisticasPorOpcion(array(
            'preg_talentohumano_nivelac'
        ));
        CVarDumper::dump($data);
    }
    public function actionCheckboxTest($id)
    {
        $encuesta = Encuesta::model()->findByPk($id);
        $data = $encuesta->getEstadisticasPorCheckbox(array(
            'preg_talentohumano_nacionalpub', 
            'preg_talentohumano_nacionalpri', 
            'preg_talentohumano_internacional'
        ));
        CVarDumper::dump($data);
    }
    public function actionRespuestasAnoTest($id)
    {
        $encuesta = Encuesta::model()->findByPk($id);
        $data = $encuesta->getEstadisticasSumaRespuestaAno(array(
            'preg_proyectosaprob_num'
        ));
        CVarDumper::dump($data);
    }
}

