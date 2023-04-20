<?php

namespace Dao\Mnt;

use Dao\Table;
/*
CREATE TABLE `carretilla` (
  `usercod` BIGINT(10) NOT NULL,
  `PrdId` BIGINT(13) NOT NULL,
   `PrdName` varchar(128) DEFAULT NULL,
   `PrdPrecio` int(12) DEFAULT NULL,
   `cantidad` int(12) DEFAULT NULL,
    `crrfching` DATETIME NOT NULL,
    `total` INT(5) NOT NULL,
  PRIMARY KEY (`usercod`, `PrdId`));

 */

/**
 * Undocumented class
 */
class Carretillas extends Table
{
    /**
     * Crea un nuevo registro de categoria.
     *
     * @param string $PrdName description
     * @param string $cantidad description
     *
     * @return int
     */
    public static function insert(

        string $PrdId,
        string $PrdName,
        string $PrdPrecio,
        string $cantidad,
        string $total

        
    ): int {
        $sqlstr = "INSERT INTO carretilla 
        (PrdId,PrdName,PrdPrecio,cantidad,total) 
        values
        (:PrdId, :PrdName, :PrdPrecio, :cantidad, :total);";

        $rowsInserted = self::executeNonQuery(
            $sqlstr,
            array(
                "PrdId" => $PrdId,
                "PrdName" => $PrdName,
                "PrdPrecio" => $PrdPrecio,
                "cantidad" => $cantidad,
                "total" => $total
            )
        );
        return $rowsInserted;
    }

    public static function update(
 
        string $PrdId,
        string $PrdName,
        string $PrdPrecio,
        string $cantidad,
        string $total

    ) {
        $sqlstr = "UPDATE carretilla set  PrdId = :PrdId, PrdName = :PrdName, PrdPrecio = :PrdPrecio,cantidad = :cantidad,total = :total, where usercod=:usercod;";
        $rowsUpdated = self::executeNonQuery(
            $sqlstr,
            array(
                "PrdId" => $PrdId,
                "PrdName" => $PrdName,
                "PrdPrecio" => $PrdPrecio,
                "cantidad" => $cantidad,
                "total" => $total

            )
        );
        return $rowsUpdated;
    }
    public static function delete(int $usercod)
    {
        $sqlstr = "DELETE from carretilla where usercod=:usercod;";
        $rowsDeleted = self::executeNonQuery(
            $sqlstr,
            array(
                "usercod" => $usercod
            )
        );
        return $rowsDeleted;
    }
    public static function findAll()
    {
        $sqlstr = "SELECT * from carretilla;";
        return self::obtenerRegistros($sqlstr, array());
    }



    public static function findByFilter()
    {
        
    }
    public static function findById(int $usercod)
    {
        $sqlstr = "SELECT * from carretilla where usercod = :usercod;";
        $row = self::obtenerUnRegistro(
            $sqlstr,
            array(
                "usercod" => $usercod
            )
        );
        return $row;
    }
}
