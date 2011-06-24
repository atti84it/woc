<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('threadId')); ?>:</b>
	<?php echo CHtml::encode($data->threadId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc')); ?>:</b>
	<?php echo CHtml::encode($data->desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('votes_up')); ?>:</b>
	<?php echo CHtml::encode($data->votes_up); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('votes_mid')); ?>:</b>
	<?php echo CHtml::encode($data->votes_mid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('votes_down')); ?>:</b>
	<?php echo CHtml::encode($data->votes_down); ?>
	<br />


</div>