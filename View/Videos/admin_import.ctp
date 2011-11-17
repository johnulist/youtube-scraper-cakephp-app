<script language="javascript" type="text/javascript">

$(document).ready(function() {

	$("#checkbox_all").click(function() {
		var checked_status = this.checked;
		$("input:checkbox").each(function() {
	  		this.checked = checked_status;
		});
	});

});

</script>

<h2>Import</h2>

<?php echo $this->Form->create('Videos', array('action' => 'import', 'type' => 'get')); ?>
<?php echo $this->Form->input('type', array('type' => 'select', 'options' => array('q' => 'Search', 'author' => 'Uploader'), 'selected' => $type)); ?>
<br />
<?php echo $this->Form->input('name', array('value' => $name)); ?>
<br />
<?php echo $this->Form->end('Submit');?>

<br />
<br />

<?php if(!empty($items)) : ?>

<?php $i = 1; ?>

<?php echo $this->Form->create(NULL, array('action' => 'importadd')); ?>

<table class="tbl">
<tr>
<th></th>
<th>Video</th>
<th>Thumb</th>
<th>Name</th>
<th>Slug</th>
<th>Description</th>
<th>Keywords</th>
<th>Time</th>
<th>Uploader</th>
<th>YouTube ID</th>
<th><input type="checkbox" id="checkbox_all"></th>
</tr>
<?php foreach($items as $item) : ?>
<tr>
<td><?php echo $i++; ?></td>
<td><a class="iframe" href="http://www.youtube.com/embed/<?php echo $item['vid']; ?>?autoplay=1">Video</a></td>
<td><img src="http://i1.ytimg.com/vi/<?php echo $item['vid']; ?>/default.jpg"></td>
<td><?php echo $item['name']; ?></td>
<td><?php echo $item['slug']; ?></td>
<td><?php echo $item['description']; ?></td>
<td><?php echo $item['keywords']; ?></td>
<td><?php echo $item['minutes']; ?></td>
<td><?php echo $this->Html->link($item['uploader'], array('action' => 'import', '?type=author&name=' . urlencode($item['uploader']))); ?></td>
<td><?php echo $item['vid']; ?></td>
<td><input type="checkbox" name="data[Video][sel][]"  value="<?php echo $item['uuid']; ?>" /></td>
</tr>
<?php endforeach; ?>
</table>

<br />

<?php echo $this->Form->end('Add Selected Videos');?>

<?php endif; ?>