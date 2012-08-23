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
<h2>Alta de usuario</h2><br />
<?php
extract($_POST);
//print_r($_POST);
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
			if($password == $verif && $password != null)
			{
				$query = "UPDATE usuario SET u_username = '" . $username . "', 'u_dni = '" . mysql_real_escape_string($dni) . "', u_nomyape = '" . mysql_real_escape_string($nomyape) . "', u_password = '" . mysql_real_escape_string($password) . "', u_email = '" . mysql_real_escape_string($email) . "', u_filiacion = '" . mysql_real_escape_string($filiacion) . "', u_perfil = '" . $perfil . "' WHERE u_id = '" . mysql_real_escape_string($u_id) . "'";
				$res = mysql_query($query);
				if(!mysql_errno())
				{
					echo "Datos actualizados correctamente";
					echo '<meta http-equiv="Refresh" content="3;url=index.php">';
					//header("location:index.php");
				}
				else
				{
					echo "Hubo un error " . mysql_errno() . "<br /> " . mysql_error() . "Primer if";
				}
			}
			else
			{
				if($password == null)
				{
					if(isset($perfil))
					{
						$query = "UPDATE usuario SET u_username = '" . $username . "', u_dni = '" . mysql_real_escape_string($dni) . "', u_nomyape = '" . mysql_real_escape_string($nomyape) . "', u_email = '" . mysql_real_escape_string($email) . "', u_filiacion = '" . mysql_real_escape_string($filiacion) . "', u_perfil = '" . $perfil . "' WHERE u_id = '" . mysql_real_escape_string($u_id) . "'";
						$res = mysql_query($query);
						if(!mysql_errno())
						{
							echo "Datos actualizados correctamente";
							echo '<meta http-equiv="Refresh" content="3;url=' . $_SERVER['HTTP_REFERER'] . '">';
							//header("location:index.php");
						}
						else
						{
							echo "Hubo un error " . mysql_errno() . "<br /> " . mysql_error() . "Segundo if";
						}
					}
					else
					{
						$query = "UPDATE usuario SET u_dni = '" . mysql_real_escape_string($dni) . "', u_nomyape = '" . mysql_real_escape_string($nomyape) . "', u_email = '" . mysql_real_escape_string($email) . "', u_filiacion = '" . mysql_real_escape_string($filiacion) . "' WHERE u_id = '" . mysql_real_escape_string($u_id) . "'";
						$res = mysql_query($query);
						if(!mysql_errno())
						{
							echo "Datos actualizados correctamente";
							echo '<meta http-equiv="Refresh" content="3;url=' . $_SERVER['HTTP_REFERER'] . '">';
							//header("location:index.php");
						}
						else
						{
							echo "Hubo un error " . mysql_errno() . "<br /> " . mysql_error() . " 3er";
						}
					}
				}
				else
				{
					echo "Las contraseñas no coinciden... ";
				}
			}
		}
		else
		{
			
		}
	}
?>

<p>
