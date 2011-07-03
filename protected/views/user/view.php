<?php
$this->breadcrumbs=array(
	'User',
);

$this->menu=array(
	array('label'=>'Update User', 'url'=>array('update')),
);
?>

<h1>User profile</h1>

<p>ID: <?php echo CHtml::encode($model->id) ?></p>

<?php if($model->id == Yii::app()->user->id){ ?>
    <p>Email: <?php echo CHtml::encode($model->email) ?></p>
<?php } ?>

<p>Nickname: <?php echo CHtml::encode($model->nickname) ?></p>

<p>Member since: <?php echo CHtml::encode($model->dateCreated) ?></p>

<p>Last login: <?php echo CHtml::encode($model->lastLogin) ?></p>
