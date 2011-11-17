<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $title_for_layout; ?></title>
<meta name="description" content="<?php echo $description ; ?>" />
<meta name="keywords" content="<?php echo $keywords ; ?>" />
<link rel="stylesheet" type="text/css" href="/css/css.css" />
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/js.js"></script>
<?php echo $scripts_for_layout; ?>
</head>
<body>
<?php echo $this->Session->flash(); ?>
<?php echo $content_for_layout; ?>
<?php echo $this->element('sql_dump'); ?>
<br /><br />
<div id="menu"><a href="/">Home</a> | <a href="/search">Search</a></div>
<div id="footer"><?php echo date('Y'); ?></div>
</body>
</html>