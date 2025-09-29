document.addEventListener('DOMContentLoaded', () => {
    console.log('mascaras.js carregado');
    const inputCPF = document.getElementById('cpf');

    if (inputCPF) {
        inputCPF.addEventListener('input', () => {
            let value = inputCPF.value.replace(/\D/g, ''); // só números
            
            if (value.length > 11) value = value.slice(0, 11); // limita a 11 dígitos

            // Aplica a máscara
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

            inputCPF.value = value;
        });
    }

    // --- MÁSCARA DE TELEFONE ---
    const inputTelefone = document.getElementById('telefone');

    if (inputTelefone) {
        inputTelefone.addEventListener('input', () => {
            let value = inputTelefone.value.replace(/\D/g, ''); // Remove tudo que não é número
            
            // Aplica a formatação do Telefone: (XX) XXXXX-XXXX
            value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
            value = value.replace(/(\d{5})(\d)/, '$1-$2');
            
            // Limita o tamanho para não ultrapassar o formato
            inputTelefone.value = value.slice(0, 15);
        });
    }

});