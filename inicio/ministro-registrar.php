<?php
session_start();
include_once('M/funciones.php');
$sesion = $_SESSION['sisad'];
//obtener zonas
$zonas = get_zonas($sesion['nacional'], $sesion['distrital'], $sesion['zonal'], $sesion['idobjeto']);
$html_zonas = '<option value="">Seleccione</option>';
if ($zonas != 0) {
    foreach ($zonas as $row) {
        if ($sesion['nacional']) {
            # code...
        }else {
            $html_zonas .= '<option value="'.$row['idzona'].'">'.$row['zona'].'</option>';
        }
    }
}
//obtner tipos
$tipos = get_tipo_tercero(1);
$html_tipos = '<option value="">Seleccione</option>';
if ($tipos != 0) {
    foreach ($tipos as $row) {
        $html_tipos .= '<option value="'.$row['idtipo'].'">'.$row['tipo'].'</option>';
    }
}
//obtener escalafones
$escalafones = get_escalafones();
$html_escalafones = '<option value="">Seleccione</option>';
if ($escalafones != 0) {
    foreach ($escalafones as $row) {
        $html_escalafones .= '<option value="'.$row['idescalafon'].'">'.$row['escalafon'].'</option>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>SISAD | Registrar Ministro</title>
    <?php include_once('M/head.php') ?>
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
                    <h3 class="text-themecolor">Registrar Ministro</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../inicio">Inicio</a></li>
                        <li class="breadcrumb-item">Ministros</li>
                        <li class="breadcrumb-item active">Registrar</li>
                    </ol>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-success alert-rounded"> <i class="fa fa-comments-o"></i> Antes de Agregar el ministro confirme que no esté registrado anteriormente.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        </div>
                    </div>
                </div>


                
                <form class="row" id="form-registrar-ministro">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Datos Basicos</h4>
                                <h6 class="card-subtitle">Informacion esencial para el Registro</h6>


                                <div class="form-material m-t-40 row">
                                        
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Cedula *</label>
                                        <div class="row">
                                            <select name="tipo_cedula" class="form-control col-md-2" required>
                                                <option>V-</option>
                                                <option>E-</option>
                                            </select>
                                            <input type="number" name="cedula" class="form-control col-md-10 form-control-line" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Nombres *</label>
                                        <input type="text" name="nombres" class="form-control form-control-line" required>
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Apellidos *</label>
                                        <input type="text" name="apellidos" class="form-control form-control-line" required>
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Sexo *</label>
                                        <select name="sexo" class="form-control form-control-line" required>
                                            <option>Masculino</option>
                                            <option>Femenino</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Estado Civil</label>
                                        <select name="estado_civil" class="form-control form-control-line">
                                            <option>Soltero(a)</option>
                                            <option>Casado(a)</option>
                                            <option>Divorciado(a)</option>
                                            <option>Viudo(a)</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Fecha de Nacimiento</label>
                                        <input type="date" name="fecha_nacimiento" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Luegar de nacimiento</label>
                                        <input type="text" name="lugar_nacimiento" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Telefono</label>
                                        <input type="tel" name="telefono" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Fax</label>
                                        <input type="text" name="fax" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Correo *</label>
                                        <input type="mail" name="correo" class="form-control form-control-line" required>
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Web</label>
                                        <input type="text" name="web" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Direccion</label>
                                        <input type="text" name="direccion" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Descripcion</label>
                                        <input type="text" name="descripcion" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                    </div>


                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Zona *</label>
                                        <select name="idzona" class="form-control form-control-line" required>
                                            <?=$html_zonas?>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Tipo *</label>
                                        <select name="idtipo" class="form-control form-control-line" required>
                                            <option value="5">Ministro</option>
                                            <option value="6">Iglesia</option>
                                        </select>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Datos Ministeriales</h4>
                                <h6 class="card-subtitle">Información Eclesiastica</h6>

                                <div class="form-material m-t-40 row">
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Fecha de Converción</label>
                                        <input type="date" name="m_fecha_convercion" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Fecha de Bautizmo en Agua</label>
                                        <input type="date" name="m_fecha_bautizmo_agua" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Fecha de Bautizmo en el Espiritu Santo</label>
                                        <input type="date" name="m_fecha_bautizmo_es" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Iglesia *</label>
                                        <input type="text" name="m_iglesia" class="form-control form-control-line" required>
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Pastor</label>
                                        <input type="text" name="m_pastor" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Ministerio *</label>
                                        <select name="m_ministerio" class="form-control form-control-line" required>
                                            <option value="">Seleccione</option>
                                            <option value="Misionero">Misionero(a)</option>
                                            <option value="Evangelista">Evangelista</option>
                                            <option value="Pastor">Pastor(a)</option>
                                            <option value="Maestro">Maestro(a)</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Escalafon *</label>
                                        <select name="m_idescalafon" class="form-control form-control-line" required>
                                            <?=$html_escalafones?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Fecha de Obtenido el escalafon</label>
                                        <input type="date" name="m_fecha_escalafon" class="form-control form-control-line">
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Estudios del Ministro</h4>
                                <h6 class="card-subtitle">Estudios Teologicos y/o Profesionales</h6>

                                <div class="form-material m-t-40 row">
                                        
                                    <div class="form-group col-md-2 m-t-20">
                                        <label>Tipo</label>
                                        <select id="e_tipo" class="form-control form-control-line">
                                            <option value="teologico">Teologico</option>
                                            <option value="secular">Profesional</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Fecha Culminación</label>
                                        <input type="date" id="e_fecha" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Estudio</label>
                                        <input type="text" id="e_estudio" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Lugar</label>
                                        <input type="text" id="e_lugar" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-1 m-t-20">
                                        <button type="button" class="btn btn-outline-success btn-circle" id="add-estudio"><i class="fa fa-check"></i> </button>
                                    </div>

                                   
                                    <div class="col-12" id="mensaje-estudio" style="display:none;">
                                        <div class="alert alert-success alert-rounded">
                                            <i class="fa fa-exclamation-triangle"></i> <span id="mensaje-html"></span>
                                        </div>
                                    </div>
                

                                    <div class="form-group col-md-12 m-t-20">
                                        <div class="table-responsive">
                                            <table class="table color-bordered-table success-bordered-table">
                                                <thead>
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>Fecha</th>
                                                        <th>Estudio</th>
                                                        <th>Lugar</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-estudios">
                                                    

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Ocupaciones del Ministro</h4>
                                <h6 class="card-subtitle">Ministeriales y/o Profesionales</h6>

                                <div class="form-material m-t-40 row">
                                        
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Tipo</label>
                                        <select id="o_tipo" class="form-control form-control-line">
                                            <option value="teologico">Teologico</option>
                                            <option value="secular">Profesional</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Ocupacion</label>
                                        <input type="text" id="o_ocupacion" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-2 m-t-20">
                                        <label>Fecha Inicio</label>
                                        <input type="date" id="o_fecha" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-3 m-t-20">
                                        <label>Fecha Culminación</label>
                                        <input type="date" id="o_fecha_fin" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-1 m-t-20">
                                        <button type="button" id="add-ocupacion" class="btn btn-outline-secondary btn-circle"><i class="fa fa-check"></i> </button>
                                    </div>

                                    <div class="col-12" id="mensaje-ocupacion" style="display:none;">
                                        <div class="alert alert-success alert-rounded">
                                            <i class="fa fa-exclamation-triangle"></i> <span id="mensaje2-html"></span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 m-t-20">
                                        <div class="table-responsive">
                                            <table class="table color-bordered-table muted-bordered-table">
                                                <thead>
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>Ocupacion</th>
                                                        <th>Fecha</th>
                                                        <th>Fecha Culminación</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-ocupacion">
                                                    

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>









                    <div class="col-12 text-center">
                        <button type="reset" class="btn waves-effect waves-light btn-rounded btn-outline-danger mr-2">Limpiar <i class="fa fa-eraser"></i></button>
                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-success">Guardar <i class="fa fa-floppy-o"></i></button>
                    </div>
                </form>
                
                
                <script src="V/js/ministro-registrar.js"></script>
                
                
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