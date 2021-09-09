<?php 
//conexion BD
function on_bd(){
    if($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '192.168.43.91'){
      $mysqli = new mysqli("localhost", "root", "", "sacad");
    }else{
      //conexion con la BD de la nube
      $mysqli = new mysqli("159.203.124.63", "asambleas", "asambleas", "sacad");
    }
    $mysqli->query("SET NAMES 'utf8'");
    if (mysqli_connect_errno()) {
        die("Error al conectar: ".mysqli_connect_error());
    }
    return $mysqli;
  }
function off_bd(Mysqli $mysqli){
    $mysqli->close();
}

function get_idempresa_concilio(){
  //idconcilio
  return 25;
}


//FUNCIONES PARA ZONAS -----------------------------------------------------------------------------------
function get_zonas($is_nacional, $is_distrital, $is_zonal, $idobjeto){
  $mysqli = on_bd();
  if ($is_nacional) {
    $sql = "";
  }elseif ($is_distrital) {
    $sql = "SELECT * FROM zonas WHERE idempresa= $idobjeto AND status";
  }elseif ($is_zonal) {
    // $datos_zona = get_zona($idobjeto);
    // $idempresa = $datos_zona['idempresa'];
    $sql = "SELECT * FROM zonas WHERE idzona= $idobjeto AND status";
  }
  
  $result = $mysqli->query($sql);
  if($mysqli->affected_rows > 0 ){
    $array = array();
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        array_push($array,$row);
    }
    $return = $array;
  }else{
    $return = 0;
  }
  off_bd($mysqli);
  return $return;
}

function get_zona($idzona){
  $mysqli = on_bd();
  $sql = "SELECT * FROM zonas WHERE idzona= $idzona";
  $result = $mysqli->query($sql);
  if($mysqli->affected_rows > 0 ){
    $array = array();
    $return = $result->fetch_array(MYSQLI_ASSOC);
  }else{
    $return = 0;
  }
  off_bd($mysqli);
  return $return;
}
//FIN FUNCIONES PARA ZONAS ------------------------------

//FUNCIONES PARA TIPO DE TERCERO -----------------------------------------------------------------------
function get_tipo_tercero($iduser_root){
  $mysqli = on_bd();
  $array = array();
  $sql = "SELECT * FROM tercero_tipo WHERE iduser_root = $iduser_root AND status = '1' ORDER BY idtipo";
    $result = $mysqli->query($sql);
    if($mysqli->affected_rows > 0 ){
      while($row = $result->fetch_array(MYSQLI_ASSOC)){
          array_push($array,$row);
      }
    }
    $return = (count($array) > 0) ? $array : 0;
    off_bd($mysqli);
    return $return;
}
//FIN DE FUNCIONES PARA TIPO TERCERO --------------------



//FUNCIONES PARA MINISTROS ------------------------------------------------------------
function get_ministro_cedula($cedula){
  $mysqli = on_bd();
  $sql = "SELECT t.idtercero, t.idtipo_tercero, t.cedula, t.razon_social, t.apellidos, t.sexo, t.estado_civil, t.nacionalidad, t.lugar_nacimiento,
  t.fecha_nac, t.telefono, t.fax, t.correo, t.web, t.direccion, t.descripcion, tp.numero, tp.tipo
  FROM tercero t
  LEFT JOIN tercero_tipo tp ON t.idtipo_tercero=tp.idtipo
  WHERE t.cedula = '$cedula' LIMIT 1";
  $result = $mysqli->query($sql);
  if($mysqli->affected_rows > 0 ){
    $return = $result->fetch_array(MYSQLI_ASSOC);
  }else{
    $return = 0;
  }
  off_bd($mysqli);
  return $return;
}

function get_tercero($idtercero){
  $mysqli = on_bd();
  $sql = "SELECT t.idtercero, t.idtipo_tercero, t.cedula, t.razon_social, t.apellidos, t.sexo, t.estado_civil, t.nacionalidad, t.lugar_nacimiento,
  t.fecha_nac, t.telefono, t.fax, t.correo, t.web, t.direccion, t.descripcion, tp.numero, tp.tipo, tz.idzona, z.zona,
  tm.convercion, tm.bautizmo_agua, tm.bautizmo_ES, tm.iglesia, tm.pastor, tm.ministerio
  FROM tercero t
  LEFT JOIN tercero_tipo tp ON t.idtipo_tercero=tp.idtipo
  LEFT JOIN tercero_zonas tz ON t.idtercero=tz.idtercero
  LEFT JOIN zonas z ON tz.idzona=z.idzona
  LEFT JOIN tercero_ministerial tm ON t.idtercero = tm.idtercero
  WHERE t.idtercero = $idtercero AND tz.status LIMIT 1";
  $result = $mysqli->query($sql);
  if($mysqli->affected_rows > 0 ){
    $return = $result->fetch_array(MYSQLI_ASSOC);
    $codigo = get_tercero_codigo($idtercero);
    $return += ['codigo'=>$codigo];

    $escalafon = get_tercero_escalafon($idtercero);
    $return += [
      'idescalafon'=>$escalafon['idescalafon'],
      'escalafon'=>$escalafon['escalafon'],
      'fecha_escalafon'=>$escalafon['fecha'],
  ];
  }else{
    $return = 0;
  }
  off_bd($mysqli);
  return $return;
}
function get_tercero_codigo($idtercero){
  $mysqli = on_bd();
  $sql = "SELECT codigo FROM tercero_codigo WHERE idtercero = $idtercero AND status=1";
  $result = $mysqli->query($sql);
  if($mysqli->affected_rows > 0 ){
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $return = $row['codigo'];
  }else{
    $return = '';
  }
  off_bd($mysqli);
  return $return;
}

