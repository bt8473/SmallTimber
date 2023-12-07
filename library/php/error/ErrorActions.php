<?php

class ErrorActions extends ActionController {
    public function doError() {

        //Sets page title
        $this->registry->set('title', 'Opps, There\'s been an error...');

    }
}

?>
