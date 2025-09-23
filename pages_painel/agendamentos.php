<?php
    // --- SIMULAÇÃO DE DADOS DO BANCO DE DADOS (SIMPLIFICADO) ---

    // 1. Aulas disponíveis (sem instrutor e vagas)
    $aulasDisponiveis = [
        [
            'id' => 1,
            'modalidade' => 'Musculação Funcional',
            'horario' => '08:00 - 09:00',
        ],
        [
            'id' => 2,
            'modalidade' => 'Zumba',
            'horario' => '09:00 - 10:00',
        ],
        [
            'id' => 3,
            'modalidade' => 'Pilates Solo',
            'horario' => '10:00 - 11:00',
        ],
        [
            'id' => 4,
            'modalidade' => 'Boxe',
            'horario' => '17:00 - 18:00',
        ],
        [
            'id' => 5,
            'modalidade' => 'Yoga',
            'horario' => '18:00 - 19:00',
        ],
         [
            'id' => 6,
            'modalidade' => 'Cross Training',
            'horario' => '19:00 - 20:00',
        ]
    ];

    // 2. IDs das aulas que o usuário atual JÁ agendou.
    $agendamentosDoUsuario = [3, 5];

?>

<div class="container">
    <h1>Agendamento de Aulas</h1>

    <nav class="date-selector">
        <a href="#">Ontem</a>
        <a href="#" class="active">Hoje</a>
        <a href="#">Amanhã</a>
    </nav>

    <main class="schedule-grid">
        <?php foreach ($aulasDisponiveis as $aula): ?>
            <?php
                // A lógica agora é mais simples: só precisamos saber se está agendado ou não.
                $isAgendado = in_array($aula['id'], $agendamentosDoUsuario);
            ?>
            <div class="class-card" data-class-id="<?php echo $aula['id']; ?>">
                <div class="class-info">
                    <p class="class-time"><?php echo htmlspecialchars($aula['horario']); ?></p>
                    <h2 class="class-title"><?php echo htmlspecialchars($aula['modalidade']); ?></h2>
                </div>

                <div class="class-details">
                    <?php if ($isAgendado): ?>
                        <button class="btn btn-primary desmarcar">
                            <i class="fa-solid fa-circle-xmark"></i> Desmarcar
                        </button>
                    <?php else: ?>
                        <button class="btn btn-primary agendar">
                            <i class="fa-solid fa-circle-check"></i> Agendar
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </main>
</div>

<script>
    // JavaScript simplificado para lidar apenas com a troca dos botões
    document.addEventListener('DOMContentLoaded', function() {
        const scheduleGrid = document.querySelector('.schedule-grid');

        scheduleGrid.addEventListener('click', function(e) {
            // Esta é uma SIMULAÇÃO para a interface responder ao clique.
            const target = e.target.closest('button');
            if (!target) return;

            // Lógica para alternar entre os botões de agendar e desmarcar
            if (target.classList.contains('btn-agendar')) {
                target.classList.remove('btn-agendar');
                target.classList.add('btn-desmarcar');
                target.innerHTML = '<i class="fa-solid fa-circle-xmark"></i> Desmarcar';
            } else if (target.classList.contains('btn-desmarcar')) {
                target.classList.remove('btn-desmarcar');
                target.classList.add('btn-agendar');
                target.innerHTML = '<i class="fa-solid fa-circle-check"></i> Agendar';
            }
        });
    });
</script>