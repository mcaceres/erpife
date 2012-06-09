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
<h1>Sistema de Gestión de Ponencias Virtual SiGePoV</h1>
<?php
	insertar($_SESSION['perfil']);
?>
</div>
<div id="content">
<div id="right">
<h2>Alta de usuario</h2>
<?php
extract($_POST);
print_r($_POST);
	conectar();
	if(isset($eliminar))
	{
		$res = mysql_query("DELETE FROM usuario WHERE usuario.u_id = '" . mysql_real_escape_string($u_id) . "'");
		if(!mysql_errno())
		{
			echo "Usuario eliminado correctamente...";
		}
		else
		{
			echo "Hubo un error";
			if(mysql_errno() == 1451)
			{
				echo "No se puede eliminar un usuario que posee un trabajo...";
			}
		}
	}
	else
	{
		if(isset($guardar))
		{
			$query = "UPDATE usuario SET u_dni = '" . mysql_real_escape_string($dni) . "', u_nomyape = '" . mysql_real_escape_string($nomyape) . "', u_password = '" . mysql_real_escape_string($password) . "', u_email = '" . mysql_real_escape_string($email) . "' WHERE u_id = '" . mysql_real_escape_string($u_id) . "'";
			$res = mysql_query($query);
			if(!mysql_errno())
			{
				echo "Datos actualizados correctamente";
			}
			else
			{
				echo "Hubo un error " . mysql_errno() . "<br /> " . mysql_error();
			}
		}
		else
		{
			echo "Error...";
		}
	}
?>

<p>


