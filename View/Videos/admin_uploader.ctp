<?php foreach ($videos as $key => $value): ?>
<a href="/admin/videos/import?type=author&name=<?php echo $value; ?>"><?php echo $value; ?></a><br />
<?php endforeach; ?>
