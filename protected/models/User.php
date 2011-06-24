<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $email
 * @property string $nickname
 * @property string $registration_date
 * @property string $updated_date
 * @property string $last_login
 * @property integer $karma
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, registration_date', 'required'),
			array('karma', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>25),
			array('nickname', 'length', 'max'=>70),
			array('updated_date, last_login', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, nickname, registration_date, updated_date, last_login, karma', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'nickname' => 'Nickname',
			'registration_date' => 'Registration Date',
			'updated_date' => 'Updated Date',
			'last_login' => 'Last Login',
			'karma' => 'Karma',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('registration_date',$this->registration_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('karma',$this->karma);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}