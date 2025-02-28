document.addEventListener("DOMContentLoaded", function () {
    fetch('/wp-json/tech-carousel/v1/icons/')
        .then(response => response.json())
        .then(data => {
            const swiperWrapper = document.querySelector('.swiper-wrapper');
            data.forEach(icon => {
                const slide = document.createElement('div');
                slide.classList.add('swiper-slide');
                slide.innerHTML = `
                    <div class="tech-icon">
                        <img src="${icon.image}" alt="${icon.title}" /> 
                    </div>
                `;
                swiperWrapper.appendChild(slide);
            });
            new Swiper('.swiper-container', {
                loop: true,
                autoplay: {
                    delay: 3000,
                },
                slidesPerView: 3,
                spaceBetween: 20,
                breakpoints: {
                    768: { slidesPerView: 4 },
                    1024: { slidesPerView: 5 }
                } 
            });
        });
});
