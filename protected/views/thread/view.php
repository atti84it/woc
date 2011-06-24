<?php
$this->breadcrumbs=array(
	'Threads'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Thread', 'url'=>array('index')),
	array('label'=>'Create Thread', 'url'=>array('create')),
	array('label'=>'Update Thread', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Thread', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Thread', 'url'=>array('admin')),
);
?>

<h1><?php echo CHtml::encode($model->title); ?></h1>

<p><?php echo CHtml::encode($model->short_desc); ?></p>

<?php echo CHtml::encode($model->desc); ?>

<?php foreach($suggestions as $s):?>

<p><b><?php echo CHtml::encode($s->title); ?></b></p>

<p><?php echo CHtml::encode($s->desc); ?></p>

<?php endforeach; ?>
