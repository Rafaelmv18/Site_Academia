<?php 
Class Aluno {
    public static function atualizarAluno($plano_id, $data_inicio, $data_fim, $aluno_id) {
        $sql = PgSql::conectar()->prepare("UPDATE Aluno SET plano_id = ?, data_inicio_plano = ?, data_fim_plano = ? WHERE aluno_id = ?");
        $sql->execute(array($plano_id, $data_inicio, $data_fim, $aluno_id));
    }
}
?>