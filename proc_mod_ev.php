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
<h1><?php echo $_SESSION['evento']; ?> - SiGePoV</h1>
<?php
	insertar($_SESSION['perfil']);
?>
</div>
<div id="content">
<div id="right">
<h2>Modificar datos de eventos</h2>
<?php
extract($_POST);
//print_r($_POST);
$var = strtolower($desc_area);
$desc_area = ucfirst($var);
//echo $username;
	conectar();
	echo "<pre>";
	//print_r($_SERVER);
	echo "</pre>";

if(isset($_POST['enviar']))
{
	conectar();
	$query = "UPDATE evento SET eve_nombre = '" . $_POST['desc_evento'] . "', eve_anio = '" . $_POST['anio'] . "', eve_email = '" . $_POST['email'] . "' WHERE eve_id = '" . $_POST['eve_id'] . "'";
	$guardar = mysql_query($query);
	echo mysql_error();
	echo "Se actualizaron los datos por los siguientes: <br /><br /> <b>Nombre del evento: </b>$desc_evento <br /><b>E-mail</b> $email <br /> <b>Año: </b> $anio";
}
else
{
	'Debe';
}
?>

<p>

