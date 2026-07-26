document.addEventListener('DOMContentLoaded', () => {

    // --- 1. Sayfa Kaydırıldığında Header Stilini Değiştirme ---
    window.addEventListener('scroll', function() {
        const header = document.querySelector('header');
        if (header) {
            if (window.scrollY > 50) {
                header.style.padding = '10px 0';
                header.style.boxShadow = '0 4px 15px rgba(0,0,0,0.1)';
            } else {
                header.style.padding = '15px 0';
                header.style.boxShadow = '0 2px 10px rgba(0,0,0,0.05)';
            }
        }
    });

    // --- 2. İletişim Formu Gönderme (Simülasyon) ---
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(contactForm);
            const name = formData.get('ad');
            const email = formData.get('email');
            const message = formData.get('mesaj');

            console.log('Form Gönderildi:', { name, email, message });
            alert(`Teşekkürler ${name}! Mesajınız başarıyla iletildi.`);
            contactForm.reset();
        });
    }

    // --- 3. Hizmetler Otomatik & Sonsuz Slider ---
    const track = document.getElementById('servicesTrack');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    if (track && prevBtn && nextBtn) {
        let autoScrollInterval;
        const scrollSpeed = 3000;

        const scrollNext = () => {
            const card = track.querySelector('.service-card');
            if (card) {
                const cardWidth = card.offsetWidth + 20;
                if (track.scrollLeft + track.clientWidth >= track.scrollWidth - 10) {
                    track.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    track.scrollBy({ left: cardWidth, behavior: 'smooth' });
                }
            }
        };

        const scrollPrev = () => {
            const card = track.querySelector('.service-card');
            if (card) {
                const cardWidth = card.offsetWidth + 20;
                if (track.scrollLeft <= 0) {
                    track.scrollTo({ left: track.scrollWidth, behavior: 'smooth' });
                } else {
                    track.scrollBy({ left: -cardWidth, behavior: 'smooth' });
                }
            }
        };

        const startAutoScroll = () => { autoScrollInterval = setInterval(scrollNext, scrollSpeed); };
        const stopAutoScroll = () => { clearInterval(autoScrollInterval); };

        nextBtn.addEventListener('click', () => { stopAutoScroll(); scrollNext(); startAutoScroll(); });
        prevBtn.addEventListener('click', () => { stopAutoScroll(); scrollPrev(); startAutoScroll(); });

        track.addEventListener('mouseenter', stopAutoScroll);
        track.addEventListener('mouseleave', startAutoScroll);
        track.addEventListener('touchstart', stopAutoScroll);
        track.addEventListener('touchend', startAutoScroll);

        startAutoScroll();
    }

    // --- 4. Projeler Yatay Slider Kaydırma ---
    const projectsTrack = document.getElementById('projectsTrack');
    const prevProjectBtn = document.getElementById('prevProjectBtn');
    const nextProjectBtn = document.getElementById('nextProjectBtn');

    if (projectsTrack && prevProjectBtn && nextProjectBtn) {
        nextProjectBtn.addEventListener('click', () => {
            const card = projectsTrack.querySelector('.project-card');
            if (card) {
                const cardWidth = card.offsetWidth + 24;
                projectsTrack.scrollBy({ left: cardWidth, behavior: 'smooth' });
            }
        });

        prevProjectBtn.addEventListener('click', () => {
            const card = projectsTrack.querySelector('.project-card');
            if (card) {
                const cardWidth = card.offsetWidth + 24;
                projectsTrack.scrollBy({ left: -cardWidth, behavior: 'smooth' });
            }
        });
    }

    // --- 5. Modal Galeri Mantığı ---
    let currentImages = [];
    let currentIndex = 0;

    window.openGallery = function(images) {
        currentImages = images;
        currentIndex = 0;
        
        const modal = document.getElementById('projectModal');
        const thumbList = document.getElementById('thumbnailList');
        
        if (!modal || !thumbList) return;

        thumbList.innerHTML = '';
        images.forEach((imgUrl, index) => {
            const thumb = document.createElement('img');
            thumb.src = imgUrl;
            thumb.classList.add('thumb-img');
            if (index === 0) thumb.classList.add('active');
            
            thumb.onclick = (e) => {
                e.stopPropagation();
                setImage(index);
            };
            thumbList.appendChild(thumb);
        });

        updateMainImage();
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    };

    window.closeGallery = function() {
        const modal = document.getElementById('projectModal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    };

    window.setImage = function(index) {
        currentIndex = index;
        updateMainImage();
    };

    window.changeImage = function(direction, event) {
        if (event) event.stopPropagation();
        currentIndex += direction;
        if (currentIndex < 0) currentIndex = currentImages.length - 1;
        if (currentIndex >= currentImages.length) currentIndex = 0;
        updateMainImage();
    };

    function updateMainImage() {
        const mainImg = document.getElementById('modalMainImg');
        if (mainImg && currentImages.length > 0) {
            mainImg.src = currentImages[currentIndex];
        }

        const thumbs = document.querySelectorAll('.thumb-img');
        thumbs.forEach((thumb, index) => {
            if (index === currentIndex) {
                thumb.classList.add('active');
            } else {
                thumb.classList.remove('active');
            }
        });
    }

    // Modal dışına tıklayınca kapatma
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('projectModal');
        if (event.target === modal) {
            closeGallery();
        }
    });
    // --- Hamburger Menü Mantığı ---
const hamburgerMenu = document.getElementById('hamburgerMenu');
const navMenu = document.getElementById('navMenu');

if (hamburgerMenu && navMenu) {
    // Hamburger butona tıklayınca aç/kapat
    hamburgerMenu.addEventListener('click', (e) => {
        e.stopPropagation();
        hamburgerMenu.classList.toggle('active');
        navMenu.classList.toggle('active');
        
        // İkonu X / Çizgi olarak değiştirme
        const icon = hamburgerMenu.querySelector('i');
        if (icon) {
            if (navMenu.classList.contains('active')) {
                icon.className = 'fa-solid fa-xmark';
            } else {
                icon.className = 'fa-solid fa-bars';
            }
        }
    });

    // Sayfada menü dışına tıklandığında menüyü kapat
    document.addEventListener('click', (e) => {
        if (!hamburgerMenu.contains(e.target) && !navMenu.contains(e.target)) {
            hamburgerMenu.classList.remove('active');
            navMenu.classList.remove('active');
            const icon = hamburgerMenu.querySelector('i');
            if (icon) icon.className = 'fa-solid fa-bars';
        }
    });
}
});
// ==========================================
// YÜKLEME EKRANI (PRELOADER) KONTROLÜ
// ==========================================

const preloader = document.getElementById('preloader');

function hidePreloader() {
    if (preloader && !preloader.classList.contains('hide-loader')) {
        preloader.classList.add('hide-loader');
    }
}

// 1. Sayfa ve görseller tamamen yüklendiğinde ekranı kaldır
window.addEventListener('load', hidePreloader);

// 2. Tarayıcıda geri/ileri tuşlarına basıldığında önbellek (bfcache) kaynaklı takılmayı önle
window.addEventListener('pageshow', (event) => {
    if (event.persisted) {
        hidePreloader();
    }
});

// 3. Güvenlik Zaman Aşımı: Görseller gecikirse en geç 2.5 saniye sonra ekranı aç
setTimeout(hidePreloader, 2500);