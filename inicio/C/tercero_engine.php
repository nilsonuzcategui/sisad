<?php
session_start();
include_once('../M/funciones.php');
$mysqli = on_bd();
$array = array(
    "response" => "error",
    "html" => "",
);

$opt = (isset($_POST['opt'])) ? limpiar($_POST['opt']) : '';

$idempresa_sesion = (isset($_SESSION['sisad']['distrital']) && $_SESSION['sisad']['distrital'] == 1) ? $_SESSION['sisad']['idobjeto'] : '' ;

$tipo_cedula = (isset($_POST['tipo_cedula'])) ? limpiar($_POST['tipo_cedula']) : '';
$cedula = (isset($_POST['cedula'])) ? limpiar($_POST['cedula']) : '';
$nombres = (isset($_POST['nombres'])) ? limpiar($_POST['nombres']) : '';
$apellidos = (isset($_POST['apellidos'])) ? limpiar($_POST['apellidos']) : '';
$sexo = (isset($_POST['sexo'])) ? limpiar($_POST['sexo']) : '';
$estado_civil = (isset($_POST['estado_civil'])) ? limpiar($_POST['estado_civil']) : '';
$fecha_nacimiento = (isset($_POST['fecha_nacimiento'])) ? limpiar($_POST['fecha_nacimiento']) : '';
$lugar_nacimiento = (isset($_POST['lugar_nacimiento'])) ? limpiar($_POST['lugar_nacimiento']) : '';
$telefono = (isset($_POST['telefono'])) ? limpiar($_POST['telefono']) : '';
$fax = (isset($_POST['fax'])) ? limpiar($_POST['fax']) : '';
$correo = (isset($_POST['correo'])) ? limpiar($_POST['correo']) : '';
$web = (isset($_POST['web'])) ? limpiar($_POST['web']) : '';
$direccion = (isset($_POST['direccion'])) ? limpiar($_POST['direccion']) : '';
$descripcion = (isset($_POST['descripcion'])) ? limpiar($_POST['descripcion']) : '';
$idzona = (isset($_POST['idzona'])) ? limpiar($_POST['idzona']) : '';
$idtipo = (isset($_POST['idtipo'])) ? limpiar($_POST['idtipo']) : '';
$m_fecha_convercion = (isset($_POST['m_fecha_convercion'])) ? limpiar($_POST['m_fecha_convercion']) : '';
$m_fecha_bautizmo_agua = (isset($_POST['m_fecha_bautizmo_agua'])) ? limpiar($_POST['m_fecha_bautizmo_agua']) : '';
$m_fecha_bautizmo_es = (isset($_POST['m_fecha_bautizmo_es'])) ? limpiar($_POST['m_fecha_bautizmo_es']) : '';
$m_iglesia = (isset($_POST['m_iglesia'])) ? limpiar($_POST['m_iglesia']) : '';
$m_pastor = (isset($_POST['m_pastor'])) ? limpiar($_POST['m_pastor']) : '';
$m_ministerio = (isset($_POST['m_ministerio'])) ? limpiar($_POST['m_ministerio']) : '';
$m_idescalafon = (isset($_POST['m_idescalafon'])) ? limpiar($_POST['m_idescalafon']) : '';
$m_fecha_escalafon = (isset($_POST['m_fecha_escalafon'])) ? limpiar($_POST['m_fecha_escalafon']) : '';

$array_estudios = (isset($_POST['array_estudios'])) ? json_decode($_POST['array_estudios']) : '';
$array_ocupacion = (isset($_POST['array_ocupacion'])) ? json_decode($_POST['array_ocupacion']) : '';

