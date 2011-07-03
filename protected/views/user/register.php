<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Login', 'url'=>array('site/login')),
);
?>

<h1>Register</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
