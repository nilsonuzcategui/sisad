<?php
include_once('../M/funciones.php');
$array = array(
    "response" => "error",
);
//VARIABLES
$opt = (isset($_POST['opt'])) ? limpiar($_POST['opt']) : '';
$idtercero = (isset($_POST['idtercero'])) ? limpiar($_POST['idtercero']) : '';


if ($opt == 'email_editar_ministro') {
  $array['response'] = email_editar_ministro($idtercero);
}

echo json_encode($array);
?>