function get_tercero_escalafon($idtercero){
  $mysqli = on_bd();
  $sql = "SELECT te.idescalafon, te.fecha, e.escalafon
  FROM tercero_escalafon te
  LEFT JOIN escalafon e ON te.idescalafon=e.idescalafon
  WHERE idtercero = $idtercero AND status LIMIT 1";
  $result = $mysqli->query($sql);
  if($mysqli->affected_rows > 0 ){
    $return = $result->fetch_array(MYSQLI_ASSOC);
  }else{
    $return = 0;
  }
  off_bd($mysqli);
  return $return;
}

function get_tercero_estudios($idtercero){
  $mysqli = on_bd();
  $array = array();
  $sql = "SELECT * FROM tercero_estudios
  WHERE idtercero = $idtercero AND status";
    $result = $mysqli->query($sql);
    if($mysqli->affected_rows > 0 ){
      while($row = $result->fetch_array(MYSQLI_ASSOC)){
          array_push($array,$row);
      }
    }
    $return = (count($array) > 0) ? $array : 0;
    off_bd($mysqli);
    return $return;
}

function get_tercero_ocupaciones($idtercero){
  $mysqli = on_bd();
  $array = array();
  $sql = "SELECT * FROM tercero_ocupaciones
  WHERE idtercero = $idtercero AND status";
    $result = $mysqli->query($sql);
    if($mysqli->affected_rows > 0 ){
      while($row = $result->fetch_array(MYSQLI_ASSOC)){
          array_push($array,$row);
      }
    }
    $return = (count($array) > 0) ? $array : 0;
    off_bd($mysqli);
    return $return;
}

function get_terceros_por_zona($idzona){
  $mysqli = on_bd();
  $array = array();
  $sql = "SELECT t.idtercero, tc.codigo, t.cedula, t.razon_social, t.apellidos, t.correo, t.telefono
  FROM tercero t
  LEFT JOIN tercero_codigo tc ON t.idtercero=tc.idtercero
  LEFT JOIN tercero_zonas tz ON t.idtercero=tz.idtercero
  LEFT JOIN zonas z ON tz.idzona=z.idzona
  WHERE tz.status AND tz.idzona = $idzona AND t.idtipo_tercero = 5";
  $result = $mysqli->query($sql);
  if($mysqli->affected_rows > 0 ){
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        array_push($array,$row);
    }
  }
  $return = (count($array) > 0) ? $array : 0;
  off_bd($mysqli);
  return $return;
}

function get_terceros_por_distrito($idempresa){
  $mysqli = on_bd();
  $array = array();
  $sql = "SELECT t.idtercero, tc.codigo, t.cedula, t.razon_social, t.apellidos, t.correo, t.telefono, z.zona
  FROM tercero t
  LEFT JOIN tercero_codigo tc ON t.idtercero=tc.idtercero
  LEFT JOIN tercero_zonas tz ON t.idtercero=tz.idtercero
  LEFT JOIN zonas z ON tz.idzona=z.idzona
  WHERE tz.status AND z.idempresa = $idempresa AND t.idtipo_tercero = 5";
  $result = $mysqli->query($sql);
  if($mysqli->affected_rows > 0 ){
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        array_push($array,$row);
    }
  }
  $return = (count($array) > 0) ? $array : 0;
  off_bd($mysqli);
  return $return;
}
//FIN FUNCIONES PARA MINISTROS --------------------------------




