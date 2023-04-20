<?php
namespace Controllers\Mnt;

use Controllers\PublicController;
use Exception;
use Utilities\ArrUtils;
use Views\Renderer;

class Inventario extends PublicController{
    private $redirectTo = "index.php?page=Mnt-Inventarios";
    private $viewData = array(
        "mode" => "DSP",
        "modedsc" => "",

        "invId" => 0,
        "invCategoriaCod" => "",
        "invPrdCod" => "",
        "existencias" => "",
        "fecha" => "",
        
        "general_errors"=> array(),
        "has_errors" =>false,
        "show_action" => true,
        "readonly" => false,
        "xxsToken"=>""
    );
    private $modes = array(
        "DSP" => "Detalle de %s (%s)",
        "INS" => "Nuevo Inventario",
        "UPD" => "Editar %s (%s)",
        "DEL" => "Borrar %s (%s)"
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
            unset($_SESSION["xxsToken_Mnt_Inventario"]);
            error_log(sprintf("Controller/Mnt/Inventario ERROR: %s", $error->getMessage()));
            \Utilities\Site::redirectToWithMsg(
                $this->redirectTo,
                "Algo Inesperado Sucedió. Intente de Nuevo."
            );
        }
   
    }

    private function page_loaded()
    {
        if(isset($_GET['mode'])){
            if(isset($this->modes[$_GET['mode']])){
                $this->viewData["mode"] = $_GET['mode'];
            } else {
                throw new Exception("Mode Not available");
            }
        } else {
            throw new Exception("Mode not defined on Query Params");
        }
        if($this->viewData["mode"] !== "INS") {
            if(isset($_GET['invId'])){
                $this->viewData["invId"] = intval($_GET["invId"]);
            } else {
                throw new Exception("Id not found on Query Params");
            }
        }
    }

    private function validatePostData(){
        if(isset($_POST["xssToken"])){
            if(isset($_SESSION["xssToken_Mnt_Inventario"])){
                if($_POST["xssToken"] !== $_SESSION["xssToken_Mnt_Inventario"]){
                    throw new Exception("Invalid Xss Token no match");
                }
            } else {
                throw new Exception("Invalid Xss Token on Session");
            }
        } else {
            throw new Exception("Invalid Xss Token");
        }

        if(isset($_POST["invCategoriaCod"])){
            if(\Utilities\Validators::IsEmpty($_POST["invCategoriaCod"])){
                $this->viewData["has_errors"] = true;
            }
        } else {
            throw new Exception("invCategoriaCod not present in form");
        }

        if(isset($_POST["invPrdCod"])){
            if(\Utilities\Validators::IsEmpty($_POST["invPrdCod"])){
                $this->viewData["has_errors"] = true;
            }
        }else {
            throw new Exception("InvPrdCod not present in form");
        }

        if(isset($_POST["existencias"])){
            if(\Utilities\Validators::IsEmpty($_POST["existencias"])){
                $this->viewData["has_errors"] = true;
            }
        } else {
            throw new Exception("existencias not present in form");
        }
       
        if(isset($_POST["fecha"])){
            if(\Utilities\Validators::IsEmpty($_POST["fecha"])){
                $this->viewData["has_errors"] = true;
            }
        }else {
            throw new Exception("fecha not present in form");
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
        if(isset($_POST["invId"])){
            if(($this->viewData["mode"] !== "INS" && intval($_POST["invId"])<=0)){
                throw new Exception("invId is not Valid");
            }
            if($this->viewData["invId"]!== intval($_POST["invId"])){
                throw new Exception("invId value is different from query");
            }
        }else {
            throw new Exception("invId not present in form");
        }
        $tmpPostData= array(
            "invCategoriaCod"=>$_POST["invCategoriaCod"],
            "invPrdCod"=>$_POST["invPrdCod"],
            "existencias"=>$_POST["existencias"],
            "fecha"=>$_POST["fecha"]

        );

        \Utilities\ArrUtils::mergeArrayTo(
           $tmpPostData,
            $this->viewData
        );

        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["invPrdCod"] = $_POST["invPrdCod"];
        }
       
    }

    
    private function executeAction(){
        switch($this->viewData["mode"]){
            case "INS":
                $inserted = \Dao\Mnt\Inventarios::insert(
                    $this->viewData["invCategoriaCod"],
                    $this->viewData["invPrdCod"],
                    $this->viewData["existencias"],
                    $this->viewData["fecha"]
                    

                );
                if($inserted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Inventario Creado Exitosamente"
                    );
                }
                break;
            case "UPD":
                $updated = \Dao\Mnt\Inventarios::update(
                    $this->viewData["invCategoriaCod"],
                    $this->viewData["invPrdCod"],
                    $this->viewData["existencias"],
                    $this->viewData["fecha"],
                    $this->viewData["invId"]
                );
                if($updated > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Inventario Actualizado Exitosamente"
                    );
                }
                break;
            case "DEL":
                $deleted = \Dao\Mnt\Inventarios::delete(
                    $this->viewData["invId"]
                );
                if($deleted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Inventario Eliminado Exitosamente"
                    );
                }
                break;
        }
    }
    private function render(){
        $xssToken = md5("Inventario" . rand(0,4000) * rand(5000, 9999));
        $this->viewData["xssToken"] = $xssToken;
        $_SESSION["xssToken_Mnt_Inventario"] = $xssToken;
       
        if($this->viewData["mode"] === "INS") {
            $this->viewData["modedsc"] = $this->modes["INS"];
        } else {
            $tmpInventarios = \Dao\Mnt\Inventarios::findById($this->viewData["invId"]);
            if(!$tmpInventarios){
                throw new Exception("Inventario no existe en DB");
            }
          
            \Utilities\ArrUtils::mergeFullArrayTo($tmpInventarios, $this->viewData);
            
            $this->viewData["modedsc"] = sprintf(
                $this->modes[$this->viewData["mode"]],
                $this->viewData["invCategoriaCod"],
                $this->viewData["invPrdCod"],
                $this->viewData["invId"]

            );
            if(in_array($this->viewData["mode"], array("DSP","DEL"))){
                $this->viewData["readonly"] = "readonly";
            }
            if($this->viewData["mode"] === "DSP") {
                $this->viewData["show_action"] = false;
            }
        }
        Renderer::render("mnt/Inventario", $this->viewData);
    }
}

?>