<?php 
Class Modalidade{
    public static function cadastrarModalidade($nome, $descricao, $horarios, $imagens) {
        $con = PgSql::conectar();
        $sql = $con->prepare("INSERT INTO modalidade (nome, descricao, horarios, imagem) VALUES (?, ?, ?, ?)");
        $sql->execute(array($nome, $descricao, $horarios, $imagens));
        $con = null;
    }
    public static function atualizarModalidade($id, $nome, $descricao, $horarios, $imagens) {
        $con = PgSql::conectar();
        $sql = $con->prepare("UPDATE modalidade SET nome = ?, descricao = ?, horarios = ?, imagem = ? WHERE modalidade_id = ?");
        $result = $sql->execute(array($nome, $descricao, $horarios, $imagens, $id));
        $con = null;
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public static function deletarModalidade($id) {
        $con = PgSql::conectar();
        $sql = $con->prepare("DELETE FROM modalidade WHERE modalidade_id = ?");
        $sql->execute(array($id));
        $con = null;
    }
}
?>