//FUNCIONES PARA LAS IGLESIAS --------------------------------------------------------------------
function get_nombre_iglesias_por_zona($idzona){
  $mysqli = on_bd();
  $array = array();
  $sql = "SELECT t.razon_social, t.apellidos FROM tercero t
  LEFT JOIN tercero_zonas tz ON t.idtercero=tz.idtercero
  WHERE t.idtipo_tercero = 6 AND tz.idzona = $idzona AND tz.status";
  $result = $mysqli->query($sql);
  if($mysqli->affected_rows > 0 ){
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
      $nombre_iglesia = ($row['apellidos'] == '') ? $row['razon_social'] : $row['razon_social'].' '.$row['apellidos'];
        array_push($array, $nombre_iglesia);
    }
  }

  $sql2 = "SELECT iglesia FROM tercero_ministerial WHERE iglesia != '';";
  $result2 = $mysqli->query($sql2);
  if($mysqli->affected_rows > 0 ){
    while($row = $result2->fetch_array(MYSQLI_ASSOC)){
      if (strlen($row['iglesia']) > 2 && $row['iglesia'] != 'N/A') {
        array_push($array, $row['iglesia']);
      } 
    }
  }

  $return = (count($array) > 0) ? $array : '';
  off_bd($mysqli);
  return $return;
}

function get_nombre_iglesias_por_distrito($iddistrito){
  $mysqli = on_bd();
  $array = array();
  $sql = "SELECT t.razon_social, t.apellidos FROM tercero t
  LEFT JOIN tercero_zonas tz ON t.idtercero=tz.idtercero
  LEFT JOIN zonas z ON tz.idzona = z.idzona
  WHERE t.idtipo_tercero = 6 AND z.idempresa = $iddistrito AND tz.status";
  $result = $mysqli->query($sql);
  if($mysqli->affected_rows > 0 ){
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
      $nombre_iglesia = ($row['apellidos'] == '') ? $row['razon_social'] : $row['razon_social'].' '.$row['apellidos'];
        array_push($array, $nombre_iglesia);
    }
  }

  $sql2 = "SELECT tm.iglesia FROM tercero_ministerial tm
  LEFT JOIN tercero t ON tm.idtercero = t.idtercero
  LEFT JOIN tercero_zonas tz ON t.idtercero=tz.idtercero
  LEFT JOIN zonas z ON tz.idzona = z.idzona
  WHERE z.idempresa = $iddistrito AND tz.status AND tm.iglesia != '';";
  $result2 = $mysqli->query($sql2);
  if($mysqli->affected_rows > 0 ){
    while($row = $result2->fetch_array(MYSQLI_ASSOC)){
      if (strlen($row['iglesia']) > 2 && $row['iglesia'] != 'N/A') {
        array_push($array, $row['iglesia']);
      } 
    }
  }

  $return = (count($array) > 0) ? $array : '';
  off_bd($mysqli);
  return $return;
}

function get_iglesias_por_zona($idzona){
  $mysqli = on_bd();
  $array = array();
  $sql = "SELECT t.idtercero, t.cedula, t.razon_social, t.apellidos, t.correo, t.telefono, tc.codigo
  FROM tercero t
  LEFT JOIN tercero_zonas tz ON t.idtercero=tz.idtercero
  LEFT JOIN zonas z ON tz.idzona=z.idzona
  LEFT JOIN tercero_codigo tc ON tc.idtercero = t.idtercero
  WHERE tz.status AND tz.idzona = $idzona AND t.idtipo_tercero = 6";
  $result = $mysqli->query($sql);
  if($mysqli->affected_rows > 0 ){
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        array_push($array,$row);
    }
  }
  $return = (count($array) > 0) ? $array : 0;
  off_bd($mysqli);
  return $return;
}

function get_iglesia_por_distrito($idempresa){
  $mysqli = on_bd();
  $array = array();
  $sql = "SELECT t.idtercero, tc.codigo, t.cedula, t.razon_social, t.apellidos, t.correo, t.telefono, z.zona
  FROM tercero t
  LEFT JOIN tercero_codigo tc ON t.idtercero=tc.idtercero
  LEFT JOIN tercero_zonas tz ON t.idtercero=tz.idtercero
  LEFT JOIN zonas z ON tz.idzona=z.idzona
  WHERE tz.status AND z.idempresa = $idempresa AND t.idtipo_tercero = 6";
  $result = $mysqli->query($sql);
  if($mysqli->affected_rows > 0 ){
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        array_push($array,$row);
    }
  }
  $return = (count($array) > 0) ? $array : 0;
  off_bd($mysqli);
  return $return;
}
//FIN FUNCIONES PARA LAS IGLESIAS --------------------------------


//FUNCIONES PARA LOS ESCALAFONES --------------------------------------------------------------------
function get_escalafones(){
  $mysqli = on_bd();
  $array = array();
  $sql = "SELECT * FROM escalafon";
    $result = $mysqli->query($sql);
    if($mysqli->affected_rows > 0 ){
      while($row = $result->fetch_array(MYSQLI_ASSOC)){
          array_push($array,$row);
      }
    }
    $return = (count($array) > 0) ? $array : 0;
    off_bd($mysqli);
    return $return;
}
//FIN DE FUNCIONES PARA LOS ESCALAFONES -----------------


function ruta_fotos_portal(){
  return '/portal/fotos_perfil/';
}

