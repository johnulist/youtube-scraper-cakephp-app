<?php if($ajax != 1): ?>
<h1>Search</h1>
<br />
<br />
<?php echo $this->Form->create('Video', array('type' => 'GET')); ?>
<?php echo $this->Form->input('search', array('label' => false, 'div' => false, 'autocomplete' => 'off', 'value' => $search)); ?>
<?php echo $this->Form->submit('Search', array('div' => false, 'class' => 'submit')); ?>
<?php echo $this->Form->end(); ?>
<br />
<?php endif; ?>

<?php echo $this->Html->script('search.js', array('inline' => false)); ?>

<div id="all">
<br />
<?php if(!empty($search)) : ?>
<?php if(!empty($videos)) : ?>
<div class="d">
<?php
$i = 0;
foreach ($videos as $video):
$i++;
?>
<div class="g">
<a href="/<?php echo $video['Video']['slug']; ?>"><img src="/images/<?php echo $video['Video']['slug']; ?>.jpg" width="160" height="120" /></a><br />
<?php echo $this->Text->highlight($video['Video']['name'], $terms1, array('format' => '<b>\1</b>', 'html' => true)); ?>
<?php //echo $this->Html->link($video['Video']['name'], $this->Html->url(array('controller' => 'videos', 'action' => 'view', 'slug' => $video['Video']['slug']), true), array('escape' => false)); ?>

</div>
<?php
if (($i % 5) == 0 ) {echo "</div>\n<div class=\"d\">\n";}
endforeach;
?>
</div>
<?php else: ?>
<h3>No Results</h3>
<?php endif; ?>
<?php endif; ?>
</div>