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

document.addEventListener("DOMContentLoaded", () => {
    const navLinks = document.querySelectorAll(".nav-link");
    const contentArea = document.querySelector(".content-area");
    const pageTitle = document.querySelector(".page-title");

    function loadPage(page, link) {
        fetch(`pages_painel/${page}.php`)


            .then(response => {
                if (!response.ok) throw new Error("Erro ao carregar página");
                return response.text();
            })
            .then(html => {
                contentArea.innerHTML = html;

                // Atualiza título da página
                pageTitle.textContent = link.querySelector("span").innerText;

                // Atualiza item ativo no menu
                document.querySelectorAll(".nav-item").forEach(item => item.classList.remove("active"));
                link.parentElement.classList.add("active");
            })
            .catch(err => {
                contentArea.innerHTML = `<p style="color:red;">${err.message}</p>`;
            });
    }

    // Clique no menu
    navLinks.forEach(link => {
        link.addEventListener("click", e => {
    e.preventDefault();
    const page = link.dataset.section; // pega "dashboard", "usuarios", etc.
    loadPage(page, link);
});

    });

    // Carregar página inicial (dashboard)
    loadPage("inicio", document.querySelector(".nav-link[data-section='inicio']"));
});
