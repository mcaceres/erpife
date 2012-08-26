<?php
function enviar_mail($tipo, $motivo)
{
	echo $tipo;
	switch ($tipo)
	{
		case "enviado":
		{
			echo "Su trabajo ha sido enviado...";
			datos_email("enviado", $motivo);
		};
		break;
/*		case "asignado":
			{
				;
			};
			break;
		case "evaluacion":
			{
				;
			};
			break;
		case "revision":
			{
				;
			};
			break;
		case "rechazado":
			{
				;
			};
			break;
		case "aprobado":
			{
				;
			};
			break;
*/		default: { ; }; break;
	}
}
function datos_email($status, $justificativo)
{
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; // True para que verifique autentificación de la cuenta o de lo contrario False 
	$mail->Username = "registro@erpife.com.ar"; // Tu cuenta de e-mail 
	$mail->Password = "nico1141"; // El Password de tu casilla de correos

	$mail->Host = "localhost";
				
	$query = "SELECT eve_email, eve_nombre, eve_anio FROM evento";
	$datos = mysql_fetch_assoc(mysql_query($query));
	$mail->From = $datos['eve_email']; 
	$mail->FromName = "Administrador"; 
	$mail->Sender = $datos['eve_email']; 
	$mail->Subject = "Modificación de estado de trabajo..."; 
	$mail->AddAddress($receptor['u_email'], $datos['eve_email']); 

	$mail->WordWrap = 50; 

	$body = "Su trabajo a sido " . $status . ". Será notificado cuando sufra otro cambio de estado (Rechazado, Aprobado, Para revisión)."; 
	if(isset($motivo))
	{
		$body .= "Motivo: ";
	}
	$mail->Body = $body; 

	//$mail->Send(); 

	//Notificamos al operador del estado del mensaje 
	if(!$mail->Send())
	{ 
		echo "No se pudo enviar el Mensaje."; 
	}
	else
	{
		echo nl2br($body) . "<br/ >"; 
	}
}



/*
$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
$cad = "";
for($i=0;$i<8;$i++) {
$cad .= substr($str,rand(0,62),1);
}
print $cad;
*/
?>
