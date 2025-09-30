document.addEventListener('DOMContentLoaded', () => {
    // Seleciona todos os alertas que estão na página
    const alerts = document.querySelectorAll('.alert');

    alerts.forEach(alertElement => {
        // Pega a duração da animação (5000ms = 5s)
        // Se a duração no CSS for 5s, use 5000.
        const duration = 5000; 

        // Adiciona um timeout para remover o alerta do DOM
        setTimeout(() => {
            alertElement.remove();
        }, duration);
    });
});