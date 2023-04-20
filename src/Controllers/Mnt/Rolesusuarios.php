<?php

namespace Controllers\Mnt;

use Controllers\PublicController;
use Views\Renderer;


class Rolesusuarios extends PublicController {
  
    public function run() :void
    {
        $viewData = array(
            /*"edit_enabled"=>true,
            "delete_enabled"=>true,
            "new_enabled"=>true*/
        );
        $viewData["Rolesusuarios"] = \Dao\Mnt\Rolesusuarios::findAll();
        Renderer::render('mnt/Rolesusuarios', $viewData);
    }
}
?>