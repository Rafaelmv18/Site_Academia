<?php
require_once '../config.php'; 
$planos = Painel::selectAll('plano', 'plano_id', 'ASC');
?>
<section class="planos">
    <h2>Escolha o Plano Perfeito para Você</h2>
    <div class="planos-container">
        <?php foreach ($planos as $plano){?>
        <div class="plano">
            <h3><?php echo $plano['nome']; ?></h3>
            <p class="preco"><?php echo $plano['valor']; ?><span>/mês</span></p>
            <ul class="beneficios">
                <li><i class="fa-solid fa-check"></i> Acesso completo à área de musculação</li>
                <li><i class="fa-solid fa-check"></i> Acesso em horário comercial</li>
                <li><i class="fa-solid fa-check"></i> Avaliação física inicial</li>
            </ul>
            <button class="btn-primary" onclick="window.location.href='pages_painel/pagamento.php?plano_id=1'">Quero Começar</button>
        </div>
        <?php } ?>
    </div>
</section>