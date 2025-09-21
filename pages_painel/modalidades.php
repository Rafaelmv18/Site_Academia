<?php
require_once '../config.php';
$modalidades = Painel::selectAll('modalidade', 'modalidade_id', 'ASC');
?>

<section class="modalidades-admin">
    <h2>Gerenciar Modalidades</h2>
    <div class="container-modalidades" style="display:grid; grid-template-columns:repeat(auto-fit,minmax(300px,1fr)); gap:20px;">

        <!-- Modalidades já cadastradas -->
        <?php foreach($modalidades as $modalidade){ ?>
            <form method="post" class="modalidade-form" style="border:1px solid #ccc; padding:15px; border-radius:10px;">
                <input type="hidden" name="modalidade_id" value="<?php echo $modalidade['modalidade_id'] ?>">

                <label>Nome:</label>
                <input type="text" name="nome" value="<?php echo $modalidade['nome'] ?>" required><br><br>

                <label>Descrição:</label><br>
                <textarea name="descricao" rows="3"><?php echo $modalidade['descricao'] ?></textarea><br><br>

                <label>Horários:</label>
                <input type="text" name="horarios" value="<?php echo $modalidade['horarios'] ?>"><br><br>

                <label>Imagem (URL):</label>
                <input type="text" name="imagem" value="<?php echo $modalidade['imagem'] ?>"><br><br>

                <img src="<?php echo $modalidade['imagem'] ?>" alt="Preview" style="max-width:100%; border-radius:8px; margin:10px 0;">

                <div style="display:flex; gap:10px;">
                    <button type="submit" name="atualizarModalidade" value="atualizar" style="flex:1; padding:8px 12px; border:none; background:#27ae60; color:white; border-radius:5px; cursor:pointer;">
                        Atualizar
                    </button>
                    <button type="submit" name="excluirModalidade" value="excluir" style="flex:1; padding:8px 12px; border:none; background:#e74c3c; color:white; border-radius:5px; cursor:pointer;">
                        Excluir
                    </button>
                </div>
            </form>
        <?php } ?>

        <form method="post" class="modalidade-form" style="border:2px dashed #999; padding:15px; border-radius:10px;">
            <label>Nome:</label>
            <input type="text" name="nome" placeholder="Digite o nome" required><br><br>

            <label>Descrição:</label><br>
            <textarea name="descricao" rows="3" placeholder="Digite a descrição"></textarea><br><br>

            <label>Horários:</label>
            <input type="text" name="horarios" placeholder="Ex: Seg a Sex - 07h às 21h"><br><br>

            <label>Imagem (URL):</label>
            <input type="text" name="imagem" placeholder="URL da imagem"><br><br>

            <button type="submit" name="cadastrarModalidade" value="cadastrar" style="width:100%; padding:10px; border:none; background:#2980b9; color:white; border-radius:5px; cursor:pointer;">
                Cadastrar
            </button>
        </form>

    </div>
</section>
