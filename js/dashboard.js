const userBtn = document.querySelector('.user-btn');
const submenu = document.querySelector('.sub_menu');

// abrir/fechar no clique do botão
userBtn.addEventListener('click', (e) => {
    e.stopPropagation(); // impede o clique de subir até o document
    submenu.classList.toggle('active');
});

// fechar se clicar fora
document.addEventListener('click', (e) => {
    if (!submenu.contains(e.target) && !userBtn.contains(e.target)) {
        submenu.classList.remove('active');
    }
});
