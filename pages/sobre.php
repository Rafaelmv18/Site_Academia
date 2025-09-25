<?php
    require_once 'config.php'; 
    $usuarios = Painel::selectAll('usuario', 'usuario_id', 'ASC');
    $funcionarios = Painel::selectAll('funcionario', 'funcionario_id', 'ASC');
?>
<section class="sobre">
    <div class="sobre-inner">
        <div class="sobre-intro">
            <h1>Nossa História, Seu Resultado</h1>
            <p>
                A SPIKE GYM nasceu com um propósito: transformar a sua rotina através
                de treinos eficientes, acompanhamento profissional e um ambiente que inspira evolução. 
                Investimos em equipamentos modernos e em uma equipe comprometida com o seu sucesso.
            </p>
        </div>

        <div class="sobre-values">
            <div class="value-card">
                <i class="fa-solid fa-bullseye"></i>
                <h3>Missão</h3>
                <p>Promover saúde e qualidade de vida, oferecendo suporte técnico e humano para sua evolução contínua.</p>
            </div>
            <div class="value-card">
                <i class="fa-solid fa-eye"></i>
                <h3>Visão</h3>
                <p>Ser a academia referência em bem-estar e performance em Feira de Santana, unindo qualidade e um ambiente motivador.</p>
            </div>
            <div class="value-card">
                <i class="fa-solid fa-handshake-angle"></i>
                <h3>Valores</h3>
                <p>Respeito, segurança, ética, evolução e acolhimento em todas as nossas interações.</p>
            </div>
        </div>

        <div class="sobre-card-container">
            <div class="card">
                <div class="card-front">
                    <img src="img/academia_interna.jpeg" alt="Estrutura da Academia" class="card-image">
                    <div class="card-title">Estrutura moderna e equipada</div>
                </div>
            </div>
        </div>

        <div class="sobre-team">
            <h2>Nossa Equipe</h2>
            <div class="team-grid">
                <?php 
                foreach ($funcionarios as $funcionario){
                    foreach ($usuarios as $usuario){
                        if($funcionario['funcionario_id'] == $usuario['usuario_id']){
                ?>
                <div class="team-member">
                    <img src="img/treinador.png" alt="Foto de <?php echo $usuario['nome']; ?>">
                    <h4><?php echo $usuario['nome']; ?></h4>
                    <p><?php echo $funcionario['cargo']; ?></p>
                </div>
                <?php 
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>