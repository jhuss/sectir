<?php
use Underscore\Types\Arrays;

class EstadisticasController extends Controller
{
    public $layout = '//layouts/chart';
    public $encId = null;
    public $actions = array();
    public $encuesta = null;

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', 'users' => array('*')),
        );
    }

    protected function beforeAction($event)
    {
        $reflection = new ReflectionClass('EstadisticasController');
        $methods = $reflection->getMethods();
        $actions = array();
        $titles = array(
            'Gastosactividades' => 'Gastos en Actividades',
            'IdentificacionPorEnte' => 'Identificación por Ente',
            'Infraestructura' => 'Infraestructura',
            'Problematicas' => 'Problematicas',
            'Activa' => 'Instalaciones/Sedes Activas',
            'Productostecnologicos' => 'Productos Tecnológicos',
            'Proyectosinvestigacion' => 'Proyectos de Investigación',
            'Recursoshumanos' => 'Recursos Humanos',
            'RecursosHumanosPorEnte' => 'Recursos Humanos por Ente',
            'Actores' => 'Actores',
            'Cooperacion' => 'Cooperación',
            'LineasInvestigacionEnte' => 'Lineas de Investigación por Ente',
            'RedesCooperacionEnte' => 'Redes de Cooperación por Ente',
            'ProyectosInnovacion' => 'Proyectos de Innovación',
            'ProgramasExistentes' => 'Programas Existentes',
            'Revistas' => 'Revistas',
            'Condiciones' => 'Condiciones',
            'Internet' => 'Internet',
            'Comiteetica' => 'Comite de Ética',
            'TipoPatrimonio' => 'Patrimonio',
            'Experiencia' => 'Experiencia',
            'Beneficiarios' => 'Beneficiarios',
            'BeneficiariosPorEnte' => 'Beneficiarios por Ente',
            'Servicios' => 'Servicios',
            'ServiciosPorEnte' => 'Servicios por Ente'
        );

        foreach ($methods as $m) {
            if (preg_match('/^action+\w{2,}/',$m->name)) {
                $name = explode('action', $m->name)[1];
                if ($name != 'index') {
                    array_push($actions, array('name'=>$name, 'title'=>$titles[$name]));
                }
            }
        }

        $this->actions = $actions;
        $parms = $this->getActionParams();

        if (array_key_exists('id', $parms)) {
            $this->encId = $parms['id'];
        }

        if (is_null($this->encId)) {
            $this->layout = '//layouts/main';
        }

        return true;
    }

    protected function agruparDatos($datos, $x, $y)
    {
        $labels = array();
        $retVal = array();

        /*if (!is_array($x)) {
            foreach ($datos as $d) {
                $retVal[] = array(
                    "x" => $d[$x],
                    "y" => $d[$y],
                );
            }
        } else {
            foreach ($datos as $d) {
                $indiceX = "";
                foreach ($x as $elX) {
                    $indiceX .= $d[$elX];
                    $indiceX .= ":";
                }
                $indiceX = rtrim($indiceX, ": ");
                $retVal[] = array(
                    "x" => $indiceX,
                    "y" => $d[$y],
                );
            }
        }*/

        if (!is_array($x)) {
            foreach ($datos as $d) {
                array_push($labels, $d[$x]);
                array_push($retVal, $d[$y]);
            }
        } else {
            foreach ($datos as $d) {
                $indiceX = "";
                foreach ($x as $elX) {
                    $indiceX .= $d[$elX];
                    $indiceX .= ":";
                }
                $indiceX = rtrim($indiceX, ": ");
                array_push($labels, $indiceX);
                array_push($retVal, $d[$y]);
            }
        }

        return array('labels' => $labels, 'data' => $retVal);
    }

    public function agruparDatosPorArray($datos, $group, $x, $y)
    {
        $temp = Arrays::from($datos)->group(function ($val) use ($group) {
            return $val[$group];
        })->obtain();
        $retVal = array();
        foreach ($temp as $i => $val) {
            $retVal[$i] = $this->agruparDatos($val, $x, $y);
        }
        return $retVal;
    }

    protected function loadEncuesta($id)
    {
        if ($this->encuesta !== null) {
            return;
        }
        $this->encuesta = Encuesta::model()
            ->findByPk($id);
        if ($this->encuesta === null) {
            throw new CHttpException(404, "No existe encuesta");
        }
    }

    private function dataChartView($temp, $titulo)
    {
        $data = array();
        foreach ($temp as $i => $t) {
            $data[] = array(
                'titulo' => strtr($titulo, array("{val}" => $i)),
                'data' => $t,
            );
        }
        return $data;
    }


    /**********
     * ACTIONS
     **********/

    public function actionindex($id=null)
    {
        $this->render('index');
    }

    public function actionGastosactividades($id, $porEnte = 0, $identificadorUni=null)
    {
        $this->loadEncuesta($id);
        if (!$porEnte) {
            $proyectosaprob = $this->encuesta->getEstadisticasSumaRespuestaAno(array(
                'preg_recursosaprob_num'
            ), "o.id",false,$identificadorUni);
            if ($proyectosaprob) {
                $proyectosaprob = $this->agruparDatos($proyectosaprob, "enunciado_comp", "suma");
            }
            $proyectosaprobArea = $this->encuesta->getEstadisticasSumaRespuestaAno(array(
                'preg_recursosaprob_area_num'
            ), "o.id",false,$identificadorUni);
            if ($proyectosaprobArea) {
                $proyectosaprobArea = $this->agruparDatos($proyectosaprobArea, "enunciado_comp", "suma");
            }
            $this->render('gastosactividades', array(
                "proyectosaprob" => $proyectosaprob,
                "proyectosaprobArea" => $proyectosaprobArea,
            ));
        } else {
            $proyectosaprob = $this->encuesta->getEstadisticasSumaRespuestaAno(array(
                'preg_recursosaprob_num'
            ), "o.id, sub2.opcion_id", true,$identificadorUni);
            $proyectosaprobArea = $this->encuesta->getEstadisticasSumaRespuestaAno(array(
                'preg_recursosaprob_area_num'
            ), "o.id, sub2.opcion_id", true,$identificadorUni);
            $tempAprob = $this->agruparDatosPorArray(
                $proyectosaprob, "sub2_enunciado",
                "enunciado_comp", "suma"
            );
            $tempArea = $this->agruparDatosPorArray(
                $proyectosaprobArea, "sub2_enunciado",
                "enunciado_comp", "suma"
            );
            $dataAprob = $this->dataChartView($tempAprob, "Recursos aprobados para {val}");
            $dataArea = $this->dataChartView($tempArea, "Recursos aprobados para {val} por area");
            $this->render('chartview', array(
                'pageName' => 'Gastos Actividades',
                'datos' => array_merge($dataAprob, $dataArea),
            ));

        }
    }

    public function actionIdentificacionPorEnte($id)
    {
        $this->loadEncuesta($id);
        $datos = $this->encuesta
            ->getEstadisticasPorOpcion(array("preg_datos_tipoinst"));
        $datosAgrup = $this->agruparDatos($datos, "enunciado", "cuenta");
        $this->render("chartview", array("datos" => array(
            array(
                "titulo" => "Entes que respondieron encuesta, por tipo",
                "data" => $datosAgrup,
            )
        )));
    }

    public function actionInfraestructura($id, $porEnte = 0,$identificadorUni=null)
    {
        $this->loadEncuesta($id);
        $datosInfraestructura = $this
            ->encuesta
            ->getEstadisticasPorOpcion(array(
                'preg_infraestructura_espacios'
            ),false,$identificadorUni);
        $datos = $this->agruparDatos($datosInfraestructura, "enunciado", "cuenta");
        $this->render('infraestructura', array('datos' => $datos));
    }

    public function actionProblematicas($id, $porEnte = 0, $identificadorUni = null)
    {
        $this->loadEncuesta($id);
        $datos = $this->encuesta->getEstadisticasPorCheckbox(array(
            'preg_problematica_sino'
        ), "", "<>", true, false, $identificadorUni);
        $datos = $this->agruparDatos($datos, "enunciado", "cuenta");
        $this->render('problematicas', array("datos" => $datos));
    }

    public function actionActiva($id, $porEnte = 0, $identificadorUni = null)
    {
        $this->loadEncuesta($id);
        $datos = $this->encuesta->getEstadisticasPorCheckbox(array(
            'preg_infraestructura_activa'
        ),1,"=",true,false,$identificadorUni);
        $datos = $this->agruparDatos($datos, "enunciado", "cuenta");
        $this->render('activa', array("datos" => $datos));
    }

    public function actionProductostecnologicos($id,$identificadorUni=null)
    {
        $this->loadEncuesta($id);
        $datosAgrup = $this->prepareProductosTecnologicos("sub2.opcion_id", true, "sub2_enunciado",$identificadorUni);
        $datosPorProducto = $this->prepareProductosTecnologicos("o.enunciado", false, "enunciado_comp",$identificadorUni);
        $datosPorPeriodo = $this->prepareProductosTecnologicos("ra.ano", false, "ano",$identificadorUni);

        $this->render('chartview', array(
            "datos" => array(
                array(
                    "titulo" => "Productos tecnológicos por ente",
                    "data" => $datosAgrup,
                ),
                array(
                    "titulo" => "Cantidad de productos por tipo",
                    "data" => $datosPorProducto,
                ),
                array(
                    "titulo" => "Cantidad de productos por año",
                    "data" => $datosPorPeriodo,
                    "mode" => 'horizontal'
                ),
            )
        ));
    }

    private function prepareProductosTecnologicos($groupBy, $ente, $agruparArray,$identificadorUni)
    {
        $estadisticasPorEnte = $this->encuesta
            ->getEstadisticasSumaRespuestaAno(array("preg_productos_numero"), $groupBy, $ente,$identificadorUni);
        $datosAgrup = $this->agruparDatos($estadisticasPorEnte, $agruparArray, "suma");
        return $datosAgrup;
    }

    public function actionProyectosinvestigacion($id, $porEnte = 0,$identificadorUni=null)
    {
        $this->loadEncuesta($id);
        $proyectosaprob = $this->encuesta->getEstadisticasSumaRespuestaAno(array(
            'preg_proyectosaprob_num'
        ), "o.id",false,$identificadorUni);
        $proyectosaprobArea = $this->encuesta->getEstadisticasSumaRespuestaAno(array(
            'preg_proyectosaprob_area_num'
        ), "o.id",false,$identificadorUni);
        if ($proyectosaprob) {
            $proyectosaprob = $this->agruparDatos($proyectosaprob, "enunciado_comp", "suma");
        }
        if ($proyectosaprobArea) {
            $proyectosaprobArea = $this->agruparDatos($proyectosaprobArea, "enunciado_comp", "suma");
        }
        $this->render('proyectosinvestigacion', array(
            "proyectosaprob" => $proyectosaprob,
            "proyectosaprobArea" => $proyectosaprobArea,
        ));
    }

    public function actionRecursoshumanos($id,$identificadorUni=null)
    {
        extract($this->getRecursosHumanos($id,false,$identificadorUni));
        if ($datos) {
            $datos = $this->agruparDatos($datos, "preg_enun", "cuenta");
        }
        if ($datosUni) {
            $datosUni = $this->agruparDatos($datosUni, "preg_enun", "cuenta");
        }
        if ($datosExp) {
            $datosExp = $this->agruparDatos($datosExp, "enunciado", "cuenta");
        }
        if ($datosFuenteFin) {
            $datosFuenteFin = $this->agruparDatos($datosFuenteFin, "enunciado", "cuenta");
        }
        $this->render('recursoshumanos', array(
            "datosPorCat" => $datos,
            "datosExp" => $datosExp,
            "datosUni" => $datosUni,
            "datosFuenteFin" => $datosFuenteFin,
        ));
    }

    public function actionRecursosHumanosPorEnte($id)
    {
        extract($this->getRecursosHumanos($id, true));
        $datos = $this->agruparDatosPorArray(
            $datos, "sub2_enunciado",
            "preg_enun", "cuenta"
        );
        $datos = $this->dataChartView($datos, "Talento humano para categoría PEI por {val}");
        $datosExp = $this->agruparDatosPorArray(
            $datosExp, "sub2_enunciado",
            "enunciado", "cuenta"
        );
        $datosExp = $this->dataChartView($datosExp, "Talento humano por experiencia PEI para {val}");
        $datosUni = $this->agruparDatosPorArray(
            $datosUni, "sub2_enunciado",
            "preg_enun", "cuenta"
        );
        $datosUni = $this->dataChartView($datosUni, "Talento humano por formación universitaria para {val}");
        $datosFuenteFin = $this->agruparDatosPorArray(
            $datosFuenteFin, "sub2_enunciado",
            "enunciado", "cuenta"
        );
        $datosFuenteFin = $this->dataChartView($datosFuenteFin, "Talento humano por fuente de financiamiento para {val}");

        $this->render("chartview", array(
            "datos" => array_merge(
                $datos, $datosExp, $datosUni, $datosFuenteFin
            )
        ));
    }

    private function getRecursosHumanos($id, $ente = false,$identificadorUni = null)
    {
        $this->loadEncuesta($id);
        if (!$ente) {
            $datos = $this->encuesta->getEstadisticasPorCheckbox(array(
                'preg_talentohumano_pei_inv',
                'preg_talentohumano_pei_inn',
            ),1,"=",true,false,$identificadorUni);
            $datosUni = $this->encuesta->getEstadisticasPorCheckbox(array(
                'preg_talentohumano_nacionalpub',
                'preg_talentohumano_nacionalpri',
                'preg_talentohumano_internacional'
            ),1,"=",true,false,$identificadorUni);
            $datosExp = $this->encuesta->getEstadisticasPorOpcion(array(
                'preg_talentohumano_exp_area'
            ),false,$identificadorUni);
            $datosFuenteFin = $this->encuesta->getEstadisticasPorOpcion(array(
                'preg_talentohumano_fuentefin'
            ),false,$identificadorUni);
        } else {
            $datos = $this->encuesta->getEstadisticasPorCheckbox(array(
                'preg_talentohumano_pei_inv',
                'preg_talentohumano_pei_inn',
            ), 1, "=", true, true,$identificadorUni);
            $datosUni = $this->encuesta->getEstadisticasPorCheckbox(array(
                'preg_talentohumano_nacionalpub',
                'preg_talentohumano_nacionalpri',
                'preg_talentohumano_internacional'
            ), 1, "=", true, true,$identificadorUni);
            $datosExp = $this->encuesta->getEstadisticasPorOpcion(array(
                'preg_talentohumano_exp_area'
            ), true,$identificadorUni);
            $datosFuenteFin = $this->encuesta->getEstadisticasPorOpcion(array(
                'preg_talentohumano_fuentefin'
            ), true,$identificadorUni);

        }
        return array(
            'datos' => $datos,
            'datosUni' => $datosUni,
            'datosExp' => $datosExp,
            'datosFuenteFin' => $datosFuenteFin,
        );
    }

    public function actionActores($id, $porEnte = 0,$identificadorUni)
    {
        $this->loadEncuesta($id);
        $datos = $this->encuesta->getEstadisticasPorCheckbox(array(
            'preg_actores_fin_actorespart',
            'preg_actores_fin_actoresfin',
        ), "", "<>",true,false,$identificadorUni);
        if ($datos) {
            $datos = $this->agruparDatos($datos, "preg_enun", "cuenta");
        }
        $this->render("actores", array('datos' => $datos));
    }

    public function actionCooperacion($id, $porEnte = 0,$identificadorUni = null)
    {
        $this->loadEncuesta($id);
        $datos = $this->encuesta->getEstadisticasPorOpcion(array(
            "preg_red_tem_pert"
        ), $porEnte,$identificadorUni);
        if ($datos) {
            if (!$porEnte) {
                $datos = $this->agruparDatos($datos, "enunciado", "cuenta");
                $this->render("cooperacion", array("datos" => $datos));
            } else {
                $datos = $this->agruparDatosPorArray($datos, "sub2_enunciado",
                    "enunciado", "cuenta");
                $datos = $this->dataChartView($datos, "Cooperación para {val}");
                $this->render("chartview", array('pageName' => 'Cooperación',
                    'datos' => $datos));
            }
        }
        else {
            $this->render("cooperacion", array("datos" => array()));
        }
    }

    public function actionLineasInvestigacionEnte($id,$identificadorUni=null)
    {
        $datos = $this->getEstadisticasOpcionEnte($id, array("preg_lineas_inv_lineasinv"),$identificadorUni);

        $datos = $this->dataChartView($datos, "Lineas de investigación para {val}");
        $this->render("chartview", array("datos" => $datos));

    }

    public function actionRedesCooperacionEnte($id,$identificadorUni=null)
    {
        $datos = $this->getEstadisticasOpcionEnte($id, array("preg_red_tem_pert"),$identificadorUni);
        $datos = $this->dataChartView($datos, "Redes temáticas de cooperación para {val}");
        $this->render("chartview", array("datos" => $datos));
    }

    private function getEstadisticasOpcionEnte($id, $preguntas,$identificadorUni=null)
    {
        $this->loadEncuesta($id);
        $estadisticas = $this->encuesta->getEstadisticasPorOpcion($preguntas, true);
        $datos = $this->agruparDatosPorArray(
            $estadisticas, "sub2_enunciado",
            "enunciado", "cuenta"
        );
        return $datos;
    }

    public function actionProyectosInnovacion($id, $porEnte = 0,$identificadorUni = null)
    {
        $this->loadEncuesta($id);
        $datos = $this->encuesta->getProyectosInnovacion("opc.id",true,false,$identificadorUni);
        if ($datos) {
            $datos = $this->agruparDatos($datos, "enunciado", "cuenta");
        }
        $this->render("proyectosinnovacion", array("datos" => $datos));
    }

    public function actionProgramasExistentes($id, $porEnte = 0, $identificadorUni = null)
    {
        $this->loadEncuesta($id);
        $datos = $this->encuesta->getPostgradosMaestria(false,$identificadorUni);
        $datosEgresados = $this->encuesta->getEgresadosProgramas(false,$identificadorUni);
        if ($datos) {
            $datos = $this->agruparDatos($datos, "enunciado", "cuenta");
        }
        if ($datosEgresados) {
            $datosEgresados = $this->agruparDatos($datosEgresados, "identificador", "suma");
        }
        $this->render("programasexistentes", array("datos" => $datos, "datosEgresados" => $datosEgresados));
    }

    public function actionRevistas($id, $porEnte = 0, $identificadorUni = null)
    {
        $this->loadEncuesta($id);
        $datos = $this->encuesta->getPublicacionesRevista(false,$identificadorUni);
        if ($datos) {
            $datos = $this->agruparDatos($datos, "enunciado", "suma");
        }
        $datosPorArea = $this->encuesta->getRevistasPorArea(false,$identificadorUni);
        if ($datosPorArea) {
            $datosPorArea = $this->agruparDatos($datosPorArea, "enunciado", "cuenta");
        }
        $this->render("revistas", array("datos" => $datos, "datosPorArea" => $datosPorArea));
    }

    public function actionCondiciones($id, $porEnte = 0, $identificadorUni=null)
    {
        $this->loadEncuesta($id);
        $datosEspacios = $this->encuesta->getEstadisticasPorOpcion(array(
            'preg_infraestructura_espacios',
        ),false,$identificadorUni);
        $datosEquipamiento = $this->encuesta->getEstadisticasPorOpcion(array(
            'preg_infraestructura_equipamiento',
        ),false,$identificadorUni);
        if ($datosEspacios) {
            $datosEspacios = $this->agruparDatos($datosEspacios, "enunciado", "cuenta");
        }
        if ($datosEquipamiento) {
            $datosEquipamiento = $this->agruparDatos($datosEquipamiento, "enunciado", "cuenta");
        }
        $this->render("condiciones", array(
            'datosEspacios' => $datosEspacios,
            'datosEquipamiento' => $datosEquipamiento,
        ));
    }

    public function actionInternet($id, $porEnte = 0,$identificadorUni=null)
    {
        $this->loadEncuesta($id);
        $datosTieneInternet = $this->encuesta->getEstadisticasPorOpcion(array(
            'preg_internet_servint'
        ),false,$identificadorUni);
        $datosSatisfaccion = $this->encuesta->getEstadisticasPorOpcion(array(
            'preg_internet_usoinv'
        ),false,$identificadorUni);
        $datosProveedor = $this->encuesta->getEstadisticasPorOpcion(array(
            'preg_internet_proveedorint'
        ),false,$identificadorUni);
        if ($datosTieneInternet) {
            $datosTieneInternet = $this->agruparDatos($datosTieneInternet, "enunciado", "cuenta");
        }
        if ($datosSatisfaccion) {
            $datosSatisfaccion = $this->agruparDatos($datosSatisfaccion, "enunciado", "cuenta");
        }
        if ($datosProveedor) {
            $datosProveedor = $this->agruparDatos($datosProveedor, "enunciado", "cuenta");
        }
        $this->render("internet", array(
            'datosTieneInternet' => $datosTieneInternet,
            'datosSatisfaccion' => $datosSatisfaccion,
            'datosProveedor' => $datosProveedor,
        ));
    }

    public function actionComiteetica($id, $porEnte = 0, $identificadorUni = null)
    {
        $this->loadEncuesta($id);
        $datosComiteEtica = $this->encuesta->getEstadisticasPorOpcion(array(
            'preg_comiteetica_evalue'
        ),false,$identificadorUni);
        if ($datosComiteEtica) {
            $datosComiteEtica = $this->agruparDatos($datosComiteEtica, "enunciado", "cuenta");
        }
        $this->render("comiteetica", array(
            "datosComiteEtica" => $datosComiteEtica,
        ));
    }

    public function actionTipoPatrimonio($id, $porEnte = 0,$identificadorUni=null)
    {
        $this->loadEncuesta($id);
        $datosPorPatrimonio = $this->encuesta->getEstadisticasPorOpcion(array(
            'preg_datos_caracterpub'
        ),false,$identificadorUni);
        if ($datosPorPatrimonio) {
            $datosPorPatrimonio = $this->agruparDatos($datosPorPatrimonio, "enunciado", "cuenta");
        }
        $this->render("tipopatrimonio", array(
            "datosPorPatrimonio" => $datosPorPatrimonio,
        ));
    }

    public function actionExperiencia($id, $porEnte = 0,$identificadorUni = null)
    {
        $this->loadEncuesta($id);
        if (!$porEnte) {
            $datos = $this->encuesta->getEstadisticasPorCheckbox(array(
                'preg_areas_exp_sino'
            ),1,"=",true,false,$identificadorUni);
            $datos = $this->agruparDatos($datos, "enunciado", "cuenta");
            $this->render('problematicas', array("datos" => $datos));
        } else {
            $datos = $this->encuesta->getEstadisticasPorCheckbox(array(
                'preg_areas_exp_sino'
            ), 1, "=", true, true,$identificadorUni);
            $temp = $this->agruparDatosPorArray(
                $datos, "sub2_enunciado",
                "enunciado", "cuenta"
            );
            $data = $this->dataChartView($temp, "Experiencia para {val}");
            $this->render("chartview", array('pageName' => 'Experiencia',
                'datos' => $data));
        }
    }

    public function actionBeneficiarios($id,$identificadorUni=null)
    {
        $this->loadEncuesta($id);
        $benefNum = $this->encuesta->getEstadisticasSumaRespuestaAno(array(
            'preg_benef_num'
        ), "o.id",false,$identificadorUni);
        if ($benefNum) {
            $benefNum = $this->agruparDatos($benefNum, "enunciado_comp", "suma");
        }
        $this->render("beneficiarios", array(
            "benefNum" => $benefNum,
        ));
    }

    public function actionBeneficiariosPorEnte($id,$identificadorUni=null)
    {
        $this->loadEncuesta($id);
        $benefNum = $this->encuesta->getEstadisticasSumaRespuestaAno(array(
            'preg_benef_num'
        ), "o.id, sub2.opcion_id", true,$identificadorUni);
        $temp = $this->agruparDatosPorArray(
            $benefNum, "sub2_enunciado",
            "enunciado_comp", "suma"
        );
        $data = $this->dataChartView($temp, "Beneficiarios para {val}");
        $this->render("chartview", array('pageName' => 'Beneficiarios',
            'datos' => $data));
    }

    public function actionServicios($id, $porEnte = 0)
    {
        $this->loadEncuesta($id);
        $datos = $this->encuesta->getProyectosInnovacion("opc.id", false);
        if ($datos) {
            $datos = $this->agruparDatos($datos, "enunciado", "cuenta");
        }
        $this->render("servicios", array(
            "datos" => $datos,
        ));
    }

    public function actionServiciosPorEnte($id)
    {
        $this->loadEncuesta($id);
        $datos = $this->encuesta->getProyectosInnovacion("opc.id", false, false);
        $temp = $this->agruparDatosPorArray(

            $datos, "sub2_enunciado",
            "enunciado_comp", "suma"
        );
        $data = $this->dataChartView($temp, "Servicios por {val}");
        $this->render("chartview", array('pageName' => 'Servicios',
            'datos' => $data));
    }
}
