<?php
require_once 'config.php'; 
$modalidades = Painel::selectAll('modalidade', 'modalidade_id', 'ASC');
?>
<section class="modalidades">
    <div class="container">
        <div class="intro">
            <h1>Transforme Seu Corpo</h1>
            <p>Descubra nossas atividades e comece sua jornada fitness hoje mesmo</p>
        </div>
        <?php foreach ($modalidades as $modalidade){ ?>
            <div class="card">
                <div class="card-inner">
                    <div class="card-front">
                        <img src="<?= htmlspecialchars($modalidade['imagem']) ?>" 
                             alt="<?= htmlspecialchars($modalidade['nome']) ?>" class="card-image">
                        <div class="card-title"><?php echo $modalidade['nome']?></div>
                    </div>
                    <div class="card-back">
                        <div class="card-description">
                            <h3><?php echo $modalidade['nome']?></h3>
                            <p><?php echo $modalidade['descricao']?></p>
                            <ul>
                                <li>Acesso 24 horas por dia</li>
                                <li>Equipamentos modernos</li>
                                <li>Ambiente climatizado</li>
                                <li>Instrutores qualificados</li>
                                <li>Programas personalizados</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>