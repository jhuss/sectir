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

	public function actionInfraestructura($id)
	{
        $this->loadEncuesta($id);
        $datosInfraestructura = $this
            ->encuesta
            ->getEstadisticasPorOpcion(array(
                'preg_infraestructura_espacios'
            ));
        $datos = $this->agruparDatos($datosInfraestructura,"enunciado","cuenta");
		$this->render('infraestructura',array('datos'=>$datos));
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
    public function actionActiva($id)
    {
        $this->loadEncuesta($id);
        $datos = $this->encuesta->getEstadisticasPorCheckbox(array(
            'preg_infraestructura_activa'
        ));
        $datos = $this->agruparDatos($datos,"enunciado","cuenta");
        $this->render('activa',array("datos"=>$datos));
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
        $datosUni = $this->encuesta->getEstadisticasPorCheckbox(array(
            'preg_talentohumano_nacionalpub', 
            'preg_talentohumano_nacionalpri', 
            'preg_talentohumano_internacional'
        ));
        $datosExp = $this->encuesta->getEstadisticasPorOpcion(array(
            'preg_talentohumano_exp_area'
        ));
        $datosFuenteFin = $this->encuesta->getEstadisticasPorOpcion(array(
            'preg_talentohumano_fuentefin'
        ));
        if ($datos) {
            $datos = $this->agruparDatos($datos,"preg_enun","cuenta");
        }
        if ($datosUni) {
            $datosUni = $this->agruparDatos($datosUni,"preg_enun","cuenta");
        }
        if ($datosExp) {
            $datosExp = $this->agruparDatos($datosExp,"enunciado","cuenta");
        }
        if ($datosFuenteFin) {
            $datosFuenteFin = $this->agruparDatos($datosFuenteFin,"enunciado","cuenta");
        }
        $this->render('recursoshumanos',array(
            "datosPorCat" => $datos,
            "datosExp" => $datosExp,
            "datosUni" => $datosUni,
            "datosFuenteFin" => $datosFuenteFin,
        ));
	}
    public function actionActores($id)
    {
        $this->loadEncuesta($id);
        $datos = $this->encuesta->getEstadisticasPorCheckbox(array(
            'preg_actores_fin_actorespart',
            'preg_actores_fin_actoresfin',
        ),"","<>");
        if ($datos) {
            $datos = $this->agruparDatos($datos,"preg_enun","cuenta");
        }
        $this->render("actores",array('datos'=>$datos));
    }
    public function actionCooperacion($id)
    {
        $this->loadEncuesta($id);
        $datos = $this->encuesta->getEstadisticasPorOpcion(array(
            "preg_red_tem_pert"
        ));
        if ($datos) {
            $datos = $this->agruparDatos($datos,"enunciado","cuenta");
        }
        $this->render("cooperacion",array("datos"=>$datos));
    }
    public function actionProyectosInnovacion($id)
    {
        $this->loadEncuesta($id);
        $datos = $this->encuesta->getProyectosInnovacion("opc.id");
        if ($datos) {
            $datos = $this->agruparDatos($datos,"enunciado","cuenta");
        }
        $this->render("proyectosinnovacion",array("datos"=>$datos));
    }
    public function actionProgramasExistentes($id)
    {
        $this->loadEncuesta($id);       
        $datos = $this->encuesta->getPostgradosMaestria();
        $datosEgresados = $this->encuesta->getEgresadosProgramas();
        if ($datos) {
            $datos = $this->agruparDatos($datos,"enunciado","cuenta");
        }
        if ($datosEgresados) {
            $datosEgresados = $this->agruparDatos($datosEgresados,"identificador","suma");
        }
        $this->render("programasexistentes",array("datos"=>$datos,"datosEgresados"=>$datosEgresados));
    }
    public function actionRevistas($id)
    {
        $this->loadEncuesta($id);
        $datos = $this->encuesta->getPublicacionesRevista();
        if ($datos) {
            $datos = $this->agruparDatos($datos,"enunciado","suma");
        }
        $datosPorArea = $this->encuesta->getRevistasPorArea();
        if ($datosPorArea) {
            $datosPorArea = $this->agruparDatos($datosPorArea,"enunciado","cuenta");
        }
        $this->render("revistas",array("datos"=>$datos,"datosPorArea"=>$datosPorArea));
    }
    public function actionCondiciones($id)
    {
        $this->loadEncuesta($id);
        $datosEspacios = $this->encuesta->getEstadisticasPorOpcion(array(
            'preg_infraestructura_espacios',
        ));
        $datosEquipamiento = $this->encuesta->getEstadisticasPorOpcion(array(
            'preg_infraestructura_equipamiento',
        ));
        if ($datosEspacios) {
            $datosEspacios = $this->agruparDatos($datosEspacios,"enunciado","cuenta");
        }
        if ($datosEquipamiento) {
            $datosEquipamiento = $this->agruparDatos($datosEquipamiento,"enunciado","cuenta");
        }
        $this->render("condiciones",array(
            'datosEspacios' => $datosEspacios,
            'datosEquipamiento' => $datosEquipamiento,
        ));
    }
    public function actionInternet($id)
    {
        $this->loadEncuesta($id);
        $datosTieneInternet = $this->encuesta->getEstadisticasPorOpcion(array(
            'preg_internet_servint'
        ));
        $datosSatisfaccion = $this->encuesta->getEstadisticasPorOpcion(array(
            'preg_internet_usoinv'
        ));
        $datosProveedor = $this->encuesta->getEstadisticasPorOpcion(array(
            'preg_internet_proveedorint'
        ));
        if ($datosTieneInternet) {
            $datosTieneInternet = $this->agruparDatos($datosTieneInternet,"enunciado","cuenta");
        }
        if ($datosSatisfaccion) {
            $datosSatisfaccion = $this->agruparDatos($datosSatisfaccion,"enunciado","cuenta");
        }
        if ($datosProveedor) {
            $datosProveedor = $this->agruparDatos($datosProveedor,"enunciado","cuenta");
        }
        $this->render("internet",array(
            'datosTieneInternet' => $datosTieneInternet,
            'datosSatisfaccion' => $datosSatisfaccion,
            'datosProveedor' => $datosProveedor,
        ));

    }
    public function actionComiteetica($id)
    {
        $this->loadEncuesta($id);
        $datosComiteEtica = $this->encuesta->getEstadisticasPorOpcion(array(
            'preg_comiteetica_evalue'
        ));
        if ($datosComiteEtica) {
            $datosComiteEtica = $this->agruparDatos($datosComiteEtica,"enunciado","cuenta");
        }
        $this->render("comiteetica",array(
            "datosComiteEtica" => $datosComiteEtica,
        ));
    }
    public function actionTipoPatrimonio($id)
    {
        $this->loadEncuesta($id);
        $datosPorPatrimonio = $this->encuesta->getEstadisticasPorOpcion(array(
            'preg_datos_caracterpub'
        )); 
        if ($datosPorPatrimonio) {
            $datosPorPatrimonio = $this->agruparDatos($datosPorPatrimonio,"enunciado","cuenta");
        }
        $this->render("tipopatrimonio",array(
            "datosPorPatrimonio" => $datosPorPatrimonio,
        ));
    }
    public function actionExperiencia($id)
    {
        $this->loadEncuesta($id);
        $datos = $this->encuesta->getEstadisticasPorCheckbox(array(
               'preg_areas_exp_sino'
        ));
        $datos = $this->agruparDatos($datos,"enunciado","cuenta");
        $this->render('problematicas',array("datos"=>$datos));
    }
    public function actionBeneficiarios($id)
    {
        $this->loadEncuesta($id);
        $benefNum = $this->encuesta->getEstadisticasSumaRespuestaAno(array(
            'preg_benef_num'
        ),"o.id");
        if ($benefNum) {
            $benefNum = $this->agruparDatos($benefNum,"enunciado_comp","suma");
        }
        $this->render("beneficiarios",array(
            "benefNum" => $benefNum,
        ));
    }
    public function actionServicios($id)
    {
        $this->loadEncuesta($id);
        $datos = $this->encuesta->getProyectosInnovacion("opc.id",false);
        if ($datos) {
            $datos = $this->agruparDatos($datos,"enunciado","cuenta");
        }
        $this->render("servicios",array(
            "datos" => $datos,
        ));
    }
}
