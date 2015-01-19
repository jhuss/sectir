<?php

class EstadisticasController extends Controller
{
    public $encuesta = null;
    protected function agruparDatos($datos,$x,$y)
    {
        $retVal = array();
        foreach ($datos as $d) {
            $retVal[] = array(
                "x" => $d[$x],
                "y" => $d[$y],
            );
        }
        return $retVal;
    }
    protected function loadEncuesta($id)
    {
        $this->encuesta = Encuesta::model()
            ->findByPk($id);
        if ($this->encuesta === null) {
            throw new CHttpException(404,"No existe encuesta");
        }
    }
	public function actionGastosactividades($id)
    {
        $this->loadEncuesta($id);
        $proyectosaprob = $this->encuesta->getEstadisticasSumaRespuestaAno(array(
            'preg_recursosaprob_num'
        ),"o.id");
        $proyectosaprobArea = $this->encuesta->getEstadisticasSumaRespuestaAno(array(
            'preg_recursosaprob_area_num'
        ),"o.id");
        if ($proyectosaprob) {
            $proyectosaprob = $this->agruparDatos($proyectosaprob,"enunciado_comp","suma");
        }
        if ($proyectosaprobArea) {
            $proyectosaprobArea = $this->agruparDatos($proyectosaprobArea,"enunciado_comp","suma");
        }
        $this->render('gastosactividades',array(
            "proyectosaprob" => $proyectosaprob,
            "proyectosaprobArea" => $proyectosaprobArea,
        ));
	}

	public function actionInfraestructura()
	{
		$this->render('infraestructura');
	}

	public function actionProblematicas($id)
    {
        $this->loadEncuesta($id);
        $datos = $this->encuesta->getEstadisticasPorCheckbox(array(
            'preg_problematica_sino'
        ),"","<>");
        $datos = $this->agruparDatos($datos,"enunciado","cuenta");
		$this->render('problematicas',array("datos"=>$datos));
	}

	public function actionProductostecnologicos()
	{
		$this->render('productostecnologicos');
	}

	public function actionProyectosinvestigacion($id)
	{
        $this->loadEncuesta($id);
        $proyectosaprob = $this->encuesta->getEstadisticasSumaRespuestaAno(array(
            'preg_proyectosaprob_num'
        ),"o.id");
        $proyectosaprobArea = $this->encuesta->getEstadisticasSumaRespuestaAno(array(
            'preg_proyectosaprob_area_num'
        ),"o.id");
        if ($proyectosaprob) {
            $proyectosaprob = $this->agruparDatos($proyectosaprob,"enunciado_comp","suma");
        }
        if ($proyectosaprobArea) {
            $proyectosaprobArea = $this->agruparDatos($proyectosaprobArea,"enunciado_comp","suma");
        }
        $this->render('proyectosinvestigacion',array(
            "proyectosaprob" => $proyectosaprob,
            "proyectosaprobArea" => $proyectosaprobArea,
        ));
	}

	public function actionRecursoshumanos($id)
	{
        $this->loadEncuesta($id);
        $datos = $this->encuesta->getEstadisticasPorCheckbox(array(
            'preg_talentohumano_pei_inv',
            'preg_talentohumano_pei_inn',
        ));
        $datosExp = $this->encuesta->getEstadisticasPorOpcion(array(
            'preg_talentohumano_exp_area'
        ));
        if ($datos) {
            $datos = $this->agruparDatos($datos,"preg_enun","cuenta");
        }
        if ($datosExp) {
            $datosExp = $this->agruparDatos($datosExp,"enunciado","cuenta");
        }
        $this->render('recursoshumanos',array(
            "datosPorCat" => $datos,
            "datosExp" => $datosExp,
        ));
	}
}
