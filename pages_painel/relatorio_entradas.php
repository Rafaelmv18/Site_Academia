<?php
require_once '../config.php';

$con = PgSql::conectar();

$sqlEntradas = $con->query("SELECT * FROM vw_entradas_mes");
$entradas = $sqlEntradas->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório - Entradas do Mês</title>
    <link rel="stylesheet" href="../style_painel/relatorio.css">
</head>
<body>
    <div class="relatorio-container">
        <h1>Relatório de Entradas no Mês</h1>

        <table border="1" cellpadding="5">
            <tr>
                <th>Aluno</th>
                <th>CPF</th>
                <th>Entrada</th>
                <th>Saída</th>
                <th>Duração</th>
            </tr>
            <?php foreach ($entradas as $e): ?>
            <tr>
                <td><?php echo $e['nome_aluno']; ?></td>
                <td><?php echo $e['cpf']; ?></td>
                <td><?php echo $e['data_hora_entrada']; ?></td>
                <td><?php echo $e['data_hora_saida']; ?></td>
                <td><?php echo $e['duracao']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <br>
        <button class="btn btn-primary" onclick="window.location.href='../painel.php?section=relatorio'">Voltar</button>
    </div>
</body>
</html>
