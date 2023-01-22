<?php session_start(); ?>
<?php require_once("./utils/helpers.php"); ?>
<?php require_once("./stores/index.php"); ?>


<?php  
  if(isset($_SESSION['AUTH_ADMIN'])){
    $ADMIN = json_decode($_SESSION['AUTH_ADMIN'], true)['user'];
    $TOKEN = json_decode($_SESSION['AUTH_ADMIN'], true)['token'];
  }
?>