<?php

namespace Utilities;

class Nav {

    public static function setNavContext(){
        $tmpNAVIGATION = array();
        $userID = \Utilities\Security::getUserId();

        if (\Utilities\Security::isAuthorized($userID, "Menu_MntQuotes")) {
            $tmpNAVIGATION[] = array(
                "nav_url" => "index.php?page=Mnt_Quotes",
                "nav_label" => "Citas"
            );
        }

        if (\Utilities\Security::isAuthorized($userID, "Menu_PaymentCheckout")) {
            $tmpNAVIGATION[] = array(
                "nav_url" => "index.php?page=Checkout_Checkout",
                "nav_label" => "Pagar"
            );
        }
        if (\Utilities\Security::isAuthorized($userID, "Menu_MntCategorias")) {
            $tmpNAVIGATION[] = array(
                "nav_url" => "index.php?page=Mnt_Categorias",
                "nav_label" => "Categorías"
            );
        }

        if (\Utilities\Security::isAuthorized($userID, "Menu_MntFunciones")) {
            $tmpNAVIGATION[] = array(
                "nav_url" => "index.php?page=Mnt_Funciones",
                "nav_label" => "Funciones"
            );
        }

        if (\Utilities\Security::isAuthorized($userID, "Menu_MntUsuarios")) {
            $tmpNAVIGATION[] = array(
                "nav_url" => "index.php?page=Mnt_Usuarios",
                "nav_label" => "Usuarios"
            );
        }

        if (\Utilities\Security::isAuthorized($userID, "Menu_MntRoles")) {
            $tmpNAVIGATION[] = array(
                "nav_url" => "index.php?page=Mnt_Roles",
                "nav_label" => "Roles "
            );
        }

        if (\Utilities\Security::isAuthorized($userID, "Menu_MntProductos")) {
            $tmpNAVIGATION[] = array(
                "nav_url" => "index.php?page=Mnt_Productos",
                "nav_label" => "Tienda"
            );
        }

        if (\Utilities\Security::isAuthorized($userID, "Menu_MntCarretillas")) {
            $tmpNAVIGATION[] = array(
                "nav_url" => "index.php?page=Mnt_Carretillas",
                "nav_label" => "Carrito"
            );
        }
        \Utilities\Context::setContext("NAVIGATION", $tmpNAVIGATION);
    }


    private function __construct()
    {
        
    }
    private function __clone()
    {
        
    }
}
?>
