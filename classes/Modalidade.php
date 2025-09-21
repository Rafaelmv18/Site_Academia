<?php 
Class Modalidade{
    public static function cadastrarModalidade($nome, $descricao, $horarios, $imagens) {
        $sql = PgSql::conectar()->prepare("INSERT INTO modalidade (nome, descricao, horarios, imagem) VALUES (?, ?, ?, ?)");
        $sql->execute(array($nome, $descricao, $horarios, $imagens));
    }
    public static function atualizarModalidade($id, $nome, $descricao, $horarios, $imagens) {
        $sql = PgSql::conectar()->prepare("UPDATE modalidade SET nome = ?, descricao = ?, horarios = ?, imagem = ? WHERE modalidade_id = ?");
        if ($sql->execute(array($nome, $descricao, $horarios, $imagens, $id))) {
            return true;
        } else {
            return false;
        }
    }
    public static function deletarModalidade($id) {
        $sql = PgSql::conectar()->prepare("DELETE FROM modalidade WHERE modalidade_id = ?");
        $sql->execute(array($id));
    }
}
?>
