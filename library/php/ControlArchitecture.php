<?php

class FrontController extends ActionController {

    //Declaring variable(s)
    private static $instance;
    private $regex;
    private $module;
    private $action;
    private $class;
    private $file;
    private $controller;

    //Class construct method
    public function __construct() {}

    //Starts new instance of this class with a singleton pattern
    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function dispatch($throwExceptions = false) {

        /* Checks for the GET variables $module and $action, and, if present,
         * strips them down with a regular expression function with a white
         * list of allowed characters, removing anything that is not a letter,
         * number, underscore or hyphen
         */
        $regex  = '/[^-_A-z0-9]+/';
        $module = isset($_GET['module']) ? preg_replace($regex, '', $_GET['module']) : 'home';
        $action = isset($_GET['action']) ? preg_replace($regex, '', $_GET['action']) : 'frontpage';

        /* Generates Actions class filename (example: HomeActions) and path to
         * that class (example: home/HomeActions.php)
         */
        $class = ucfirst($module) . 'Actions';
        $file  = $this->pageDir . '/' . $module . '/' . $class . '.php';

        try {

            //Checks for existance of file
            if (!is_file($file)) {
                throw new Exception('File not found!');
            }

            //Includes file
            require_once $file;

            /* Creates a new instance of the Actions class (example: $controller
             * = new HomeActions();), and passes the registry variable to the
             * ActionController class
             */
            $controller = new $class();
            $controller->setRegistry($this->registry);

            //Trys the setModule method in the ActionController class
            $controller->setModule($module);

            /* The ActionController dispatchAction method checks if the method
             * exists, then runs the displayView function in the
             * ActionController class
             */    
            $controller->dispatchAction($action);

        } catch(Exception $error) {

            /* An exception has occurred, and will be displayed if
             * $throwExceptions is set to true, else the generic error page
             * will be displayed
             */
            if($throwExceptions) {
                echo $error; //Displaying exception
            } else {
                header("Location: error"); //Displaying generic error page
            }
        }
    }
}

abstract class ActionController {

    //Declaring variable(s)
    protected $registry;
    protected $pageDir;
    private $template;
    private $module;
    private $action;

    //Class construct method
    public function __construct() {}

    public function setRegistry($registry) {

        //Sets the registry object
        $this->registry = $registry;

        /* Once the registry is loaded, the controller root directory path is
         * set from the registry.
         */
        $this->setPageDir();
    }

    //Sets the controller root directory from the value stored in the registry
    public function setPageDir() {
        $this->pageDir = $this->registry->get('pageDir');
    }

    //Sets the view template from the value stored in the registry
    public function setTemplate() {
        $this->template = $this->registry->get('template');
    }

    //Sets the module
    public function setModule($module) {
        $this->module = $module;
    }

    //Gets the module
    public function getModule() {
        return $this->module;
    }

    /* Checks for actionMethod in the Actions class (example: doFrontpage()
     * within home/HomeActions.php) with the method_exists function and, if
     * present, the actionMethod and displayView functions are executed
     */
    public function dispatchAction($action) {

        //Establishes the actionMethod variable (example: doFrontpage())
        $actionMethod = 'do' . ucfirst($action);

        /* Checks for actionMethod in the Actions class (example: doFrontpage()
         * within home/HomeActions.php)
         */
        if (!method_exists($this, $actionMethod)) {
            throw new Exception('Action not found!');
        }

        //Executes the actionMethod in the Actions class
        $this->$actionMethod();

        //Executes the displayView function
        $this->displayView($action);
    }

    public function displayView($action) {

        //Checks for the actionView
        if (!is_file($this->pageDir . '/' . $this->getModule() . '/' . $action . 'View.php')) {
            throw new Exception('View not found!');
        }

        //Sets $this->actionView to the path of the action View file
        $this->actionView = $this->pageDir . '/' . $this->getModule() . '/' . $action . 'View.php';

        //Sets path of the action View file into the registry
        $this->registry->set('actionView', $this->actionView);

        //Sets template name
        $this->setTemplate();

        //Includes template file within which the action View file is included
        require_once $this->pageDir . '/templates/' . $this->template . '.tpl';
    }
}

class Registry {

    //Declaring variable(s)
    private $store;
    private $registryItems = array();

    //Class construct method
    public function __construct() {}

    //Sets registry variable
    public function set($label, $object) {
        $this->store[$label] = $object;
    }

    //Gets registry variable    
    public function get($label) {
        if(isset($this->store[$label])) {
            return $this->store[$label];
        } else {
            return false;
        }
    }

    //Adds outside array of registry values to $this->store array
    public function addRegistryArray($registryItems) {
        foreach ($registryItems as $key => $value) {
            $this->set($key, $value);
        }
    }

    //Returns registry array
    public function getRegistryArray() {
        return $this->store;
    }
}

?>