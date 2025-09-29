
console.log("Script de agendamento carregado.");
document.addEventListener('DOMContentLoaded', function() {
    // --- ELEMENTOS DA PÁGINA ---
    const dateSelector = document.querySelector('.date-selector');
    const scheduleGrid = document.querySelector('.schedule-grid');
    const classCards = document.querySelectorAll('.class-card');

    // --- MAPA DOS DIAS DA SEMANA (DOMINGO = 0, SEGUNDA = 1, etc.) ---
    const diasDaSemana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];

    /**
     * Função principal que verifica se uma aula acontece em um determinado dia da semana.
     * @param {number} diaIndex - O índice do dia a ser verificado (0-6).
     * @param {string} horariosJson - A string JSON dos horários da aula.
     * @returns {boolean} - True se a aula ocorre no dia, false caso contrário.
     */
    function aulaOcorreNoDia(diaIndex, horariosJson) {
        const diaAlvo = diasDaSemana[diaIndex];
        let horarios;

        try {
            horarios = JSON.parse(horariosJson);
        } catch (e) {
            return false; // Retorna falso se o JSON for inválido
        }
        
        if (!Array.isArray(horarios) || horarios.length === 0) {
            return false; // Retorna falso se não houver horários definidos
        }

        // Verifica cada regra de horário (ex: "Segunda a Sexta", "Terça e Quinta")
        for (const regra of horarios) {
            const diasRegra = regra.dia.toLowerCase(); // ex: "segunda a sábado"
            const diaAlvoLower = diaAlvo.toLowerCase(); // ex: "terça"

            // 1. Verifica se é um dia específico ou uma lista (ex: "Terça e Quinta")
            if (diasRegra.includes(diaAlvoLower)) {
                return true;
            }

            // 2. Verifica se é um intervalo (ex: "Segunda a Sábado")
            const intervalo = diasRegra.match(/(\w+)\s*a\s*(\w+)/);
            if (intervalo) {
                const diaInicioStr = intervalo[1];
                const diaFimStr = intervalo[2];

                const diaInicioIndex = diasDaSemana.findIndex(d => d.toLowerCase().startsWith(diaInicioStr));
                const diaFimIndex = diasDaSemana.findIndex(d => d.toLowerCase().startsWith(diaFimStr));

                if (diaInicioIndex !== -1 && diaFimIndex !== -1 && 
                    diaIndex >= diaInicioIndex && diaIndex <= diaFimIndex) {
                    return true;
                }
            }
        }

        return false; // Se nenhuma regra bateu, retorna falso
    }

    /**
     * Filtra os cards visíveis na tela com base no dia selecionado.
     * @param {string} diaSelecionado - "ontem", "hoje" ou "amanha".
     */
    function filtrarAulas(diaSelecionado) {
        const hojeIndex = new Date().getDay();
        let diaAlvoIndex;

        if (diaSelecionado === 'hoje') {
            diaAlvoIndex = hojeIndex;
        } else if (diaSelecionado === 'amanha') {
            diaAlvoIndex = (hojeIndex + 1) % 7; // O % 7 faz o dia "virar" de Sábado (6) para Domingo (0)
        } else if (diaSelecionado === 'ontem') {
            diaAlvoIndex = (hojeIndex - 1 + 7) % 7; // O + 7 garante que não dê negativo
        }
        
        // Passa por cada card e mostra ou esconde
        classCards.forEach(card => {
            const horariosJson = card.dataset.horarios;
            if (aulaOcorreNoDia(diaAlvoIndex, horariosJson)) {
                card.style.display = 'block'; // Mostra o card
            } else {
                card.style.display = 'none'; // Esconde o card
            }
        });
    }

    // --- EVENTOS DE CLIQUE ---

    // Adiciona o evento de clique na navegação de dias
    dateSelector.addEventListener('click', function(e) {
        e.preventDefault();
        const target = e.target.closest('a');
        if (!target) return;

        // Atualiza a classe 'active'
        dateSelector.querySelector('.active').classList.remove('active');
        target.classList.add('active');

        // Filtra as aulas
        const dia = target.dataset.day;
        filtrarAulas(dia);
    });

    // Lógica para o botão de agendar/desmarcar (código original)
    scheduleGrid.addEventListener('click', function(e) {
        const target = e.target.closest('button');
        if (!target) return;

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

    // --- INICIALIZAÇÃO ---
    // Filtra as aulas para "hoje" assim que a página carrega
    filtrarAulas('hoje');
});
