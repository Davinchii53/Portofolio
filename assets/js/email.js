// Inisialisasi
emailjs.init('e4FS-2tq1Fwa7Rfbg');

document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Tambahkan timestamp
    const formData = new FormData(this);
    formData.append('time', new Date().toLocaleString());
    
    emailjs.sendForm('service_qbxl3zr', 'template_rc44hoa', this)
        .then(() => alert('Message sent successfully!'))
        .catch(error => console.error('Error:', error));
});