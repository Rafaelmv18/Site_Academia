<?php
require_once '../config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatórios Gerenciais</title>
    <link rel="stylesheet" href="relatorios.css">
</head>
<body>
     <section class="relatorios">
        <h1>Relatórios Gerenciais</h1>

        <div class="relatorio-item">
            <h2>Frequência dos Alunos</h2>
            <a href="api/gerar_pdf.php?relatorio=frequencia" target="_blank" class="btn btn-primary">
                <i class="fa-solid fa-file-pdf"></i> Gerar PDF
            </a>
        </div>
        <div class="relatorio-item">
            <h2>Ocupação das Modalidades</h2>
            <a href="api/gerar_pdf.php?relatorio=ocupacao" target="_blank" class="btn btn-primary">
                <i class="fa-solid fa-file-pdf"></i> Gerar PDF
            </a>
        </div>

        <div class="relatorio-item">
            <h2>Planos Ativos x Expirados</h2>
                <button class="btn btn-primary" onclick="window.location.href='/Site_Academia/pages_painel/relatorio_planos.php'">Gerar</button>
        </div>

        <div class="relatorio-item">
            <h2>Entradas no Mês</h2>
            <button class="btn btn-primary" onclick="window.location.href='/Site_Academia/pages_painel/relatorio_entradas.php'">Gerar</button>
        </div>
        
    </section>
</body>
</html>
