<?php echo $this->Html->css(array('jstarbox.css'),'stylesheet', array('inline' => false )); ?>
<?php echo $this->Html->script('view.js', array('inline' => false)); ?>
<?php echo $this->Html->script('jstarbox.js', array('inline' => false)); ?>
<h1><?php echo $video['Video']['name']; ?> Music Video</h1>
<br />
<iframe width="820" height="470" src="http://www.youtube.com/embed/<?php echo $video['Video']['vid']; ?>" frameborder="0" allowfullscreen></iframe>
<h3><?php echo $video['Video']['name']; ?></h3>
<?php if (!empty($video['Lyric']['name'])) : ?>
<p><?php echo nl2br(h($video['Lyric']['name'])); ?></p>
<?php endif; ?>
<span class="starbox" id="<?php echo $video['Video']['id']; ?>" a="<?php echo $video['Video']['rating']; ?>"></span> <span id="starbox-text"></span><br /><br />
<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_button_google_plusone"></a>
</div><br />
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script>
<br />
<img src="/images/<?php echo $video['Video']['slug']; ?>.jpg" alt="<?php echo h($video['Video']['name']); ?>" /><br />
<?php echo $this->Html->link($video['Video']['name'], '/' . $video['Video']['slug']); ?>
<br /><br />
<?php
$i = 0;
foreach ($videos as $item):
$i++;
?>
<div class="g">
<img src="/images/<?php echo $item['Video']['slug']; ?>.jpg" width="160" height="120" /><br />
<?php echo $this->Html->link($item['Video']['name'], $this->Html->url(array('controller' => 'videos', 'action' => 'view', 'slug' => $item['Video']['slug']), true), array('escape' => false)); ?></div>
<?php
if (($i % 5) == 0 ) {echo "</div>\n<div class=\"d\">\n";}
endforeach;
?>
</div>