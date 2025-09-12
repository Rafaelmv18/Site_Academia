
    <?php
        // Exemplo de como você traria os dados do usuário do banco de dados
        // session_start();
        // $user_id = $_SESSION['user_id'];
        // $dados_usuario = busca_dados_do_banco($user_id);

        // Dados de exemplo (substitua com seus dados reais)
        $nome_usuario = "Carlos Santana";
        $cpf_usuario = "***.123.456-**"; // É bom mascarar o CPF
        $tipo_conta = "Administrador";
        $plano_atual = "Plano Premium";
        $dias_para_vencer = 18;
    ?>

    <section class="dashboard-home">
        <h1>Bem-vindo(a) de volta, <?php echo explode(' ', $nome_usuario)[0]; ?>!</h1>
        <p class="subtitle">Aqui está um resumo rápido da sua conta.</p>

        <div class="dashboard-grid">
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-icon">
                        <i class="fa-solid fa-user-circle"></i>
                    </div>
                    <div class="profile-info">
                        <h2><?php echo $nome_usuario; ?></h2>
                        <span>CPF: <?php echo $cpf_usuario; ?></span>
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
                <a href="#" data-section="cadastro" class="btn btn-primary nav-link">
                    <i class="fa-solid fa-pencil"></i> Editar Perfil
                </a>
            </div>

            <div class="plan-card">
                <h3>Status do seu Plano</h3>
                <ul class="plan-details">
                    <li>
                        <strong>Plano Atual:</strong>
                        <span><?php echo $plano_atual; ?></span>
                    </li>
                    <li class="plan-expiration">
                        <strong>Vencimento:</strong>
                        <span class="days-left">Expira em <strong><?php echo $dias_para_vencer; ?> dias</strong></span>
                    </li>
                </ul>
                <a href="#" data-section="planos" class="btn btn-secondary nav-link">
                    <i class="fa-solid fa-calendar-days"></i> Ver Planos e Faturas
                </a>
            </div>
        </div>
    </section>
