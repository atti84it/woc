<?php 
$assetsUrl = Yii::app()->getModule('woc')->assetsUrl; 
$prevalentVote = $data->getPrevalentVote();
?>
<div class="suggestion-view">

    <div class="suggestion-left-container">
        <div class="smiley-container">
            <img src="<?php echo $assetsUrl; ?>images/smiley_<?php echo $prevalentVote['type']; ?>.png" style="opacity: <?php echo $prevalentVote['opacity']; ?>">
        </div>
        <div style="width: 70px" title="Up:<?php echo $data->votes_up ?> mid:<?php echo $data->votes_mid ?> down:<?php echo $data->votes_down ?>">
            <div class="colored-visualizer" style="background: #027C00; width: <?php echo $data->votesPercent('up') ?>%"></div>
            <div class="colored-visualizer" style="background: #FFCC2A; width: <?php echo $data->votesPercent('mid') ?>%"></div>
            <div class="colored-visualizer" style="background: #C6000C; width: <?php echo $data->votesPercent('down') ?>%"></div>
        </div>
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
    </div>

	
    <div class="">
        <b><?php echo CHtml::encode($data->title); ?></b>	
        <br />
        <?php echo CHtml::encode($data->desc); ?>
        <br />

        <!--
        <?php echo CHtml::encode($data->getAttributeLabel('votes_up')); ?>:
        <?php echo CHtml::encode($data->votes_up); ?>
         &middot; 

        <?php echo CHtml::encode($data->getAttributeLabel('votes_mid')); ?>:
        <?php echo CHtml::encode($data->votes_mid); ?>
         &middot; 

        <?php echo CHtml::encode($data->getAttributeLabel('votes_down')); ?>:
        <?php echo CHtml::encode($data->votes_down); ?>
        -->
    </div>

</div>
