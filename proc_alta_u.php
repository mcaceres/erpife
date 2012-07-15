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
<h2>Alta de usuario</h2>
<?php
extract($_POST);
//print_r($_POST);
$buscar = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
$reemplazar = array('a', 'e', 'i', 'o', 'u', 'n');
$nomyape = $nombre . " " . $apellido;
$nombre = str_replace($buscar, $reemplazar, strtolower($nombre));
$apellido = str_replace($buscar, $reemplazar, strtolower($apellido));
$espacio = ' ';
$pos = stripos($apellido, $espacio);

$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
$cad = "";
for($i=0;$i<8;$i++)
{
	$cad .= substr($str,rand(0,62),1);
}
$pass_gen =  $cad;

//echo $pos;
if(isset($pos) && $pos != 0)
{
//	echo "pos está seteado";
	$username = substr($nombre, 0, $cant) . substr($apellido, 0, $pos);
}
else
{
	$username =  substr($nombre, 0, $cant) . $apellido;
};
//echo $username;
	conectar();
if($nombre != null && $apellido != null && $dni != null && $email != null)
{
	if($password == $verif)
	{
		$res = mysql_query("INSERT INTO usuario (u_username, u_password, u_perfil, u_dni, u_email, u_nomyape) VALUES ('" . mysql_real_escape_string($username) . "', '" . mysql_real_escape_string($pass_gen) . "', '" . mysql_real_escape_string($perfil) . "', '" . mysql_real_escape_string($dni) . "', '" . mysql_real_escape_string($email) . "', '" . mysql_real_escape_string($nomyape) . "')");
		if(mysql_errno() == '1062')
		{
			echo "Ya existe un usuario con el nombre <b>" . $username . "</b>";
		}
		else
		{
			echo "Usuario <b>" . $username . "</b> creado exitosamente.";
		}
	}
	else
	{
		echo "Las contraseñas no coinciden.";
	}	
}
else
{
	echo "Debe rellenar todos los campos...";
}
?>

<p>

