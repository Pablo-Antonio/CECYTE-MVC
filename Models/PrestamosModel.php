<?php
require_once("../BD/Mysql.php");
class PrestamosModel extends Mysql
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM prestamos";
        $request = $this->select_all($sql);
        return $request;
    }

    public function prestamo($datos)
    {
        $sql = "INSERT INTO prestamos (folio,matricula,alumno,gradoGrupo,fechaPrestamo)
        VALUES (?,?,?,?,?)";
        $request = $this->insert($sql, $datos);
        return $request;
    }

    public function equipoFolio($folio)
    {
        $sql = "SELECT * FROM equipos WHERE folio = '$folio'";
        $request = $this->select($sql);
        return $request;
    }

    public function equipoPrestamo($folio)
    {
        $sql = "SELECT * FROM prestamos WHERE folio = '$folio'";
        $request = $this->select($sql);
        return $request;
    }

    public function buscarPrestamo($idPrestamo)
    {
        $sql = "SELECT * FROM prestamos WHERE idPrestamo = $idPrestamo";
        $request = $this->select($sql);
        return $request;
    }

    public function devolucion($idPrestamo, $datos)
    {
        $sql = "UPDATE prestamos  SET fechaDevolucion = ?, folio = ?, 
        incidencia = ?, status = ? WHERE idPrestamo = $idPrestamo";
        $request = $this->update($sql, $datos);
        return $request;
    }
}
