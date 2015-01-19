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
	public function actionGastosactividades()
    {
		$this->render('gastosactividades');
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

	public function actionProyectosinvestigacion()
	{
		$this->render('proyectosinvestigacion');
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
