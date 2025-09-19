<?php
require_once '../config.php';

$modalidades = Painel::selectAll('modalidade', 'modalidade_id', 'ASC');
if(isset($_POST['acao'])){
    $id = $_POST['modalidade_id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $horarios = $_POST['horarios'];
    $imagem = $_POST['imagem'];

    if(Modalidade::atualizarModalidade($id, $nome, $descricao, $horarios, $imagem)){
        Painel::alert('sucesso', 'Modalidade atualizada com sucesso!');
        // Recarregar a página para refletir as mudanças
        header("Refresh:0");
    } else {
        Painel::alert('erro', 'Erro ao atualizar modalidade. Tente novamente.');
    }
}
?>

<section class="modalidades-admin">
    <h2>Gerenciar Modalidades</h2>
    <div class="container-modalidades">
        <?php foreach($modalidades as $modalidade){ ?>
            <form method="post" class="modalidade-form" style="border:1px solid #ccc; padding:15px; margin:10px 0; border-radius:10px;">
                <input type="hidden" name="modalidade_id" value="<?php echo $modalidade['modalidade_id'] ?>">

                <label>Nome:</label>
                <input type="text" name="nome" value="<?php echo $modalidade['nome'] ?>" required><br><br>

                <label>Descrição:</label><br>
                <textarea name="descricao" rows="3"><?php echo $modalidade['descricao'] ?></textarea><br><br>

                <label>Horários:</label>
                <input type="text" name="horarios" value="<?php echo $modalidade['horarios'] ?>"><br><br>

                <label>Imagem (URL):</label>
                <input type="text" name="imagem" value="<?php echo $modalidade['imagem'] ?>"><br><br>

                <img src="<?php echo $modalidade['imagem'] ?>" alt="Preview" style="max-width:150px; display:block; margin:10px 0;">

                <button type="submit" name="acao" style="padding:8px 12px; border:none; background:#27ae60; color:white; border-radius:5px; cursor:pointer;">
                    Atualizar
                </button>
            </form>
        <?php } ?>
    </div>
</section>
