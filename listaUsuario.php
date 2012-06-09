<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
session_start();
include "ctrl_sesion.php";
include "menu_perfil.php";
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
<h2>Listado de usuarios</h2>
<p>
	<form name="lista" method="POST" action="bm.php" class="niceform">
	<?php
		conectar();
		$lista = mysql_query("SELECT u_id, u_username, u_dni, u_email, u_nomyape, descripcion FROM usuario, perfil where usuario.u_perfil = perfil.perfil_id ORDER BY usuario.u_id");
		echo "<table>
		<tr><center><th>Username</th><th>DNI</th><th>Email</th><th>Nombre y Apellido</th><th>Perfil</th><th>Modificar</th></center></tr>";
		while($fila = mysql_fetch_array($lista))
		{
			echo "<tr>
			<td> " . $fila['u_username'] . "</td>
			<td> " . $fila['u_dni'] . "</td>
			<td> " . $fila['u_email'] . "</td>
			<td> " . $fila['u_nomyape'] ."</td>
			<td> " . ucfirst($fila['descripcion']) . "</td>
			<td> <input type=\"submit\" name=\"modificar\" value=\"" . $fila['u_id'] . "\"> </td>
			</tr>";
		}
		echo "</table>";
	?>
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

