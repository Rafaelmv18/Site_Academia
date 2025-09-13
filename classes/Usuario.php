<?php 
Class Usuario{
    public static function cadastrarUsuario($nome, $sexo, $endereco) {
		$sql = MySql::conectar()->prepare("INSERT INTO `tb_usuarios` VALUES (null,?,?,?)");
		$sql->execute(array($nome, $sexo, $endereco));
	}
	public static function atualizarUsuario($id, $nome, $sexo, $endereco) {
		$sql = MySql::conectar()->prepare("UPDATE `tb_.usuarios` SET nome = ?, sexo = ?, endereco = ? WHERE id = ?");
		if ($sql->execute(array($nome, $sexo, $endereco, $id))) {
			return true;
		} else {
			return false;
		}
	}
}
?>