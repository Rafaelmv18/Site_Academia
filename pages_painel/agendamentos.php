<?php
    // --- SIMULAÇÃO DE DADOS DO BANCO DE DADOS ---

    // 1. Aulas disponíveis para o dia selecionado (ex: Hoje)
    $aulasDisponiveis = [
        [
            'id' => 1,
            'modalidade' => 'Musculação Funcional',
            'instrutor' => 'Ana Silva',
            'horario' => '08:00 - 09:00',
            'vagas_total' => 15,
            'vagas_ocupadas' => 10
        ],
        [
            'id' => 2,
            'modalidade' => 'Zumba',
            'instrutor' => 'Pedro Costa',
            'horario' => '09:00 - 10:00',
            'vagas_total' => 20,
            'vagas_ocupadas' => 20 // Aula Lotada
        ],
        [
            'id' => 3,
            'modalidade' => 'Pilates Solo',
            'instrutor' => 'Mariana Lima',
            'horario' => '10:00 - 11:00',
            'vagas_total' => 12,
            'vagas_ocupadas' => 5
        ],
        [
            'id' => 4,
            'modalidade' => 'Boxe',
            'instrutor' => 'Rafael Souza',
            'horario' => '17:00 - 18:00',
            'vagas_total' => 10,
            'vagas_ocupadas' => 9
        ],
        [
            'id' => 5,
            'modalidade' => 'Yoga',
            'instrutor' => 'Sofia Almeida',
            'horario' => '18:00 - 19:00',
            'vagas_total' => 18,
            'vagas_ocupadas' => 12
        ],
         [
            'id' => 6,
            'modalidade' => 'Cross Training',
            'instrutor' => 'Lucas Ferreira',
            'horario' => '19:00 - 20:00',
            'vagas_total' => 16,
            'vagas_ocupadas' => 15
        ]
    ];

    // 2. IDs das aulas que o usuário atual JÁ agendou.
    // Em um sistema real, isso viria de uma consulta ao banco: "SELECT id_aula FROM agendamentos WHERE id_usuario = ... "
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
                $isAgendado = in_array($aula['id'], $agendamentosDoUsuario);
                $isLotado = $aula['vagas_ocupadas'] >= $aula['vagas_total'];
                $percentualOcupacao = ($aula['vagas_total'] > 0) ? ($aula['vagas_ocupadas'] / $aula['vagas_total']) * 100 : 0;
            ?>
            <div class="class-card" data-class-id="<?php echo $aula['id']; ?>">
                <div class="class-info">
                    <p class="class-time"><?php echo htmlspecialchars($aula['horario']); ?></p>
                    <h2 class="class-title"><?php echo htmlspecialchars($aula['modalidade']); ?></h2>
                    <p class="class-instructor"><i class="fa-solid fa-user"></i><?php echo htmlspecialchars($aula['instrutor']); ?></p>
                </div>

                <div class="class-details">
                    <div class="vacancies-info">
                        <span class="vacancies-text">Vagas</span>
                        <span class="vacancies-count" data-ocupadas="<?php echo $aula['vagas_ocupadas']; ?>" data-total="<?php echo $aula['vagas_total']; ?>">
                            <?php echo $aula['vagas_ocupadas']; ?> de <?php echo $aula['vagas_total']; ?>
                        </span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-bar-fill <?php if($isLotado) echo 'full'; ?>" style="width: <?php echo $percentualOcupacao; ?>%;"></div>
                    </div>

                    <?php if ($isAgendado): ?>
                        <button class="btn btn-primary desmarcar">
                            <i class="fa-solid fa-circle-xmark"></i> Desmarcar
                        </button>
                    <?php elseif ($isLotado): ?>
                        <button class="btn" disabled>
                            <i class="fa-solid fa-lock"></i> Lotado
                        </button>
                    <?php else: ?>
                            <button class="btn btn-primary">
                            <i class="fa-solid fa-circle-check"></i> Agendar
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </main>
</div>

<script>
    // Adiciona interatividade aos botões para simular agendamento/desmarcamento
    document.addEventListener('DOMContentLoaded', function() {
        const scheduleGrid = document.querySelector('.schedule-grid');

        scheduleGrid.addEventListener('click', function(e) {
            // Em um sistema real, aqui você faria uma chamada AJAX para o servidor
            // para confirmar o agendamento/desmarcamento no banco de dados.
            // Esta é uma SIMULAÇÃO para a interface responder ao clique.

            const target = e.target.closest('button');
            if (!target || target.disabled) return;

            const card = target.closest('.class-card');
            const vacanciesCountEl = card.querySelector('.vacancies-count');
            const progressBarFill = card.querySelector('.progress-bar-fill');
            
            let vagasOcupadas = parseInt(vacanciesCountEl.dataset.ocupadas);
            const vagasTotal = parseInt(vacanciesCountEl.dataset.total);

            if (target.classList.contains('btn-agendar')) {
                // Lógica para agendar
                vagasOcupadas++;
                target.classList.remove('btn-agendar');
                target.classList.add('btn-desmarcar');
                target.innerHTML = '<i class="fa-solid fa-circle-xmark"></i> Desmarcar';
            } else if (target.classList.contains('btn-desmarcar')) {
                // Lógica para desmarcar
                vagasOcupadas--;
                target.classList.remove('btn-desmarcar');
                target.classList.add('btn-agendar');
                target.innerHTML = '<i class="fa-solid fa-circle-check"></i> Agendar';
            }

            // Atualiza a UI
            vacanciesCountEl.dataset.ocupadas = vagasOcupadas;
            vacanciesCountEl.textContent = `${vagasOcupadas} de ${vagasTotal}`;
            
            const newPercentage = (vagasOcupadas / vagasTotal) * 100;
            progressBarFill.style.width = newPercentage + '%';

            // Verifica se a aula ficou lotada ou disponível após a ação
            const isLotadoAgora = vagasOcupadas >= vagasTotal;
            progressBarFill.classList.toggle('full', isLotadoAgora);
            
            // Se a ação foi desmarcar, o botão "Agendar" do vizinho que estava lotado deve ser reavaliado
            // (Isso é uma simplificação, um sistema real recarregaria os dados)
        });
    });
</script>
