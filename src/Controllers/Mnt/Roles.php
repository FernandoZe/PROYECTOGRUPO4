<?php

namespace Controllers\Mnt;

use Controllers\PublicController;
use Views\Renderer;

/**
 * Roles
 */
class Roles extends PublicController {
    public function run() :void
    {
        $viewData = array(
            "edit_enabled"=>true,
            "delete_enabled"=>true,
            "new_enabled"=>true
        );
        $viewData["roles"] = \Dao\Mnt\Roles::findAll();
        Renderer::render('mnt/roles', $viewData);
    }
}
?>
