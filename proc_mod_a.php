<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include 'ctrl_sesion.php';
include 'menu_perfil.php';
include 'func_conn.php';
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
<h2>Modificación / eliminación de áreas temáticas</h2>
<?php
extract($_POST);
//print_r($_POST);
	conectar();
	if(isset($eliminar))
	{
		$res = mysql_query("DELETE FROM area_tematica WHERE area_tematica.a_id = '" . $a_id . "'");
		if(!mysql_errno())
		{
			echo "Área eliminada...";
		}
		else
		{
			echo "Hubo un error " . mysql_errno();
		}
	}
	else
	{
		if(isset($guardar))
		{
			$res = mysql_query("UPDATE area_tematica SET a_descripcion = '" . $descripcion . "' WHERE a_id = '" . $a_id . "'");
			if(!mysql_errno())
			{
				echo "Datos actualizados correctamente";
			}
			else
			{
				echo "Hubo un error " . mysql_errno();
			}
		}
		else
		{
			echo "Error...";
		}
	}
?>

<p>


