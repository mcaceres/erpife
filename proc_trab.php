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
<h2>Alta de trabajos</h2>
<?php
extract($_POST);
//print_r($_POST);
echo "<br/>";
//print_r($_SESSION);
	conectar();
	
	if($expositor != null && $titulo != null && $trabajo != null && $keywords != null)
	{
		$res = mysql_query("INSERT INTO trabajo (t_ex_id, t_titulo, t_area_id, t_keywords, t_resumen, t_estado) VALUES ('" . $_SESSION['u_id'] . "', '" . $titulo . "', '" . $area . "', '" . $keywords . "', '" . $trabajo . "', '1')");
		if(mysql_error())
		{
			echo mysql_error() . mysql_errno();
		}
		else
		{
			echo "Trabajo dado de alta correctamente...";
		}
		//					INSERT INTO trabajo (t_ex_id, t_titulo, t_area_id, t_keywords, t_resumen) VALUES ('9', 'Titulo de prueba', '1', 'prueba, trabajo', 'Resumen del trabajo...')
	}
	else
	{
		echo "Debe rellenar todos los campos...";
	}
	
?>

<p>


