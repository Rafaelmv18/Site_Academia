<?php
require('../config.php');

$usuario_id = $_SESSION['usuario_id'] ?? 0;
$modalidades = Painel::selectAll('modalidade', 'modalidade_id', 'ASC');
?>

<div class="container">
    <h1>Agendamento de Aulas</h1>

    <nav class="date-selector">
        <a href="#" data-day="ontem">Ontem</a>
        <a href="#" data-day="hoje" class="active">Hoje</a>
        <a href="#" data-day="amanha">Amanhã</a>
    </nav>

    <main class="schedule-grid">
        <?php foreach ($modalidades as $aula){ ?>
            <div class="class-card" 
                 data-class-id="<?php echo $aula['modalidade_id']; ?>"
                 data-horarios='<?php echo $aula['horarios'], ENT_QUOTES, 'UTF-8'; ?>'>
                
                <div class="class-info">
                    <div class="class-schedule">
                        <?php
                        $horariosJson = $aula['horarios'];
                        $horariosArray = json_decode($horariosJson, true);
                        if (is_array($horariosArray) && !empty($horariosArray)) {
                            foreach ($horariosArray as $horario) {
                                ?>
                                <div class="schedule-item">
                                    <i class="fa-regular fa-clock"></i>
                                    <span>
                                        <strong><?php echo $horario['dia']; ?>:</strong>
                                        <?php echo $horario['inicio'] . ' - ' . $horario['fim']; ?>
                                    </span>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<div class="schedule-item-empty">Horário a definir</div>';
                        }
                        ?>
                    </div>
                    <h2 class="class-title"><?php echo $aula['nome']; ?></h2>
                </div>

                <div class="class-details">
                    <button class="btn btn-primary btn-agendar">
                        <i class="fa-solid fa-circle-check"></i> Agendar
                    </button>
                </div>
            </div>
        <?php } ?>
    </main>
</div>

<script src="js/agendamento.js"></script>