<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include "ctrl_sesion.php";
include "menu_perfil.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<title>Gestión de ponencias IAES</title>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
</head>
<body>
<div id="header">
<h1>Gestión de ponencias ERPIFE</h1>
<?php
	insertar($_SESSION['perfil']);
?>
</div>
<div id="content">
<div id="right">
<h2>Bienvenido</h2>
<p>
	<?php
		if(isset($_SESSION['usuario']))
		{
			echo "Bienvenido " . $_SESSION['nomyape'] . ", utilice el menú superior para seleccionar las opciones que desee.";
		}
		else
		{
			echo "Bienvenido, identifíquese para poder acceder a las diferentes opciones.";
		}
	?>
</p>
</div>
	
<div id="left">
<?php

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
