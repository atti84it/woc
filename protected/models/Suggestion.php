<?php

/**
 * This is the model class for table "suggestions".
 *
 * The followings are the available columns in table 'suggestions':
 * @property string $id
 * @property string $title
 * @property string $desc
 * @property integer $votes_up
 * @property integer $votes_mid
 * @property integer $votes_down
 */
class Suggestion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Suggestion the static model class
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
		return 'suggestions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('votes_up, votes_mid, votes_down', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>200),
			array('desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, desc, votes_up, votes_mid, votes_down', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'desc' => 'Desc',
			'votes_up' => 'Votes Up',
			'votes_mid' => 'Votes Mid',
			'votes_down' => 'Votes Down',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('votes_up',$this->votes_up);
		$criteria->compare('votes_mid',$this->votes_mid);
		$criteria->compare('votes_down',$this->votes_down);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}