<?php 
Class Agendamento {
    public static function criarAgendamento($modalidade_id, $aluno_id, $data) {
        $sql = PgSql::conectar()->prepare("INSERT INTO agendamento (modalidade_id, aluno_id, data) VALUES (?, ?, ?)");
        $sql->execute(array($modalidade_id, $aluno_id, $data));
    }
    public static function deletarAgendamento($agendamento_id) {
        $sql = PgSql::conectar()->prepare("DELETE FROM agendamento WHERE agendamento_id = ?");
        $sql->execute(array($agendamento_id));
    }
}
?>