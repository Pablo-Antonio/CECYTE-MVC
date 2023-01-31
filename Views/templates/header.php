<?php
require_once("../Helpers/Helpers.php");
session_start();
if (!$_SESSION['login']) {
    header('Location: ' . $BASE_URL . '/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="PvSystems">

    <link rel="icon" type="image/png" href="<?= $BASE_MEDIA ?>/img/logo.png" sizes="30x30">

    <title>CECyTE 02 Yecapixtla</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= $BASE_MEDIA ?>/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="<?= $BASE_MEDIA ?>/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="<?= $BASE_MEDIA ?>/css/style.css" rel="stylesheet">
    <link href="<?= $BASE_MEDIA ?>/css/style-responsive.css" rel="stylesheet">
    <link href="<?= $BASE_MEDIA ?>/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="<?= $BASE_MEDIA ?>/css/table-responsive.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= $BASE_MEDIA ?>/js/plugins/sweetalert/sweetalert2.min.css">

</head>

<body>

    <section id="container">
        <!--header start-->
        <header class="header black-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>CECyTE 02 Yecapixtla</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
            </div>
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="<?= $BASE_URL ?>/Ajax/loginAjax.php?op=logout">Logout</a></li>
                </ul>
            </div>
        </header>
        <!--header end-->

        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse ">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav-accordion">

                    <p class="centered"><a href="profile.html"><img src="<?= $BASE_MEDIA ?>/img/admin.png" class="img-circle" width="60"></a></p>
                    <h5 class="centered">Administrador</h5>

                    <li class="sub-menu">
                        <a href="inventario.php" id="liInventario">
                            <i class="fa fa-desktop"></i>
                            <span>Inventario</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="prestamos.php" id="liPrestamos">
                            <i class="fa fa-cogs"></i>
                            <span>Prestamos</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="incidencias.php" id="liIncidencias">
                            <i class="fa fa-book"></i>
                            <span>Incidencias</span>
                        </a>
                    </li>
                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->