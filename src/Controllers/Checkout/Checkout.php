<?php

namespace Controllers\Checkout;

use Controllers\PublicController;

class Checkout extends PublicController{
    public function run():void
    {
   
        $viewData = array(
    
        );
        if ($this->isPostBack()) {
            $PayPalOrder = new \Utilities\Paypal\PayPalOrder(
                "test".(time() - 10000000),
                "http://localhost/mvc_nw_202301-MAIN/index.php?page=checkout_error",
                "http://localhost/mvc_nw_202301-MAIN/index.php?page=checkout_accept"
            );
            $carretilla=\Dao\Mnt\Carretillas::findAll();

            foreach($carretilla as $s){
                $PayPalOrder->addItem($s['PrdName'], $s['PrdId'], $s['usercod'], $s['PrdPrecio'], 10, 1, "DIGITAL_GOODS");
            }
           
            $response = $PayPalOrder->createOrder();
            $_SESSION["orderid"] = $response[1]->result->id;
            \Utilities\Site::redirectTo($response[0]->href);
            die();
        }

        \Views\Renderer::render("paypal/checkout", $viewData);
    }
}
