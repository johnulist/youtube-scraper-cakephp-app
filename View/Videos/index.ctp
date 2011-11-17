<h1>Youtube Videos</h1>
<div class="d">
<?php
$i = 0;
foreach ($videos as $video):
$i++;
?>
<div class="g">
<a href="/<?php echo $video['Video']['slug']; ?>"><img src="/images/<?php echo $video['Video']['slug']; ?>.jpg" width="160" height="120" /></a><br />
<?php echo $this->Html->link($video['Video']['name'], $this->Html->url(array('controller' => 'videos', 'action' => 'view', 'slug' => $video['Video']['slug']), true), array('escape' => false)); ?></div>
<?php
if (($i % 5) == 0 ) {echo "</div>\n<div class=\"d\">\n";}
endforeach;
?>
</div>