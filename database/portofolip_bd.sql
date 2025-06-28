-- Buat database
CREATE DATABASE IF NOT EXISTS portfolio_db;
USE portfolio_db;

-- Buat tabel komentar
CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Contoh data dummy (opsional)
INSERT INTO comments (name, email, message) VALUES
('John Doe', 'john@example.com', 'Website yang menginspirasi!'),
('Jane Smith', 'jane@example.com', 'Saya suka desain portofolio Anda');