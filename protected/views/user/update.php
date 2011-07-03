<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update your profile</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
