<?php
include_once('../M/funciones.php');
$mysqli = on_bd();
$response = 'error';

$usuario = (isset($_POST['cedula'])) ? limpiar($_POST['cedula']) : '';
$clave = (isset($_POST['clave'])) ? limpiar($_POST['clave']) : '';

$sql = "SELECT ud.iduser, ud.iduser_root, ud.idtercero, ud.user, ud.secretaria,
sp.nacional, sp.distrital, sp.zonal, sp.idobjeto,
t.razon_social, t.apellidos, t.correo, pf.ruta AS foto
FROM user_data ud
LEFT JOIN sisad_permisos sp ON ud.iduser=sp.iduser
LEFT JOIN tercero t ON ud.idtercero=t.idtercero
LEFT JOIN portal_foto pf ON ud.idtercero=pf.idtercero 
WHERE ud.user='$usuario' AND ud.pass='$clave' AND ud.status LIMIT 1";
$result = $mysqli->query($sql);
if($mysqli->affected_rows > 0 ){
    $datos = $result->fetch_array(MYSQLI_ASSOC);
    $idtercero = $datos['idtercero'];
    $idobjeto = $datos['idobjeto'];
    $idconcilio = get_idempresa_concilio();
    if ($datos['secretaria']) {
        $is_login = false;
        //validar si esta asignado a algo
        if ($datos['nacional'] || $datos['distrital'] || $datos['zonal']) {
            //buscar licencia
            if ($datos['nacional']) {
                $sql2 = "SELECT l.fin, l.status, l.idempresa, l.is_limite 
                FROM licencias l WHERE idempresa = $idconcilio AND l.status";
            }
            if ($datos['distrital']) {
                $sql2 = "SELECT l.fin, l.status, l.idempresa, l.is_limite 
                FROM licencias l WHERE idempresa = $idobjeto AND l.status";
            }
            if ($datos['zonal']) {
                $sql2 = "SELECT l.fin, l.status, l.idempresa, l.is_limite
                FROM zonas z
                LEFT JOIN licencias l ON l.idempresa=z.idempresa
                WHERE z.idzona = $idobjeto AND l.status";
            }
            $result = $mysqli->query($sql2);
            if($mysqli->affected_rows > 0 ){
                $licencia_datos = $result->fetch_array(MYSQLI_ASSOC);
                //validar tipo licencia
                if($licencia_datos['is_limite'] == 0){
                    $is_login = true;
                }else{
                    //validar fecha de vencimiento de la licencia
                    $hoy = date('Y-m-d', time());
                    if($hoy <= $licencia_datos['fin']){
                        $is_login = true;
                    }else{
                        $response = 'vencido';
                    }
                }
            }else {
                $response = 'no_se_encontro_liciencia';
            }
        } else {
            $response = 'no_asignado_a_nada';
        }

        //almacenar en cache
        if ($is_login) {
            session_start();
            $_SESSION['sisad'] = $datos;
            $response = 'exito';
        }
    } else {
        $response = 'no_secretario';
    }
}else {
    $response = 'no_existe_usuario';
}

$mysqli->close();
echo json_encode($response);
?>