<?php
session_start();
include_once('M/funciones.php');
$sesion = $_SESSION['sisad'];

// Subiendo por Deploy

//OBTENER VARIABLE DE LA GET
$idtercero_get = (isset($_GET['id'])) ? desencriptar($_GET['id']) : '' ;
if ($idtercero_get != '') {
    $tercero = get_tercero($idtercero_get);
    $tipo_cedula = substr($tercero['cedula'], 0, 2);
    $cedula = substr($tercero['cedula'], 2);

    //obtener zonas
    $zonas = get_zonas($sesion['nacional'], $sesion['distrital'], $sesion['zonal'], $sesion['idobjeto']);
    $html_zonas = '<option value="">Seleccione</option>';
    if ($zonas != 0) {
        foreach ($zonas as $row) {
            if ($sesion['nacional']) {
                # code...
            }else {
                $seleccionar = ($tercero['idzona'] == $row['idzona']) ? 'selected' : '' ;
                $html_zonas .= '<option value="'.$row['idzona'].'" '.$seleccionar.'>'.$row['zona'].'</option>';
            }
        }
    }

    //obtner tipos
    $tipos = get_tipo_tercero(1);
    $html_tipos = '<option value="">Seleccione</option>';
    if ($tipos != 0) {
        foreach ($tipos as $row) {
            $seleccionar = ($tercero['idtipo_tercero'] == $row['idtipo']) ? 'selected' : '' ;
            $html_tipos .= '<option value="'.$row['idtipo'].'" '.$seleccionar.'>'.$row['tipo'].'</option>';
        }
    }

    //obtener escalafones
    $escalafones = get_escalafones();
    $html_escalafones = '<option value="">Seleccione</option>';
    if ($escalafones != 0) {
        foreach ($escalafones as $row) {
            $seleccionar = ($tercero['idescalafon'] == $row['idescalafon']) ? 'selected' : '' ;
            $html_escalafones .= '<option value="'.$row['idescalafon'].'" '.$seleccionar.'>'.$row['escalafon'].'</option>';
        }
    }

    //OBTENER ESTUDIOS
    $tercero_estudios = get_tercero_estudios($tercero['idtercero']);
    $html_estudios = '';
    if ($tercero_estudios != 0) {
        foreach ($tercero_estudios as $row) {
            $html_estudios .= '
            <tr>
                <td>'.$row['tipo'].'</td>
                <td>'.$row['fecha'].'</td>
                <td>'.$row['estudio'].'</td>
                <td>'.$row['lugar'].'</td>
                <td>
                    <button data-idestudio="'.$row['idtercero_estudio'].'" type="button" class="btn btn-outline-danger btn-circle quitar-estudio"><i class="fa fa-trash-o"></i> </button>
                </td>
            </tr>';
        }
    }

    //OBTENER ESTUDIOS
    $tercero_ocupaciones = get_tercero_ocupaciones($tercero['idtercero']);
    $html_ocupaciones = '';
    if ($tercero_ocupaciones != 0) {
        foreach ($tercero_ocupaciones as $row) {
            $html_ocupaciones .= '
            <tr>
                <td>'.$row['tipo'].'</td>
                <td>'.$row['ocupacion'].'</td>
                <td>'.$row['fecha'].'</td>
                <td>'.$row['fecha_fin'].'</td>
                <td>
                    <button data-idocupacion="'.$row['idtercero_ocupacion'].'" type="button" class="btn btn-outline-danger btn-circle quitar-ocupacion"><i class="fa fa-trash-o"></i> </button>
                </td>
            </tr>';
        }
    }

    if ($sesion['zonal'] == 1) {
        $iglesia_nombres = get_nombre_iglesias_por_zona($sesion['idobjeto']);
    }elseif ($sesion['distrital'] == 1) {
        $iglesia_nombres = get_nombre_iglesias_por_distrito($sesion['idobjeto']);
    }else {
        //NACIONAL
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>SISAD | Editar Iglesia</title>
    <?php include_once('M/head.php') ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
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
                    <h3 class="text-themecolor">Editar Iglesia</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../inicio">Inicio</a></li>
                        <li class="breadcrumb-item">Iglesias</li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                
                <?php
                if ($idtercero_get == '') {
                ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>Buscar Iglesia</h4>
                                <h6 class="card-subtitle">Seleccione un tercero para poder empezar a editar</h6>
                                <select class="js-example-basic-single" id="select-idtercero" style="width: 100%">
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }else{
                ?>
                <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
                <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                
                <form class="row" id="form-registrar-ministro">
                    <input type="hidden" name="idtercero" value="<?=$tercero['idtercero']?>">
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
                                                <option <?php echo ($tipo_cedula == 'V-') ? 'selected' : '' ;?> >V-</option>
                                                <option <?php echo ($tipo_cedula == 'E-') ? 'selected' : '' ;?> >E-</option>
                                            </select>
                                            <input type="number" value="<?=$cedula?>" name="cedula" class="form-control col-md-10 form-control-line" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Razon Social *</label>
                                        <input type="text" value="<?=$tercero['razon_social']?>" name="nombres" class="form-control form-control-line" required>
                                    </div>
                                    
                                    
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Fecha de fundación</label>
                                        <input type="date" value="<?=$tercero['fecha_nac']?>" name="fecha_nacimiento" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Luegar de fundación</label>
                                        <input type="text" value="<?=$tercero['lugar_nacimiento']?>" name="lugar_nacimiento" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Telefono</label>
                                        <input type="tel" value="<?=$tercero['telefono']?>" name="telefono" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Fax</label>
                                        <input type="text" value="<?=$tercero['fax']?>" name="fax" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Correo *</label>
                                        <input type="mail" value="<?=$tercero['correo']?>" name="correo" class="form-control form-control-line" required>
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Web</label>
                                        <input type="text" value="<?=$tercero['web']?>" name="web" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Direccion</label>
                                        <input type="text" value="<?=$tercero['direccion']?>" name="direccion" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Descripcion</label>
                                        <input type="text" value="<?=$tercero['descripcion']?>" name="descripcion" class="form-control form-control-line">
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
                                            <option value="6">Iglesia</option>
                                        </select>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- 
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Datos Ministeriales</h4>
                                <h6 class="card-subtitle">Información Eclesiastica</h6>

                                <div class="form-material m-t-40 row">
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Fecha de Converción</label>
                                        <input type="date" value="<?=$tercero['convercion']?>" name="m_fecha_convercion" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Fecha de Bautizmo en Agua</label>
                                        <input type="date" value="<?=$tercero['bautizmo_agua']?>" name="m_fecha_bautizmo_agua" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Fecha de Bautizmo en el Espiritu Santo</label>
                                        <input type="date" value="<?=$tercero['bautizmo_ES']?>" name="m_fecha_bautizmo_es" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Iglesia *</label>
                                        <input type="text" value="<?=$tercero['iglesia']?>" name="m_iglesia" id="autocomplete" class="form-control form-control-line" required>
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Pastor</label>
                                        <input type="text" value="<?=$tercero['pastor']?>" name="m_pastor" class="form-control form-control-line">
                                    </div>
                                    <div class="form-group col-md-6 m-t-20">
                                        <label>Ministerio *</label>
                                        <select name="m_ministerio" class="form-control form-control-line" required>
                                            <option value="">Seleccione</option>
                                            <option value="Misionero" <?php echo ($tercero['ministerio'] == 'Misionero') ? 'selected' : '' ;?> >Misionero(a)</option>
                                            <option value="Evangelista" <?php echo ($tercero['ministerio'] == 'Evangelista') ? 'selected' : '' ;?> >Evangelista</option>
                                            <option value="Pastor" <?php echo ($tercero['ministerio'] == 'Pastor') ? 'selected' : '' ;?> >Pastor(a)</option>
                                            <option value="Maestro" <?php echo ($tercero['ministerio'] == 'Maestro') ? 'selected' : '' ;?> >Maestro(a)</option>
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
                                        <input type="date" value="<?=$tercero['fecha_escalafon']?>" name="m_fecha_escalafon" class="form-control form-control-line">
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
                                        <button type="button" class="btn btn-outline-success btn-circle" id="add-estudio" data-idtercero="<?=$tercero['idtercero']?>"><i class="fa fa-check"></i> </button>
                                    </div>

                                   
                                    <div class="col-12" id="mensaje-estudio" style="display:none;">
                                        <div class="alert alert-success alert-rounded">
                                            <i class="fa fa-exclamation-triangle"></i> <span id="mensaje-html"></span>
                                        </div>
                                    </div>

                                    <div class="col-12" style="display:none;" id="loading-estudio">
                                        <div class="progress">
                                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                Espere un momento...
                                            </div>
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
                                                    
                                                    <?=$html_estudios?>

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
                                        <button type="button" id="add-ocupacion" class="btn btn-outline-secondary btn-circle" data-idtercero="<?=$tercero['idtercero']?>"><i class="fa fa-check"></i> </button>
                                    </div>

                                    <div class="col-12" id="mensaje-ocupacion" style="display:none;">
                                        <div class="alert alert-success alert-rounded">
                                            <i class="fa fa-exclamation-triangle"></i> <span id="mensaje2-html"></span>
                                        </div>
                                    </div>

                                    <div class="col-12" style="display:none;" id="loading-ocupacion">
                                        <div class="progress">
                                            <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;background-color: #99abb4 !important;">
                                                Espere un momento...
                                            </div>
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
                                                    
                                                    <?=$html_ocupaciones?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> 
                    -->









                    <div class="col-12 text-center">
                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-success">Guardar <i class="fa fa-floppy-o"></i></button>
                    </div>
                </form>
                <script src="V/js/ministro-editar.js"></script>
                <script>
                    $( "#autocomplete" ).autocomplete({
                            source: [ "<?=implode('","', $iglesia_nombres)?>" ]
                        });
                </script>
                <?php
                }
                ?>
                
                <script>
                    $(document).ready(function() {
                        $('.js-example-basic-single').select2();
                        $('#select-idtercero').select2({
                            placeholder: 'RIF / CI / Nombres / Apellidos',
                            ajax: {
                                url: 'C/select2_ajax_terceros.php',
                                dataType: 'json',
                                delay: 250,
                                processResults: function (data) {
                                    return {
                                    results: data
                                    };
                                },
                                cache: true
                            }
                        });

                        $("#select-idtercero").change(function(){
                            var idtercero = $(this).val();
                            $(location).attr('href','?id='+idtercero);
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