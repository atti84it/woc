<?php $assetsUrl = Yii::app()->getModule('woc')->assetsUrl; ?>
<div class="view">

    <div class="side-controls-container">
        <div class="side-controls">
            <img src="<?php echo $assetsUrl; ?>images/up20x24.png" id="<?php echo 'vote-' . $data->id . '-up';?>" >
            <img src="<?php echo $assetsUrl; ?>images/mid20x24.png" id="<?php echo 'vote-' . $data->id . '-mid';?>" >
            <img src="<?php echo $assetsUrl; ?>images/down20x24.png" id="<?php echo 'vote-' . $data->id . '-down';?>" >
        </div>
        <div class="side-controls-overlay">
            <img src="<?php echo $assetsUrl; ?>images/wait2.gif">
        </div>
        
    </div>
	
    <div class="">
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



</div>
