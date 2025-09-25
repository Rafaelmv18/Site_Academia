<?php
require_once '../config.php';

$sqlAlunos = PgSql::conectar()->query("SELECT aluno_id, (verificar_plano_ativo(aluno_id)) AS ativo FROM Aluno");

$alunos = $sqlAlunos->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório - Planos</title>
    <link rel="stylesheet" href="../style_painel/relatorio.css">
</head>
<body>
    <div class="relatorio-container">
        <h1>Relatório de Planos por Aluno</h1>

        <table border="1" cellpadding="5">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Status do Plano</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($alunos as $aluno){
                    $usuario = Painel::select('usuario', 'usuario_id = ?', array($aluno['aluno_id']))
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['cpf']); ?></td>
                        <td><?php echo $aluno['ativo'] == 't' ? 'Ativo' : 'Expirado'; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <br>
        <button class="btn-gerar" onclick="window.location.href='../painel.php?section=relatorio'">Voltar</button>
    </div>
</body>
</html>
