<?php
// Di bagian atas file
$page_title = "Your Name - Portfolio";
require_once 'php/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <!-- ... (bagian head tetap sama) ... -->
</head>
<body>
    <!-- ... (konten HTML tetap sama) ... -->
    
    <!-- Bagian komentar yang dimodifikasi -->
    <div id="comments-section" class="comments-container">
        <!-- Komentar akan dimuat via AJAX -->
    </div>

    <!-- Form yang dimodifikasi -->
    <form id="commentForm" class="contact-form">
        <div class="input-box">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
        </div>
        <textarea name="message" placeholder="Your Message" required></textarea>
        <button type="submit" class="btn neon-btn">Send Message</button>
    </form>

    <!-- JavaScript yang dimodifikasi -->
    <script>
    // Fungsi untuk memuat komentar
    function loadComments() {
        fetch('php/get_comments.php')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('comments-section');
                if (data.error) {
                    container.innerHTML = '<p>Error loading comments</p>';
                    return;
                }
                
                if (data.length === 0) {
                    container.innerHTML = '<p>No comments yet. Be the first!</p>';
                    return;
                }
                
                let html = '<h3>Visitor Comments</h3>';
                data.forEach(comment => {
                    html += `
                    <div class="comment-box">
                        <h4>${comment.name}</h4>
                        <p>${comment.message}</p>
                        <small>Posted on ${comment.formatted_date}</small>
                    </div>
                    `;
                });
                container.innerHTML = html;
            });
    }

    // Handle form submission
    document.getElementById('commentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch('php/submit_comment.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                this.reset();
                loadComments(); // Refresh comments
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred');
        });
    });

    // Muat komentar saat halaman dimuat
    document.addEventListener('DOMContentLoaded', loadComments);
    </script>
</body>
</html>