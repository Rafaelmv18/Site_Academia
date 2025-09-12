<?php
    // --- LÓGICA PHP PARA PREENCHER OS CAMPOS (MODO EDIÇÃO) ---
    // Exemplo de como você traria os dados do usuário do banco de dados para edição.
    // Se for um novo cadastro, essas variáveis estariam vazias.
    $usuario = [
        'nome' => 'Carlos Santana', 
        'email' => 'carlos.s@email.com', 
        'telefone' => '(75) 98123-4567', 
        'plano' => 'premium'
    ];
?>

<section class="cadastro-wrapper">
    <div class="form-container">
        
        <div class="profile-picture-area">
            <div class="profile-picture">
                <i class="fa-solid fa-user"></i>
            </div>
            <a href="#" class="edit-picture-btn" title="Alterar foto">
                <i class="fa-solid fa-camera"></i>
            </a>
        </div>

        <h1>Gerenciar Cadastro</h1>
        <p class="subtitle">Preencha os dados para registrar um novo aluno ou edite as informações existentes.</p>

        <form id="cadastroForm" method="POST" action="api/salvar_cadastro.php">
            
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome completo" required 
                       value="<?php echo htmlspecialchars($usuario['nome']); ?>">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="exemplo@email.com" required
                       value="<?php echo htmlspecialchars($usuario['email']); ?>">
            </div>

            <div class="form-group">
                <label for="telefone">Telefone / WhatsApp</label>
                <input type="tel" id="telefone" name="telefone" placeholder="(75) 99999-9999"
                       value="<?php echo htmlspecialchars($usuario['telefone']); ?>">
            </div>

            <div class="form-group">
                <label for="plano">Plano</label>
                <select id="plano" name="plano">
                    <option value="basico" <?php if($usuario['plano'] == 'basico') echo 'selected'; ?>>Plano Básico</option>
                    <option value="plus" <?php if($usuario['plano'] == 'plus') echo 'selected'; ?>>Plano Plus</option>
                    <option value="premium" <?php if($usuario['plano'] == 'premium') echo 'selected'; ?>>Plano Premium</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </div>
        </form>
    </div>
</section>