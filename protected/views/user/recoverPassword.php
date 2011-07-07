<?php
$this->breadcrumbs=array(
	'User'=>array('index'),
	'Recover your password',
);

$this->menu=array(
	array('label'=>'Register', 'url'=>array('register')),
    array('label'=>'Login', 'url'=>array('site/login')),
);
?>

<h1>Recover your password</h1>
<br /><br />

<?php 
if (Yii::app()->user->hasFlash('emailNotFound'))
{
    echo '<div class="flash-error">' . Yii::app()->user->getFlash('emailNotFound') . '</div>';
} 
if (Yii::app()->user->hasFlash('emailSent'))
{
    echo '<div class="flash-success">' . Yii::app()->user->getFlash('emailSent') . '</div>';
} 
?>

<?php if($displayForm) { ?>
<div class="form">
<?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::label('Enter your email: ','email'); ?>
    <?php echo CHtml::textField('email') ?>
    
    <?php echo CHtml::submitButton('Send'); ?>
    
<?php echo CHtml::endForm(); ?>
</div>

<?php } // End display form ?>

<br /><br />
