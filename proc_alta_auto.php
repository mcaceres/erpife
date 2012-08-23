<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
include 'menu_perfil.php';
include 'func_conn.php';
include 'Mail.php';
require("class.phpmailer.php"); //Importamos la función PHP class.phpmailer
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
<h2>Alta de usuario</h2><br />
<?php
extract($_POST);
//print_r($_POST);

$buscar = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
$reemplazar = array('a', 'e', 'i', 'o', 'u', 'n');
$nomyape = ucfirst(strtolower($nombre)) . " " . ucfirst(strtolower($apellido));
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
		$query = "INSERT INTO usuario (u_username, u_password, u_perfil, u_dni, u_email, u_nomyape, u_filiacion) VALUES ('" . mysql_real_escape_string($username) . "', '" . mysql_real_escape_string($pass_gen) . "', '" . mysql_real_escape_string($perfil) . "', '" . mysql_real_escape_string($dni) . "', '" . mysql_real_escape_string($email) . "', '" . mysql_real_escape_string($nomyape) . "', '" . mysql_real_escape_string($filiacion) . "')";
		$res = mysql_query($query);
		if(mysql_errno())
		{
			if(mysql_errno() == '1062')
			{
				echo "Ya existe un usuario con el nombre " . $username;
			}
			else
			{
				echo "Ha habido un error " . mysql_error();
			}
		}
		else
		{
			$mail = new PHPMailer(); 
			$mail->IsSMTP(); 
			$mail->SMTPAuth = true; // True para que verifique autentificación de la cuenta o de lo contrario False 
			$mail->Username = "registro@erpife.com.ar"; // Tu cuenta de e-mail 
			$mail->Password = "nico1141"; // El Password de tu casilla de correos

			$mail->Host = "localhost"; 
			$mail->From = "registro@erpife.com.ar"; 
			$mail->FromName = "Administrador"; 
			$mail->Subject = "Registro ERPIFE..."; 
			$mail->AddAddress($email, $nomyape); 

			$mail->WordWrap = 50; 

			$body = "¡Bienvenido! Se ha registrado exitosamente en el sistema del ERPIFE.\nSus datos son: \nNombre y Apellido: " . $nomyape . "\nNombre de usuario: " . $username . "\nContraseña: " . $pass_gen . "\nD. N. I.: " . $dni . "\nCorreo electrónico: " . $email . "\nLugar de filiación: " . $filiacion ; 
			$body .= "\n\nPara modificar cualquiera de estos datos, inicie sesión en el sistema y en la opción 'Perfil' podrá hacerlo.\n\nPara solicitar un cambio de perfil (a Evaluador), dirigirse al mismo mail, expresando en el asunto 'Cambio de perfil: Evaluador' y enviando sus datos personales."; 

			$mail->Body = $body; 

			//$mail->Send(); 

			// Notificamos al usuario del estado del mensaje 
			if(!$mail->Send())
			{ 
				echo "No se pudo enviar el Mensaje."; 
			}
			else
			{ 
				echo nl2br($body) . "<br/ > Se ha enviado un correo electrónico a la dirección ingresada. Revíselo para obtener su contraseña de acceso. Compruebe también la carpeta de 'Correo no deseado'."; 
			}
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
