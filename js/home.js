document.addEventListener("DOMContentLoaded", () => {
  const links = document.querySelectorAll("nav ul li a");
  const currentUrl = window.location.search;

  links.forEach(link => {
    if(link.getAttribute("href") === currentUrl) {
      link.classList.add("active");
    }
  });
});


$(function(){
    console.log("jQuery carregado e funcionando!");
    const slideshow = $('.slideshow');

    if(slideshow.length > 0){
        const slides = slideshow.find('.banner-single');
        const bulletsContainer = slideshow.find('.bullets');
        const slideCount = slides.length;
        let currentSlide = 0;
        let slideInterval; // Variável para guardar o ID do nosso timer

        // --- FUNÇÃO PARA INICIAR O SLIDER ---
        function initSlider() {
            slides.hide().eq(0).show();
            let bulletHTML = '';
            for (let i = 0; i < slideCount; i++) {
                bulletHTML += `<span class="${i === 0 ? 'active-slider' : ''}"></span>`;
            }
            bulletsContainer.html(bulletHTML);
        }

        // --- FUNÇÃO PARA TROCAR O SLIDE ---
        function changeSlide() {
            // .stop(true, true) limpa a fila de animações e finaliza a atual
            slides.eq(currentSlide).stop(true, true).fadeOut(1000);
            currentSlide = (currentSlide + 1) % slideCount;
            slides.eq(currentSlide).stop(true, true).fadeIn(1000);
            
            bulletsContainer.find('span').removeClass('active-slider');
            bulletsContainer.find('span').eq(currentSlide).addClass('active-slider');
        }

        // --- FUNÇÃO PARA REINICIAR O TIMER ---
        function startTimer() {
            // Limpa qualquer timer antigo antes de criar um novo
            clearInterval(slideInterval);
            slideInterval = setInterval(changeSlide, 4000);
        }

        // --- EVENTO DE CLIQUE NAS 'BULLETS' ---
        bulletsContainer.on('click', 'span', function(){
            const clickedIndex = $(this).index();
            
            if (clickedIndex !== currentSlide) {
                // PARA O TIMER AUTOMÁTICO
                clearInterval(slideInterval);

                slides.eq(currentSlide).stop(true, true).fadeOut(500);
                currentSlide = clickedIndex;
                slides.eq(currentSlide).stop(true, true).fadeIn(500);
                
                bulletsContainer.find('span').removeClass('active-slider');
                $(this).addClass('active-slider');
                
                // REINICIA O TIMER para que a contagem de 4s comece de novo
                startTimer();
            }
        });

        // --- INICIA TUDO ---
        initSlider();
        startTimer(); // Inicia o timer pela primeira vez
    }
});