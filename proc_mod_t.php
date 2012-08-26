<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include 'ctrl_sesion.php';
include 'menu_perfil.php';
include 'func_conn.php';
require("class.phpmailer.php"); //Importamos la función PHP class.phpmailer

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
<h1><?php echo $_SESSION['evento']; ?> - SiGePoV</h1>
<?php
	insertar($_SESSION['perfil']);
?>
</div>
<div id="content">
<div id="right">
<h2>Modificación de trabajos</h2>
<p>
<?php
extract($_POST);
//print_r($_POST);
//print_r($_SESSION);
	conectar();
	if(isset($enviar))
	{
		$res = mysql_query("UPDATE trabajo SET t_titulo = '" . $titulo . "', t_area_id = '" . $area . "', t_keywords = '" . $keywords . "', t_resumen = '" . $trabajo ."' WHERE t_id = '" . $t_id . "'");
		if(!mysql_errno())
		{
			echo "Trabajo actualizado correctamente.";
			echo '<meta http-equiv="Refresh" content="3;url=index.php">';
		}
		else
		{
			echo "Hubo un error " . mysql_errno() . mysql_error();
		}
	}
?>
</p>
