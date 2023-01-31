<?php
require_once("../Models/InventarioModel.php");

$idEquipo = isset($_POST["idEquipo"]) ? $_POST["idEquipo"] : "";
$folio = isset($_POST["folio"]) ? $_POST["folio"] : "";
$nomEquipo = isset($_POST["nomEquipo"]) ? $_POST["nomEquipo"] : "";
$desEquipo = isset($_POST["desEquipo"]) ? $_POST["desEquipo"] : "";
$nomEquipoUpd = isset($_POST["nomEquipoUpd"]) ? $_POST["nomEquipoUpd"] : "";
$desEquipoUpd = isset($_POST["desEquipoUpd"]) ? $_POST["desEquipoUpd"] : "";
$dateIngreso = isset($_POST["dateIngreso"]) ? $_POST["dateIngreso"] : "";

$inventario = new InventarioModel();

switch ($_GET["op"]) {
    case "listar":
        $arrData = $inventario->getAll();

        for ($i = 0; $i < count($arrData); $i++) {
            //$folio = strval($arrData[$i]['idEquipo']);
            $btnView = '';
            $btnEdit = '';
            $btnAcc = '';
            if ($arrData[$i]['status'] == 0) {
                $arrData[$i]['status'] = '<span class="label label-danger" >Asistencia</span>';
                //$btnAcc = '<button class="btn btn-success btn-sm" onClick="ftnAccUsr(' . $arrData[$i]['idEquipo'] . ',2)" title="Activar"><i class="fa fa-power-off" aria-hidden="true"></i></button>';
                $btnView = '';
                $arrData[$i]['acciones'] = '<div class="text-center">' . $btnView . '</div>';
            } else if ($arrData[$i]['status'] == 1) {
                $arrData[$i]['status'] = '<span class="label label-success" >Activo</span>';
                $btnView = '<button class="btn btn-info btn-sm" onClick="viewEquipo(' .  $arrData[$i]['idEquipo'] . ')" title="Ver Detalles"><i class="fa fa-eye"></i></button>';
                $btnEdit = '<button class="btn btn-primary btn-sm" onClick="viewActualizar(' . $arrData[$i]['idEquipo'] . ')" title="Actualizar Equipo"><i class="fa fa-pencil"></i></button>';
                //$btnAcc = '<button class="btn btn-danger btn-sm" onClick="ftnAccUsr(' . $arrData[$i]['idEquipo'] . ',1)" title="Desactivar"><i class="fa fa-power-off" aria-hidden="true"></i></button>';
                $arrData[$i]['acciones'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . '</div>';
            } else if ($arrData[$i]['status'] == 2) {
                $arrData[$i]['status'] = '<span class="label label-warning" >Prestamo</span>';
                $btnView = '';
                $arrData[$i]['acciones'] = '<div class="text-center">' . $btnView . '</div>';
            }
        }

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        break;

    case "nuevo":
        $arrResponse = "";
        $request = "";

        $request = $inventario->equipoFolio($folio);
        //print_r($request);
        if (!empty($request)) {
            $arrResponse = array('status' => false, 'msg' => 'Ya existe un equipo registrado con ese FOLIO.');
        } else {
            $datos = array($folio, $nomEquipo, $desEquipo, $dateIngreso);
            $request = $inventario->nuevo($datos);
            //echo $request;
            if ($request > 0) {
                $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'No es posible guardar los datos.');
            }
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
        break;
    case "verEquipo":
        $arrData = $inventario->equipoId($idEquipo);
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
        break;

    case "update":
        $datos = array($nomEquipoUpd,$desEquipoUpd);
        $request = $inventario->updateEquipo($idEquipo,$datos);
        if ($request > 0) {
            $arrResponse = array('status' => true, 'msg' => 'Equipo Actualizado Correctamente.');
        } else {
            $arrResponse = array('status' => false, 'msg' => 'No es posible actualizar el equipo.');
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        break;
}
