<?php
require_once 'config.php'; 
$planos = Painel::selectAll('plano', 'plano_id', 'ASC');
?>
<section class="sobre">
    <h2>Transforme Seu Corpo e Mente</h2>
    <p>
        Na SPIKE GYM, acreditamos que a atividade física é a chave para uma vida plena. Oferecemos uma estrutura moderna, equipamentos de ponta e uma equipe de profissionais apaixonados, prontos para guiar você em sua jornada de transformação, seja qual for o seu objetivo.
    </p>
    <p>
        Explore nossas modalidades, da musculação intensa às aulas de Fit Dance e Pilates que relaxam e fortalecem. Venha descobrir a sua melhor versão em um ambiente motivador e acolhedor.
    </p>
</section>

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
                    <button class="btn-primary" onclick="window.location.href='login.php'">Quero Começar</button>
            </div>
        <?php } ?>
    </div>
</section>