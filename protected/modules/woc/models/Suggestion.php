<?php

/**
 * This is the model class for table "suggestions".
 *
 * The followings are the available columns in table 'suggestions':
 * @property string $id
 * @property integer $threadId
 * @property integer $userId
 * @property string $title
 * @property string $desc
 * @property string $dateCreated
 * @property integer $votes_up
 * @property integer $votes_mid
 * @property integer $votes_down
 */
class Suggestion extends CActiveRecord
{
    /**
     * Error message on voting operations
     */
    public $errorMsg;
    
    const VOTE_UP = 3;
    const VOTE_MID = 2;
    const VOTE_DOWN = 1;
    
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
		return Yii::app()->getModule('woc')->dbTablePrefix . 'suggestions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, threadId, userId, dateCreated', 'required'),
			array('threadId, votes_up, votes_mid, votes_down', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>200),
			array('desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, threadId, title, desc, votes_up, votes_mid, votes_down, userId, dateCreated', 'safe', 'on'=>'search'),
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
            'threadId' => 'Thread id',
			'title' => 'Title',
			'desc' => 'Desc',
            'dateCreated' => 'Date of creation',
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
        $criteria->compare('ThreadId',$this->threadId);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('votes_up',$this->votes_up);
		$criteria->compare('votes_mid',$this->votes_mid);
		$criteria->compare('votes_down',$this->votes_down);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    
    /**
     * Returns an associative array with:
     *   'type': one of 'up, mid, down'
     *   'opacity': strenght of decision
     */
    public function getPrevalentVote()
    {   
        $totVotes = $this->votes_up + $this->votes_mid + $this->votes_down;
        if ($this->votes_up >= $this->votes_mid) 
            if ($this->votes_up >= $this->votes_down) 
                $type = 'up';
             else 
                $type = 'down';
         else 
            if ($this->votes_mid >= $this->votes_down) 
                $type = 'mid';
             else 
                $type = 'down';
        
        $var = 'votes_' . $type;
        
        $opacity = ($this->totVotes != 0) ? $this->{$var} / $this->totVotes : 0.2;
        
        return array('type' => $type, 'opacity' => $opacity);
    }
    
    public function getTotVotes()
    {
        return $this->votes_up + $this->votes_mid + $this->votes_down;
    }
    
    /**
     * Registers a vote
     * @param string $type One of 'up', 'mid', 'down'
     * @return boolean according to success
     */
    public function vote($type)
    {
        if (in_array($type, array('up','mid','down')))
        {
            $vote = Vote::model()->findAll(array(
                'condition' => 'suggestionId = :suggestionId AND userId = :userId',
                'params' => array(
                    ':suggestionId' => $this->id, 
                    ':userId' => Yii::app()->user->id
                ),
            ));
            if ($vote)
            {
                $this->errorMsg = 'You already voted for this suggestion!';
                return false;
            } else {
                $const = 'Suggestion::VOTE_' . strtoupper($type);
                $vote = new Vote;
                $vote->suggestionId = $this->id;
                $vote->userId = Yii::app()->user->id;
                $vote->datetime = gmdate('Y-m-d H:i:s');
                $vote->type = constant($const);
                
                $result = $vote->save();
                if ($result)
                {
                    $attribute = 'votes_' . $type;
                    $this->$attribute += 1;
                    $this->save();
                    return true;
                } else {
                    $this->errorMsg = 'Internal DB error';
                    return false;
                }
            }
        } else {
            $this->errorMsg = 'Invalid option';
            return false;
        }
    }
    
    public function votesPercent($type)
    {
        if ($this->totVotes == 0)
            return 0;
        $var = 'votes_' . $type;
        return ($this->$var / $this->totVotes) * 100;
        
    }
}
