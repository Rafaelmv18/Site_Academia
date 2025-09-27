<?php
    require_once '../config.php';
    $tipo_conta = ($_SESSION['tipo_usuario'] == 1) ? 'Administrador' : 'Usuário';
    $aluno = Painel::select('aluno', 'aluno_id=?', array($_SESSION['usuario_id']));
    if (!is_bool($aluno)){
        $plano = Painel::select('plano', 'plano_id=?', array($aluno['plano_id']));
    }
    $cpf_limpo = preg_replace('/[^\d]/', '', $_SESSION['cpf']);
    $digitos_visiveis = substr($cpf_limpo, 3, 3);
    $cpf_mascarado = '***.' . $digitos_visiveis . '.***-**';
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
            <a href="painel.php?section=dados" class="btn btn-primary">
                <i class="fa-solid fa-pencil"></i> 
                <span>Editar Perfil</span>
            </a>
        </div>

        <div class="plan-card">
            <h3>Status do seu Plano</h3>
            <ul class="plan-details">
                <li>
                    <strong>Plano Atual:</strong>
                    <span>
                        <?php 
                            if (!is_bool($aluno) && !is_bool($plano)) {
                                echo $plano['nome'];
                            } else {
                                echo "";
                            }
                        ?>
                    </span>
                </li>
                <li class="plan-expiration">
                    <strong>Vencimento:</strong>
                    <span class="days-left"><?php echo (empty($aluno['data_fim_plano'])) ? 'Sem Plano':  $aluno['data_fim_plano']; ?></span>
                </li>
            </ul>
            <a href="painel.php?section=planos" class="btn btn-primary">
                <i class="fa-solid fa-calendar-days"></i> Ver Planos
            </a>
        </div>
    </div>
</section>

<script src="../js/inicio.js"></script>
