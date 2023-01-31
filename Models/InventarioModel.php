<?php
require_once("../BD/Mysql.php");
class InventarioModel extends Mysql{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll(){
        $sql = "SELECT * FROM equipos";
        $request = $this->select_all($sql);
        return $request;
    }

    public function nuevo($datos){
        $sql = "INSERT INTO equipos (folio,nombreEquipo,descripcionEquipo,fechaIngreso)
        VALUES (?,?,?,?)";
        $request = $this->insert($sql,$datos);
        return $request;
    }

    public function equipoFolio($folio){
        $sql = "SELECT * FROM equipos WHERE folio = '$folio'";
        $request = $this->select($sql);
        return $request;
    }

    public function equipoId($idEquipo){
        $sql = "SELECT * FROM equipos WHERE idEquipo = $idEquipo";
        $request = $this->select($sql);
        return $request;
    }

    public function updateEquipo($idEquipo,$datos){
        $sql="UPDATE equipos SET nombreEquipo = ?,
        descripcionEquipo = ? WHERE idEquipo = $idEquipo";
        $request = $this->update($sql,$datos);
        return $request;
    }

}
