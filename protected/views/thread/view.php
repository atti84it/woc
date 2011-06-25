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

    <?php echo $this->renderPartial('/suggestion/_view', array('data'=>$s)); ?>

<?php endforeach; ?>

<div id="suggestions">

    <h3>New suggestion</h3>
 
    <?php if(Yii::app()->user->hasFlash('suggestionSubmitted')): ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('suggestionSubmitted'); ?>
        </div>
    <?php else: ?>
        <?php $this->renderPartial('/suggestion/_form',array(
            'model'=>$suggestion,
        )); ?>
    <?php endif; ?>
 
</div><!-- suggestions -->

<script>
    $(function(){
        
        $('div.side-controls > img').mouseenter(function(){
            $(this).addClass('light');
        }).mouseleave(function(){
            $(this).removeClass('light');
        }).click(function(){
            var clickedContainer = $(this).parent();
            var suggestionId = $(this).attr('id').split('-')[1];
            var type = $(this).attr('id').split('-')[2];
            $(this).parent().html('<img src="images/wait2.gif">');
            $.ajax({
                url: 'index.php?r=suggestion/ajaxVote', //TODO chtml::link or whatever
                data: {id: suggestionId, type: type},
                success: function (data) {
                    clickedContainer.html(data.msg);
                },
                dataType: 'json',
            });
        });
        
    });
</script>
