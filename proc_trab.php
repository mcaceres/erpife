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
<h2>Alta de trabajos</h2>
<?php
extract($_POST);
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
			echo "Trabajo dado de alta correctamente...<br />";
			$receptor = mysql_fetch_assoc(mysql_query("SELECT u_email FROM usuario WHERE u_id = '" . $_SESSION['u_id'] . "'"));
			extract($receptor);
			enviar_mail("enviado_exp", "Ha enviado un trabajo...", $titulo, $u_email);
			enviar_mail("enviado_eve", "Nuevo trabajo cargado...", $titulo, $_SESSION['eve_email']);
		}
	}
	else
	{
		echo "Debe rellenar todos los campos...";
	}
	
?>

<p>



</p>
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
