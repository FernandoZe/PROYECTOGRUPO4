<?php
/**
 * Archivo Controlador de Categorias el Listado
 */
namespace Controllers\Mnt;

use Controllers\PrivateController;
use Views\Renderer;

/**
 * Categorias
 */
class Carretillas extends PrivateController {
    /**
     * Handles Categorias Request
     *
     * @return void
     */
    public function run() :void
    {
        $viewData = array(
            "edit_enabled"=>true,
            "delete_enabled"=>true,
            "new_enabled"=>true
        );
        $viewData["carretillas"] = \Dao\Mnt\Carretillas::findAll();
        Renderer::render('mnt/carretillas', $viewData);
    }
}
?>
