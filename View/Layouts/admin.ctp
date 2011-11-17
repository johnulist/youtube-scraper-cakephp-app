<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin</title>
<?php
echo $this->Html->css(array('admin', 'jquery.fancybox-1.3.4.css'));
echo $this->Html->script(array('http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js', 'jquery.fancybox-1.3.4.pack.js', 'admin.js'));
echo $scripts_for_layout;
?>
</head>

<body>

<div class="menu">
<ul>
<li><?php echo $this->Html->link('Videos', array('controller' => 'videos', 'action' => 'index', 'admin' => true)); ?></li>
<li><?php echo $this->Html->link('Uploader', array('controller' => 'videos', 'action' => 'uploader', 'admin' => true)); ?></li>
<li><?php echo $this->Html->link('Import Videos', array('controller' => 'videos', 'action' => 'import', 'admin' => true)); ?></li>
</ul>
</div>

<div id="content">
<?php echo $this->Session->flash(); ?>
<?php echo $content_for_layout; ?>
<br />
<br />
<?php echo $this->element('sql_dump'); ?>
</div>

</body>
</html>