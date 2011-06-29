<?php
$assetsUrl = Yii::app()->getModule('woc')->assetsUrl;

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
    <br />
    Enter your email address and verification code to join us in one click!<br />
    <br />
    <div id="hotlog-captcha"></div>
    <label for="hotlog-verification-code">Verification code:</label>
    <input size="10" maxlength="40" id="hotlog-verification-code" type="text" /><br />
    <label for="hotlog-email">Email address:</label>
    <input size="30" maxlength="40" id="hotlog-email" type="text" /><br />
    <input id="hotlog-submit" value="Join" type="button" /><br /><br />
    <div>Please provide a valid email address. You will get your password there.</div>
    <div id="hotlog-result"></div>
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

        $('.side-controls-overlay').hide();  // Hide overlay div initially
        
        $('div.side-controls > img').mouseenter(function(){
            $(this).addClass('light');
        }).mouseleave(function(){
            $(this).removeClass('light');
        }).click(function(){
            /* Current structure is:
             * side-controls-container
             *   side-controls
             *     img *3
             *   side-controls-overlay
             * So clickedContainer points to root div
             */
            var clickedContainer = $(this).parent().parent();
            var suggestionId = $(this).attr('id').split('-')[1];
            var type = $(this).attr('id').split('-')[2];
            var timerVote = setTimeout(function(){timeout(clickedContainer)},10000);            
            
            // The following lines replace arrow controls with waiting animated gif
            var height=$(clickedContainer).height(); // optionally add .children('.side-controls')
            var width =$(clickedContainer).width();
            $(clickedContainer).children('.side-controls-overlay').height(height);
            $(clickedContainer).children('.side-controls-overlay').width(width);
            $(clickedContainer).children('.side-controls').hide();
            $(clickedContainer).children('.side-controls-overlay').show();

            $.ajax({
                url: '<?php echo $this->createUrl('/woc/suggestion/ajaxVote'); ?>',
                data: {id: suggestionId, type: type},
                dataType: 'json',
                success: function (data) {
                    clearTimeout(timerVote);
                    restoreControls(clickedContainer);
                    if (data.code == 'ok')
                    {
                        var imgId = '#vote-' + suggestionId + '-' + type; 
                        $(imgId).addClass('light');
                        // TODO increment corresponding voted number +1
                    } else if (data.code == 'isguest') {
                        $('#prompt-hotlog').fadeIn('fast');
                        $.ajax({
                            url: '<?php echo $this->createUrl('/woc/user/ajaxCaptchaPicture'); ?>',
                            dataType: 'html',
                            success: function (data) {
                                $('#hotlog-captcha').html(data);
                            }
                        });
                    } else {
                        $('#message').html(data.msg);
                        //$('#prompt-message').position({my:'left top', at:'left bottom', of:clickedContainer}); // TODO Not working
                        $('#prompt-message').fadeIn('fast');
                    }
                }                
            });
        });
        
        $('#hotlog-submit').click(function(){
            var verificationCode = $('#hotlog-verification-code').val();
            var email = $('#hotlog-email').val();
            //TODO disable code, email and button
            //TODO show wait... + img
            //TODO enable timeout and refactor name of previous timeout function
            $.ajax({
                url: '<?php echo $this->createUrl('/woc/user/ajaxHotlog'); ?>',
                data: {verificationCode: verificationCode, email: email},
                dataType: 'json',
                success: function (data){
                    if (data.code == 'ok')
                    {
                        $('#hotlog-result').html('Succesful registration! You may now login using the password that has been sent to your email address');
                    } else if (data.code == 'wrongcode') {
                        $('#hotlog-result').html('Verification code is not correct');
                    } else if (data.code == 'emailexisting') {
                        $('#hotlog-result').html('You are already a member. Have you forgot your password?');
                    } else if (data.code == 'dberror') {
                        $('#hotlog-result').html('Unknown database error :(');
                    }
                }
            });
        });
        
        $('.close-link').click(function(){
            $(this).parent().hide();
        });
        
        function restoreControls(target){
            $(target).children('.side-controls').show();
            $(target).children('.side-controls-overlay').hide();
        }
    });
    
    function timeout(clickedContainer)
    {
        restoreControls(clickedContainer);
    }
    
</script>
