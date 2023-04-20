<?php
namespace Controllers\Mnt;

use Controllers\PrivateController;
use Exception;
use Views\Renderer;

class Producto extends PrivateController{
    public $i=0;
    private $redirectTo = "index.php?page=Mnt-Productos";
    private $viewData = array(
        "mode" => "DSP",
        "modedsc" => "",
        "PrdId" => 0,
        "catid" => "",
        "PrdName" => "",
        "PrdPrecio" => "",
        "cantidad" => "",
        "img" => "",

        "PrdName_error"=> "",
        "general_errors"=> array(),
        "has_errors" =>false,
        "show_action" => true,
        "readonly" => false,
        "xssToken" =>""
    );
    private $modes = array(
        "DSP" => "Detalle de %s (%s)",
        "INS" => "Nueva Producto",
        "UPD" => "Editar %s (%s)",
        "DEL" => "Borrar %s (%s)",
    );

    private $modesAuth = array(
        "DSP" => "mnt_productos_view",
        "INS" => "mnt_productos_new",
        "UPD" => "mnt_productos_edit",
        "DEL" => "mnt_productos_delete"
    );
    public function run() :void
    {

        try {
            $this->page_loaded();
            if($this->isPostBack()){
                $this->validatePostData();
                if(!$this->viewData["has_errors"]){
                    $this->executeAction();
                }
            }
            $this->render();
        } catch (Exception $error) {
            unset($_SESSION["xssToken_Mnt_Producto"]);
            error_log(sprintf("Controller/Mnt/Producto ERROR: %s", $error->getMessage()));
            \Utilities\Site::redirectToWithMsg(
                $this->redirectTo,
                "Algo Inesperado Sucedió. Intente de Nuevo."
            );
        }
        /*
        1) Captura de Valores Iniciales QueryParams -> Parámetros de Query ? 
            https://ax.ex.com/index.php?page=abc&mode=UPD&id=1029
        2) Determinamos el método POST GET
        3) Procesar la Entrada
            3.1) Si es un POST
            3.2) Capturar y Validara datos del formulario
            3.3) Según el modo realizar la acción solicitada
            3.4) Notificar Error si hay
            3.5) Redirigir a la Lista
            4.1) Si es un GET
            4.2) Obtener valores de la DB sin no es INS
            4.3) Mostrar Valores
        4) Renderizar
        */

    }
    private function page_loaded()
    {
        if(isset($_GET['mode'])){
            if(isset($this->modes[$_GET['mode']])){
                if (!$this->isFeatureAutorized($this->modesAuth[$_GET['mode']])) {
                    throw new Exception("Mode is not Authorized!");
                } else {
                $this->viewData["mode"] = $_GET['mode'];
                }
            } else {
                throw new Exception("Mode Not available");
            }
        } else {
            throw new Exception("Mode not defined on Query Params");
        }
        if($this->viewData["mode"] !== "INS") {
            if(isset($_GET['PrdId'])){
                $this->viewData["PrdId"] = intval($_GET["PrdId"]);
            } else {
                throw new Exception("Id not found on Query Params");
            }
        }
    }
    private function validatePostData(){
        if(isset($_POST["xssToken"])){
            if(isset($_SESSION["xssToken_Mnt_Producto"])){
                if($_POST["xssToken"] !== $_SESSION["xssToken_Mnt_Producto"]){
                    throw new Exception("Invalid Xss Token no match");
                }
            } else {
                throw new Exception("Invalid Xss Token on Session");
            }
        } else {
            throw new Exception("Invalid Xss Token");
        }
        if(isset($_POST["PrdName"])){
            if(\Utilities\Validators::IsEmpty($_POST["PrdName"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["PrdName_error"] = "El nombre no puede ir vacío!";
            }
        } else {
            throw new Exception("PrdName not present in form");
        }
       
        if(isset($_POST["mode"])){
            if(!key_exists($_POST["mode"], $this->modes)){
                throw new Exception("mode has a bad value");
            }
            if($this->viewData["mode"]!== $_POST["mode"]){
                throw new Exception("mode value is different from query");
            }
        }else {
            throw new Exception("mode not present in form");
        }
        if(isset($_POST["PrdId"])){
            if(($this->viewData["mode"] !== "INS" && intval($_POST["PrdId"])<=0)){
                throw new Exception("PrdId is not Valid");
            }
            if($this->viewData["PrdId"]!== intval($_POST["PrdId"])){
                throw new Exception("PrdId value is different from query");
            }
        }else {
            throw new Exception("PrdId not present in form");
        }
        $this->viewData["catid"] = $_POST["catid"];
        $this->viewData["PrdName"] = $_POST["PrdName"];
        $this->viewData["PrdPrecio"] = $_POST["PrdPrecio"];
        $this->viewData["cantidad"] = $_POST["cantidad"];
        $this->viewData["img"] = $_POST["img"];
    }
    private function executeAction(){
        switch($this->viewData["mode"]){
            case "INS":
                $inserted = \Dao\Mnt\Productos::insert(
                    $this->viewData["catid"],
                    $this->viewData["PrdName"],
                    $this->viewData["PrdPrecio"],
                    $this->viewData["cantidad"],
                    $this->viewData["img"]

                    
                );
                if($inserted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Producto Creada Exitosamente"
                    );
                }
                break;
            case "UPD":
                $updated = \Dao\Mnt\Productos::update(
                    $this->viewData["catid"],
                    $this->viewData["PrdName"],
                    $this->viewData["PrdPrecio"],
                    $this->viewData["cantidad"],
                    $this->viewData["img"],

                    $this->viewData["PrdId"]       
                );
                if($updated > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Producto Actualizada Exitosamente"
                    );
                }
                break;
            case "DEL":
                $deleted = \Dao\Mnt\Productos::delete(
                    $this->viewData["PrdId"]
                );
                if($deleted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Producto Eliminada Exitosamente"
                    );
                }
                break;
        }
    }
    private function render(){
        $xssToken = md5("PRODUCTO" . rand(0,4000) * rand(5000, 9999));
        $this->viewData["xssToken"] = $xssToken;
        $_SESSION["xssToken_Mnt_Producto"] = $xssToken;

        if($this->viewData["mode"] === "INS") {
            $this->viewData["modedsc"] = $this->modes["INS"];
        } else {
            $tmpProductos = \Dao\Mnt\Productos::findById($this->viewData["PrdId"]);
            if(!$tmpProductos){
                throw new Exception("Producto no existe en DB");
            }
            //$this->viewData["PrdName"] = $tmpProductos["PrdName"];
            //$this->viewData["cantidad"] = $tmpProductos["cantidad"];
            \Utilities\ArrUtils::mergeFullArrayTo($tmpProductos, $this->viewData);
           
            $this->viewData["modedsc"] = sprintf(
                $this->modes[$this->viewData["mode"]],
                $this->viewData["catid"],
                $this->viewData["PrdName"],
                $this->viewData["PrdPrecio"],
                $this->viewData["cantidad"],
                $this->viewData["img"],

                $this->viewData["PrdId"]
            );
            if(in_array($this->viewData["mode"], array("DSP","DEL"))){
                $this->viewData["readonly"] = "readonly";
            }
            if($this->viewData["mode"] === "DSP") {
                $this->viewData["show_action"] = false;
            }
        }
        Renderer::render("mnt/producto", $this->viewData);
    }
}

?>
