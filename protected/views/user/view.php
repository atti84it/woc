<?php
$this->breadcrumbs=array(
	'Users',
	$model->id,
);

$this->menu=array(
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
);
?>

<h1>View User #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'email',
		'password',
		'nickname',
		'dateCreated',
		'dateUpdated',
		'lastLogin',
		'karma',
	),
)); ?>
