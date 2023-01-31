<?php
require_once("templates/header.php");
require_once("modals/modalVerIncidencia.php");
require_once("modals/modalBaja.php");
require_once("modals/modarReparar.php");
require_once("modals/modaReparado.php");
require_once("modals/modalNoReparado.php");
?>

<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Historial Incidencias</h3>
        <div class="row mt">
            <div class="col-lg-12">
                <div class="content-panel">
                    <section id="unseen">
                        <table class="table table-bordered table-striped table-condensed" id="tableIncidencias">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Folio Equipo</th>
                                    <th>Fecha Reporte</th>
                                    <th>Status</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Folio Equipo</th>
                                    <th>Fecha Reporte</th>
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

<script src="<?= $BASE_MEDIA ?>/js/functions_incidencias.js"></script>