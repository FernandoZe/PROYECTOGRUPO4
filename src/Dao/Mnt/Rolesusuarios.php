<?php

namespace Dao\Mnt;

use Dao\Table;
/* 
 CREATE TABLE `roles_usuarios` (
  `usercod` bigint(10) NOT NULL,
  `rolescod` varchar(15) NOT NULL,
  `roleuserest` char(3) DEFAULT NULL,
  `roleuserfch` datetime DEFAULT NULL,
  `roleuserexp` datetime DEFAULT NULL,
  PRIMARY KEY (`usercod`,`rolescod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
*/

class RolesUsuarios extends Table
{


    public static function insert(
        string $usercod,
        string $rolescod,
        string $roleuserest,
        string $roleuserfch,
        string $roleuserexp

    ): int {
        $sqlstr = "INSERT INTO roles_usuarios
         (usercod,
          roleuserfch,
          roleuserest,
          rolescod,
          roleuserexp
          ) 
        values
        (
        :usercod,
        :roleuserfch,
        :roleuserest,
        :rolescod,
        :roleuserexp);";

        $rowsInserted = self::executeNonQuery(
            $sqlstr,
            array(
                "usercod" => $usercod,
                "roleuserfch" => $roleuserfch,
                "roleuserest" => $roleuserest,
                "rolescod" => $rolescod,
                "roleuserexp" => $roleuserexp
            )

        );
        return $rowsInserted;
    }
    public static function update(
        string $rolescod,
        string $roleuserest,
        string $roleuserfch,
        string $roleuserexp,
        int $usercod
    ) {
        $sqlstr = "UPDATE roles_usuarios SET
         roleuserfch = :roleuserfch,
         roleuserest = :roleuserest,
         rolescod = :rolescod, 
         roleuserexp = :roleuserexp
         where usercod=:usercod;";

        $rowsUpdated = self::executeNonQuery(
            $sqlstr,
            array(
                "roleuserfch" => $roleuserfch,
                "roleuserest" => $roleuserest,
                "rolescod" => $rolescod,
                "roleuserexp" => $roleuserexp,

                "usercod" => $usercod
            )
        );
        return $rowsUpdated;
    }
    public static function delete(int $usercod)
    {
        $sqlstr = "DELETE from roles_usuarios where usercod=:usercod;";
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
        $sqlstr = "SELECT * from roles_usuarios;";
        return self::obtenerRegistros($sqlstr, array());
    }
    public static function findByFilter()
    {
    }
    public static function findById(int $usercod)
    {
        $sqlstr = "SELECT * from roles_usuarios where usercod = :usercod;";
        $row = self::obtenerUnRegistro(
            $sqlstr,
            array(
                "usercod" => $usercod
            )
        );
        return $row;
    }
}
