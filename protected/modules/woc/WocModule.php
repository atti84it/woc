<?php

class WocModule extends CWebModule
{
    /**
     * Stores the url to access the assets.
     * This property is used in views.
     */
    public $assetsUrl;
    
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'woc.models.*',
			'woc.components.*',
		));
        
        $assetsDir = dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
        $this->assetsUrl = Yii::app()->getAssetManager()->publish($assetsDir, false, -1, true).DIRECTORY_SEPARATOR; //PRODUCTION TODO do not republish
        Yii::app()->getClientScript()->registerCssFile($this->assetsUrl . 'woc.css', "screen, projection");
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
