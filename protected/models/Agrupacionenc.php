<?php

/**
 * This is the model class for table "{{Agrupacionenc}}".
 *
 * The followings are the available columns in table '{{Agrupacionenc}}':
 * @property integer $id
 * @property string $nombre
 * @property integer $user_id
 * @property string $creado_en
 * @property string $actualizado_en
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Encuesta[] $encuestas
 */
class Agrupacionenc extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{Agrupacionenc}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre', 'required'),
			array('nombre', 'length', 'max'=>64),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, user_id, creado_en, actualizado_en', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'encuestas' => array(self::HAS_MANY, 'Encuesta', 'agrupacionenc_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'user_id' => 'User',
			'creado_en' => 'Creado En',
			'actualizado_en' => 'Actualizado En',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('creado_en',$this->creado_en,true);
		$criteria->compare('actualizado_en',$this->actualizado_en,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Agrupacionenc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    /**
     * Retorna los identificadores de los grupos de encuestas 
     * @return array
     */
    public function getIdentificadoresGrupoEnc()
    {
        $query = "SELECT id, nombre FROM " . $this->tableName() . " ORDER BY nombre";
        $command = Yii::app()->db->createCommand($query);
        $vals = $command->queryAll();
        $retVal = array();
        foreach ($vals as $v) {
            $retVal[$v['id']] = $v['nombre'];
        }
        return $retVal;
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
