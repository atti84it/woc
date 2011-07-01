<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $email
 * @property string $password
 * @property string $nickname
 * @property string $dateCreated
 * @property string $dateUpdated
 * @property string $lastLogin
 * @property integer $karma
 */
class User extends CActiveRecord
{
    /**
     * Stores unhashed password
     */
    public $cleanPassword;
    
    /**
     * Contains salt to hash password
     */
    private $salt = 'salt';
    
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
			array('email, dateCreated', 'required'),
			array('karma', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>25),
			array('nickname', 'length', 'max'=>70),
			array('dateUpdated, lastLogin, password', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, nickname, dateCreated, dateUpdated, lastLogin, karma', 'safe', 'on'=>'search'),
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
            'password' => 'Password',
			'nickname' => 'Nickname',
			'dateCreated' => 'Registration Date',
			'dateUpdated' => 'Updated Date',
			'lastLogin' => 'Last Login',
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
		$criteria->compare('dateCreated',$this->dateCreated,true);
		$criteria->compare('dateUpdated',$this->dateUpdated,true);
		$criteria->compare('lastLogin',$this->lastLogin,true);
		$criteria->compare('karma',$this->karma);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    
    /**
     * $params = array('verificationCode'=>$verificationCode, 'email'=>$email)
     */
    public static function hotlog($params)
    {
        $ca = Yii::app()->getController()->createAction('captcha');
        if (! $ca->validate($params['verificationCode'], false) )
            return 'wrongcode';
            
        $exists = User::model()->find('email = :email', array(':email'=>$params['email']));
        if ($exists)
            return 'emailexists';
        
        $user = new User;
        $user->email = $params['email'];
        $user->dateCreated = date('Y-m-d H:i:s'); //TODOdate
        
        $user->cleanPassword = $user->generatePassword();
        $user->password = $this->hashPassword($user->cleanPassword);
        $result = $user->save();
        
        $emailSuccess = $user->sendAuthenticationEmail();
        
        if ($result)
            return 'ok';
        else
            return 'dberror';
    }
    
    /**
     * Generates a 9 digit alphanumeric random password
     */
    public function generatePassword()
    {
        $pass = '';
        $c = array('b','c','d','f','g','h','j','k','l','m','n','p','q','r','s','t','v','z');
        $v = array('a','e','i','o','u');
        
        for ($i=1; $i<=3; $i++)
        {
            $pass .= array_rand($c);
            $pass .= array_rand($v);
        }
        
        for ($i=1; $i<=3; $i++)
        {
            $pass .= rand(0,9);
        }
        
        return $pass;
    }
    
    public function hashPassword($password)
    {
        return md5($password . $this->salt);
    }
    
    /**
     * Sends an email to the user with authentication
     * This will be improved in future releases to provide a more secure way (TODO)
     */
    public function sendAuthenticationEmail()
    {
        return $this->sendPasswordEmail();
    }
    
    /**
     * Sends an email to user with password in it
     */
    public function sendPasswordEmail()
    {
        $subject='Subscription to ' . Yii::app()->name; // or? CHtml::encode(Yii::app()->name)
        $body='You can now login with the following credentials. Username: ' . $this->email . ' Password: ' . $this->cleanPassword . ' ';
        $headers='From: noreply@woc.demo';
		return mail($this->email,$subject,$body,$headers);
    }
}
