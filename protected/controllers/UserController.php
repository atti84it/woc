<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
            array('deny',
                'actions'=>array('register'),
                'users'=>array('@'),
            ),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index', 'register', 'recoverPassword'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update', 'view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

    /**
     * Generates a new password and sends via email
     */
    public function actionRecoverPassword()
    {
        $displayForm = true;
        
        if(isset($_POST['email']))
        {
            $user = User::model()->find('email = :email', array(':email'=>$_POST['email']));
            if ($user)
            {
                $user->cleanPassword = $user->generatePassword();
                $user->password = $user->hashPassword($user->cleanPassword);
                $result = $user->save();

                $emailSuccess = $user->sendAuthenticationEmail();
                
                Yii::app()->user->setFlash('emailSent','A new password has been sent to your email address');
                $displayForm = false;
            }
            else
            {
                Yii::app()->user->setFlash('emailNotFound','There\'s no user with that email');
            }
        }
        
        $this->render('recoverPassword', array(
            'displayForm'=>$displayForm,
        ));
    } 

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionRegister()
	{
		$model=new SiteUser;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SiteUser']))
		{
            $user = User::model()->find('email = :email', array(':email'=>$_POST['SiteUser']['email']));
            if($user)
                throw new CHttpException(400,'You are already registered');
            
			$model->attributes=$_POST['SiteUser'];
            $model->dateCreated = gmdate('Y-m-d H:i:s');

            if($model->validate())
            {
                $model->password = $model->hashPassword($model->newPassword);

                if($model->save())
				$this->redirect(array('view','id'=>$model->id));
            }
		}

		$this->render('register',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel(Yii::app()->user->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SiteUser']))
		{
			$model->attributes=$_POST['SiteUser'];

            if ($model->newPassword !== '') {
              $model->setScenario('changePassword');
            }

			if($model->validate())
            {
                if ($model->newPassword !== '')
                    $model->password = $model->hashPassword($model->newPassword);

                $model->dateUpdated = gmdate('Y-m-d H:i:s');
                
                if($model->save(false))
                    $this->redirect(array('view','id'=>$model->id));

            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = SiteUser::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
