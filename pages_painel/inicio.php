<?php
    require_once '../config.php';
    $tipo_conta = ($_SESSION['tipo_usuario'] == 1) ? 'Administrador' : 'Usuário'; 
    $plano_atual = "Plano Premium";
    $dias_para_vencer = 18;
    $aluno = Painel::select('tb_aluno', 'aluno_id=?', array($_SESSION['usuario_id']));
    $plano = Painel::select('tb_plano', 'plano_id=?', array($aluno['plano_id']));
?>

<section class="dashboard-home">
    <h1>Bem-vindo(a)!</h1>
    <p class="subtitle">Aqui está um resumo rápido da sua conta.</p>

    <div class="dashboard-grid">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-icon">
                    <i class="fa-solid fa-user-circle"></i>
                </div>
                <div class="profile-info">
                    <h2><?php echo $_SESSION['nome']; ?></h2>
                    <span>CPF: 
                        <?php 
                            echo htmlspecialchars($cpf_mascarado);
                        ?>
                    </span>
                </div>
            </div>
            <ul class="profile-details">
                <li>
                    <strong>Tipo de Conta:</strong>
                    <span class="tag <?php echo ($tipo_conta === 'Administrador') ? 'tag-admin' : 'tag-aluno'; ?>">
                        <?php echo $tipo_conta; ?>
                    </span>
                </li>
            </ul>
            <a href="#" class="btn btn-primary">
                <i class="fa-solid fa-pencil"></i> Editar Perfil
            </a>

        </div>

        <div class="plan-card">
            <h3>Status do seu Plano</h3>
            <ul class="plan-details">
                <li>
                    <strong>Plano Atual:</strong>
                    <span><?php echo $plano['nome']; ?></span>
                </li>
                <li class="plan-expiration">
                    <strong>Vencimento:</strong>
                    <span class="days-left">Expira em <strong><?php echo $dias_para_vencer; ?> dias</strong></span>
                </li>
            </ul>
            <a href="#" data-section="planos" class="btn btn-primary">
                <i class="fa-solid fa-calendar-days"></i> Ver Planos e Faturas
            </a>
        </div>
    </div>
</section>

<script src="../js/inicio.js"></script>
