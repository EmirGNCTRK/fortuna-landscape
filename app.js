// --- Sayfa Kaydırıldığında Header Stilini Değiştirme ---
window.addEventListener('scroll', function() {
    const header = document.querySelector('header');
    if (window.scrollY > 50) {
        header.style.padding = '10px 0'; // Header'ı küçült
        header.style.boxShadow = '0 4px 15px rgba(0,0,0,0.1)';
    } else {
        header.style.padding = '15px 0'; // Orijinal boyut
        header.style.boxShadow = '0 2px 10px rgba(0,0,0,0.05)';
    }
});

// --- İletişim Formu Gönderme (Simülasyon) ---
const contactForm = document.getElementById('contact-form');

if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault(); // Formun gerçekten gönderilmesini engelle

        // Form verilerini al
        const formData = new FormData(contactForm);
        const name = formData.get('ad');
        const email = formData.get('email');
        const message = formData.get('mesaj');

        // Basit bir geri bildirim simülasyonu
        console.log('Form Gönderildi:', { name, email, message });
        alert(`Teşekkürler ${name}! Mesajınız başarıyla simüle edildi. (Şimdilik gerçek bir e-posta gönderilmedi.)`);

        // Formu temizle
        contactForm.reset();
    });
}
// --- Hizmetler Otomatik & Sonsuz Slider ---
const track = document.getElementById('servicesTrack');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

if (track && prevBtn && nextBtn) {
    let autoScrollInterval;
    const scrollSpeed = 3000; // Kaç milisaniyede bir kaysın (3 saniye)

    // Sağ tarafa kaydırma fonksiyonu
    const scrollNext = () => {
        const card = track.querySelector('.service-card');
        const cardWidth = card.offsetWidth + 20; // Kart genişliği + gap (20px)
        
        // Eğer sona ulaştıysa başa dön, ulaşmadıysa sağa kay
        if (track.scrollLeft + track.clientWidth >= track.scrollWidth - 10) {
            track.scrollTo({ left: 0, behavior: 'smooth' });
        } else {
            track.scrollBy({ left: cardWidth, behavior: 'smooth' });
        }
    };

    // Sol tarafa kaydırma fonksiyonu
    const scrollPrev = () => {
        const card = track.querySelector('.service-card');
        const cardWidth = card.offsetWidth + 20;

        if (track.scrollLeft <= 0) {
            track.scrollTo({ left: track.scrollWidth, behavior: 'smooth' });
        } else {
            track.scrollBy({ left: -cardWidth, behavior: 'smooth' });
        }
    };

    // Otomatik Kaydırmayı Başlatırma
    const startAutoScroll = () => {
        autoScrollInterval = setInterval(scrollNext, scrollSpeed);
    };

    // Otomatik Kaydırmayı Durdurma
    const stopAutoScroll = () => {
        clearInterval(autoScrollInterval);
    };

    // Buton Tıklamaları
    nextBtn.addEventListener('click', () => {
        stopAutoScroll();
        scrollNext();
        startAutoScroll();
    });

    prevBtn.addEventListener('click', () => {
        stopAutoScroll();
        scrollPrev();
        startAutoScroll();
    });

    // Mouse Üzerine Gelince Durdur / Ayrılınca Başlat
    track.addEventListener('mouseenter', stopAutoScroll);
    track.addEventListener('mouseleave', startAutoScroll);

    // Dokunmatik cihazlar için (Mobil)
    track.addEventListener('touchstart', stopAutoScroll);
    track.addEventListener('touchend', startAutoScroll);

    // Başlangıçta otomatği çalıştır
    startAutoScroll();
}
// --- Modal Galeri Mantığı ---
let currentImages = [];
let currentIndex = 0;

function openGallery(images) {
    currentImages = images;
    currentIndex = 0;
    
    const modal = document.getElementById('projectModal');
    const thumbList = document.getElementById('thumbnailList');
    
    // Küçük resimleri yükle
    thumbList.innerHTML = '';
    images.forEach((imgUrl, index) => {
        const thumb = document.createElement('img');
        thumb.src = imgUrl;
        thumb.classList.add('thumb-img');
        if (index === 0) thumb.classList.add('active');
        
        thumb.onclick = () => setImage(index);
        thumbList.appendChild(thumb);
    });

    // Ana resmi ayarla
    updateMainImage();
    
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden'; // Arka plan kaymasını engelle
}

function closeGallery() {
    const modal = document.getElementById('projectModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

function setImage(index) {
    currentIndex = index;
    updateMainImage();
}

function changeImage(direction) {
    currentIndex += direction;
    if (currentIndex < 0) currentIndex = currentImages.length - 1;
    if (currentIndex >= currentImages.length) currentIndex = 0;
    updateMainImage();
}

function updateMainImage() {
    const mainImg = document.getElementById('modalMainImg');
    mainImg.src = currentImages[currentIndex];

    // Thumbnail aktiflik sınıfını güncelle
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
window.onclick = function(event) {
    const modal = document.getElementById('projectModal');
    if (event.target === modal) {
        closeGallery();
    }
};