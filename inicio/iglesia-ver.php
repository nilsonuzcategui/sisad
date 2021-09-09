<?php
session_start();
include_once('M/funciones.php');
$sesion = $_SESSION['sisad'];

//obtener ministros dependiendo la zona
if ($sesion['zonal'] == 1) {
    $terceros = get_iglesias_por_zona($sesion['idobjeto']);
} elseif ($sesion['distrital'] == 1) {
    $terceros = get_iglesia_por_distrito($sesion['idobjeto']);
} else {
    //NACIONAL
}

$html_terceros = '';
foreach ($terceros as $row) {
    $html_boton_correo = '';
    if ($row['correo'] != '') {
        $html_boton_correo = '<button data-toggle="modal" data-target="#exampleModal" data-correo="' . $row['correo'] . '" type="button" class="btn btn-info btn-circle mr-1 boton-correo" data-toggle="tooltip" data-placement="left" title="Enviar Correo" data-original-title="Enviar Correo"><i class="fa fa-send-o"></i> </button>';
    }
    $html_terceros .= '
    <tr>
        <td>' . $row['codigo'] . '</td>
        <td>' . $row['cedula'] . '</td>
        <td>' . $row['razon_social'] . ' ' . $row['apellidos'] . '</td>
        <td>' . $row['correo'] . '</td>
        <td>' . $row['telefono'] . '</td>
    ';
    if ($sesion['distrital']) {
        $html_terceros .= '<td>' . $row['zona'] . '</td>';
    }
    $html_terceros .= '
        <td>
            <div style="display: flex;justify-content: center;"">
                ' . $html_boton_correo . '
                <a href="ministro-editar.php?id=' . encriptar($row['idtercero']) . '" class="btn btn-success btn-circle" style="color:white;" data-toggle="tooltip" data-placement="left" title="Editar Datos" data-original-title="Editar Datos"><i class="fa fa-pencil"></i> </a>
            </div>
        </td>
    </tr>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>SISAD | Iglesias</title>
    <?php include_once('M/head.php') ?>
    <style>
        .btn-circle {
            border-radius: 100%;
            width: 30px;
            height: 30px;
            padding: 5px;
        }
    </style>
</head>

<body class="fix-header card-no-border fix-sidebar">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">S.I.S.A.D</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include_once('V/header.php') ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php include_once('V/dashboard.php') ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">

            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Ver Iglesias</h3>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../inicio">Inicio</a></li>
                            <li class="breadcrumb-item">Ministros</li>
                            <li class="breadcrumb-item active">Ver</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->




                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Listado de Iglesias</h4>
                        <h6 class="card-subtitle">Solo se muestran las Iglesias de su
                            <?php
                            if ($sesion['distrital']) {
                                echo 'distrito asignado.';
                            }elseif ($sesion['zonal']) {
                                echo 'zona asignada.';
                            }
                            ?></h6>
                        <div class="table-responsive m-t-40">
                            <table id="myTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Telefono</th>
                                        <?php
                                        if ($sesion['distrital']) {
                                            echo '<th>Zona</th>';
                                        }
                                        ?>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?= $html_terceros ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Eviar Correo Electrónico con sus datos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">


                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                    <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Información</h3> Al envíar este correo, automaticamente se enviarán los datos actualizados del tercero y si usted lo desea, puede agregar un mensaje adicional; dicho mensaje es opcional.
                                </div>


                                <form>
                                    <div class="form-group">
                                        <label for="recipient-name" class="control-label">Correo:</label>
                                        <input type="text" class="form-control" id="tercero-correo" readonly disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="control-label">Mensaje (opcional):</label>
                                        <textarea class="form-control" id="message-text"></textarea>
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="button" class="btn btn-outline-success btn-rounded">Enviar Correo <i class="fa fa-envelope-open-o"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <script>
                    $(document).ready(function() {
                        $('#myTable').DataTable();

                        $('#myTable tbody').on('click', '.boton-correo', function() {
                            var correo = $(this).data('correo');
                            $('#tercero-correo').val(correo);
                        });
                    });
                </script>


                <!-- ============================================================== -->
                <!-- End Page Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->

            </div>



            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include_once('V/footer.php') ?>
            <!-- This is data table -->
            <script src="../assets/datatables/jquery.dataTables.min.js"></script>
            <!-- start - This is for export functionality only -->
            <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
            <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
            <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
            <!-- end - This is for export functionality only -->
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->

    <?php include_once('M/food-importaciones.php') ?>
</body>

</html>