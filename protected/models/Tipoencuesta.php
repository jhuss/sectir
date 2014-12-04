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
			array('enunciado, identificador, creado_en, user_id', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('enunciado', 'length', 'max'=>256),
			array('identificador', 'length', 'max'=>32),
			array('actualizado_en', 'safe'),
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
}
