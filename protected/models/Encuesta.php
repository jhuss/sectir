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
class Encuesta extends CActiveRecord
{
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
			array('tipoencuesta_id, enunciado, identificador', 'required'),
            array('tipoencuesta_id', 'exist', 'allowEmpty' => false, 'className' => 'Tipoencuesta', 'attributeName' => 'id'),
            array('enunciado', 'length', 'max'=>256),
            array('identificador', 'unique'),
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
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'tipoencuesta' => array(self::BELONGS_TO, 'Tipoencuesta', 'tipoencuesta_id'),
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
    public function behaviors()
    {
        return array(
           'timestamp' => array(
               'class' => 'zii.behaviors.CTimestampBehavior',
               'createAttribute' => 'creado_en',
               'updateAttribute' => 'actualizado_en',
           ),
           'defaultValue' => array(
               'class' => 'DefaultValueBehavior',
               'attribute' => 'user_id',
               'value' => Yii::app()->user->id,
           ),
        );
    }
}
