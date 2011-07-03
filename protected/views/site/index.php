<?php $this->pageTitle='WOC Project - Home'; ?>

<h1>Homepage</h1>

<p>WOC is an Open Source collaborative platform for making decisions. 
It's written in PHP on top of Yii framework. You can find more details in 
<?php echo CHtml::link(
                    'this page',
                    array('/site/page', 'view'=>'details')
            ) ?>
.</p>

<p>This website is a meta-WOC: it's purpose is to improve the development of WOC tool through the same WOC.</p>

<p><strong>Basic use:</strong> visit the 
<?php echo CHtml::link(
                    'Threads',
                    array('woc/thread/index')
            ) ?>
 section and vote for the suggestions that you think are the best. 
Wisdom of crowds will make the rest..</p>
