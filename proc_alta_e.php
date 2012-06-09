<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include 'ctrl_sesion.php';
include 'menu_perfil.php';
include 'func_conn.php';
$cant = 1;
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<title>Sistema de Gestión de Ponencias Virtual SiGePoV</title>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="niceforms-default.css" media="forms" />
<script language="javascript" type="text/javascript" src="niceforms.js"></script>
</head>
<body>
<div id="header">
<h1>Sistema de Gestión de Ponencias Virtual SiGePoV</h1>
<?php
	insertar($_SESSION['perfil']);
?>
</div>
<div id="content">
<div id="right">
<h2>Alta de área temática</h2>
<?php
extract($_POST);
//print_r($_POST);
$var = strtolower($desc_area);
$desc_area = ucfirst($var);
//echo $username;
	conectar();
	echo "<pre>";
	print_r($_SERVER);
	echo "</pre>";

if($desc_area != null)
{
	$res = mysql_query("INSERT INTO area_tematica (a_descripcion) VALUES ('" . $desc_area . "')");
	if(mysql_errno() == '1062')
	{
		echo "Ya existe un área temática con el nombre " . $desc_area;
	}
	else
	{
		echo mysql_error();
		echo "Área temática dada de alta exitosamente.";
		echo " <meta http-equiv=\"Refresh\" content=\"5;url=" . $_SERVER['HTTP_REFERER'] . "\">";
		//header("location:" . $_SERVER['HTTP_REFERER'] . "");
	}
}
else
{
	echo "Debe rellenar todos los campos...";
}
?>

<p>

