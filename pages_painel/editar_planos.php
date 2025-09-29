<?php
require_once '../config.php';
$planos = Painel::selectAll('plano', 'plano_id', 'ASC');
?>

<section class="planos-admin">
    <h2>Gerenciar Planos</h2>
    <div class="container-planos" style="display:grid; grid-template-columns:repeat(auto-fit,minmax(300px,1fr)); gap:20px;">

        <?php foreach($planos as $plano){ ?>
            <form method="post" class="plano-form" style="border:1px solid #ccc; padding:15px; border-radius:10px;">
                <input type="hidden" name="plano_id" value="<?php echo $plano['plano_id'] ?>">

                <label>Nome:</label>
                <input type="text" name="nome" value="<?php echo $plano['nome'] ?>" required><br>

                <label>Valor:</label>
                <input type="text" name="valor" value="<?php echo $plano['valor'] ?>" required><br>

                <label>Descrição:</label>
                <textarea name="descricao" rows="3"><?php echo $plano['descricao'] ?? '' ?></textarea><br>

                <div style="display:flex; gap:10px; margin-top:10px;">
                    <button type="submit" name="atualizarPlano" value="atualizar" style="flex:1; padding:8px 12px; border:none; background:#27ae60; color:white; border-radius:5px; cursor:pointer;">
                        Atualizar
                    </button>
                    <button type="submit" name="excluirPlano" value="excluir" style="flex:1; padding:8px 12px; border:none; background:#e74c3c; color:white; border-radius:5px; cursor:pointer;">
                        Excluir
                    </button>
                </div>
            </form>
        <?php } ?>

        <!-- Cadastro de novo plano -->
        <form method="post" class="plano-form" style="border:2px dashed #999; padding:15px; border-radius:10px;">
            <label>Nome:</label>
            <input type="text" name="nome" placeholder="Digite o nome" required><br>

            <label>Valor:</label>
            <input type="text" name="valor" placeholder="Ex: 99.90" required><br>

            <label>Descrição:</label>
            <textarea name="descricao" rows="3" placeholder="Digite a descrição"></textarea><br>

            <button type="submit" name="cadastrarPlano" value="cadastrar" style="width:100%; padding:10px; border:none; background:#2980b9; color:white; border-radius:5px; cursor:pointer;">
                Cadastrar
            </button>
        </form>

    </div>
</section>
