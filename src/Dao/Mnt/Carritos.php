<?php
namespace Dao\Mnt;

use Dao\Table;
/*
`catid` BIGINT(8) NOT NULL AUTO_INCREMENT,
`catnom` VARCHAR(45) NULL,
`catdesc` CHAR(3) NULL DEFAULT 'ACT',
 */
/**
 * Undocumented class
 */
class Carrito extends Table{
    /**
     * Crea un nuevo registro de categoria.
     *
     * @param string $catnom description
     * @param string $catdesc description
     *
     * @return int
     */
    
    
    public static function addcarrito(int $PrdId){
        $sqlstr = "SELECT * from productos where PrdId = :PrdId;";
        $row = self::obtenerUnRegistro(
            $sqlstr,
            array(
                "PrdId"=> $PrdId
            )
        );
        return $row;
    }
}
