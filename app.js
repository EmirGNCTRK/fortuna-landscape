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