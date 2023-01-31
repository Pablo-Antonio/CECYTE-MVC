<?php
require_once("../BD/Mysql.php");
class IncidenciasModel extends Mysql
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM incidencias";
        $request = $this->select_all($sql);
        return $request;
    }

    public function nuevaIncidencia($datos)
    {
        $sql = "INSERT INTO incidencias (idPrestamo,folio,desReporte,fechaReporte)
        VALUES (?,?,?,?)";
        $request = $this->insert($sql, $datos);
        return $request;
    }

    public function verIncidencia($idIncidencia)
    {
        $sql = "SELECT i.idIncidencia,i.fechaReporte,i.desReporte,
        i.fechaSolucion,i.desSolucion,i.status,
        p.idPrestamo,p.folio,p.matricula,p.alumno,p.gradoGrupo,p.fechaPrestamo
        FROM  incidencias as i 
        INNER JOIN prestamos as p 
        ON i.idPrestamo = p.idPrestamo
        WHERE i.idIncidencia = $idIncidencia";
        $request = $this->select($sql);
        return $request;
    }

    public function actualizarIncidencia($idIncidencia,$datos){
        $sql = "UPDATE incidencias SET fechaSolucion = ?, desSolucion = ?,
        status = ? WHERE idIncidencia = $idIncidencia";
        $request = $this->update($sql,$datos);
        return $request;
    }
}
