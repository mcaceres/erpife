<?php

error_reporting(0);

function conectar()
{
	mysql_connect("localhost", "root", "mysqladmin");
	mysql_select_db("ponencias");

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
