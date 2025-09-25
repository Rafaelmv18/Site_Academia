console.log("Busca.js executado e pronto!");

// Seleciona os elementos diretamente, sem esperar por nenhum evento.
const input = document.getElementById("cpfInput");
const cards = document.querySelectorAll(".user-card");
const resultArea = document.getElementById("resultArea"); // Vamos usar isso para a mensagem

// Cria um elemento para a mensagem de "não encontrado"
const noResultsMessage = document.createElement("p");
noResultsMessage.id = "noResultsMessage";
noResultsMessage.textContent = "Nenhum usuário encontrado.";
noResultsMessage.style.display = "none"; // Começa escondido
resultArea.appendChild(noResultsMessage); // Adiciona à área de resultados
input.addEventListener("keyup", () => {
    const termo = input.value.toUpperCase().replace(/\D/g, ""); // Pega só os números
    let encontrouAlgum = false;

    cards.forEach(card => {
        // Busca o CPF dentro do span específico para evitar bugs
        const cpfSpan = card.querySelector(".user-cpf");
        if (cpfSpan) {
            const cpfDoCard = cpfSpan.textContent.toUpperCase().replace(/\D/g, "");
            
            // Verifica se o CPF do card começa com o termo digitado
            if (cpfDoCard.startsWith(termo)) {
                card.style.display = "flex"; // Mostra o card
                encontrouAlgum = true;
            } else {
                card.style.display = "none"; // Esconde o card
            }
        }
    });

    // Mostra ou esconde a mensagem de "nenhum resultado"
    if (encontrouAlgum) {
        noResultsMessage.style.display = "none";
    } else {
        noResultsMessage.style.display = "block";
    }
});
