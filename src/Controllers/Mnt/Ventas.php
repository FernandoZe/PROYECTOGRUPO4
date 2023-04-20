<?php

// ---------------------------------------------------------------
// Sección de imports
// ---------------------------------------------------------------
namespace Controllers\Mnt;
use Controllers\PublicController;
use Views\Renderer;

class Ventas extends PublicController
{
    /**
     * Runs the controller
     *
     * @return void
     */
    public function run():void
    {
       
        $viewData = array(
            "edit_enabled"=>true,
            "delete_enabled"=>true,
            "new_enabled"=>true,
            "Ventas"=> \Dao\Mnt\Ventas::getAll()
        );

        Renderer::render('mnt/ventas', $viewData);
    }
}

?>
