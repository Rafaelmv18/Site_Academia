<?php 
Class Modalidade{
    public static function cadastrarModalidade($nome, $descricao, $horarios, $imagens) {
        $sql = PgSql::conectar()->prepare("INSERT INTO modalidade (nome, descricao, horarios, imagens) VALUES (?, ?, ?, ?)");
        $sql->execute(array($nome, $descricao, $horarios, $imagens));
    }
    public static function atualizarModalidade($id, $nome, $descricao, $horarios, $imagens) {
        $sql = PgSql::conectar()->prepare("UPDATE modalidade SET nome = ?, descricao = ?, horarios = ?, imagens = ?WHERE id = ?");
        if ($sql->execute(array($nome, $descricao, $horarios, $imagens, $id))) {
            return true;
        } else {
            return false;
        }
    }
}
?>
