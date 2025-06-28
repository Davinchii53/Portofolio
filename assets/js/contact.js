document.getElementById('contactForm').addEventListener('submit', async function(event) {
    event.preventDefault();
    
    const btn = event.target.querySelector('button');
    const originalText = btn.textContent;
    
    try {
        btn.disabled = true;
        btn.textContent = 'Sending...';
        
        // Debug: Log form data
        const formData = new FormData(event.target);
        console.log('Form data:', Object.fromEntries(formData));
        
        const response = await emailjs.sendForm(
            'service_qbxl3zr', // Ganti dengan Service ID
            'template_rc44hoa', // Ganti dengan Template ID
            event.target,
            'e4FS-2tq1Fwa7Rfbg' // Ganti dengan Public Key
        );
        
        console.log('EmailJS Response:', response);
        
        if (response.status === 200) {
            alert('Message sent successfully! Check your email (including spam folder).');
            event.target.reset();
        } else {
            throw new Error(response.text);
        }
    } catch (error) {
        console.error('Full error details:', error);
        alert(`Failed to send: ${error.message || 'Unknown error'}`);
    } finally {
        btn.disabled = false;
        btn.textContent = originalText;
    }
});