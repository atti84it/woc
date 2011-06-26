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

<div id="prompt-hotlog" class="prompt">
    <div class="close-link"><a href="#">close</a></div><br />
    You must be registered to vote<br />
    Enter your email address and verification code to join us in one click!<br />
    <input size="30" maxlength="40" id="hotlog-email" type="text" />
    <input id="hotlog-submit" value="Join" type="button" />
</div>

<div id="prompt-message" class="prompt">
    <div class="close-link"><a href="#">close</a></div><br />
    <span id="message"></span>
</div>

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
            var timer = setTimeout(function(){timeout(clickedContainer)},10000);
            $(this).parent().html('<img src="images/wait2.gif">');
            $.ajax({
                url: 'index.php?r=suggestion/ajaxVote', //TODO chtml::link or whatever
                data: {id: suggestionId, type: type},
                success: function (data) {
                    clearTimeout(timer);
                    if (data.code == 'ok')
                    {
                        clickedContainer.html(data.msg);
                    } else if (data.code == 'isguest') {
                        clickedContainer.html(''); // Change this, must be overlay
                        $('#prompt-hotlog').fadeIn('fast');
                    } else {
                        clickedContainer.html(''); // Change this, must be overlay
                        $('#message').html(data.msg);
                        //$('#prompt-message').position({my:'left top', at:'left bottom', of:clickedContainer}); // Not working
                        $('#prompt-message').fadeIn('fast');
                    }
                },
                dataType: 'json',
            });
        });
        
        $('.close-link').click(function(){
            $(this).parent().hide();
        });
    });
    
    function timeout(clickedContainer)
    {
        clickedContainer.html(''); // Change this, must be overlay
    }
    
    /*
function timedCount() {
    if ( (tmp=jQuery('#bigboxDetails .gt-cell-actived').children('.gt-inner').html()) != cell_value ) {
        cell_value=tmp;
        jQuery('#descripcion').html(cell_value);
        if (cell_value != null) {
            image(cell_value);
        }
    }

    t=setTimeout("timedCount()",100);
}    
    */
</script>
