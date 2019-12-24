<?php  

	# Incluindo os arquivos necessários
	include_once dirname(__DIR__)."/models/config.php";
	include_once $project_path."/models/connect.php";
	include_once $project_path."/models/manager.php";

	# Validando a sessão
	session_start();

	if(!isset($_SESSION[md5("user_data")])){
		header("location: $project_index?error=access_denied");
	}

	# Recuperando os dados da sessão
	$user = $_SESSION[md5("user_data")];
	
	# Testando se é realmente um ADMIN 
	if($user['profile_page'] != "admin.php"){
		header("location: $project_index?error=access_denied");
	}

	# Recebendo os dados do formulário
	$data = $_POST;

	# Criptografando a SENHA
	$data['user_password'] = password_hash($data['user_password'], PASSWORD_DEFAULT);

	# Gravando os dados no banco
	insert("tb_users", $data);


	if($data['profile_id'] != 3){
		# Redirecionamento
		header("location: $project_index/".$user['profile_page']."?option=manager_users&success=insert_ok");	
	}else{
		# Redirecionamento
		header("location: $project_index/".$user['profile_page']."?option=manager_clients&success=insert_ok");
	}

?>