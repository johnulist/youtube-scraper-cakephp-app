<h2>Videos</h2>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php //echo $this->Paginator->sort('thumbnail');?></th>
	<th><?php //echo $this->Paginator->sort('thumbnail');?></th>
	<th><?php echo $this->Paginator->sort('vid');?></th>
	<th><?php echo $this->Paginator->sort('name');?></th>
	<th><?php echo $this->Paginator->sort('slug');?></th>
	<th><?php echo $this->Paginator->sort('description');?></th>
	<th><?php echo $this->Paginator->sort('keywords');?></th>
	<th><?php echo $this->Paginator->sort('minutes');?></th>
	<th><?php echo $this->Paginator->sort('seconds');?></th>
	<th><?php echo $this->Paginator->sort('uploader');?></th>
	<th><?php echo $this->Paginator->sort('views');?></th>
	<th><?php echo $this->Paginator->sort('is_active');?></th>
	<th><?php echo $this->Paginator->sort('created');?></th>
	<th><?php echo $this->Paginator->sort('modified');?></th>
	<th class="actions"><?php echo __('Actions');?></th>
</tr>
<?php foreach ($videos as $video): ?>
<tr>
	<td><a class="iframe" href="http://www.youtube.com/embed/<?php echo $video['Video']['vid']; ?>?autoplay=1">Video</a></td>
	<td><a class="image" href="<?php echo $video['Video']['thumbnail']; ?>">Image</a></td>
	<td><?php echo h($video['Video']['vid']); ?></td>
	<td><?php echo h($video['Video']['name']); ?></td>
	<td><?php echo h($video['Video']['slug']); ?></td>
	<td><?php echo h($video['Video']['description']); ?></td>
	<td><?php echo h($video['Video']['keywords']); ?></td>
	<td><?php echo h($video['Video']['minutes']); ?></td>
	<td><?php echo h($video['Video']['seconds']); ?></td>
	<td><?php echo h($video['Video']['uploader']); ?></td>
	<td><?php echo h($video['Video']['views']); ?></td>
	<td><?php echo h($video['Video']['is_active']); ?></td>
	<td><?php echo h($video['Video']['created']); ?></td>
	<td><?php echo h($video['Video']['modified']); ?></td>
	<td class="actions">
		<?php echo $this->Html->link('View', '/' . $video['Video']['slug'], array('target' => '_blank')); ?>
		<?php echo $this->Html->link('Edit', array('action' => 'edit', $video['Video']['id'])); ?>
		<?php echo $this->Form->postLink('Delete', array('action' => 'delete', $video['Video']['id']), null, 'Are you sure you want to delete # %s?', $video['Video']['id']); ?>
	</td>
</tr>
<?php endforeach; ?>
</table>

<p><?php echo $this->Paginator->counter(array('format' => 'Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')); ?></p>

<div class="paging">
<?php echo $this->Paginator->prev('< previous', array(), null, array('class' => 'prev disabled')); ?>
<?php echo $this->Paginator->numbers(array('separator' => ' | ')); ?>
<?php echo $this->Paginator->next('next >', array(), null, array('class' => 'next disabled')); ?>
</div>

<h3>Actions</h3>
<ul>
<li><?php echo $this->Html->link('New Video', array('action' => 'add')); ?></li>
<li><?php echo $this->Html->link('List Lyrics', array('controller' => 'lyrics', 'action' => 'index')); ?> </li>
<li><?php echo $this->Html->link('New Lyric', array('controller' => 'lyrics', 'action' => 'add')); ?> </li>
</ul>
