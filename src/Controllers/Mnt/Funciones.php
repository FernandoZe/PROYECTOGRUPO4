<?php

namespace Controllers\Mnt;

use Controllers\PublicController;
use Views\Renderer;

class Funciones extends PublicController {
   
    public function run() :void
    {
        $viewData = array(
            "edit_enabled"=>true,
            "delete_enabled"=>true,
            "new_enabled"=>true
        );
        $viewData["Funciones"] = \Dao\Mnt\Funciones::findAll();
        Renderer::render('mnt/Funciones', $viewData);
    }
}
?>