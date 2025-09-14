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
	public static function alert($tipo,$mensagem){
		if($tipo == 'sucesso'){
			echo '
				<div class="alert alert-success" role="alert" style="z-index: 99; top: 1vh; position: fixed; left: 75vw;">
					<i class="bi bi-check-circle me-1" style="margin-right: 5px;"></i>'
					.$mensagem.
					'
					<span class="progress"></span>
				</div>';
		}else if($tipo == 'atencao'){
			echo '
				<div class="noprint alert alert-warning" role="alert" style="z-index: 99; top: 1vh; position: fixed; left: 75vw;">
					<i class="bi bi-exclamation-triangle me-1" style="margin-right: 5px;"></i>'
					.$mensagem.
					'
					<span class="progress"></span>
				</div>';
		}else if($tipo == 'erro'){
			echo '
				<div class="alert alert-danger" role="alert" style="z-index: 99; top: 1vh; position: fixed; left: 75vw;">
					<i class="bi bi-exclamation-octagon me-1" style="margin-right: 5px;"></i>'
					.$mensagem.
					'
					<span class="progress"></span>
				</div>';
		}
	}
}

?>