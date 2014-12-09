<?php

/**
 * This is the model class for table "{{Tipoencuesta}}".
 *
 * The followings are the available columns in table '{{Tipoencuesta}}':
 * @property integer $id
 * @property string $enunciado
 * @property string $identificador
 * @property string $creado_en
 * @property string $actualizado_en
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property Encuesta[] $encuestas
 * @property Users $user
 * @property Grupo[] $sectirGrupos
 */

use Underscore\Types\Arrays;

class Tipoencuesta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{Tipoencuesta}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('enunciado, identificador', 'required'),
			array('enunciado', 'length', 'max'=>256),
			array('identificador', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, enunciado, identificador, creado_en, actualizado_en, user_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'encuestas' => array(self::HAS_MANY, 'Encuesta', 'tipoencuesta_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'sectirGrupos' => array(self::MANY_MANY, 'Grupo', '{{TipoencuestaGrupo}}(tipoencuesta_id, grupo_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'enunciado' => 'Enunciado',
			'identificador' => 'Identificador',
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
		$criteria->compare('enunciado',$this->enunciado,true);
		$criteria->compare('identificador',$this->identificador,true);
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
	 * @return Tipoencuesta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
    }
    /**
     * behaviors
     * @return array
     **/
    public function behaviors()
    {
        return array(
           'timestamp' => array(
               'class' => 'zii.behaviors.CTimestampBehavior',
               'createAttribute' => 'creado_en',
               'updateAttribute' => 'actualizado_en',
            )
        );
    }
    /**
     * Retorna los identificadores de los tipos de encuestas
     * @return array
     */
    public function getIdentificadoresTE()
    {
        $query = "SELECT id, identificador, enunciado FROM " . $this->tableName() . " ORDER BY identificador";
        $command = Yii::app()->db->createCommand($query);
        $vals = $command->queryAll();
        $retVal = array();
        foreach ($vals as $v) {
            $retVal[$v["id"]] = "(" . $v["identificador"] . "): " . $v["enunciado"];
        }
        return $retVal;
    }

    public function getPreguntasEncuesta()
    {
        /**
         * Obtenemos preguntas (Junto con sus valores lft y rgt
         */
        // Fixed query
        //Poner caching (Ya que es pesado)
        $sql = <<<EOF
SELECT p.enunciado, p.id, p.identificador, p.compuesta, p.tipo, pc.lft, pc.rgt, pc.grupocomp_id, pc.cuenta, pg.grupo_id FROM {{PreguntaGrupo}} pg 
	INNER JOIN {{Grupo}} g ON pg.grupo_id = g.id 
    INNER JOIN {{TipoencuestaGrupo}} teg ON teg.grupo_id = g.id 
    INNER JOIN {{Tipoencuesta}} te ON teg.tipoencuesta_id = te.id 
    INNER JOIN {{Pregunta}} p ON pg.pregunta_id = p.id 
    LEFT JOIN (
        SELECT node.pregunta_id,node.lft,node.rgt,COUNT(parent.pregunta_id) AS cuenta, node.grupocomp_id FROM 	({{Preguntacompuesta}} node, {{Preguntacompuesta}} parent )
		WHERE node.lft BETWEEN parent.lft AND parent.rgt AND node.grupocomp_id = parent.grupocomp_id
    	GROUP BY node.pregunta_id,node.grupocomp_id
        ) AS pc ON p.id = pc.pregunta_id 
WHERE te.id = :idencuesta
EOF;
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(":idencuesta",$this->id);
        $preguntas = $command->queryAll();
        $idPreguntas = Arrays::from($preguntas)->pluck('id')->obtain();
        /**
         * Obtenemos opciones
         */
        $sqlOpcs = <<<EOF
SELECT o.id, o.enunciado, o.identificador, po.pregunta_id FROM {{PreguntaOpc}} po INNER JOIN {{Opcion}} o ON po.opcion_id = o.id INNER JOIN {{Pregunta}} p ON po.pregunta_id = p.id WHERE p.id IN (_ids_)
EOF;
        $paramsOpc = array_map(function($id){
            return ":pregunta_$id";
        },range(0,count($idPreguntas) - 1));
        $sqlOpcs = strtr($sqlOpcs,array(
            '_ids_' => implode(",",$paramsOpc)
        ));
        $commandOpc = Yii::app()->db->createCommand($sqlOpcs);
        foreach ($idPreguntas as $i=>$val) {
            $commandOpc->bindValue($paramsOpc[$i],$val);
        }
        $opciones = $commandOpc->queryAll();
        /**
         * Obtenemos opciones compuestas
         */
        $sqlOpcComp = <<<EOF
SELECT oc.id, oc.enunciado, goc.grupocomp_id FROM {{GrupocompOpcioncomp}} goc INNER JOIN {{Opcioncomp}} oc ON goc.opcioncomp_id = oc.id WHERE goc.grupocomp_id IN (_ids_)
EOF;
        $idGrupoComps = Arrays::from($preguntas)->pluck('grupocomp_id')->obtain();
        $paramsOpc = array_map(function($id){
            return ":grupocomp_id_$id";
        },range(0,count($idPreguntas) - 1));
        $sqlOpcComp = strtr($sqlOpcComp,array(
            '_ids_' => implode(",",$paramsOpc)
        ));
        $commandOpc = Yii::app()->db->createCommand($sqlOpcComp);
        foreach ($idPreguntas as $i=>$val) {
            $commandOpc->bindValue($paramsOpc[$i],$val);
        }
        $opcionesComp = $commandOpc->queryAll();
        /**
         * Organizamos preguntas
         */
        $arrayFinal = Arrays::from($preguntas)->sort(function($val){
            return array(
                (int) $val["grupo_id"],
                (int) $val["grupocomp_id"],
                (int) $val["lft"]
            );
        });

        $arrayFinal = $arrayFinal->group(function($val){
            return $val["grupo_id"] . "-" . (int) $val["grupocomp_id"];
        });
        var_dump($arrayFinal->obtain());

    }
    
}
