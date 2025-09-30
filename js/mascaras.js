/**
 * Função principal que aplica as máscaras de CPF e Telefone.
 * Esta função será chamada pelo dashboard.js quando a página de cadastro for carregada.
 */
function aplicarMascarasCadastro() {
    console.log("-> Ativando máscaras para o formulário de cadastro...");

    // --- MÁSCARA DE CPF ---
    const inputCPF = document.getElementById('cpf');
    if (inputCPF) {
        inputCPF.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não for dígito
            if (value.length > 11) value = value.slice(0, 11); // Limita a 11 dígitos

            // Aplica a máscara (000.000.000-00)
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            e.target.value = value;
        });
        console.log("-> Máscara de CPF aplicada.");
    }

    // --- MÁSCARA DE TELEFONE ---
    const inputTelefone = document.getElementById('telefone');
    if (inputTelefone) {
        inputTelefone.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 11) value = value.slice(0, 11);

            // Aplica máscara de celular (XX) XXXXX-XXXX ou fixo (XX) XXXX-XXXX
            if (value.length > 10) {
                value = value.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3');
            } else if (value.length > 6) {
                value = value.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, '($1) $2-$3');
            } else if (value.length > 2) {
                value = value.replace(/^(\d{2})(\d*)/, '($1) $2');
            } else if (value.length > 0) {
                value = value.replace(/^(\d*)/, '($1');
            }
            e.target.value = value;
        });
        console.log("-> Máscara de Telefone aplicada.");
    }
}