function get_foto_perfil_sesion($sesion_foto){
  $foto = ($sesion_foto == '') ? 'estandar.jpg' : $sesion_foto ;
  return ruta_fotos_portal().$foto;
}

//---------------------------------------LIMPIAR INPUT DE INYECCIONES SQL-----------------------------------------------------------
function cleanInput($input) {

  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Elimina javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Elimina las etiquetas HTML
    '@<style[^>]*?>.*?</style>@siU',    // Elimina las etiquetas de estilo
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Elimina los comentarios multi-línea
  );

    $output = preg_replace($search, '', $input);
    return $output;
  }

function limpiar($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = limpiar($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        //$output = mysql_real_escape_string($input);
        $output = $input;
    }
    return $input;
}


//----------------------------ENCRIPTAR
function encriptar($data)
{
    $key="abcde12345";
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted=openssl_encrypt($data, "aes-256-cbc", $key, 0, $iv);
    // return the encrypted string with $iv joined
    $return = base64_encode($encrypted."::".$iv);
    //validar que se encuentre ningun +
    if (strpos($return, '+')) {
      $return = encriptar($data);
    }
    return $return;
}
function desencriptar($data)
{
    $key="abcde12345";
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
}





//cambiar un monto a texto
function unidad($numuero){
switch ($numuero)
{
case 9:
{
$numu = "NUEVE";
break;
}
case 8:
{
$numu = "OCHO";
break;
}
case 7:
{
$numu = "SIETE";
break;
}
case 6:
{
$numu = "SEIS";
break;
}
case 5:
{
$numu = "CINCO";
break;
}
case 4:
{
$numu = "CUATRO";
break;
}
case 3:
{
$numu = "TRES";
break;
}
case 2:
{
$numu = "DOS";
break;
}
case 1:
{
$numu = "UNO";
break;
}
case 0:
{
$numu = "";
break;
}
}
return $numu;
}

function decena($numdero){

if ($numdero >= 90 && $numdero <= 99)
{
$numd = "NOVENTA ";
if ($numdero > 90)
$numd = $numd."Y ".(unidad($numdero - 90));
}
else if ($numdero >= 80 && $numdero <= 89)
{
$numd = "OCHENTA ";
if ($numdero > 80)
$numd = $numd."Y ".(unidad($numdero - 80));
}
else if ($numdero >= 70 && $numdero <= 79)
{
$numd = "SETENTA ";
if ($numdero > 70)
$numd = $numd."Y ".(unidad($numdero - 70));
}
else if ($numdero >= 60 && $numdero <= 69)
{
$numd = "SESENTA ";
if ($numdero > 60)
$numd = $numd."Y ".(unidad($numdero - 60));
}
else if ($numdero >= 50 && $numdero <= 59)
{
$numd = "CINCUENTA ";
if ($numdero > 50)
$numd = $numd."Y ".(unidad($numdero - 50));
}
else if ($numdero >= 40 && $numdero <= 49)
{
$numd = "CUARENTA ";
if ($numdero > 40)
$numd = $numd."Y ".(unidad($numdero - 40));
}
else if ($numdero >= 30 && $numdero <= 39)
{
$numd = "TREINTA ";
if ($numdero > 30)
$numd = $numd."Y ".(unidad($numdero - 30));
}
else if ($numdero >= 20 && $numdero <= 29)
{
if ($numdero == 20)
$numd = "VEINTE ";
else
$numd = "VEINTI".(unidad($numdero - 20));
}
else if ($numdero >= 10 && $numdero <= 19)
{
switch ($numdero){
case 10:
{
$numd = "DIEZ ";
break;
}
case 11:
{
$numd = "ONCE ";
break;
}
case 12:
{
$numd = "DOCE ";
break;
}
case 13:
{
$numd = "TRECE ";
break;
}
case 14:
{
$numd = "CATORCE ";
break;
}
case 15:
{
$numd = "QUINCE ";
break;
}
case 16:
{
$numd = "DIECISEIS ";
break;
}
case 17:
{
$numd = "DIECISIETE ";
break;
}
case 18:
{
$numd = "DIECIOCHO ";
break;
}
case 19:
{
$numd = "DIECINUEVE ";
break;
}
}
}
else
$numd = unidad($numdero);
return $numd;
}

