<?php
require_once '../config.php';
$modalidades = Painel::selectAll('modalidade', 'modalidade_id', 'ASC');
?>

<section class="modalidades-admin">
    <h2>Gerenciar Modalidades</h2>
    <div class="container-modalidades" style="display:grid; grid-template-columns:repeat(auto-fit,minmax(300px,1fr)); gap:20px;">

        <?php foreach($modalidades as $modalidade){ ?>
            <form method="post" enctype="multipart/form-data" class="modalidade-form" style="border:1px solid #ccc; padding:15px; border-radius:10px;">
                <input type="hidden" name="modalidade_id" value="<?php echo $modalidade['modalidade_id'] ?>">
                <input type="hidden" name="imagem_atual" value="<?php echo $modalidade['imagem'] ?>">
                <label>Nome:</label>
                <input type="text" name="nome" value="<?php echo $modalidade['nome'] ?>" required><br>

                <label>Descrição:</label>
                <textarea name="descricao" rows="3"><?php echo $modalidade['descricao'] ?></textarea><br>
                <label>Horários:</label>
                <?php
                    // LÓGICA MOVIDA PARA DENTRO DO LOOP
                    $horariosJson = $modalidade['horarios'] ?? '[]';
                    $horariosArray = json_decode($horariosJson, true);
                    $primeiroHorario = $horariosArray[0] ?? ['dia' => '', 'inicio' => '', 'fim' => ''];
                ?>
                <div class="horarios-editor-simples">
                    <input type="text" name="horario_dia" class="horario-dia" 
                           value="<?php echo $primeiroHorario['dia']; ?>" 
                           placeholder="Dia (ex: Segunda a Sexta)">
                    <input type="time" name="horario_inicio" class="horario-inicio" 
                           value="<?php echo $primeiroHorario['inicio']; ?>">
                    <span>às</span>
                    <input type="time" name="horario_fim" class="horario-fim" 
                           value="<?php echo $primeiroHorario['fim']; ?>">
                </div>
                <br>
                <div class="file-input-container">
                    <label>Imagem:</label>
                    <input type="file" name="imagem"><br>
                </div>
                <p>Imagem Atual:</p>
                <img src="<?php echo $modalidade['imagem'] ?>" alt="Preview" style="max-width:100%; border-radius:8px; margin:10px 0;">

                <div style="display:flex; gap:10px;">
                    <button type="submit" name="atualizarModalidade" value="atualizar" onclick="return confirm('Tem certeza que deseja atualizar está modalidade?');" style="flex:1; padding:8px 12px; border:none; background:#27ae60; color:white; border-radius:5px; cursor:pointer;">
                        Atualizar
                    </button>
                    <button type="submit" name="excluirModalidade" value="excluir" onclick="return confirm('Tem certeza que deseja excluir está modalidade? A ação não pode ser desfeita.');" style="flex:1; padding:8px 12px; border:none; background:#e74c3c; color:white; border-radius:5px; cursor:pointer;">
                        Excluir
                    </button>
                </div>
            </form>
        <?php } ?>

        <form method="post" enctype="multipart/form-data" class="modalidade-form" style="border:2px dashed #999; padding:15px; border-radius:10px;">
            <label>Nome:</label>
            <input type="text" name="nome" placeholder="Digite o nome" required><br>

            <label>Descrição:</label><br>
            <textarea name="descricao" rows="3" placeholder="Digite a descrição"></textarea><br>

            <label>Horário:</label>
            <div class="horarios-editor-simples">
                <input type="text" name="horario_dia" class="horario-dia" placeholder="Dia (ex: Segunda a Sexta)">
                <input type="time" name="horario_inicio" class="horario-inicio">
                <span>às</span>
                <input type="time" name="horario_fim" class="horario-fim">
            </div>
            <br>
            <div class="file-input-container">
                <label>Imagem:</label>
                <input type="file" name="imagem"><br><br>
            </div>
            <button type="submit" name="cadastrarModalidade" value="cadastrar" style="width:100%; padding:10px; border:none; background:#2980b9; color:white; border-radius:5px; cursor:pointer;">
                Cadastrar
            </button>
        </form>

    </div>
</section>
