<?php
require_once '../config.php';

$con = PgSql::conectar();

$sqlAlunos = $con->query("SELECT aluno_id, (verificar_plano_ativo(aluno_id)) AS ativo FROM Aluno");
$ativos = 0;
$expirados = 0;

while ($row = $sqlAlunos->fetch(PDO::FETCH_ASSOC)) {
    if ($row['ativo'] == 't') {
        $ativos++;
    } else {
        $expirados++;
    }
}
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
        <h1>Relatório de Planos Ativos x Expirados</h1>

        <table border="1" cellpadding="5">
            <tr>
                <th>Status</th>
                <th>Quantidade</th>
            </tr>
            <tr>
                <td>Ativos</td>
                <td><?php echo $ativos; ?></td>
            </tr>
            <tr>
                <td>Expirados</td>
                <td><?php echo $expirados; ?></td>
            </tr>
        </table>

        <br>
        <button class="btn btn-primary" onclick="window.location.href='../painel.php?section=relatorio'">Voltar</button>
    </div>
</body>
</html>