function centena($numc){
if ($numc >= 100)
{
if ($numc >= 900 && $numc <= 999)
{
$numce = "NOVECIENTOS ";
if ($numc > 900)
$numce = $numce.(decena($numc - 900));
}
else if ($numc >= 800 && $numc <= 899)
{
$numce = "OCHOCIENTOS ";
if ($numc > 800)
$numce = $numce.(decena($numc - 800));
}
else if ($numc >= 700 && $numc <= 799)
{
$numce = "SETECIENTOS ";
if ($numc > 700)
$numce = $numce.(decena($numc - 700));
}
else if ($numc >= 600 && $numc <= 699)
{
$numce = "SEISCIENTOS ";
if ($numc > 600)
$numce = $numce.(decena($numc - 600));
}
else if ($numc >= 500 && $numc <= 599)
{
$numce = "QUINIENTOS ";
if ($numc > 500)
$numce = $numce.(decena($numc - 500));
}
else if ($numc >= 400 && $numc <= 499)
{
$numce = "CUATROCIENTOS ";
if ($numc > 400)
$numce = $numce.(decena($numc - 400));
}
else if ($numc >= 300 && $numc <= 399)
{
$numce = "TRESCIENTOS ";
if ($numc > 300)
$numce = $numce.(decena($numc - 300));
}
else if ($numc >= 200 && $numc <= 299)
{
$numce = "DOSCIENTOS ";
if ($numc > 200)
$numce = $numce.(decena($numc - 200));
}
else if ($numc >= 100 && $numc <= 199)
{
if ($numc == 100)
$numce = "CIEN ";
else
$numce = "CIENTO ".(decena($numc - 100));
}
}
else
$numce = decena($numc);

return $numce;
}

function miles($nummero){
if ($nummero >= 1000 && $nummero < 2000){
$numm = "MIL ".(centena($nummero%1000));
}
if ($nummero >= 2000 && $nummero <10000){
$numm = unidad(Floor($nummero/1000))." MIL ".(centena($nummero%1000));
}
if ($nummero < 1000)
$numm = centena($nummero);

return $numm;
}

function decmiles($numdmero){
if ($numdmero == 10000)
$numde = "DIEZ MIL";
if ($numdmero > 10000 && $numdmero <20000){
$numde = decena(Floor($numdmero/1000))."MIL ".(centena($numdmero%1000));
}
if ($numdmero >= 20000 && $numdmero <100000){
$numde = decena(Floor($numdmero/1000))." MIL ".(miles($numdmero%1000));
}
if ($numdmero < 10000)
$numde = miles($numdmero);

return $numde;
}

function cienmiles($numcmero){
if ($numcmero == 100000)
$num_letracm = "CIEN MIL";
if ($numcmero >= 100000 && $numcmero <1000000){
$num_letracm = centena(Floor($numcmero/1000))." MIL ".(centena($numcmero%1000));
}
if ($numcmero < 100000)
$num_letracm = decmiles($numcmero);
return $num_letracm;
}

function millon($nummiero){
if ($nummiero >= 1000000 && $nummiero <2000000){
$num_letramm = "UN MILLON ".(cienmiles($nummiero%1000000));
}
if ($nummiero >= 2000000 && $nummiero <10000000){
$num_letramm = unidad(Floor($nummiero/1000000))." MILLONES ".(cienmiles($nummiero%1000000));
}
if ($nummiero < 1000000)
$num_letramm = cienmiles($nummiero);

return $num_letramm;
}

function decmillon($numerodm){
if ($numerodm == 10000000)
$num_letradmm = "DIEZ MILLONES";
if ($numerodm > 10000000 && $numerodm <20000000){
$num_letradmm = decena(Floor($numerodm/1000000))."MILLONES ".(cienmiles($numerodm%1000000));
}
if ($numerodm >= 20000000 && $numerodm <100000000){
$num_letradmm = decena(Floor($numerodm/1000000))." MILLONES ".(millon($numerodm%1000000));
}
if ($numerodm < 10000000)
$num_letradmm = millon($numerodm);

return $num_letradmm;
}

function cienmillon($numcmeros){
if ($numcmeros == 100000000)
$num_letracms = "CIEN MILLONES";
if ($numcmeros >= 100000000 && $numcmeros <1000000000){
$num_letracms = centena(Floor($numcmeros/1000000))." MILLONES ".(millon($numcmeros%1000000));
}
if ($numcmeros < 100000000)
$num_letracms = decmillon($numcmeros);
return $num_letracms;
}

function milmillon($nummierod){
if ($nummierod >= 1000000000 && $nummierod <2000000000){
$num_letrammd = "MIL ".(cienmillon($nummierod%1000000000));
}
if ($nummierod >= 2000000000 && $nummierod <10000000000){
$num_letrammd = unidad(Floor($nummierod/1000000000))." MIL ".(cienmillon($nummierod%1000000000));
}
if ($nummierod < 1000000000)
$num_letrammd = cienmillon($nummierod);

return $num_letrammd;
}


function convertir($numero){
$num = str_replace(",","",$numero);
$num = number_format($num,2,'.','');
$cents = substr($num,strlen($num)-2,strlen($num)-1);
$num = (int)$num;

$numf = milmillon($num);

return $numf." CON ".$cents."/100 Bs.";
}

function validateDate($date, $format = 'Y-m-d'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}


