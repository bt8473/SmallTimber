<?php

//Controller path
$registryItems['pageDir'] = CTR_ROOT; //Required by controller

//Default template
$registryItems['template'] = 'default'; //Name of .tpl file

//Default template settings
$registryItems['x-robots-tag']    = 'noindex, nofollow, noarchive, nosnippet';
$registryItems['title']           = 'SmallTimber: A simple, no-frills PHP framework';
$registryItems['metaAuthor']      = 'The SmallTimber Team';
$registryItems['metaDescription'] = 'SmallTimber is a simple, no-frills PHP framework';
$registryItems['metaRobots']      = 'noindex, nofollow';
$registryItems['stylesheet']      = 'default'; //Name of .css file
$registryItems['linkCanonical']   = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

?>