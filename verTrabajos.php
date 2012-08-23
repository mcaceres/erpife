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
<h2></h2>
<p>
	<form name="corregir" method="POST" action="detalleTrabajo.php" class="niceform">
	<fieldset>
	<legend>Trabajos cargados</legend>

<?php
extract($_POST);
//print_r($_POST);
	conectar();
	
	$query = "SELECT t_id, t_titulo, a_descripcion, e_descripcion FROM estado INNER JOIN (trabajo INNER JOIN area_tematica ON trabajo.t_area_id = area_tematica.a_id) ON estado.e_id = trabajo.t_estado ORDER BY estado.e_id";
	$lista = mysql_query($query);
	echo "<br /><table>
		<tr><center><th>Número</th><th>Título</th><th>Área temática</th><th>Estado</th><th>Detallado</th><th>Enviar</th></center></tr>";
	while($fila = mysql_fetch_array($lista))
	{
		echo "<tr>
		<td> " . $fila['t_id'] . "</td>
		<td> " . $fila['t_titulo'] . "</td>
		<td> " . $fila['a_descripcion'] . "</td>
		<td> " . $fila['e_descripcion'] . "</td>
		<td> <input type=\"submit\" name=\"trabajo\" value=\"" . abs($fila['t_id']) . "\"></td>
		<td>";
		
		if($fila['e_descripcion'] == "Aprobado")
		{
			echo "<input type=\"submit\" name=\"mail\" value=\"" . abs($fila['t_id']) . "\">";
		}
		echo "</td>
		</tr>";
	}
	echo "</table>";
?>
	</fieldset>
	</form>
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
