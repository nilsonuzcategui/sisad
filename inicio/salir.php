<?php
session_start();
unset($_SESSION['sisad']);
if($_SERVER['SERVER_NAME'] == 'localhost'){
  header('Location: /sisad/');
}else{
  header('Location: /sisad/');
}
?>