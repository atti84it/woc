<?php
$this->breadcrumbs=array(
	'Suggestions'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Suggestion', 'url'=>array('index')),
	array('label'=>'Create Suggestion', 'url'=>array('create')),
	array('label'=>'Update Suggestion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Suggestion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Suggestion', 'url'=>array('admin')),
);
?>

<h1>View Suggestion #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'threadId',
		'userId',
		'title',
		'desc',
		'dateCreated',
		'votes_up',
		'votes_mid',
		'votes_down',
	),
)); ?>
