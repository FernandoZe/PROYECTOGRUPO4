<?php

namespace Controllers\Mnt;

use Controllers\PublicController;
use Views\Renderer;


class Inventarios extends PublicController {
  
    public function run() :void
    {
        $viewData = array(
            /*"edit_enabled"=>true,
            "delete_enabled"=>true,
            "new_enabled"=>true*/
        );
        $viewData["Inventarios"] = \Dao\Mnt\Inventarios::findAll();
        Renderer::render('mnt/Inventarios', $viewData);
    }
}
?>