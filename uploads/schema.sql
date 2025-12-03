-- Buat database khusus produk kecantikan
CREATE DATABASE produk_tugas;
USE produk_tugas;

-- Buat tabel produk kecantikan
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,             -- nama produk (misalnya Lipstik Matte, Serum Vitamin C)
    brand VARCHAR(100) NOT NULL,            -- merek produk (misalnya Wardah, L'Oreal)
    category ENUM('makeup','skincare','haircare','fragrance','bodycare') NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
    description TEXT,                       -- deskripsi produk
    image_path VARCHAR(255),                -- path gambar produk
    status ENUM('active','inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Buat user database
CREATE USER 'user_crud'@'localhost' IDENTIFIED BY 'gusadi34';

-- Berikan hak akses penuh ke database beauty_store
GRANT ALL PRIVILEGES ON produk_tugas.* TO 'user_crud'@'localhost';

-- Terapkan perubahan hak akses
FLUSH PRIVILEGES;

-- Data contoh awal
INSERT INTO products (name, brand, category, price, stock, description, image_path, status)
VALUES
('Lipstik Matte', 'Wardah', 'makeup', 45000, 50, 'Lipstik matte tahan lama dengan warna natural.', 'uploads/lipstik.png', 'active'),
('Serum Vitamin C', 'The Ordinary', 'skincare', 150000, 30, 'Serum untuk mencerahkan kulit dan mengurangi flek hitam.', 'uploads/serum.png', 'active'),
('Shampoo Anti-Dandruff', 'Head & Shoulders', 'haircare', 60000, 40, 'Shampoo untuk mengatasi ketombe dan menjaga kesehatan kulit kepala.', 'uploads/shampoo.png', 'active'),
('Parfum Floral', 'L\'Occitane', 'fragrance', 350000, 20, 'Parfum dengan aroma bunga segar.', 'uploads/parfum.png', 'inactive');