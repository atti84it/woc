<div class="view">

	<b><?php echo CHtml::encode($data->title); ?></b>	
	<br />
	<?php echo CHtml::encode($data->desc); ?>
	<br />

	<?php echo CHtml::encode($data->getAttributeLabel('votes_up')); ?>:
	<?php echo CHtml::encode($data->votes_up); ?>
	 &middot; 

	<?php echo CHtml::encode($data->getAttributeLabel('votes_mid')); ?>:
	<?php echo CHtml::encode($data->votes_mid); ?>
	 &middot; 

	<?php echo CHtml::encode($data->getAttributeLabel('votes_down')); ?>:
	<?php echo CHtml::encode($data->votes_down); ?>


</div>
