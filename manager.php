<meta charset="utf-8">
<?php  
	
	function insert($table, $data){
	
		# 1° Parte da QUERY -  Inicio
		$query = "INSERT INTO `$table`";
	
		# 2° Parte da Query - CAMPOS
		$fields = array_keys($data);
		$fields = implode("`, `", $fields);		
		$query .= "(`$fields`)";

		# 3º Parte da Query - VALORES
		$values = implode("', '", $data);
		$query .= " VALUES ('$values')";

		//echo $query;
		# Enviando a query para o banco
		global $conn;
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

		return $result;
	}

	/* SELECT * FROM `tb_name` */
	function select($table, $fields, $filters, $query_extra){
		# 1° PARTE DA QUERY - INICIO
		$query = "SELECT ";

		if($fields != NULL){
			foreach($fields as $field){
				$query .= "`$field`, ";
			}

			# Eliminando o espaço e a virgula
			$query = substr($query, 0, -2);

		}else{
			$query .= "*";
		}

		# 2° PARTE DA QUERY - TABELA
		$query .= " FROM `$table` "; 

		# 3° PARTE DA QUERY - FILTROS
		if($filters != NULL){
			$query .="WHERE "; 
			foreach ($filters as $key => $value){
				$query .= "`$key` = '$value' AND ";	
			}

			# Eliminando o espaço e o AND
			$query = substr($query, 0, -4);
		}

		# 4º PARTE DA QUERY - QUERY EXTRA
		if($query_extra != NULL){
			$query .= $query_extra;
		}

		//echo $query;
		# Envio da query para o banco
		global $conn;

		$result = mysqli_query($conn, $query);

		$data;
		while($row = mysqli_fetch_assoc($result)){
			$data[] = $row;
		}

		return $data;
	}

	/* UPDATE tb_name SET campo=novoValor WHERE campo=valor */
	function update($table, $data, $filters){
		
		# 1° PARTE DA QUERY - INICIO
		$query = "UPDATE `$table` SET ";
	
		# 2° PARTE DA QUERY - CAMPOS E VALORES
		foreach ($data as $key => $value) {
			$query .= "`$key` = '$value', ";
		}
		$query = substr($query, 0, -2);

		# 3° PARTE DA QUERY - FILTROS
		$query .=" WHERE "; 
		foreach ($filters as $key => $value){
			$query .= "`$key` = '$value' AND ";	
		}

		# Eliminando o espaço e o AND
		$query = substr($query, 0, -4);

		echo $query;
		# Enviando a query para o banco
		global $conn;
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

		return $result;

	}


	function delete($table, $filters){

		# 1° PARTE DA QUERY 
		$query = "DELETE FROM `$table` WHERE ";

		# 2° PARTE DA QUERY - FILTROS
		foreach ($filters as $key => $value){
			$query .= "`$key` = '$value' AND ";	
		}
		$query = substr($query, 0, -4);

		global $conn;
		$result = mysqli_query($conn, $query);

		return $result;

	}

?>