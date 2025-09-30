<?php 
Class Usuario{
    public static function cadastrarUsuario($nome, $senha, $cpf, $email, $telefone, $data, $endereco, $tipo, $cargo) {
        $con = PgSql::conectar();
		$sql = $con->prepare("INSERT INTO usuario (nome, senha, cpf, email, telefone, data_nascimento, endereco, tipo_usuario, cargo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$sql->execute(array($nome, $senha, $cpf, $email, $telefone, $data, $endereco, $tipo, $cargo));
        $con = null;
	}
	public static function atualizarUsuario($id, $nome, $cpf, $email, $telefone, $data, $endereco) {
        $con = PgSql::conectar();
		$sql = $con->prepare("UPDATE usuario SET nome = ?, cpf = ?, email = ?, telefone = ?, data_nascimento = ?, endereco = ? WHERE usuario_id = ?");
		$result = $sql->execute(array($nome, $cpf, $email, $telefone, $data, $endereco, $id));
        $con = null;
		if ($result) {
			return true;
		} else {
			return false;
		}
	}
}
?>