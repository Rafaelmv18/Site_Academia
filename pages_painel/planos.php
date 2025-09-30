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
                <?php 
                $beneficios = explode("\n", $plano['descricao']); 
                foreach ($beneficios as $b) {
                    echo "<li><i class='fa-solid fa-check'></i> " . trim($b) . "</li>";
                }
                ?>
            </ul>
            <button class="btn-primary" onclick="window.location.href='pages_painel/pagamento.php?plano_id=<?php echo $plano['plano_id']?>'">Quero Começar</button>
        </div>
        <?php } ?>
    </div>
</section>