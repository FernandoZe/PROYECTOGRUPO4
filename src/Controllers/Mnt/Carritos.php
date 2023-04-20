<?php
/**
 * Archivo Controlador de Categorias el Listado
 */
namespace Controllers\Mnt;

use Controllers\PublicController;
use Views\Renderer;

/**
 * Categorias
 */
class Carritos extends PublicController {
    /**
     * Handles Categorias Request
     *
     * @return void
     */
    public function run() :void
    {
        $viewData = array(
            "edit_enabled"=>true
            
        );
        
        $viewData["Carritos"] = \Dao\Mnt\Carrito::addcarrito();
        Renderer::render('mnt/Carrito', $viewData);
    }
}
?>
