<?php

//General configurations
require_once 'configurations.php';

//Additional includes
require_once CTR_ROOT . '/RegistryItems.php';       //Default registry items
require_once CTR_ROOT . '/ControlArchitecture.php'; //Controller with registry

//Instantiating registry object
$registry = new Registry();
$registry->addRegistryArray($registryItems);

//Instantiating front controller object
$controller = FrontController::getInstance();
$controller->setRegistry($registry);
$controller->dispatch();

?>
