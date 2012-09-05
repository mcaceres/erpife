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
<h2>Estado de trabajos presentados</h2>
<?php
extract($_POST);
//print_r($_POST);
//print_r($_SESSION);
	conectar();
?>
<br />
<p>
	<form name="corregir" method="POST" action="eval.php" class="niceform">
	<fieldset>
	<legend>Trabajos presentados</legend>
	<?php
		conectar();
		$lista = mysql_query("SELECT c_comentario, t_id, t_titulo, t_resumen, a_descripcion FROM correcciones INNER JOIN (usuario INNER JOIN (trabajo INNER JOIN area_tematica ON trabajo.t_area_id = area_tematica.a_id) ON usuario.u_id = t_ex_id) ON correcciones.c_t_id = trabajo.t_id WHERE trabajo.t_ex_id = '" . $_SESSION['u_id'] . "' ORDER BY c_id DESC LIMIT 0,1");
		if(mysql_num_rows($lista) > 0)
		{	
			while($fila = mysql_fetch_array($lista))
			{
				echo "
				<dl>
					<dt><label for=\"numero\">Número de trabajo: </label></dt>
					<dd>" .  abs($fila['t_id']) . "</dd>
				</dl>
				<dl>
					<dt><label for=\"titulo\">Título: </label></dt>
					<dd><b><i>" . $fila['t_titulo'] . "</i></b></dd>
				</dl>
				<dl>
					<dt><label for=\"descripcion\">Área temática: </label></dt>
					<dd>" . $fila['a_descripcion'] . "</dd>
				</dl>
				<dl>
					<dt><label for=\"correccion\">Corrección: </label></dt>
					<dd><em>" . $fila['c_comentario'] . "</em></dd>
				</dl>
	";
			}
		}
		else
		{
			echo "<br />No tiene trabajos presentados corregidos...";
		}		
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
<p>
</body>
</html>
