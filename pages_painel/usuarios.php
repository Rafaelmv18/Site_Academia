<?php
    require_once '../config.php'; 

    $usuarios = Painel::selectAll('usuario', 'usuario_id', 'ASC');
?>
<section>
    <div class="usuarios-wrapper">
        <h2>Buscar usuário por CPF</h2>

        <!-- Pesquisa -->
        <div class="search-box-usuario">
            <input id="cpfInput" type="text" placeholder="Digite o CPF (apenas números)" maxlength="14" />
            <button id="searchBtn" class="btn-primary">Buscar</button>
            <button id="clearBtn" class="btn-secondary" style="padding:10px 12px;border-radius:8px;border:1px solid #ccc;background:#fff;cursor:pointer">Limpar</button>

        </div>

        <!-- Resultado -->
        <div id="resultArea" class="result-area" aria-live="polite">
            <?php foreach($usuarios as $usuario){
                $plano = null;
                if($usuario['tipo_usuario'] == 0){
                    $aluno = Painel::select('aluno', 'aluno_id=?', array($usuario['usuario_id']));
                    $plano = Painel::select('plano', 'plano_id=?', array($aluno['plano_id']));
                }
            ?>
                <div class="user-card">
                    <i class="fa-solid fa-user-circle user-icon"></i>
                    <span class="user-name"><?php echo $usuario['nome'];?></span>
                    <span class="user-cpf"><?php echo $usuario['cpf'];?></span>
                    <span class="user-plan">
                        <?php
                        if(!is_bool($plano)){
                            if (isset($plano['nome'])) {
                                echo $plano['nome'];
                            } else {
                                echo 'Funcionario';
                            } 
                        }?>

                        
                    </span>
                </div>
            <?php } ?>
        </div>
        <p id="noResultsMessage" style="display: none;">Nenhum usuário encontrado.</p>
    </div>
</section>
<script src="../js/busca.js"></script>