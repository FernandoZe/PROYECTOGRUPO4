<?php
namespace Controllers\Mnt;

use Controllers\PublicController;
use Exception;
use Utilities\ArrUtils;
use Views\Renderer;

class Rolesusuario extends PublicController{
    private $redirectTo = "index.php?page=Mnt-Rolesusuarios";
    private $viewData = array(
        "mode" => "DSP",
        "modedsc" => "",

        "usercod" => "",
        "rolescod" => "CLIENTE",
        "rolescod_CLIENTE" => "selected",
        "rolescod_ADMIN" => "",
        "roleuserest" => "ACT",
        "roleuserest_ACT" => "selected",
        "roleuserest_INA" => "",
        "roleuserfch" => "",
        "roleuserexp" => "",
        
        "general_errors"=> array(),
        "has_errors" =>false,
        "show_action" => true,
        "readonly" => false,
        "xxsToken"=>""
    );
    private $modes = array(
        "DSP" => "Detalle de %s (%s)",
        "INS" => "Nuevo Roles Usuarios",
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
            unset($_SESSION["xxsToken_Mnt_Rolesusuario"]);
            error_log(sprintf("Controller/Mnt/Rolesusuario ERROR: %s", $error->getMessage()));
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
            if(isset($_GET['usercod'])){
                $this->viewData["usercod"] = intval($_GET["usercod"]);
            } else {
                throw new Exception("Id not found on Query Params");
            }
        }
    }

    private function validatePostData(){
        if(isset($_POST["xssToken"])){
            if(isset($_SESSION["xssToken_Mnt_Rolesusuario"])){
                if($_POST["xssToken"] !== $_SESSION["xssToken_Mnt_Rolesusuario"]){
                    throw new Exception("Invalid Xss Token no match");
                }
            } else {
                throw new Exception("Invalid Xss Token on Session");
            }
        } else {
            throw new Exception("Invalid Xss Token");
        }

        if(isset($_POST["rolescod"])){
            if (!in_array( $_POST["rolescod"], array("CLIENTE","ADMIN"))){
                throw new Exception("rolescod incorrect value");
            }
        } else {
            if($this->viewData["mode"]!=="DEL") {
                throw new Exception("rolescod not present in form");
            }
        }

        if(isset($_POST["roleuserest"])){
            if (!in_array( $_POST["roleuserest"], array("ACT","INA"))){
                throw new Exception("roleuserest incorrect value");
            }
        }else {
            if($this->viewData["mode"]!=="DEL") {
                throw new Exception("roleuserest not present in form");
            }
        }
        if(isset($_POST["roleuserfch"])){
            if (floatval( $_POST["roleuserfch"])<=0){
                throw new Exception("roleuserfch incorrect value");
            }
        }else {
            if($this->viewData["mode"]!=="DEL") {
                throw new Exception("roleuserfch not present in form");
            }
        }

        if(isset($_POST["roleuserexp"])){
            if(\Utilities\Validators::IsEmpty($_POST["roleuserexp"])){
                throw new Exception("roleuserexp incorrect value");
            }
        } else {
            throw new Exception("roleuserexp not present in form");
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
        
        $tmpPostData= array(
            "usercod"=>$_POST["usercod"],
            "rolescod"=>$_POST["rolescod"],
            "roleuserfch"=>$_POST["roleuserfch"],
            "roleuserexp"=>$_POST["roleuserexp"]

        );

        \Utilities\ArrUtils::mergeArrayTo(
           $tmpPostData,
            $this->viewData
        );

        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["roleuserest"] = $_POST["roleuserest"];
        }
       
    }

    
    private function executeAction(){
        switch($this->viewData["mode"]){
            case "INS":
                $inserted = \Dao\Mnt\Rolesusuarios::insert(
                    $this->viewData["usercod"],
                    $this->viewData["rolescod"],
                    $this->viewData["roleuserest"],
                    $this->viewData["roleuserfch"],
                    $this->viewData["roleuserexp"]
                    

                );
                if($inserted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Roles Creado Exitosamente"
                    );
                }
                break;
            case "UPD":
                $updated = \Dao\Mnt\Rolesusuarios::update(
                    $this->viewData["rolescod"],
                    $this->viewData["roleuserest"],
                    $this->viewData["roleuserfch"],
                    $this->viewData["roleuserexp"],
                    $this->viewData["usercod"]
                );
                if($updated > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Roles Actualizado Exitosamente"
                    );
                }
                break;
            case "DEL":
                $deleted = \Dao\Mnt\Rolesusuarios::delete(
                    $this->viewData["usercod"]
                );
                if($deleted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Roles Eliminado Exitosamente"
                    );
                }
                break;
        }
    }
    private function render(){
        $xssToken = md5("ROLES_USUARIO" . rand(0,4000) * rand(5000, 9999));
        $this->viewData["xssToken"] = $xssToken;
        $_SESSION["xssToken_Mnt_Rolesusuario"] = $xssToken;
       
        if($this->viewData["mode"] === "INS") {
            $this->viewData["modedsc"] = $this->modes["INS"];
        } else {
            $tmpRolesusuarios = \Dao\Mnt\Rolesusuarios::findById($this->viewData["usercod"]);
            if(!$tmpRolesusuarios){
                throw new Exception("Rolesusuario no existe en DB");
            }
          
            \Utilities\ArrUtils::mergeFullArrayTo($tmpRolesusuarios, $this->viewData);
            $this->viewData["rolescod_CLIENTE"] = $this->viewData["rolescod"] === "CLIENTE" ? "selected": "";
            $this->viewData["rolescod_ADMIN"] = $this->viewData["rolescod"] === "ADMIN" ? "selected": "";

            $this->viewData["roleuserest_ACT"] = $this->viewData["roleuserest"] === "ACT" ? "selected": "";
            $this->viewData["roleuserest_INA"] = $this->viewData["roleuserest"] === "INA" ? "selected": "";

            $this->viewData["modedsc"] = sprintf(
                $this->modes[$this->viewData["mode"]],
                $this->viewData["roleuserfch"],
                $this->viewData["usercod"]

            );
            if(in_array($this->viewData["mode"], array("DSP","DEL"))){
                $this->viewData["readonly"] = "readonly";
            }
            if($this->viewData["mode"] === "DSP") {
                $this->viewData["show_action"] = false;
            }
        }
        Renderer::render("mnt/Rolesusuario", $this->viewData);
    }
}

?>