$idtercero = (isset($_POST['idtercero'])) ? limpiar($_POST['idtercero']) : '';
$fecha = (isset($_POST['fecha'])) ? limpiar($_POST['fecha']) : '';
$fecha_fin = (isset($_POST['fecha_fin'])) ? limpiar($_POST['fecha_fin']) : '';
$tipo = (isset($_POST['tipo'])) ? limpiar($_POST['tipo']) : '';
$estudio = (isset($_POST['estudio'])) ? limpiar($_POST['estudio']) : '';
$lugar = (isset($_POST['lugar'])) ? limpiar($_POST['lugar']) : '';
$ocupacion = (isset($_POST['ocupacion'])) ? limpiar($_POST['ocupacion']) : '';

$idestudio = (isset($_POST['idestudio'])) ? limpiar($_POST['idestudio']) : '';
$idocupacion = (isset($_POST['idocupacion'])) ? limpiar($_POST['idocupacion']) : '';

if($opt == 'add_ministro'){
    $cedula_full = $tipo_cedula.$cedula;
    //validar si el ministro existe
    $datos_aux = get_ministro_cedula($cedula_full);
    if ($datos_aux == 0) {
        //REGISTRAR MINISTRO EN tercero
        $sql = "INSERT INTO `tercero` (`idtipo_tercero`, `cedula`, `razon_social`, `apellidos`, `sexo`, 
        `estado_civil`, `lugar_nacimiento`, `fecha_nac`, `telefono`, 
        `fax`, `correo`, `web`, `direccion`, `descripcion`) 
        VALUES ($idtipo, '$cedula_full', '$nombres', '$apellidos', '$sexo', 
        '$estado_civil', '$lugar_nacimiento', '$fecha_nacimiento', '$telefono', 
        '$fax', '$correo', '$web', '$direccion', '$descripcion');";
        $result = $mysqli->query($sql);
        if($mysqli->affected_rows > 0 ){
          $idtercero = $mysqli->insert_id;
          //REGISTRAR MINISTRO EN UNA ZONA
          $sql = "INSERT INTO `tercero_zonas` (`idzona`, `idtercero`) VALUES ($idzona, $idtercero);";
          $result = $mysqli->query($sql);
          if($mysqli->affected_rows > 0 ){
            //REGISTRAR MINISTRO EN tercero_ministerial
            $sql = "INSERT INTO `tercero_ministerial` (`idtercero`, `convercion`, `bautizmo_agua`, `bautizmo_ES`, 
            `iglesia`, `pastor`, `ministerio`) 
            VALUES ($idtercero, '$m_fecha_convercion', '$m_fecha_bautizmo_agua', '$m_fecha_bautizmo_es', 
            '$m_iglesia', '$m_pastor', '$m_ministerio');";
            $result = $mysqli->query($sql);
            if($mysqli->affected_rows > 0 ){
                //REGISTRAR ESCALAFON
                $sql = "INSERT INTO `tercero_escalafon` (`idtercero`, `idescalafon`, `fecha`, `status`) 
                VALUES ($idtercero, $m_idescalafon, NOW(), '1');";
                $result = $mysqli->query($sql);
                if($mysqli->affected_rows > 0 ){
                    //AGREGAR LOS ESTUDIOS
                    if ($array_estudios != '') {
                        if(!empty($array_estudios)){
                            foreach ($array_estudios as $row) {
                                //variables de los detalles
                                $tipo = $row[0];
                                $fecha = $row[1];
                                $estudio = $row[2];
                                $lugar = $row[3];
                                
                                $sql = "INSERT INTO `tercero_estudios` (`idtercero`, `fecha`, `estudio`, `lugar`, `tipo`, `status`) 
                                VALUES ($idtercero, '$fecha', '$estudio', '$lugar', '$tipo', 1);";
                                $result = $mysqli->query($sql);
                              }
                        }
                    }
                    
                    //AGREGAR LAS OCUPACIONES
                    if ($array_ocupacion != '') {
                        if(!empty($array_ocupacion)){
                            foreach ($array_ocupacion as $row) {
                                //variables de las ocupaciones
                                $tipo = $row[0];
                                $ocupacion = $row[1];
                                $fecha = $row[2];
                                $fecha_fin = $row[3];
                                
                                $sql = "INSERT INTO `tercero_ocupaciones` (`idtercero`, `fecha`, `fecha_fin`, `ocupacion`, `tipo`) 
                                VALUES ($idtercero, '$fecha', '$fecha_fin', '$ocupacion', '$tipo');";
                                $result = $mysqli->query($sql);
                              }
                        }
                    }
                    

                    $array['response'] = 'exito';
                }else {
                    $array['response'] = 'error_insert_tercero_escalafon';
                }
            }else {
                $array['response'] = 'error_insert_tercero_ministerial';
            }
          }else {
            $array['response'] = 'error_insert_tercero_zonas';
          }
        }else {
            // $array['response'] = $sql;
            $array['response'] = 'error_insert_tercero';
        }
    }else {
        $array['response'] = 'cedula_existe';
    }
}elseif ($opt == 'add_estudio') {
    $sql = "INSERT INTO `tercero_estudios` (`idtercero`, `fecha`, `estudio`, `lugar`, `tipo`) 
    VALUES ($idtercero, '$fecha', '$estudio', '$lugar', '$tipo');";
    $result = $mysqli->query($sql);
    if($mysqli->affected_rows > 0 ){
        $array['response'] = 'exito';
        $array['idestudio'] = $mysqli->insert_id;
    }else {
        $array['response'] = 'error_insert';
    }
}elseif($opt == 'delete_estudio'){
   $sql = "UPDATE `tercero_estudios` SET `status`='0' WHERE `idtercero_estudio`=$idestudio;";
   $result = $mysqli->query($sql);
    if($mysqli->affected_rows > 0 ){
        $array['response'] = 'exito';
    }else {
        $array['response'] = 'error_deleted';
    }
}elseif($opt == 'add_ocupacion') {
    $sql = "INSERT INTO `tercero_ocupaciones` (`idtercero`, `fecha`, `fecha_fin`, `ocupacion`, `tipo`) 
    VALUES ($idtercero, '$fecha', '$fecha_fin', '$ocupacion', '$tipo');";
    $result = $mysqli->query($sql);
    if($mysqli->affected_rows > 0 ){
        $array['response'] = 'exito';
        $array['idocupacion'] = $mysqli->insert_id;
    }else {
        $array['response'] = 'error_insert';
    }
}elseif($opt == 'delete_ocupacion'){
    $sql = "UPDATE `tercero_ocupaciones` SET `status`='0' WHERE `idtercero_ocupacion`=$idocupacion;";
    $result = $mysqli->query($sql);
    if($mysqli->affected_rows > 0 ){
        $array['response'] = 'exito';
    }else {
        $array['response'] = 'error_deleted';
    }
}elseif ($opt = 'edit_ministro') {
    $tercero = get_tercero($idtercero);
    if ($tercero != 0) {
        $cedula_full = $tipo_cedula.$cedula;
        //validar si la cedula a actualizar ya corresponde a otra persona
        $continuar = true;
        $sql_cedula_update = "";
        if ($cedula_full != $tercero['cedula']) {
            $sql_cedula = "SELECT * FROM tercero WHERE cedula='$cedula_full' AND idtercero != $idtercero";
            $result = $mysqli->query($sql_cedula);
            if($mysqli->affected_rows > 0 ){
                $continuar = false;
            }else {
                $sql_cedula_update = "`cedula`='$cedula_full',";
            }
        }


        if ($continuar) {
            //ACTUALIZAR EN TABLA -> TERCERO
            $sql = "UPDATE `tercero` SET `idtipo_tercero`=$idtipo, $sql_cedula_update `razon_social`='$nombres', `apellidos`='$apellidos', 
            `sexo`='$sexo', `estado_civil`='$estado_civil', `lugar_nacimiento`='$lugar_nacimiento', `fecha_nac`='$fecha_nacimiento', `telefono`='$telefono', `fax`='$fax', 
            `correo`='$correo', `web`='$web', `direccion`='$direccion', `descripcion`='$descripcion' WHERE `idtercero`='$idtercero';";
            $result = $mysqli->query($sql);

            //ACTUALIZAR EN TABLA MINISTRO
            //-->buscar si existe algunos datos para actualizar, sino insertar datos
            $sql_ministerial = "SELECT * FROM tercero_ministerial WHERE idtercero = $idtercero";
            $result_m = $mysqli->query($sql_ministerial);
            if($mysqli->affected_rows > 0 ){//actualizar datos ministeriales
                $sql2 = "UPDATE `tercero_ministerial` SET `convercion`='$m_fecha_convercion', `bautizmo_agua`='$m_fecha_bautizmo_agua', `bautizmo_ES`='$m_fecha_bautizmo_es', 
                `iglesia`='$m_iglesia', `pastor`='$m_pastor', `ministerio`='$m_ministerio' WHERE `idtercero`=$idtercero";
                $result2 = $mysqli->query($sql2);
            }else{//insertar datos ministeriales
                $sql2 = "INSERT INTO `tercero_ministerial` (`idtercero`, `convercion`, `bautizmo_agua`, `bautizmo_ES`, `iglesia`, `pastor`, `ministerio`) VALUES 
                ($idtercero, '$m_fecha_convercion', '$m_fecha_bautizmo_agua', '$m_fecha_bautizmo_es', '$m_iglesia', '$m_pastor', '$m_ministerio');";
                $result2 = $mysqli->query($sql2);
            }

            //CAMBIAR ZONA SI FUE EL CASO
            if ($idzona != $tercero['idzona'] && $idempresa_sesion != '') {
                $insertar_zona = false;
                //buscar todas las zonas activas del ministro en el distrito
                $sql_zonas = "SELECT tz.idzona, tz.idtercero FROM tercero_zonas tz
                LEFT JOIN zonas z ON tz.idzona = z.idzona
                WHERE z.idempresa = $idempresa_sesion AND z.status AND tz.status AND idtercero = $idtercero";
                $result3 = $mysqli->query($sql_zonas);
                if ($mysqli->affected_rows > 0) {
                    while($row = $result3->fetch_array(MYSQLI_ASSOC)){
                        $sql_update = "UPDATE `tercero_zonas` SET `status`='0' WHERE `idzona`=".$row['idzona']." AND `idtercero`= ".$row['idtercero'];
                        $result_update = $mysqli->query($sql_update);
                    }
                    $insertar_zona = true;
                }else {
                    $insertar_zona = true;
                }

                if ($insertar_zona) {
                    $sql_insertar_zona = "INSERT INTO `tercero_zonas` (`idzona`, `idtercero`, `status`) VALUES ($idzona, $idtercero, 1);";
                    $result_insert_zona = $mysqli->query($sql_insertar_zona);
                }
            }

            //CAMBIAR ESCALAFON SI ES EL CASO
            if ($m_idescalafon != $tercero['idescalafon']) {
                $sql_escalafon_set_0 = "UPDATE `tercero_escalafon` SET `status`='0' WHERE `idtercero`=$idtercero;";
                $result_set_0 = $mysqli->query($sql_escalafon_set_0);
                $sql_add_escalafon = "INSERT INTO `tercero_escalafon` (`idtercero`, `idescalafon`, `fecha`, `status`) 
                VALUES ($idtercero, $m_idescalafon, '$m_fecha_escalafon', 1);";
                $result_insert = $mysqli->query($sql_add_escalafon);
            }
            $array['response'] = 'exito';
        }else {
            $array['response'] = 'cedula_asignada_a_otro_tercero';
        }
    }else {
        $array['response'] = 'idtercero_no_encontrado';
    }

    
}


$mysqli->close();
echo json_encode($array);
exit();
?>