//FUNCIONES PARA ENVIOS DE CORREOS
function email_editar_ministro($idtercero){
  $mysqli = on_bd();
  $tercero = get_tercero($idtercero);


  //Variables para el envio
  $para = $tercero['correo'];
  $titulo = 'S.I.S.A.D - Actualizacion de datos';


  $nombre_empresa = 'Superintedencia del Distrito Falcon';
  $responder_en = 'distritofalcon2013@gmail.com';

  $cabeceras = 'MIME-Version: 1.0' . "\r\n";
  $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
  $cabeceras .= 'From: '.$nombre_empresa.' <'.$responder_en.'>';

  //VARIABLES PARA COMPLETAR EL MENSAJE
  $codigo_tercero = (isset($tercero['codigo'])) ? $tercero['codigo'] : 0;
  $html_codigo = '';
  if ($codigo_tercero != 0) {
    $html_codigo = '<em><strong>Código</strong> de las asambleas asignado para usted es</em>: <strong>'.$codigo_tercero.'</strong>';
  }else {
    $html_codigo = '<em><strong>Usted no posee codigo porque no se ha registrado un aporte a su nombre.</strong></em>';
  }

  $cedula_tercero = $tercero['cedula'];
  $nombre_tercero = $tercero['razon_social'].' '.$tercero['apellidos'];
  $correo_tercero = $para;
  $escalafon_tercero = $tercero['escalafon'];
  $ministerio_tercero = $tercero['ministerio'];
  
  ob_start();
  ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" style="width:100%;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0"><head><meta charset="UTF-8"><meta content="width=device-width, initial-scale=1" name="viewport"><meta name="x-apple-disable-message-reformatting"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta content="telephone=no" name="format-detection"><title>SISAD - Actualizacion de datos</title> <!--[if (mso 16)]><style type="text/css"> a {text-decoration: none;} </style><![endif]--> <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> <!--[if gte mso 9]><xml> <o:OfficeDocumentSettings> <o:AllowPNG></o:AllowPNG> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings> </xml><![endif]--> <!--[if !mso]><!-- --><link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700,700i" rel="stylesheet"> <!--<![endif]--><style type="text/css">#outlook a { padding:0;}.ExternalClass { width:100%;}.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div { line-height:100%;}.es-button { mso-style-priority:100!important; text-decoration:none!important;}a[x-apple-data-detectors] { color:inherit!important; text-decoration:none!important; font-size:inherit!important; font-family:inherit!important; font-weight:inherit!important; line-height:inherit!important;}.es-desk-hidden { display:none; float:left; overflow:hidden; width:0; max-height:0; line-height:0; mso-hide:all;}.es-button-border:hover a.es-button, .es-button-border:hover button.es-button { background:#3498db!important; border-color:#3498db!important;}.es-button-border:hover { border-color:#1f68b1 #1f68b1 #1f68b1 #1f68b1!important; background:#3498db!important;}[data-ogsb] .es-button { border-width:0!important; padding:10px 40px 10px 40px!important;}td .es-button-border:hover a.es-button-1 { background:#2980d9!important; border-color:#2980d9!important;}td .es-button-border-2:hover { background:#2980d9!important;}[data-ogsb] .es-button.es-button-3 { padding:10px 40px!important;}@media only screen and (max-width:600px) {p, ul li, ol li, a { line-height:150%!important } h1 { font-size:26px!important; text-align:center; line-height:120%!important } h2 { font-size:24px!important; text-align:center; line-height:120%!important } h3 { font-size:20px!important; text-align:center; line-height:120%!important } .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a { font-size:26px!important } .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a { font-size:24px!important } .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a { font-size:20px!important } .es-menu td a { font-size:13px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:13px!important } .es-content-body p, .es-content-body ul li, .es-content-body ol li, .es-content-body a { font-size:14px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:13px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:11px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } a.es-button, button.es-button { font-size:14px!important; display:block!important; border-left-width:0px!important; border-right-width:0px!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } .es-menu td { width:1%!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } }</style></head>
<body style="width:100%;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0"><div class="es-wrapper-color" style="background-color:#2980D9"> <!--[if gte mso 9]><v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t"> <v:fill type="tile" color="#2980d9"></v:fill> </v:background><![endif]--><table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top"><tr style="border-collapse:collapse"><td valign="top" style="padding:0;Margin:0"><table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"><tr style="border-collapse:collapse"><td class="es-info-area" align="center" style="padding:0;Margin:0"><table bgcolor="#FFFFFF" class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px"><tr style="border-collapse:collapse"><td align="left" style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px"><table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr style="border-collapse:collapse"><td align="center" valign="top" style="padding:0;Margin:0;width:560px"><table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr style="border-collapse:collapse"><td class="es-infoblock es-m-txt-c" align="center" style="padding:0;Margin:0;line-height:13px;font-size:11px;color:#CCCCCC"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:13px;color:#CCCCCC;font-size:11px">Secretaria de las Asambleas de Dios</p>
</td></tr></table></td></tr></table></td></tr></table></td>
</tr></table><table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"><tr style="border-collapse:collapse"><td align="center" style="padding:0;Margin:0"><table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" bgcolor="transparent" align="center"><tr style="border-collapse:collapse"><td style="padding:0;Margin:0;padding-left:20px;padding-right:20px;background-position:center top;background-color:#ffffff" bgcolor="#ffffff" align="left"><table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr style="border-collapse:collapse"><td valign="top" align="center" style="padding:0;Margin:0;width:560px"><table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-position:center bottom;background-color:transparent" width="100%" cellspacing="0" cellpadding="0" bgcolor="transparent" role="presentation"><tr style="border-collapse:collapse"><td align="center" style="padding:0;Margin:0;font-size:0px"><a target="_blank" href="https://gestionad.pro/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#2980D9;font-size:14px"><img class="adapt-img" src="https://hkabnh.stripocdn.email/content/guids/CABINET_433fd736934b1de75d0cbcef46614e03/images/31391625596786486.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="150"></a></td>
</tr><tr style="border-collapse:collapse"><td bgcolor="transparent" align="center" style="padding:0;Margin:0;padding-bottom:5px;padding-top:10px"><h3 style="Margin:0;line-height:30px;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;font-size:20px;font-style:normal;font-weight:bold;color:#2980d9">¡Hola,&nbsp;hemos actualizado tus datos!</h3></td></tr><tr style="border-collapse:collapse"><td bgcolor="transparent" align="left" style="padding:0;Margin:0;padding-top:10px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:21px;color:#666666;font-size:14px">Recientemente realizamos cambios en tu información personal; Información importante</p></td>
</tr><tr style="border-collapse:collapse"><td bgcolor="transparent" align="left" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:21px;color:#666666;font-size:14px">para el buen procedimiento de nuestros sistemas en Asambleas de Dios.</p></td></tr></table></td></tr></table></td>
</tr><tr style="border-collapse:collapse"><td style="padding:0;Margin:0;background-position:center bottom" align="left"><table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr style="border-collapse:collapse"><td valign="top" align="center" style="padding:0;Margin:0;width:600px"><table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-position:center bottom;background-color:#ffffff;border-radius:0px 0px 5px 5px" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff" role="presentation"><tr style="border-collapse:collapse"><td height="15" align="center" style="padding:0;Margin:0"></td></tr></table></td></tr></table></td>
</tr><tr style="border-collapse:collapse"><td style="padding:0;Margin:0;padding-left:20px;padding-right:20px;background-position:center bottom" align="left"><table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr style="border-collapse:collapse"><td valign="top" align="center" style="padding:0;Margin:0;width:560px"><table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr style="border-collapse:collapse"><td height="10" align="center" style="padding:0;Margin:0"></td></tr></table></td></tr></table></td>
</tr><tr style="border-collapse:collapse"><td style="padding:0;Margin:0;background-position:center bottom" align="left"><table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr style="border-collapse:collapse"><td valign="top" align="center" style="padding:0;Margin:0;width:600px"><table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-position:center bottom;background-color:#ffffff;border-radius:5px 5px 0px 0px" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff" role="presentation"><tr style="border-collapse:collapse"><td height="16" align="center" style="padding:0;Margin:0"></td></tr></table></td></tr></table></td>
</tr><tr style="border-collapse:collapse"><td style="padding:0;Margin:0;padding-left:20px;padding-right:20px;background-position:center bottom;background-color:#ffffff" bgcolor="#ffffff" align="left"><table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr style="border-collapse:collapse"><td valign="top" align="center" style="padding:0;Margin:0;width:560px"><table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr style="border-collapse:collapse"><td bgcolor="transparent" align="left" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:24px;color:#666666;font-size:16px"><?=$html_codigo?></p>
</td></tr><tr style="border-collapse:collapse"><td bgcolor="transparent" align="left" style="padding:0;Margin:0;padding-top:5px;padding-bottom:10px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:21px;color:#666666;font-size:14px">Estos son algunos de los datos que actualizamos.</p></td></tr><tr style="border-collapse:collapse"><td bgcolor="transparent" align="left" style="padding:0;Margin:0;padding-bottom:5px;padding-left:5px;padding-right:5px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:28px;color:#666666;font-size:14px"><span style="color:#2980d9">►&nbsp;</span><strong>Cedula / RIF:</strong> <?=$cedula_tercero?></p>
<p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:28px;color:#666666;font-size:14px"><span style="color:#2980d9">►</span><strong>Nombres y Apellidos:</strong> <?=$nombre_tercero?></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:28px;color:#666666;font-size:14px"><span style="color:#2980d9">►</span>&nbsp;<strong>correo:</strong> <?=$correo_tercero?></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:28px;color:#666666;font-size:14px"><span style="color:#2980d9">►</span>&nbsp;<b>Escalafón:</b>&nbsp;<?=$escalafon_tercero?></p>
<p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:28px;color:#666666;font-size:14px"><span style="color:#2980d9">►</span>&nbsp;<strong>Ministerio:</strong> <?=$ministerio_tercero?></p></td></tr><tr style="border-collapse:collapse"><td bgcolor="transparent" align="center" style="padding:0;Margin:0;padding-bottom:5px;padding-top:10px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:21px;color:#666666;font-size:14px"><strong style="color:#2980d9">Si esta información no coinciden con la real te invito a modificar tu&nbsp;</strong><font color="#2980d9"><b>información</b></font></p></td></tr></table></td>
</tr><tr style="border-collapse:collapse"><td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:560px"><table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr style="border-collapse:collapse"><td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px"><span class="es-button-border" style="border-style:solid;border-color:#2980D9;background:#2980D9;border-width:0px;display:inline-block;border-radius:5px;width:auto"><a href="https://gestionad.pro/portal/" class="es-button es-button-3" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:18px;border-style:solid;border-color:#2980D9;border-width:10px 40px;display:inline-block;background:#2980D9;border-radius:5px;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center">Acceder al Portal AD</a></span></td>
</tr></table></td></tr></table></td></tr><tr style="border-collapse:collapse"><td style="padding:0;Margin:0;background-position:center bottom" align="left"><table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr style="border-collapse:collapse"><td valign="top" align="center" style="padding:0;Margin:0;width:600px"><table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-position:center bottom;background-color:#ffffff;border-radius:0px 0px 5px 5px" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff" role="presentation"><tr style="border-collapse:collapse"><td height="32" align="center" style="padding:0;Margin:0"></td></tr></table></td></tr></table></td></tr></table></td>
</tr></table><table class="es-footer" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top"><tr style="border-collapse:collapse"><td align="center" style="padding:0;Margin:0"><table class="es-footer-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center"><tr style="border-collapse:collapse"><td style="Margin:0;padding-top:15px;padding-left:20px;padding-right:20px;padding-bottom:25px;background-position:center bottom;background-color:transparent" bgcolor="transparent" align="left"> <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:270px" valign="top"><![endif]--><table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left"><tr style="border-collapse:collapse"><td valign="top" align="center" style="padding:0;Margin:0;width:270px"><table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-position:center top" width="100%" cellspacing="0" cellpadding="0" role="presentation"><tr style="border-collapse:collapse"><td class="es-m-txt-c" align="left" style="padding:0;Margin:0;padding-top:5px;padding-bottom:10px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:21px;color:#EFEFEF;font-size:14px">SISAD es&nbsp;una extensión del sistema administrativo contable de las Asambleas de Dios.</p>
</td></tr></table></td></tr></table> <!--[if mso]></td><td style="width:20px"></td>
<td style="width:270px" valign="top"><![endif]--><table class="es-right" cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right"><tr style="border-collapse:collapse"><td align="left" style="padding:0;Margin:0;width:270px"><table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr style="border-collapse:collapse"><td align="center" style="padding:0;Margin:0;font-size:0px"><a target="_blank" href="https://gestionad.pro/portal/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#FFFFFF;font-size:14px"><img class="adapt-img" src="https://hkabnh.stripocdn.email/content/guids/CABINET_433fd736934b1de75d0cbcef46614e03/images/59821625597692037.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="130"></a></td>
</tr></table></td></tr></table> <!--[if mso]></td></tr></table><![endif]--></td></tr></table></td>
</tr></table><table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"><tr style="border-collapse:collapse"><td align="center" style="padding:0;Margin:0"><table bgcolor="transparent" class="es-content-body" align="center" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px"><tr style="border-collapse:collapse"><td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px"><table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr style="border-collapse:collapse"><td valign="top" align="center" style="padding:0;Margin:0;width:560px"><table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"><tr style="border-collapse:collapse"><td class="es-infoblock made_with" align="center" style="padding:0;Margin:0;line-height:0px;font-size:0px;color:#CCCCCC"><a target="_blank" href="https://gestionad.pro/portal/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#CCCCCC;font-size:11px"><img src="https://hkabnh.stripocdn.email/content/guids/CABINET_433fd736934b1de75d0cbcef46614e03/images/58211625597772089.png" alt width="100" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
</tr><tr style="border-collapse:collapse"><td align="center" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;line-height:21px;color:#ffffff;font-size:14px"><strong>SACAD</strong> - Sistema Administrativo Contable de las Asambleas de Dios</p></td></tr></table></td></tr></table></td></tr></table></td></tr></table></td></tr></table></div></body></html>

  
  <?php
  $html = ob_get_clean();
  return mail($para, $titulo, $html, $cabeceras);
}
?>