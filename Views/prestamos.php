<?php
require_once("templates/header.php");
require_once("modals/modalNuevoPrestamo.php");
require_once("modals/modalDevolucion.php");
require_once("modals/modalVerPrestamo.php");
require_once("modals/modalReportar.php");
?>

<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Historial Prestamos</h3>
        <!-- Button trigger modal -->
        <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#mdlNewPres">
            Nuevo Prestamo
        </button>
        <div class="row mt">
            <div class="col-lg-12">
                <div class="content-panel">
                    <section id="unseen">
                        <table class="table table-bordered table-striped table-condensed" id="tablePrestamos">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Matricula</th>
                                    <th>Folio</th>
                                    <th>Fecha Prestamo</th>
                                    <th>Status</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
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

<script src="<?= $BASE_MEDIA ?>/js/functions_prestamos.js"></script>