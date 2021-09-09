<?php
include_once('../M/funciones.php');
$mysqli = on_bd();
session_start();

$q = (isset($_GET['q'])) ? limpiar($_GET['q']) : '';

$sesion = $_SESSION['sisad'];

$is_nacional = $sesion['nacional'];
$is_distrital = $sesion['distrital'];
$is_zonal = $sesion['zonal'];
$idobjeto = $sesion['idobjeto'];

$sql_filtrado_permisos = "";
if ($is_nacional) {
  # code...
}elseif ($is_distrital) {
  $sql_filtrado_permisos = "z.idempresa = $idobjeto AND tz.status = 1 AND ";
  
}elseif ($is_zonal) {
  $sql_filtrado_permisos = "z.idzona = $idobjeto AND";
}


$sql = "SELECT t.idtercero, t.cedula, t.razon_social, t.apellidos FROM tercero t
LEFT JOIN tercero_tipo tp ON t.idtipo_tercero=tp.idtipo
LEFT JOIN tercero_zonas tz ON t.idtercero=tz.idtercero
LEFT JOIN zonas z ON tz.idzona=z.idzona
WHERE t.idtipo_tercero = 5 AND $sql_filtrado_permisos (t.cedula LIKE '%".$q."%' || CONCAT(t.razon_social, ' ',  t.apellidos) LIKE '%".$q."%') LIMIT 10";


$result = $mysqli->query($sql);
$json = [];
if($mysqli->affected_rows > 0 ){
  while($row = $result->fetch_assoc()){
    $texto =  $row['cedula'] .' - '. $row['razon_social'] .' '.$row['apellidos'];
       $json[] = ['id'=>encriptar($row['idtercero']), 'text'=>$texto];
  }
}


off_bd($mysqli);
echo json_encode($json);
?>
