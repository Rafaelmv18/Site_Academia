<?php
require('../config.php');

$usuario_id = $_SESSION['usuario_id'] ?? 0;
$modalidades = Painel::selectAll('modalidade', 'modalidade_id', 'ASC');

?>

<div class="container">
    <h1>Agendamento de Aulas</h1>  
    <main class="schedule-grid">
        <?php foreach ($modalidades as $aula){ ?>
            <?php
                $agendado = Painel::select('Agendamento', 'aluno_id = ? AND modalidade_id = ?', [$usuario_id, $aula['modalidade_id']]);
            ?>
            <div class="class-card" data-horarios='<?php echo htmlspecialchars($aula['horarios'] ?? '[]', ENT_QUOTES, 'UTF-8'); ?>'>
                
                <h2 class="class-title"><?php echo htmlspecialchars($aula['nome']); ?></h2>

                <div class="horarios-wrapper">
                    <?php
                    $horariosArray = json_decode($aula['horarios'] ?? '[]', true);
                    if (is_array($horariosArray) && !empty($horariosArray)) {
                        foreach ($horariosArray as $horario) {?>
                            <div class="schedule-item">
                            <i class="fa-regular fa-clock"></i>
                            <span>
                                <strong><?= htmlspecialchars($horario['dia'] ?? 'N/D'); ?>:</strong>
                                <?= htmlspecialchars($horario['inicio'] ?? 'N/D'); ?> - <?= htmlspecialchars($horario['fim'] ?? 'N/D'); ?>
                            </span><br><br>
                        </div>
                    <?php } }?>
                </div>
                
                <?php
                if($_SESSION['tipo_usuario'] != 1){
                    if($aula['nome'] != 'Musculação'){
                        if ($agendado){ 
                ?>
                        <form method="POST">
                            <input type="hidden" name="agendamento_id" value="<?php echo $agendado['agendamento_id']; ?>">
                            <button type="submit" name="desmarcar" class="btn btn-primary desmarcar">
                                <i class="fa-solid fa-xmark"></i> Desmarcar
                            </button>
                        </form>
                    <?php }else{ ?>
                        <form method="POST">
                            <input type="hidden" name="modalidade_id" value="<?php echo $aula['modalidade_id']; ?>">
                            <input type="hidden" name="data" value="<?php echo date('Y-m-d H:i:s'); ?>"> 
                            <button type="submit" name="agendar" class="btn btn-primary">
                                <i class="fa-solid fa-circle-check"></i> Agendar
                            </button>
                        </form>
                    <?php }
                    }
                } ?>
            </div>
        <?php } ?>
        
    </main>
</div>

<script src="js/agendamento.js"></script>