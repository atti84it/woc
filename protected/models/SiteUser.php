<?php

/**
 * This class overrides Woc module's User module class
 */
class SiteUser extends User
{   
    /**
     * Needed for changing password
     */
    public $newPassword;
    public $newPasswordConfirm;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}    
    
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('newPassword', 'compare', 'compareAttribute'=>'newPasswordConfirm', 'on'=>'register, changePassword'),
            array('newPassword', 'required', 'on'=>'register'),
        
            //User class stuff
			array('email, dateCreated', 'required'),
			array('karma', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>40),
			array('nickname', 'length', 'max'=>70),
			array('dateUpdated, lastLogin, password, newPassword, newPasswordConfirm', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, nickname, dateCreated, dateUpdated, lastLogin, karma', 'safe', 'on'=>'search'),
		);
	}
    
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'newPassword' => 'New password',
            'newPasswordConfirm' => 'Confirm new password',
        
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
}
