<?php
session_start();
if(!isset($_SESSION['usuario'])) // 
{
	$redir = true;
	header("location:index.php");
}

?>
