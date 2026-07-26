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