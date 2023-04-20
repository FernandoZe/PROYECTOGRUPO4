<?php

namespace Dao\Mnt;

use Dao\Table;

class Ventas extends Table
{

    public static function getAll()
    {
        $sqlstr = "Select * from ventascomics;";
        return self::obtenerRegistros($sqlstr, array());
    }
    /**
     * Get Producto By Id
     *
     * @param int $invPrdId Codigo del Producto
     *
     * @return array
     */
    public static function getById(int $comics_id,int $venta_id)
    {
        $sqlstr = "SELECT * from ventascomics where comics_id=:comics_id and venta_id = :venta_id ;";
        $sqlParams = array("comics_id" => $comics_id,"venta_id" => $venta_id);
        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }


}
