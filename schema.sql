-- schema.sql
CREATE DATABASE IF NOT EXISTS produk_tugas;
USE produk_tugas;

CREATE TABLE items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  harga DECIMAL(10,2) NOT NULL CHECK (harga >= 0),
  kategori ENUM('elektronik', 'pakaian') NOT NULL,
  stok INT NOT NULL DEFAULT 0 CHECK (stok >= 0),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
