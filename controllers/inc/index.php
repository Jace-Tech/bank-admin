<?php  
session_start();

// Configs
$CONFIGS = json_decode(file_get_contents("../config/setup.json"), true) or die("Can't load setup.json");
extract($CONFIGS);

if(isset($_SESSION['AUTH_ADMIN'])){
  $ADMIN = json_decode($_SESSION['AUTH_ADMIN'], true)['user'];
  $TOKEN = json_decode($_SESSION['AUTH_ADMIN'], true)['token'];
}
// Utils
require_once("../utils/helpers.php");
require_once("../stores/index.php");
