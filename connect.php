<?php  
	
	# Erros
	ini_set("display_errors", 1);

	# Váriaveis de controle
	$host = "localhost";
	$user = "root";
	$password = "utd123456";
	$database = "db_booklet";

	# Função de conexão
	$conn = mysqli_connect($host,$user,$password,$database) or die(mysqli_connect_error());
	
	
?>