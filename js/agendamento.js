// Dentro de js/dashboard.js
const pageScripts = {

    agendamentos: function() {
        console.log("Inicializando script de Agendamentos com filtro de dias...");

        // --- ELEMENTOS DA PÁGINA ---
        const dateSelector = document.querySelector('.date-selector');
        const classCards = document.querySelectorAll('.schedule-grid .class-card');

        // Se os elementos não existirem, não continua para evitar erros.
        if (!dateSelector || classCards.length === 0) {
            return;
        }

        // --- MAPA DOS DIAS DA SEMANA (DOMINGO = 0, SEGUNDA = 1, etc.) ---
        const diasDaSemana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];

        /**
         * Verifica se uma aula (card) deve ser exibida em um determinado dia.
         * @param {HTMLElement} card - O elemento do card da aula.
         * @param {number} diaIndex - O índice do dia a ser verificado (0-6).
         * @returns {boolean} - True se a aula ocorre no dia, false caso contrário.
         */
        function aulaOcorreNoDia(card, diaIndex) {
            const diaAlvo = diasDaSemana[diaIndex];
            const horariosJson = card.dataset.horarios;
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
                if (!regra.dia) continue; // Pula se não houver 'dia' definido na regra

                const diasRegra = regra.dia.toLowerCase();
                const diaAlvoLower = diaAlvo.toLowerCase();

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
            return false; // Se nenhuma regra correspondeu, retorna falso
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
                diaAlvoIndex = (hojeIndex + 1) % 7;
            } else if (diaSelecionado === 'ontem') {
                diaAlvoIndex = (hojeIndex - 1 + 7) % 7;
            }
            
            // Passa por cada card e decide se ele deve ser mostrado ou escondido
            classCards.forEach(card => {
                if (aulaOcorreNoDia(card, diaAlvoIndex)) {
                    card.style.display = ''; // Mostra o card (remove o display:none)
                } else {
                    card.style.display = 'none'; // Esconde o card
                }
            });
        }

        // --- EVENTO DE CLIQUE NA NAVEGAÇÃO DE DIAS ---
        dateSelector.addEventListener('click', function(e) {
            e.preventDefault();
            const target = e.target.closest('a');
            if (!target) return;

            // Atualiza a classe 'active' para o link clicado
            dateSelector.querySelector('.active').classList.remove('active');
            target.classList.add('active');

            // Executa a filtragem
            const dia = target.dataset.day;
            filtrarAulas(dia);
        });

        // --- INICIALIZAÇÃO ---
        // Filtra as aulas para "hoje" assim que a página de agendamentos é carregada
        filtrarAulas('hoje');
    },

    // ... suas outras funções de página (usuarios, editar_planos, etc.)
};