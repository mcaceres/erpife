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
<h2>Asignación de trabajos</h2>
<br />
<?php
extract($_POST);
//print_r($_POST);
echo "<br/>";
//print_r($_SESSION);
	conectar();
	foreach($_POST as $variable => $valor)
	{
		if($valor != 'Asignar' && $variable != 'evaluador')
		{
			$query = "INSERT INTO asignaciones (as_id_trabajo, as_id_evaluador) VALUES ('" . $valor . "', '" . $evaluador . "')";
			//echo $query . "<br />";
			$insert = mysql_query($query);
			echo "<br />" . mysql_error() . "<br />";
			$query2 = "UPDATE trabajo SET t_estado = '3', t_asignado = '1' WHERE trabajo.t_id = '" . $valor . "'";
			//echo $query2;
			$insert = mysql_query($query2);
			echo "Trabajo asignado correctamente";
			echo '<meta http-equiv="Refresh" content="3;url=index.php">';
		}
	}
	
?>
<p>


