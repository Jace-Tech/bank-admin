<?php  
error_reporting(0);
require(realpath("../utils/helpers.php"));
$CONFIGS = json_decode(file_get_contents(__DIR__. "/setup.json"), true) or die("Can't load setup.json");