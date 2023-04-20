<?php
/**
 * Archivo Controlador de Categorias el Listado
 */
namespace Controllers\Mnt;

use Controllers\PrivateController;
use Views\Renderer;

/**
 * Productos
 */
class Productos extends PrivateController {
    /**
     * Handles Categorias Request
     *
     * @return void
     */
    public function run() :void
    {  
     
        $viewData = array();
        $viewData["productos"] = \Dao\Mnt\Productos::findAll();
        /*
            "edit_enabled"=>true,
            "delete_enabled"=>true,
            "new_enabled"=>true,
            "cont"=>$cont
        */

        $viewData["productos_view"] = $this->isFeatureAutorized('mnt_productos_view');
        $viewData["productos_edit"] = $this->isFeatureAutorized('mnt_productos_edit');
        $viewData["productos_delete"] = $this->isFeatureAutorized('mnt_productos_delete');
        $viewData["productos_new"] = $this->isFeatureAutorized('mnt_productos_new');
        /**
         * HACER OTRO PARA AGREGAR CARRITO
         */


    
        Renderer::render('mnt/productos', $viewData);
    }
}
?>
