<?php

class HomeActions extends ActionController {
    public function doFrontpage() {

        //Sets the header X-Robots-Tag value (which overwrites the default value set in RegistryItems.php)
        $this->registry->set('x-robots-tag', 'index, nofollow, noarchive, snippet');

        //Sets the meta robots value (which overwrites the default value set in RegistryItems.php)
        $this->registry->set('metaRobots', 'index, nofollow');

    }

    public function doAbout() {

        //Sets page title (which overwrites the default value set in RegistryItems.php)
        $this->registry->set('title', 'About SmallTimber');

    }

}

?>
