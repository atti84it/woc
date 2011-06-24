<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'suggestion-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'threadId'); ?>
		<?php echo $form->textField($model,'threadId',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'threadId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc'); ?>
		<?php echo $form->textArea($model,'desc',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'votes_up'); ?>
		<?php echo $form->textField($model,'votes_up'); ?>
		<?php echo $form->error($model,'votes_up'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'votes_mid'); ?>
		<?php echo $form->textField($model,'votes_mid'); ?>
		<?php echo $form->error($model,'votes_mid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'votes_down'); ?>
		<?php echo $form->textField($model,'votes_down'); ?>
		<?php echo $form->error($model,'votes_down'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->