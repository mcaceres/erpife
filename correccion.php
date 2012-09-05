<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include 'ctrl_sesion.php';
include 'menu_perfil.php';
include 'func_conn.php';
include 'mail.php';
require("class.phpmailer.php");
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
<h2>Alta de corrección</h2>
<br />
<?php
extract($_POST);
	echo "<pre>";
//print_r($_POST);
//print_r($_SESSION);
	echo "</pre>";
	conectar();
	$query = "UPDATE trabajo SET t_estado = '" . $estado . "' WHERE t_id = '" . $numero . "'";
	//echo $query . "<br />";
	$insert = mysql_query($query);
	$query = "INSERT INTO correcciones (c_t_id, c_u_id, c_comentario) VALUES ('" . $_POST['numero'] . "', '" . $_SESSION['u_id'] . "', '" . $_POST['correccion'] . "')";
	//echo $query;
	$insert = mysql_query($query);
	echo mysql_error();
/*	$SELECT u_nomyape, u_email, t_id FROM trabajo
INNER JOIN usuario ON trabajo.t_ex_id = usuario.u_id AND trabajo.t_id = '103'
*/
	echo "Corrección realizada.";
	$mail = mysql_fetch_array(mysql_query("SELECT u_email, e_descripcion FROM usuario INNER JOIN trabajo ON trabajo.t_ex_id = usuario.u_id AND t_id = '" . $_POST['trabajo'] . "' INNER JOIN estado ON estado.e_id = trabajo.t_estado"));
	$_SESSION['t_estado'] = $mail['e_descripcion'];
//	print_r($mail);
	enviar_mail("evaluado", "Se ha corregido su trabajo...", $_SESSION['t_titulo'], $mail['u_email'])
?>
</div>
<div id="left">
<?php
//print_r($_SESSION);
if(!isset($_SESSION['usuario']))
{
	insertar('login');
}
?>			
	<div class="box">
				<h2>Links :</h2>
				<ul>
				<li><a href="http://www.iaes.edu.ar">IAES Puerto Rico</a></li>
				</ul>
	</div>
		
    <div class="box">
	   <div style="font-size: 0.8em;">Design by <a href="http://www.minimalistic-design.net">Minimalistic Design</a></div>
	</div>
</div>
</div>
</body>
</html>
