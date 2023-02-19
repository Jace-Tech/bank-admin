<?php  
error_reporting(0);

// Configs
$CONFIGS = json_decode(file_get_contents("./config/setup.json"), true) or die("Can't load setup.json");
extract($CONFIGS);

// Session
require_once("./addons/Session.php");