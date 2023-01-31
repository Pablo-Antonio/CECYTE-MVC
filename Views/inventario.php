<?php
require_once("templates/header.php");
require_once("modals/modalNuevoEquipo.php");
require_once("modals/modalVerEquipo.php");
require_once("modals/modalUpdateEquipo.php");
?>

<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Inventario Equipo</h3>
        <!-- Button trigger modal -->
        <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#mdlNewEq">
            Nuevo Equipo
        </button>
        <div class="row mt">
            <div class="col-lg-12">
                <div class="content-panel">
                    <section id="unseen">
                        <table class="table table-bordered table-striped table-condensed" id="tableEquipos">
                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Nombre</th>
                                    <th>Fecha Ingreso</th>
                                    <th>Status</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Folio</th>
                                    <th>Nombre</th>
                                    <!--<th>Descripcion</th>-->
                                    <th>Fecha Ingreso</th>
                                    <th>Status</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>
    </section>

</section><!-- /MAIN CONTENT -->

<?php
require_once("templates/footer.php");
?>

<script src="<?= $BASE_MEDIA ?>/js/functions_inventario.js"></script>