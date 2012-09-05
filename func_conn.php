<?php

error_reporting(0);

function conectar()
{
	mysql_connect("localhost", "root", "mysqladmin");
	mysql_select_db("ponencias");

	$evento = mysql_fetch_array(mysql_query("SELECT eve_nombre, eve_anio, eve_email FROM evento WHERE evento.eve_id = '1' LIMIT 0,30"));
	$_SESSION['evento'] = $evento['eve_nombre'] . " (" . $evento['eve_anio'] . ")";

	$_SESSION['eve_email'] = $evento['eve_email'];

//	mysql_connect("mysql11.000webhost.com", "a3409092_iaes", "iaes9ponencias");//Se conecta a la base de datos
//	mysql_select_db("a3409092_iaes");
/*
$mysql_host = "mysql11.000webhost.com";
$mysql_database = "a3409092_iaes";
$mysql_user = "a3409092_iaes";
$mysql_password = "iaes9ponencias";
*/	
}

?>
