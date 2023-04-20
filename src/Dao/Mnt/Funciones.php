<?php

namespace Dao\Mnt;

use Dao\Table;
/*
CREATE TABLE `funciones` (
  `fncod` varchar(255) NOT NULL,
  `fndsc` varchar(45) DEFAULT NULL,
  `fnest` char(3) DEFAULT NULL,
  `fntyp` char(3) DEFAULT NULL,
  PRIMARY KEY (`fncod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/

class Funciones extends Table
{

    public static function insert(
        string $fndsc,
        string $fnest,
        string $fntyp
    ): int {

        $sqlstr = "INSERT INTO`funciones`
        (`fndsc`,
        `fnest`,
        `fntyp`)
        VALUES
        (:fndsc,
        :fnest,
        :fntyp);";
        $rowsInserted = self::executeNonQuery(
            $sqlstr,
            array(
                "fndsc" => $fndsc, "fndsc" => $fndsc,
                "fnest" => $fnest, "fnest" => $fnest,
                "fntyp" => $fntyp, "fntyp" => $fntyp

            )

        );
        return $rowsInserted;
    }


    public static function update(
        string $fndsc,
        string $fnest,
        string $fntyp,

        int $fncod
    ) {
        $sqlstr = "UPDATE `funciones`
        SET
        `fndsc` = :fndsc,
        `fnest` = :fnest,
        `fntyp` = :fntyp
        WHERE `fncod` = :fncod;";

        $rowsUpdated = self::executeNonQuery(
            $sqlstr,
            array(
                "fndsc" => $fndsc,
                "fnest" => $fnest,
                "fntyp" => $fntyp,

                "fncod" => $fncod
            )
        );
        return $rowsUpdated;
    }


    public static function delete(int $fncod)
    {
        $sqlstr = "DELETE from funciones where fncod=:fncod;";
        $rowsDeleted = self::executeNonQuery(
            $sqlstr,
            array(
                "fncod" => $fncod
            )
        );
        return $rowsDeleted;
    }

    public static function findAll()
    {
        $sqlstr = "SELECT * from funciones;";
        return self::obtenerRegistros($sqlstr, array());
    }

    public static function findByFilter()
    {

    }

    public static function findById(int $fncod)
    {
        $sqlstr = "SELECT * from funciones where fncod = :fncod;";
        $row = self::obtenerUnRegistro(
            $sqlstr,
            array(
                "fncod" => $fncod
            )
        );
        return $row;
    }
}
