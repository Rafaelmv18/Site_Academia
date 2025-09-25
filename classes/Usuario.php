<?php 
Class Usuario{
    public static function cadastrarUsuario($nome, $senha, $cpf, $email, $telefone, $data, $endereco, $tipo, $cargo) {
		$sql = PgSql::conectar()->prepare("INSERT INTO usuario (nome, senha, cpf, email, telefone, data_nascimento, endereco, tipo_usuario, cargo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$sql->execute(array($nome, $senha, $cpf, $email, $telefone, $data, $endereco, $tipo, $cargo));
	}
	public static function atualizarUsuario($id, $nome, $cpf, $email, $telefone, $data, $endereco) {
		$sql = PgSql::conectar()->prepare("UPDATE usuario SET nome = ?, cpf = ?, email = ?, telefone = ?, data_nascimento = ?, endereco = ? WHERE usuario_id = ?");
		if ($sql->execute(array($nome, $cpf, $email, $telefone, $data, $endereco, $id))) {
			return true;
		} else {
			return false;
		}
	}
}
?>