<?php
$this->breadcrumbs=array(
	'Threads',
);

$this->menu=array(
	array('label'=>'Create Thread', 'url'=>array('create')),
);
?>

<h1>Threads</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
