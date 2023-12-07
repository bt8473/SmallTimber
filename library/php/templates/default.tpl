<?php

//Sets HTTP header response field values
header('Content-type: text/html; charset=utf-8');
header('Content-Language: en');
header('Cache-Control: no-cache');
header('Expires:' . gmdate('D, d M Y H:i:s T'));
header('Pragma: no-cache');
header('X-Robots-Tag:'. $this->registry->get('x-robots-tag'));
header('X-Powered-By: Me');

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

	<title><?php echo $this->registry->get('title'); ?></title>

	<meta name="author" content="<?php echo $this->registry->get('metaAuthor'); ?>" />
	<meta name="description" content="<?php echo $this->registry->get('metaDescription'); ?>" />
	<meta name="robots" content="<?php echo $this->registry->get('metaRobots'); ?>" />

	<link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/library/css/<?php echo $this->registry->get('stylesheet'); ?>.css" type="text/css" media="all" />
	<link rel="canonical" href="<?php echo $this->registry->get('linkCanonical'); ?>" />
</head>

<body>
	<header class="utmost">
		Find the <a href="https://github.com/bt8473/SmallTimber">SmallTimber repository</a> on GitHub.
	</header>
	
<?php

    //Includes the action View file
    require_once $this->registry->get('actionView');

?>

</body>

</html>