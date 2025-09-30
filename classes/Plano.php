<?php
class Plano {
    public static function cadastrarPlano($nome, $descricao, $valor) {
        $con = PgSql::conectar();
        $sql = $con->prepare("INSERT INTO plano (nome, descricao, valor) VALUES (?, ?, ?)");
        $sql->execute([$nome, $descricao, $valor]);
        $con = null;
    }

    public static function atualizarPlano($id, $nome, $valor, $descricao) {
        $con = PgSql::conectar();
        $sql = $con->prepare("UPDATE plano SET nome=?, valor=?, descricao=? WHERE plano_id=?");
        $sql->execute([$nome, $valor, $descricao, $id]);
        $con = null;
    }

    public static function deletarPlano($id) {
        $con = PgSql::conectar();
        $sql = $con->prepare("DELETE FROM plano WHERE plano_id=?");
        $sql->execute([$id]);
        $con = null;
    }
}
?>