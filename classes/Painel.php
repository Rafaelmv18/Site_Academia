<?php 

class Painel{
    public static function selectQuery($table, $query = '', $by, $order){
		$sql = MySql::conectar()->prepare("SELECT * FROM `$table` $query ORDER BY `$by` $order");
		$sql->execute();
		return $sql->fetchAll();
	}
    public static function select($table,$query = '',$arr = ''){
		if($query != false){
			$sql = MySql::conectar()->prepare("SELECT * FROM `$table` WHERE $query");
			$sql->execute($arr);
		}else{
			$sql = MySql::conectar()->prepare("SELECT * FROM `$table`");
			$sql->execute();
		}
		return $sql->fetch();
	}
    public static function selectAll($tabela,$by,$order){
		$busca = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY `$by` $order");
		$busca->execute();
		return $busca = $busca->fetchAll();
	}
}

?>