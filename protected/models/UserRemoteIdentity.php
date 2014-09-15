<?php

/**
 * This is the model class for table "{{user_remote_identities}}".
 *
 * The followings are the available columns in table '{{user_remote_identities}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $provider
 * @property string $identifier
 * @property string $created_on
 * @property string $last_used_on
 *
 * The followings are the available model relations:
 * @property User $user
 */
class ExampleUserRemoteIdentity extends CActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public function tableName()
	{
		return '{{user_remote_identities}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('user_id, provider, identifier', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('provider, identifier', 'length', 'max'=>100),
			array('user_id', 'isUnique'),
		);
	}

	/**
	 * An inline validator that checkes if there are no existing records
	 * with same provider and identifier for specified user.
	 * @param string $attribute
	 * @param array $params
	 * @return boolean
	 */
	public function isUnique($attribute, $params)
	{
		return 0 === $this->countByAttributes(array(
			'user_id'=>$this->user_id,
			'provider'=>$this->provider,
			'identifier'=>$this->identifier,
		));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('models', 'ID'),
			'user_id' => Yii::t('models', 'User'),
			'provider' => Yii::t('models', 'Provider'),
			'identifier' => Yii::t('models', 'Identifier'),
			'created_on' => Yii::t('models', 'Created On'),
			'last_used_on' => Yii::t('models', 'Last Used On'),
		);
	}

	/**
	 * @param string $className active record class name.
	 * @return UserRemoteIdentity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	protected function beforeSave()
	{
		if ($this->isNewRecord) {
			$this->created_on = date('Y-m-d H:i:s');
		}
		return parent::beforeSave();
	}
}
