<?php
class Plano {
    public static function cadastrarPlano($nome, $descricao, $valor) {
        $sql = PgSql::conectar()->prepare("INSERT INTO plano (nome, descricao, valor) VALUES (?, ?, ?)");
        $sql->execute([$nome, $descricao, $valor]);
    }

    public static function atualizarPlano($id, $nome, $valor, $descricao) {
        $sql = PgSql::conectar()->prepare("UPDATE plano SET nome=?, valor=?, descricao=? WHERE plano_id=?");
        $sql->execute([$nome, $valor, $descricao, $id]);
    }

    public static function deletarPlano($id) {
        $sql = PgSql::conectar()->prepare("DELETE FROM plano WHERE plano_id=?");
        $sql->execute([$id]);
    }
}
?>
