<?php
require('../config.php');
// Dados atuais
if (isset($_GET['usuario_id']) && isset($_SESSION['cargo']) && $_SESSION['cargo'] == 1){
    $usuario_id = $_GET['usuario_id'];
} else {
    $usuario_id = $_SESSION['usuario_id'];
}

$usuario = Painel::select('usuario', 'usuario_id=?', array($usuario_id));
$nascimento_raw = date('Y-m-d', strtotime($usuario['data_nascimento']));
$tipo_conta = ($_SESSION['cargo'] == 1) ? 'Administrador' : 'Usuário';
$readonly_attr = ($_SESSION['cargo'] == 1) ? '' : 'readonly';
?>
<section>
    <div class="usuarios-wrapper">
        <h2>Dados de Usuário</h2>
        <form class="cadastro-form" method="POST">
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" value="<?php echo $usuario['nome'];?>" <?php echo $readonly_attr; ?>/>
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="<?php echo $usuario['email'];?>"/>
            </div>

            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" value="<?php echo $usuario['cpf'];?>" maxlength="14" <?php echo $readonly_attr; ?>/>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone</label>
                <div class="telefone-box">
                    <input type="tel" id="telefone" name="telefone" value="<?php echo $usuario['telefone'];?>" />
                </div>
            </div>

            <div class="form-group">
                <label for="nascimento">Data de Nascimento</label>
                <input type="text" id="nascimento" name="nascimento" value="<?php echo $usuario['data_nascimento'];?>" <?php echo $readonly_attr; ?>/>
            </div>

            <div class="form-group">
                <label for="endereco">Endereço</label>
                <textarea id="endereco" name="endereco"rows="3"><?php echo $usuario['endereco'];?></textarea>
            </div>

            <input type="hidden" name="usuario_id" value="<?php echo isset($_GET['usuario_id']) ? $_GET['usuario_id'] : $_SESSION['usuario_id']; ?>">

            <!-- <div class="form-group">
                <label for="tipo">Tipo</label>
                <input type="text"  name="tipo_atual" value="<?php echo $tipo_conta;?>" readonly/>
            </div> -->

            <!-- <div class="form-group">
                <label for="cargo">Cargo</label>
                <input type="text"  name="cargo_atual" value="<?php echo $_SESSION['tipo_usuario'];?>" readonly/>
            </div> -->


            <!-- Botão -->
            <button type="submit" name="atualiza" onclick="return confirm('Tem certeza que deseja atualizar?');" class="btn btn-primary">Atualizar</button>
            <button type="reset" class="btn btn-primary desmarcar">Cancelar</button>
        </form>
    </div>
</section>