<?php
require_once("../Models/PrestamosModel.php");

$idEquipo = isset($_POST["idEquipo"]) ? $_POST["idEquipo"] : "";
$idPrestamo = isset($_POST["idPrestamo"]) ? $_POST["idPrestamo"] : "";
$folio = isset($_POST["folio"]) ? $_POST["folio"] : "";
$matricula = isset($_POST["matricula"]) ? $_POST["matricula"] : "";
$alumno = isset($_POST["nomAlum"]) ? $_POST["nomAlum"] : "";
$graGru = isset($_POST["graGru"]) ? $_POST["graGru"] : "";
$datePrestamo = isset($_POST["datePrestamo"]) ? $_POST["datePrestamo"] : "";

$dateDevolucion = isset($_POST["dateDevolucion"]) ? $_POST["dateDevolucion"] : "";


$prestamos = new PrestamosModel();

switch ($_GET["op"]) {
    case "listar":
        $arrData = $prestamos->getAll();
        for ($i = 0; $i < count($arrData); $i++) {
            $btnView = '';
            $btnEnt = '';
            $btnInc = '';

            if ($arrData[$i]['status'] == 0) {
                if ($arrData[$i]['incidencia'] == 1) {
                    $arrData[$i]['status'] = '<span class="label label-danger" >Reportado</span>';
                    $btnView = '';
                    $arrData[$i]['acciones'] = '<div class="text-center">' . $btnView . '</div>';
                } else {
                    $arrData[$i]['status'] = '<span class="label label-success" >Entregado</span>';
                    $btnView = '<button class="btn btn-info btn-sm" onClick="viewDevolucion(' . $arrData[$i]['idPrestamo'] . ')" title="Ver Detalles"><i class="fa fa-eye"></i></button>';
                    $arrData[$i]['acciones'] = '<div class="text-center">' . $btnView . '</div>';
                }
            } else {
                $arrData[$i]['status'] = '<span class="label label-warning" >Prestamo</span>';
                $btnView = '<button class="btn btn-info btn-sm" onClick="viewPrestamo(' . $arrData[$i]['idPrestamo'] . ')" title="Ver Detalles"><i class="fa fa-eye"></i></button>';
                $btnEnt = '<button class="btn btn-success btn-sm" onClick="devolver(' . $arrData[$i]['idPrestamo'] . ')" title="Devolver Equipo"><i class="fa fa-check"></i></button>';
                $btnInc = '<button class="btn btn-warning btn-sm" onClick="reportar(' . $arrData[$i]['idPrestamo'] . ')" title="Reportar Equipo"><i class="fa fa-exclamation-triangle"></i></button>';
                $arrData[$i]['acciones'] = '<div class="text-center">' . $btnView . ' ' . $btnEnt . ' ' . $btnInc . '</div>';
            }
        }
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        break;

    case "nuevo":
        $arrResponse = "";
        $request = "";

        $request = $prestamos->equipoFolio($folio);
        if (empty($request)) {
            $arrResponse = array('status' => false, 'msg' => 'FOLIO NO REGISTRADO.');
        } else {
            if ($request['status'] == 0) {
                $arrResponse = array('status' => false, 'msg' => 'Equipo En Asistencia.');
            } else if ($request['status'] == 2) {
                $arrResponse = array('status' => false, 'msg' => 'EQUIPO PRESTADO.');
            } else {
                $datos = array($folio, $matricula, $alumno, $graGru, $datePrestamo);
                $request = $prestamos->prestamo($datos);
                if ($request > 0) {
                    $arrResponse = array('status' => true, 'msg' => 'Prestamo registrado correctamente.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible realizar el prestamo.');
                }
            }
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
        break;
    case "verPrestamo":
        $arrData = $prestamos->buscarPrestamo($idPrestamo);
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
        break;

    case "devolucion":
        $datos = array($dateDevolucion, $folio, 0, 0);
        //print_r($datos);
        $request = $prestamos->devolucion($idPrestamo, $datos);
        if ($request > 0) {
            $arrResponse = array('status' => true, 'msg' => 'Devolución Registrada Correctamente.');
        } else {
            $arrResponse = array('status' => false, 'msg' => 'No es posible registrar la devolución.');
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        break;
}
