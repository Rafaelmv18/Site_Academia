<?php 
Class Usuario{
    public static function cadastrarUsuario($nome, $senha, $cpf, $email, $telefone, $data, $endereco, $tipo, $cargo) {
		$sql = PgSql::conectar()->prepare("INSERT INTO usuario (nome, senha, cpf, email, telefone, data_nascimento, endereco, tipo_usuario, status, cargo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$sql->execute(array($nome, $senha, $cpf, $email, $telefone, $data, $endereco, $tipo, 'Ativo', $cargo));
	}
	public static function atualizarUsuario($id, $nome, $senha, $cpf, $email, $telefone, $data, $endereco, $tipo, $cargo) {
		$sql = PgSql::conectar()->prepare("UPDATE usuario SET nome = ?, senha = ?, cpf = ?, email = ?, telefone = ?, data = ?, endereco = ?, tipo = ?, cargo = ? WHERE id = ?");
		if ($sql->execute(array($nome, $senha, $cpf, $email, $telefone, $data, $endereco, $tipo, $cargo, $id))) {
			return true;
		} else {
			return false;
		}
	}
}
?>