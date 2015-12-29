<?php
$servername = "servername";
$username = "user";
$password = "pass";
$Srv = '171.0.0.1';

/*
 * config bd MysqlPhp
 */
$link = mysql_connect($Srv, $username, $password);
if (!$link) {
    die('Não foi possível conectar: ' . mysql_error());
}

$db_selected = mysql_select_db('ora_view', $link);
if (!$db_selected) {
    die ('Can\'t use ora_view : ' . mysql_error());
}

mysql_query("SET NAMES 'utf8'", $link);
    
