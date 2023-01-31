<?php
require_once("../Models/IncidenciasModel.php");

$idIncidencia = isset($_POST["idIncidencia"]) ? $_POST["idIncidencia"] : "";
$idPrestamo = isset($_POST["idPrestamo"]) ? $_POST["idPrestamo"] : "";
$folio = isset($_POST["folio"]) ? $_POST["folio"] : "";
$desReporte = isset($_POST["desReporte"]) ? $_POST["desReporte"] : "";
$dateReporte = isset($_POST["dateReporte"]) ? $_POST["dateReporte"] : "";
$dateSolucion = isset($_POST["dateSolucion"]) ? $_POST["dateSolucion"] : "";
$desSolucion = isset($_POST["desSolucion"]) ? $_POST["desSolucion"] : "";
$opcion = isset($_POST["opcion"]) ? $_POST["opcion"] : "";

$incidencias = new IncidenciasModel();

switch ($_GET["op"]) {
    case "listar":
        $arrData = $incidencias->getAll();
        for ($i = 0; $i < count($arrData); $i++) {
            $btnView = '';
            $btnRep = '';
            $btnBaj = '';
            if ($arrData[$i]['status'] == 0) {
                $arrData[$i]['status'] = '<span class="label label-success" >Reparado</span>';
                $btnView = '<button class="btn btn-info btn-sm" onClick="viewReparado(' . $arrData[$i]['idIncidencia'] . ')" title="Ver Detalles"><i class="fa fa-eye"></i></button>';
                $arrData[$i]['acciones'] = '<div class="text-center">' . $btnView . '</div>';
            } else if ($arrData[$i]['status'] == 1) {
                $arrData[$i]['status'] = '<span class="label label-warning" >Pendiente</span>';
                $btnView = '<button class="btn btn-info btn-sm" onClick="viewIncidencia(' . $arrData[$i]['idIncidencia'] . ')" title="Ver Detalles"><i class="fa fa-eye"></i></button>';
                $btnRep = '<button class="btn btn-success btn-sm" onClick="viewReparar(' . $arrData[$i]['idIncidencia'] . ')" title="Reparar"><i class="fa fa-check"></i></button>';
                $btnBaj = '<button class="btn btn-danger btn-sm" onClick="viewBaja(' . $arrData[$i]['idIncidencia'] . ')" title="Dar Baja"><i class="fa fa-times"></i></button>';
                $arrData[$i]['acciones'] = '<div class="text-center">' . $btnView . ' ' . $btnRep . ' ' . $btnBaj . '</div>';
            } else {
                $arrData[$i]['status'] = '<span class="label label-danger" >No Reparado</span>';
                $btnView = '<button class="btn btn-info btn-sm" onClick="viewNoReparado(' . $arrData[$i]['idIncidencia'] . ')" title="Ver Detalles"><i class="fa fa-eye"></i></button>';
                $arrData[$i]['acciones'] = '<div class="text-center">' . $btnView . '</div>';
            }
        }
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
        break;

    case "nuevaIncidencia":
        $datos = array($idPrestamo, $folio, $desReporte, $dateReporte);
        $request = $incidencias->nuevaIncidencia($datos);
        if ($request > 0) {
            $arrResponse = array('status' => true, 'msg' => 'Reporte Realizado Correctamente.');
        } else {
            $arrResponse = array('status' => false, 'msg' => 'No es posible realziar el reporte.');
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
        break;
    case "verIncidencia":
        $arrData = $incidencias->verIncidencia($idIncidencia);
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
        break;

    case "actualizarIncidencia":
        $request = "";
        $arrResponse = "";

        if ($opcion == 1) { //reparar
            $datos = array($dateSolucion, $desSolucion, 0);
            $request = $incidencias->actualizarIncidencia($idIncidencia,$datos);
        } else { //dar baja
            $datos = array($dateSolucion, $desSolucion, 2);
            $request = $incidencias->actualizarIncidencia($idIncidencia,$datos);
        }

        if ($request > 0) {
            $arrResponse = array('status' => true, 'msg' => 'Asistencia Registrada Correctamente.');
        } else {
            $arrResponse = array('status' => false, 'msg' => 'No es posible registrar la asistencia.');
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
        break;
}
