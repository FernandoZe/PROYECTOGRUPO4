<?php
namespace Controllers\Mnt;

use Controllers\PublicController;
use Exception;
use Views\Renderer;

class Rol extends PublicController{
    private $redirectTo = "index.php?page=Mnt-Roles";
    private $viewData = array(
        "mode" => "DSP",
        "modedsc" => "",
        "rolescod" => 0,
        "rolesdsc" => "",
        "rolesest" => "ACT",
        "rolesest_ACT" => "selected",
        "rolesest_INA" => "",
        "rolesdsc_error"=> "",
        "general_errors"=> array(),
        "has_errors" =>false,
        "show_action" => true,
        "readonly" => false,
        "xssToken" =>""
    );
    private $modes = array(
        "DSP" => "Detalle de %s (%s)",
        "INS" => "Nuevo Rol",
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
            unset($_SESSION["xssToken_Mnt_Rol"]);
            error_log(sprintf("Controller/Mnt/Rol ERROR: %s", $error->getMessage()));
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
            if(isset($_GET['rolescod'])){
                $this->viewData["rolescod"] = intval($_GET["rolescod"]);
            } else {
                throw new Exception("Id not found on Query Params");
            }
        }
    }
    private function validatePostData(){
        if(isset($_POST["xssToken"])){
            if(isset($_SESSION["xssToken_Mnt_Rol"])){
                if($_POST["xssToken"] !== $_SESSION["xssToken_Mnt_Rol"]){
                    throw new Exception("Invalid Xss Token no match");
                }
            } else {
                throw new Exception("Invalid Xss Token on Session");
            }
        } else {
            throw new Exception("Invalid Xss Token");
        }
        if(isset($_POST["rolesdsc"])){
            if(\Utilities\Validators::IsEmpty($_POST["rolesdsc"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["rolesdsc_error"] = "La descripcion no puede ir vacío!";
            }
        } else {
            throw new Exception("rolesdsc not present in form");
        }
        if(isset($_POST["rolesest"])){
            if (!in_array( $_POST["rolesest"], array("ACT","INA"))){
                throw new Exception("rolesest incorrect value");
            }
        }else {
            if($this->viewData["mode"]!=="DEL") {
                throw new Exception("rolesest not present in form");
            }
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
        if(isset($_POST["rolescod"])){
            if(($this->viewData["mode"] !== "INS" && intval($_POST["rolescod"])<=0)){
                throw new Exception("rolescod is not Valid");
            }
            if($this->viewData["rolescod"]!== intval($_POST["rolescod"])){
                throw new Exception("rolescod value is different from query");
            }
        }else {
            throw new Exception("rolescod not present in form");
        }
        $this->viewData["rolesdsc"] = $_POST["rolesdsc"];
        if($this->viewData["mode"]!=="DEL"){
            $this->viewData["rolesest"] = $_POST["rolesest"];
        }
    }
    private function executeAction(){
        switch($this->viewData["mode"]){
            case "INS":
                $inserted = \Dao\Mnt\Roles::insert(
                    $this->viewData["rolescod"],
                    $this->viewData["rolesdsc"],
                    $this->viewData["rolesest"]
                );
                if($inserted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Rol Creado Exitosamente"
                    );
                }
                break;
            case "UPD":
                $updated = \Dao\Mnt\Roles::update(
                    $this->viewData["rolesdsc"],
                    $this->viewData["rolesest"],
                    $this->viewData["rolescod"]
                );
                if($updated > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Rol Actualizado Exitosamente"
                    );
                }
                break;
            case "DEL":
                $deleted = \Dao\Mnt\Roles::delete(
                    $this->viewData["rolescod"]
                );
                if($deleted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Rol Eliminada Exitosamente"
                    );
                }
                break;
        }
    }
    private function render(){
        $xssToken = md5("ROL" . rand(0,4000) * rand(5000, 9999));
        $this->viewData["xssToken"] = $xssToken;
        $_SESSION["xssToken_Mnt_Rol"] = $xssToken;

        if($this->viewData["mode"] === "INS") {
            $this->viewData["modedsc"] = $this->modes["INS"];
        } else {
            $tmpRoles = \Dao\Mnt\Roles::findById($this->viewData["rolescod"]);
            if(!$tmpRoles){
                throw new Exception("Rol no existe en DB");
            }
            \Utilities\ArrUtils::mergeFullArrayTo($tmpRoles, $this->viewData);
            $this->viewData["rolesest_ACT"] = $this->viewData["rolesest"] === "ACT" ? "selected": "";
            $this->viewData["rolesest_INA"] = $this->viewData["rolesest"] === "INA" ? "selected": "";
            $this->viewData["modedsc"] = sprintf(
                $this->modes[$this->viewData["mode"]],
                $this->viewData["rolesdsc"],
                $this->viewData["rolescod"]
            );
            if(in_array($this->viewData["mode"], array("DSP","DEL"))){
                $this->viewData["readonly"] = "readonly";
            }
            if($this->viewData["mode"] === "DSP") {
                $this->viewData["show_action"] = false;
            }
        }
        Renderer::render("mnt/rol", $this->viewData);
    }
}

?>