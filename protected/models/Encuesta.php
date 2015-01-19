<?php

/**
 * This is the model class for table "{{Encuesta}}".
 *
 * The followings are the available columns in table '{{Encuesta}}':
 * @property integer $id
 * @property integer $tipoencuesta_id
 * @property string $enunciado
 * @property string $identificador
 * @property string $fecha_inicial
 * @property string $fecha_final
 * @property string $creado_en
 * @property string $actualizado_en
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property Tipoencuesta $tipoencuesta
 * @property Users $user
 * @property Respuestaabierta[] $respuestaabiertas
 * @property Respuestaano[] $respuestaanos
 * @property Respuestanum[] $respuestanums
 * @property Respuestaopc[] $respuestaopcs
 */
use Underscore\Types\Arrays;

class Encuesta extends CActiveRecord
{
    /**
     * Número de años a ser encuestados
     */
    const ANOS_ENCUESTADOS = 12;
    /**
     * Cola de preguntas
     */
    protected $_colaRespuestas = array();    
    /**
     * Cola de preguntas abiertas
     */
    protected $_colaRespuestasAbiertas = array();
    /**
     * Cola de preguntas opciones
     */
    protected $_colaRespuestasOpc = array();
    /**
     * Cola de preguntas numericas
     */
    protected $_colaRespuestasNum = array();
    /**
     * Cola de preguntas Anuales
     */
    protected $_colaRespuestasAno = array();
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{Encuesta}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('agrupacionenc_id, tipoencuesta_id, enunciado, ano, identificador', 'required'),
            array('tipoencuesta_id', 'exist', 'allowEmpty' => false, 'className' => 'Tipoencuesta', 'attributeName' => 'id'),
            array('agrupacionenc_id', 'exist', 'allowEmpty' => false, 'className' => 'Agrupacionenc', 'attributeName' => 'id'),
            array('enunciado', 'length', 'max'=>256),
            array('identificador', 'unique'),
            array('ano', 'numerical', 'min' => 2014),
			array('identificador', 'length', 'max'=>32),
			array('fecha_inicial, fecha_final, actualizado_en', 'safe'),
            array('fecha_inicial, fecha_final', 'date'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tipoencuesta_id, enunciado, identificador, fecha_inicial, fecha_final, creado_en, actualizado_en, user_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'tipoencuesta' => array(self::BELONGS_TO, 'Tipoencuesta', 'tipoencuesta_id'),
            'agrupacionenc' => array(self::BELONGS_TO, 'Agrupacionenc',
                'agrupacionenc_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'respuestaabiertas' => array(self::HAS_MANY, 'Respuestaabierta', 'encuesta_id'),
			'respuestaanos' => array(self::HAS_MANY, 'Respuestaano', 'encuesta_id'),
			'respuestanums' => array(self::HAS_MANY, 'Respuestanum', 'encuesta_id'),
			'respuestaopcs' => array(self::HAS_MANY, 'Respuestaopc', 'encuesta_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tipoencuesta_id' => 'Tipoencuesta',
			'enunciado' => 'Enunciado',
			'identificador' => 'Identificador',
			'fecha_inicial' => 'Fecha Inicial',
			'fecha_final' => 'Fecha Final',
			'creado_en' => 'Creado En',
			'actualizado_en' => 'Actualizado En',
			'user_id' => 'User',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('tipoencuesta_id',$this->tipoencuesta_id);
		$criteria->compare('enunciado',$this->enunciado,true);
		$criteria->compare('identificador',$this->identificador,true);
		$criteria->compare('fecha_inicial',$this->fecha_inicial,true);
		$criteria->compare('fecha_final',$this->fecha_final,true);
		$criteria->compare('creado_en',$this->creado_en,true);
		$criteria->compare('actualizado_en',$this->actualizado_en,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Encuesta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
    }
    /**
     * Retornar encuestas activas
     *
     * @return array
     */
    public static function getEncuestasActivas()
    {
        $sql = <<<EOF
SELECT e.id, e.enunciado FROM {{Encuesta}} e WHERE e.activa = :actparam
EOF;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(':actparam',1);
        return $command->queryAll();
    }
    
    public function behaviors()
    {
        $behaviors = array(
            'timestamp' => array(
               'class' => 'zii.behaviors.CTimestampBehavior',
               'createAttribute' => 'creado_en',
               'updateAttribute' => 'actualizado_en',
            ),
        );
        if (Yii::app() instanceof CWebApplication) {
            $behaviors["defaultValue"] = array(
                'class' => 'DefaultValueBehavior',
                'attribute' => 'user_id',
                'value' => Yii::app()->user->id,
                );
        }
        return $behaviors;
    }
    public function obtenerRespuestasEncuesta($entradas)
    {
        foreach ($entradas as $entrada) {
            if (isset($entrada["values"])) {
                if ($entrada["hasSubQ"] === false) {
                    foreach ($entrada["values"] as $value) {
                        foreach ($value as $indice=>$internalValue) {
                            if (is_array($internalValue)) {
                                foreach ($internalValue as $v) {
                                    $this->meterColaRespuestas($v['text']);
                                }
                            }
                            else {
                                $this->meterColaRespuestas($indice,$internalValue);
                            }
                        }
                    }
                }
                else {
                    foreach ($entrada["values"] as $indice=>$grupoRespuestas) {
                        foreach ($grupoRespuestas as $indiceSubQ=>$value) {
                            if (!is_array($value)) {
                                // code...
                                $this->meterColaRespuestas($indice,$value,$indiceSubQ);
                            }
                            else {
                                foreach ($value as $v) {
                                    $this->meterColaRespuestas($indice,
                                        $v['text'],$indiceSubQ);
                                }
                            }
                        }
                    }
                }
            } else {
                foreach ($entrada as $indice=>$valorEntrada) {
                    //TODO revisar si esto funciona para tags
                    if (is_array($valorEntrada)) {
                        foreach ($valorEntrada as $v) {
                            $this->meterColaRespuestas($indice,$v['text']);
                            
                        }
                    }
                    else {
                        $this->meterColaRespuestas($indice,$valorEntrada);
                    }
                }
            }
        }
    }
    public function validarColaPreguntas()
    {
        //Regexes Numeros
        $numRealRegex = '/^\s*[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?\s*$/';
        //Cola de errores
        $errores = array();
        //Creamos validadores
        $emailValidator = new CEmailValidator;
        $numberValidator = new CNumberValidator;
        //Creamos función para crear parametros
        $paramFunc = function($range){
            $params = array();
            for ($i = 0; $i < $range; $i++) {
                $params[] = ":param_$i";
            }
            return implode(", ",$params);
        };
        //Funcion para agrupar por pregunta
        $preguntaIdFn = function($val){
            return $val["pregunta_id"];
        };
        //Obtenemos preguntas
        $sqlPreguntas = <<<EOF
SELECT p.id, p.tipo, p.enunciado, p.identificador FROM {{Pregunta}} p 
	INNER JOIN {{PreguntaGrupo}} pg ON pg.pregunta_id = p.id 
    INNER JOIN {{Grupo}} g ON pg.grupo_id = g.id
    INNER JOIN {{TipoencuestaGrupo}} tg ON tg.grupo_id = g.id
WHERE tg.tipoencuesta_id = :tipoencuestaid
EOF;
        $commandPreguntas = Yii::app()->db->createCommand($sqlPreguntas);
        $commandPreguntas->bindValue(":tipoencuestaid", $this->tipoencuesta_id);
        $preguntasSinIndexar = $commandPreguntas->queryAll();
        $preguntasIndexadasPorPID = array();
        foreach ($preguntasSinIndexar as $pregunta) {
            $preguntasIndexadasPorPID[$pregunta["id"]] = $pregunta;
        }
        //Fin de obtención de preguntas
        //Obtencion de opciones
        $sqlOpcionesSinProc = <<<EOF
SELECT o.id, o.enunciado, o.identificador, po.pregunta_id FROM {{Opcion}} o 
	INNER JOIN {{PreguntaOpc}} po ON o.id = po.opcion_id
WHERE po.pregunta_id IN (_ids_)
EOF;
        $sqlOpciones = strtr($sqlOpcionesSinProc,array(
            '_ids_' => $paramFunc(count($preguntasSinIndexar)),
        ));
        $opcionesCommand = Yii::app()->db->createCommand($sqlOpciones);
        foreach ($preguntasSinIndexar as $i=>$preg) {
            $opcionesCommand->bindValue(":param_$i",$preg['id']);
        }
        $opcionesSinProcesar = $opcionesCommand->queryAll();
        $opcionesPorPregunta = Arrays::from($opcionesSinProcesar)
            ->group($preguntaIdFn)
            ->obtain();
        //Fin de obtención de opciones
        //Obtencion de opciones Compuestas
        $sqlOpcionesCompSinProc = <<<EOF
SELECT o.id, o.enunciado, o.identificador, pc.pregunta_id FROM {{Opcioncomp}} o  
	INNER JOIN {{GrupocompOpcioncomp}} gop ON gop.opcioncomp_id = o.id
    INNER JOIN {{Preguntacompuesta}} pc ON pc.grupocomp_id = gop.grupocomp_id
WHERE pc.pregunta_id IN (_ids_)
EOF;
        $sqlOpcionesComp = strtr($sqlOpcionesCompSinProc,array(
            '_ids_' => $paramFunc(count($preguntasSinIndexar)),
        ));
        $opcionesCompCommand = Yii::app()->db->createCommand($sqlOpcionesComp);
        foreach ($preguntasSinIndexar as $i=>$preg) {
            $opcionesCompCommand->bindValue(":param_$i",$preg['id']);
        }
        $opcionesCompSinProcesar = $opcionesCompCommand->queryAll();
        $opcionesCompPorPregunta = Arrays::from($opcionesCompSinProcesar)
            ->group($preguntaIdFn)
            ->obtain();
        //Fin de obtención de opciones Comp
        //Obtenemos preguntas Requeridas
        $sqlPreguntasRequeridasSinProc = <<<EOF
SELECT r.pregunta_id, r.tipo_requerimiento, r.datos FROM {{Requerimientos}} r WHERE r.pregunta_id IN (_ids_) 
EOF;
        $sqlPreguntasRequeridas = strtr($sqlPreguntasRequeridasSinProc, array(
            '_ids_' => $paramFunc(count($preguntasSinIndexar)),
        ));
        $commandRequeridas = Yii::app()->db->createCommand($sqlPreguntasRequeridas);
        foreach ($preguntasSinIndexar as $i=>$preg) {
            $commandRequeridas->bindValue(":param_$i",$preg["id"]);
        }
        $requerimientos = $commandRequeridas->queryAll();
        $requerimientosPorPregunta = Arrays::from($requerimientos)
            ->group($preguntaIdFn)
            ->obtain();
        //Fin de preguntas requeridas
        //Agrupamos datos
        foreach ($preguntasSinIndexar as $i=>$preg) {
            $commandRequeridas->bindValue(":param_$i",$preg['id']);
        }
        $preguntasRespondidas = array();
        foreach ($this->_colaRespuestas as &$respuesta) {
            //En caso de que la respuesta sea parte de un año, extraer indice de pregunta
            if (strpos("-",$respuesta["idPregunta"]) !== false) {
                $anoYPregunta = explode("-",$respuesta["idPregunta"]);
                $idPregunta = $anoYPregunta[0]; //El id está en la primera parte de la pregunta
            } else {
                $idPregunta = $respuesta["idPregunta"];
            }
            if ($respuesta["valor"]) {
                $preguntasRespondidas[] = $idPregunta;
            }
            if (isset($preguntasIndexadasPorPID[$idPregunta])) {
                $preguntaActual = $preguntasIndexadasPorPID[$respuesta["idPregunta"]];
            }
            else {
                $errores[] = "Pregunta no definida";
                continue;
            }
            if ($respuesta["ano"] !== false) {
                if ($respuesta["ano"] > $this->ano 
                    || $respuesta["ano"] < ($this->ano - 12)) {
                        $errores[] = "Año inválido en " . $preguntaActual["enunciado"];
                    }
            }
            switch ($preguntaActual["tipo"]) {
                case 'email':
                    $respuesta["tipo"] = "email";
                    $valido = 
                        $emailValidator->validateValue($preguntaActual["valor"]);
                    if (!$valido) {
                        $errores[] = "El email " . $respuesta["valor"] . " en " . $preguntaActual["enunciado"] . " no es valido";
                    } 
                    break;
                case 'number':
                    $respuesta["tipo"] = "number";
                    $valido =
                        preg_match($numRealRegex,$respuesta["valor"]);
                    if (!$valido) {
                        $errores[] = "El número " . $respuesta["valor"] . " en " . $preguntaActual["enunciado"] . " no es valido";
                    }
                    break;
                case 'select':
                    $respuesta["tipo"] = "select";
                    if (isset($opcionesPorPregunta[$preguntaActual['id']])) {
                        $valido = false;
                        foreach ($opcionesPorPregunta[$preguntaActual["id"]] as $opcion) {
                            if ($opcion["identificador"] == $respuesta["valor"]) {
                                $valido = true;
                                break;
                            }
                        }
                    }
                    else {
                        $valido = false;
                    }
                    if (!$valido) {
                        if(isset($opcion["enunciado"]))
                            $errores[] = 
                                "La opcion " . $opcion["enunciado"] . " es inválida";
                        else {
                            $errores[] = "Opción invalida para pregunta " . $preguntaActual['id'];
                        }
                    }
                    break;
                default:
                    $respuesta["tipo"] = "abierta";
                    break;
            }
            if (isset($respuesta["indiceSubQ"])) {
                $valido = false;
                if (isset($opcionesCompPorPregunta[$preguntaActual["id"]])) {
                    foreach ($opcionesCompPorPregunta[$preguntaActual["id"]] as $opccomp) {
                        if ($opccomp["id"] == $respuesta["indiceSubQ"]) {
                            $valido = true;
                            break;
                        }
                    }
                }
                if (!$valido) {
                    $errores[] = 
                        "Respuesta inválida en [" 
                        . $preguntaActual["enunciado"] 
                        . "]";
                }
            }
        }
        $preguntasRespondidas = array_unique($preguntasRespondidas);
        foreach ($requerimientosPorPregunta as $idPregunta => $requerimientosDePreg) {
            foreach ($requerimientosDePreg as $req) {
                switch ($req["tipo_requerimiento"]) {
                    case 'requerida':
                        $valido = in_array($idPregunta,$preguntasRespondidas);
                        if (!$valido) {
                            $errores[] = "Pregunta " . $preguntasIndexadasPorPID[$idPregunta]["enunciado"] . " es requerida";
                        }
                        break;
                    
                    default:
                        
                        break;
                }
            }
        }
        return $errores;
    }
    public function meterColaRespuestas($indice,$valor,$indiceSubQ=false)
    {
        $trimmedIndice = trim((string) $indice);
        $tieneAno = strpos($trimmedIndice,"-") !== false;
        if ($tieneAno) {
            $explodedArray = explode("-",$trimmedIndice);
            $idPregunta = $explodedArray[0];
            $ano = $explodedArray[1];
        }
        else {
            $idPregunta = $trimmedIndice;
            $ano = false;
        }
        $arrayPregunta = array(
            'valor' => $valor,
            'idPregunta' => $idPregunta,
            'ano' => $ano,
        );
        if ($indiceSubQ !== false) {
            $arrayPregunta["indiceSubQ"] = trim((string) $indiceSubQ);
        }
        $this->_colaRespuestas[] = $arrayPregunta;
    }
    public function meterColaDeInsercion()
    {
        foreach ($this->_colaRespuestas as $respuesta) {
            if ($respuesta["ano"] === false) {
                switch ($respuesta["tipo"]) {
                    case 'email':
                    case 'abierta':
                        $this->_colaRespuestasAbiertas[] = $respuesta;
                        break;
                    case 'number':
                        $this->_colaRespuestasNum[] = $respuesta;
                        break;
                    case 'select':
                        $this->_colaRespuestasOpc[] = $respuesta;
                        break;
                        
                    default:
                        $this->_colaRespuestasAbiertas[] = $respuesta;      
                        break;
                }
            } else {
                $this->_colaRespuestasAno[] = $respuesta;
            }
        }        
    }
    protected function insertarPreguntasAbiertas()
    {
        $valoresAInsertar = array();
        foreach ($this->_colaRespuestasAbiertas as $respuesta) {
            $valoresAInsertar[] = array(
                'valor' => $respuesta["valor"],
                'user_id' => Yii::app()->user->id,
                'pregunta_id'  => $respuesta["idPregunta"],
                'encuesta_id' => $this->id,              
                'opcioncomp_id' => 
                    isset($respuesta["indiceSubQ"]) ? $respuesta["indiceSubQ"] : null,
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
            );
        }
        $command = Yii::app()
            ->db
            ->commandBuilder
            ->createMultipleInsertCommand("{{Respuestaabierta}}",$valoresAInsertar);
        return $command->execute();
    }
    protected function insertarPreguntasNum()
    {
        $valoresAInsertar = array();
        foreach ($this->_colaRespuestasNum as $respuesta) {
            $valoresAInsertar[] = array(
                'valor' => $respuesta["valor"],
                'user_id' => Yii::app()->user->id,
                'pregunta_id'  => $respuesta["idPregunta"],
                'encuesta_id' => $this->id,              
                'opcioncomp_id' => 
                    isset($respuesta["indiceSubQ"]) ? $respuesta["indiceSubQ"] : null,
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
            );
        }
        $command = Yii::app()
            ->db
            ->commandBuilder
            ->createMultipleInsertCommand("{{Respuestanum}}",$valoresAInsertar);
        return $command->execute();
    }
    protected function insertarPreguntasOpc()    
    {
        //Obtenemos valores de estas opciones
        $valoresRespuesta = Arrays::from($this->_colaRespuestasOpc)
            ->pluck("valor")
            ->unique()
            ->obtain();
        $opcionesSinIndexar = Yii::app()->db
            ->createCommand()
            ->select(array("id","identificador"))
            ->from("{{Opcion}}")
            ->where(array("in",'identificador',$valoresRespuesta))
            ->queryAll();
        $opcionesIndexadasPorIdentificador = Arrays::from($opcionesSinIndexar)
            ->group(function($val){
                return $val["identificador"];
            })->obtain();
        //Insertamos
        $valoresAInsertar = array();
        foreach ($this->_colaRespuestasOpc as $respuesta) {
            if (isset($opcionesIndexadasPorIdentificador[$respuesta["valor"]])) {
                $opcion_id =
                    $opcionesIndexadasPorIdentificador[$respuesta["valor"]][0]["id"];
            } else {
                throw new CException("Error al insertar opciones");
            }
            $valoresAInsertar[] = array(
                'opcion_id' => $opcion_id,
                'user_id' => Yii::app()->user->id,
                'pregunta_id'  => $respuesta["idPregunta"],
                'encuesta_id' => $this->id,              
                'opcioncomp_id' => 
                    isset($respuesta["indiceSubQ"]) ? $respuesta["indiceSubQ"] : null,
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
            );
        }
        $command = Yii::app()
            ->db
            ->commandBuilder
            ->createMultipleInsertCommand("{{Respuestaopc}}",$valoresAInsertar);
        return $command->execute();
    }
    protected function insertarPreguntasAno()
    {
        $valoresAInsertar = array();
        foreach ($this->_colaRespuestasAno as $respuesta) {
            $valoresAInsertar[] = array(
                'valor' => $respuesta["valor"],
                'ano' => $respuesta["ano"],
                'user_id' => Yii::app()->user->id,
                'pregunta_id'  => $respuesta["idPregunta"],
                'encuesta_id' => $this->id,              
                'opcioncomp_id' => 
                    isset($respuesta["indiceSubQ"]) ? $respuesta["indiceSubQ"] : null,
                'creado_en' => new CDbExpression('NOW()'),
                'actualizado_en' => new CDbExpression('NOW()'),
            );
        }
        $command = Yii::app()
            ->db
            ->commandBuilder
            ->createMultipleInsertCommand("{{Respuestaano}}",$valoresAInsertar);
        return $command->execute();
    }
    public function insertarEncuestaFinalizada()
    {
        $sql = <<<EOF
INSERT INTO {{Encuestarespondida}} (encuesta_id,user_id,fecha_respuesta) VALUES
    (:encuesta_id, :user_id, CURRENT_TIMESTAMP);
EOF;
        $command = Yii::app()->db->createCommand($sql);
        return $command->execute(array(
            ':user_id' => Yii::app()->user->id,
            ':encuesta_id' => $this->id,
        ));
    }
    public function insertarDatos()
    {
        $this->meterColaDeInsercion();
        $this->insertarPreguntasNum();
        $this->insertarPreguntasAbiertas();
        $this->insertarPreguntasAno();
        $this->insertarPreguntasOpc();
        $this->insertarEncuestaFinalizada();
    }
    
    public function getProyectosInnovacion($groupBy)
    {
        $sql = <<<EOF
SELECT COUNT(ra.valor), opc.identificador FROM {{Respuestaabierta}} ra
	INNER JOIN {{Opcioncomp}} opc ON ra.opcioncomp_id = opc.id
    INNER JOIN {{Pregunta}} p ON ra.pregunta_id = p.id
    INNER JOIN (
        SELECT _ra.opcioncomp_id AS id, _ra.user_id, _ra.encuesta_id FROM {{Respuestaabierta}} _ra
        	INNER JOIN {{Pregunta}} _p ON _ra.pregunta_id = _p.id
        WHERE _ra.valor = 1 AND _p.identificador = :identificador_int
    ) sub ON sub.id = ra.opcioncomp_id AND sub.user_id = ra.user_id AND sub.encuesta_id = ra.encuesta_id
WHERE ra.encuesta_id = :encuesta_id AND ra.valor <> :valor AND p.identificador = :identificador_ext
GROUP BY _group_
EOF;
        $sql = strtr($sql,array('_group_'=>$groupBy));
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(":valor","");
        $command->bindValue(":encuesta_id",$this->id);
        $command->bindValue(":identificador_int","preg_actividadesciencia_sino");
        $command->bindValue(":identificador_ext","preg_actividadesciencia_cuales");
        return $command->queryAll();
    }
    public function getEstadisticasPorOpcion($identificadores)
    {
        $fn = function($val){
            return ":param_$val";
        };
        $sql = <<<EOF
        SELECT COUNT(ro.opcion_id) AS cuenta,ro.user_id, o.identificador,o.enunciado FROM {{Respuestaopc}} ro
	INNER JOIN {{Pregunta}} p ON ro.pregunta_id = p.id
    INNER JOIN {{Opcion}} o ON ro.opcion_id = o.id
WHERE ro.encuesta_id = :encuesta_id AND p.identificador IN (_ids_)
GROUP BY ro.opcion_id
EOF;
        $sql = strtr($sql,array(
            '_ids_' => implode(",",array_map($fn,range(0,count($identificadores) - 1))),
        ));
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(":encuesta_id",$this->id);
        foreach ($identificadores as $i=>$id) {
            $command->bindValue($fn($i),$id);
        }
        return $command->queryAll();

    }
    public function getEstadisticasPorCheckbox($identificadores,$valor=1,$comparador = "=")
    {
        $sql = <<<EOF
SELECT COUNT(ra.valor) AS cuenta, p.identificador AS preg_ident, p.enunciado AS preg_enun, op.enunciado FROM {{Respuestaabierta}} ra
	INNER JOIN {{Pregunta}} p ON ra.pregunta_id = p.id
    LEFT JOIN {{Opcioncomp}} op ON ra.opcioncomp_id = op.id 
WHERE ra.valor $comparador :valor AND ra.encuesta_id = :encuesta_id AND p.identificador
    IN (_ids_)
GROUP BY p.id, op.id
EOF;

        $fn = function($val){
            return ":param_$val";
        };
        $sql = strtr($sql,array(
            '_ids_' => implode(",",array_map($fn,range(0,count($identificadores) - 1))),
        ));
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(":encuesta_id",$this->id);
        $command->bindValue(":valor",$valor);
        foreach ($identificadores as $i=>$id) {
            $command->bindValue($fn($i),$id);
        }
        return $command->queryAll();

    }
    public function getEstadisticasSumaRespuestaAno($identificadores)
    {
        $sql = <<<EOF
SELECT SUM(ra.valor) AS suma, p.identificador FROM {{Respuestaano}} ra
    INNER JOIN {{Pregunta}} p ON ra.pregunta_id = p.id
WHERE ra.encuesta_id = :encuesta_id AND p.identificador IN (_ids_)
GROUP BY ra.pregunta_id,ra.ano
EOF;
        $fn = function($val){
            return ":param_$val";
        };
        $sql = strtr($sql,array(
            '_ids_' => implode(",",array_map($fn,range(0,count($identificadores) - 1))),
        ));
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(":encuesta_id",$this->id);
        foreach ($identificadores as $i=>$id) {
            $command->bindValue($fn($i),$id);
        }
        return $command->queryAll();
    }
    public function getPublicacionesRevista()
    {
        $sql = <<<EOF
SELECT SUM(ra.valor), opc.identificador FROM {{Respuestaano}} ra
    INNER JOIN {{Opcioncomp}} opc ON ra.opcioncomp_id = opc.id
    INNER JOIN {{Pregunta}} p ON ra.pregunta_id = p.id
    INNER JOIN (
        SELECT _ra.opcioncomp_id AS id, _ra.user_id, _ra.encuesta_id FROM {{Respuestaabierta}} _ra
            INNER JOIN {{Pregunta}} _p ON _ra.pregunta_id = _p.id
        WHERE _ra.valor <> :valor_int AND _p.identificador = :identificador_int
    ) sub ON sub.id = ra.opcioncomp_id AND sub.user_id = ra.user_id AND sub.encuesta_id = ra.encuesta_id
WHERE ra.encuesta_id = :encuesta_id AND ra.valor <> :valor AND p.identificador = :identificador_ext
GROUP BY opc.id, ra.user_id
EOF;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(":valor_int","");
        $command->bindValue(":valor","");
        $command->bindValue(":identificador_int","preg_revistas_area_revista");
        $command->bindValue(":identificador_ext","preg_revistas_area_num");
        $command->bindValue(":encuesta_id",$this->id);
        return $command->queryAll();
    } 
}
