<?php

namespace Dao\Mnt;

use Dao\Table;
/*
`PrdId` BIGINT(8) NOT NULL AUTO_INCREMENT,
`PrdName` VARCHAR(45) NULL,
`cantidad` CHAR(3) NULL DEFAULT 'ACT',
 */

/**
 * Undocumented class
 */
class Productos extends Table
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
        string $catid,
        string $PrdName,
        string $PrdPrecio,
        string $cantidad,
        string $img
        ): int
        {
        $sqlstr = "INSERT INTO productos 
        (catid,PrdName, PrdPrecio, cantidad,img) 
        values
        (:catid, :PrdName, :PrdPrecio, :cantidad,:img);";

        $rowsInserted = self::executeNonQuery(
            $sqlstr,
            array(
                "catid" => $catid,
                "PrdName" => $PrdName,
                "PrdPrecio" => $PrdPrecio,
                "cantidad" => $cantidad,
                "img" => $img

            )
        );
        return $rowsInserted;
    }

    public static function update(
        string $PrdName,
        string $PrdPrecio,
        string $cantidad,
        string $img,

        int $PrdId

    ) {
        $sqlstr = "UPDATE productos set PrdName = :PrdName, PrdPrecio = :PrdPrecio, cantidad = :cantidad, img = :img where PrdId=:PrdId;";
        $rowsUpdated = self::executeNonQuery(
            $sqlstr,
            array(
                "PrdName" => $PrdName,
                "PrdPrecio" => $PrdPrecio,
                "cantidad" => $cantidad,
                "img" => $img,

                "PrdId" => $PrdId,

            )
        );
        return $rowsUpdated;
    }
    public static function delete(int $PrdId)
    {
        $sqlstr = "DELETE from productos where PrdId=:PrdId;";
        $rowsDeleted = self::executeNonQuery(
            $sqlstr,
            array(
                "PrdId" => $PrdId
            )
        );
        return $rowsDeleted;
    }
    public static function findAll()
    {
        $sqlstr = "SELECT * from productos;";
        return self::obtenerRegistros($sqlstr, array());
    }

    public static function memoriaram()
    {
        $sqlstr ="SELECT * from productos where catid =:1;";
        return self::obtenerRegistros($sqlstr, array());
    }

    public static function findByFilter()
    {
    }
    public static function findById(int $PrdId)
    {
        $sqlstr = "SELECT * from productos where PrdId = :PrdId;";
        $row = self::obtenerUnRegistro(
            $sqlstr,
            array(
                "PrdId" => $PrdId
            )
        );
        return $row;
    }
}
