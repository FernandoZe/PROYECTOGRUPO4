<?php

namespace Dao\Mnt;

use Dao\Table;
/* 
  CREATE TABLE `invenproductos` (
  `invId` bigint(13) NOT NULL AUTO_INCREMENT,
  `invCategoriaCod` varchar(128) DEFAULT NULL,
  `invPrdCod` varchar(128) DEFAULT NULL,
  `existencias` varchar(128) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  
);
 
*/

class Inventarios extends Table
{


    public static function insert(
        string $invCategoriaCod,
        string $invPrdCod,
        string $existencias,
        string $fecha

    ): int {
        $sqlstr = "INSERT INTO invenproductos
         (
          invCategoriaCod,
          invPrdCod,
          existencias,
          fecha) 
        values
        (
        :invCategoriaCod,
        :invPrdCod,
        :existencias,
        :fecha";

        $rowsInserted = self::executeNonQuery(
            $sqlstr,
            array(
                "invCategoriaCod" => $invCategoriaCod,
                "invPrdCod" => $invPrdCod,
                "existencias" => $existencias,
                "fecha" => $fecha
            )

        );
        return $rowsInserted;
    }
    public static function update(
        string $invCategoriaCod,
        string $invPrdCod,
        string $existencias,
        string $fecha,
        int $invId
    ) {
        $sqlstr = "UPDATE invenproductos SET
         invCategoriaCod = :invCategoriaCod, 
         invPrdCod = :invPrdCod,
         existencias = :existencias,
         fecha = :fecha
         where invId=:invId;";

        $rowsUpdated = self::executeNonQuery(
            $sqlstr,
            array(
                "invCategoriaCod" => $invCategoriaCod,
                "invPrdCod" => $invPrdCod,
                "existencias" => $existencias,
                "fecha" => $fecha,

                "invId" => $invId
            )
        );
        return $rowsUpdated;
    }
    public static function delete(int $invId)
    {
        $sqlstr = "DELETE from invenproductos where invId=:invId;";
        $rowsDeleted = self::executeNonQuery(
            $sqlstr,
            array(
                "invId" => $invId
            )
        );
        return $rowsDeleted;
    }
    public static function findAll()
    {
        $sqlstr = "SELECT * from invenproductos;";
        return self::obtenerRegistros($sqlstr, array());
    }
    public static function findByFilter()
    {
    }
    public static function findById(int $invId)
    {
        $sqlstr = "SELECT * from invenproductos where invId = :invId;";
        $row = self::obtenerUnRegistro(
            $sqlstr,
            array(
                "invId" => $invId
            )
        );
        return $row;
    }
}
