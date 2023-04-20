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
class Categorias extends Table{
    /**
     * Crea un nuevo registro de categoria.
     *
     * @param string $catnom description
     * @param string $catdesc description
     *
     * @return int
     */
    public static function insert(string $catnom, string $catdesc="ACT"): int
    {
        $sqlstr = "INSERT INTO categorias 
        (catnom, catdesc) values(:catnom, :catdesc);";
        $rowsInserted = self::executeNonQuery(
            $sqlstr,
            array("catnom"=>$catnom, "catdesc"=>$catdesc)
        );
        return $rowsInserted;
    }
    public static function update(
        string $catnom,
        string $catdesc,
        int $catid
    ){
        $sqlstr = "UPDATE categorias set catnom = :catnom, catdesc = :catdesc where catid=:catid;";
        $rowsUpdated = self::executeNonQuery(
            $sqlstr,
            array(
                "catnom" => $catnom,
                "catdesc" => $catdesc,
                "catid" => $catid
            )
        );
        return $rowsUpdated;
    }
    public static function delete(int $catid){
        $sqlstr = "DELETE from categorias where catid=:catid;";
        $rowsDeleted = self::executeNonQuery(
            $sqlstr,
            array(
                "catid" => $catid
            )
        );
        return $rowsDeleted;
    }
    public static function findAll(){
        $sqlstr = "SELECT * from categorias;";
        return self::obtenerRegistros($sqlstr, array());
    }
    public static function findByFilter(){

    }
    public static function findById(int $catid){
        $sqlstr = "SELECT * from categorias where catid = :catid;";
        $row = self::obtenerUnRegistro(
            $sqlstr,
            array(
                "catid"=> $catid
            )
        );
        return $row;
    }
}
