<div class="view">

	<b><?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?></b><br />

	<?php echo CHtml::encode($data->short_desc); ?>
	<br />

	<?php echo CHtml::encode(substr($data->desc,0,60)); ?> ...<?php echo CHtml::link('(read more)', array('view', 'id'=>$data->id)); ?>
	<br />


</div>
