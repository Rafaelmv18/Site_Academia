<?php 
Class Agendamento {
    public static function criarAgendamento($modalidade_id, $aluno_id, $data) {
        $con = PgSql::conectar();
        $sql = $con->prepare("INSERT INTO agendamento (modalidade_id, aluno_id, data) VALUES (?, ?, ?)");
        $sql->execute(array($modalidade_id, $aluno_id, $data));
        $con = null;
    }
    public static function deletarAgendamento($agendamento_id) {
        $con = PgSql::conectar();
        $sql = $con->prepare("DELETE FROM agendamento WHERE agendamento_id = ?");
        $sql->execute(array($agendamento_id));
        $con = null;
    }
}
?>