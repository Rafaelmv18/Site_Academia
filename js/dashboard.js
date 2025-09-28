const userBtn = document.querySelector('.user-btn');
const submenu = document.querySelector('.sub_menu');

userBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    submenu.classList.toggle('active');
});

document.addEventListener('click', (e) => {
    if (!submenu.contains(e.target) && !userBtn.contains(e.target)) {
        submenu.classList.remove('active');
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const navLinks = document.querySelectorAll(".nav-link"); // Seleciona todos os links iniciais
    const contentArea = document.querySelector(".content-area");
    const pageTitle = document.querySelector(".page-title");

function loadPage(page, link) {
    // 1. Obtém o parâmetro 'usuario_id' da URL atual do navegador
    const urlParams = new URLSearchParams(window.location.search);
    const userId = urlParams.get('usuario_id');
    
    // 2. Constrói a URL do fetch, garantindo que o ID do usuário seja incluído
    let fetchUrl = `pages_painel/${page}.php`;
    
    if (userId) {
        // Adiciona o 'usuario_id' ao fetch URL para que o PHP o veja
        fetchUrl += `?usuario_id=${userId}`;
    }

    fetch(fetchUrl) 
        .then(response => {
            if (!response.ok) throw new Error("Erro ao carregar página (Código HTTP não OK)");
            return response.text();
        })
        .then(html => {
            contentArea.innerHTML = html;

            // --- Lógica de Re-execução de Scripts (Mantida) ---
            const scripts = contentArea.querySelectorAll("script");
            scripts.forEach(oldScript => {
                const newScript = document.createElement("script");
                
                Array.from(oldScript.attributes).forEach(attr => {
                    newScript.setAttribute(attr.name, attr.value);
                });

                if (oldScript.textContent) {
                    newScript.textContent = oldScript.textContent;
                }

                oldScript.parentNode.removeChild(oldScript);
                document.body.appendChild(newScript);
            });

            navLinks.forEach(link => {
                link.removeEventListener("click", handleNavigationClick); 
                link.addEventListener("click", handleNavigationClick);
            });

            window.history.replaceState({}, document.title, 'painel.php');

            // Atualiza título e item ativo no menu
            const titleElement = link.querySelector("span") || link;
            pageTitle.textContent = titleElement.innerText.trim();

            document.querySelectorAll(".nav-item").forEach(item => item.classList.remove("active"));
            
            // Ativa o item da sidebar com base na página atual
            const sidebarLink = document.querySelector(`.sidebar .nav-link[data-section="${page}"]`);
            if (sidebarLink && sidebarLink.parentElement) {
                sidebarLink.parentElement.classList.add("active");
            }
            
            // Salva a nova seção (ou a atual)
            localStorage.setItem("activeSection", page);
        })
        .catch(err => {
            contentArea.innerHTML = `<p style="color:red;">Falha na Requisição AJAX: ${err.message}</p>`;
            console.error("Erro AJAX:", err);
        });
    }

    // --- FUNÇÃO PARA TRATAR O CLIQUE (Sidebar e Botões) ---
    function handleNavigationClick(e) {
        e.preventDefault();
        
        const link = e.currentTarget;
        const page = link.dataset.section;
        
        window.history.pushState({page: page}, '', `painel.php?section=${page}`);

        loadPage(page, link);
    }
    
    navLinks.forEach(link => {
        link.addEventListener("click", handleNavigationClick);
    });

    const urlParams = new URLSearchParams(window.location.search);
    const sectionFromURL = urlParams.get('section');
    const savedSection = localStorage.getItem("activeSection");
    
    let targetPage = sectionFromURL || savedSection || 'inicio';
    
    const initialLink = document.querySelector(`.nav-link[data-section="${targetPage}"]`);
    
    if (initialLink) {
        loadPage(targetPage, initialLink);
    } else {
        loadPage("inicio", document.querySelector(".nav-link[data-section='inicio']"));
    }
});