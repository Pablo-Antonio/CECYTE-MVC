<?php
require_once("../Models/LoginModel.php");

if (strlen(session_id()) < 1) {
    session_start(); //Validamos si existe o no la sesión
}

$usr = isset($_POST["usr"]) ? $_POST["usr"] : "";
$password = isset($_POST["pass"]) ? $_POST["pass"] : "";

$login = new LoginModel();

switch ($_GET["op"]) {
    case "login":
        $request = $login->login($usr, $password);
        if (!empty($request)) {
            $arrResponse = array('status' => true, 'msg' => '.');
            $_SESSION['login'] = true;
        } else {
            $arrResponse = array('status' => false, 'msg' => 'Usuario y/o Contraseña incorrectos.');
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
        break;
    case "logout":
        //Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");
        break;
}
