<?php
// class/Product.php

class Product {
    // PROPERTIES
    protected $db;
    protected $id;              // ID protected agar tidak sembarangan diubah

    public $name;
    public $category;
    public $price;
    public $stock;
    public $image_path;
    public $status;

    // CONSTRUCTOR
    public function __construct($db) {
        $this->db = $db;
    }

    // Getter untuk ID
    public function getId() {
        return $this->id;
    }

    // Setter untuk ID (opsional, jika ingin set manual)
    protected function setId($id) {
        $this->id = $id;
    }

    // SAVE: Insert jika id kosong, Update jika id ada
    public function save() {
        if (empty($this->id)) {
            // INSERT
            $sql = "INSERT INTO products (name, category, price, stock, image_path, status) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $result = $this->db->query($sql, [
                $this->name,
                $this->category,
                $this->price,
                $this->stock,
                $this->image_path,
                $this->status
            ]);

            if ($result) {
                // Ambil ID terakhir yang diinsert
                $this->id = $this->db->conn->lastInsertId();
            }
            return $result;
        } else {
            // UPDATE
            $sql = "UPDATE products 
                    SET name=?, category=?, price=?, stock=?, image_path=?, status=? 
                    WHERE id=?";
            return $this->db->query($sql, [
                $this->name,
                $this->category,
                $this->price,
                $this->stock,
                $this->image_path,
                $this->status,
                $this->id
            ]);
        }
    }

    // Ambil semua produk
    public function getAll() {
        $sql = "SELECT * FROM products ORDER BY id DESC";
        $stmt = $this->db->query($sql);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    // Ambil produk berdasarkan ID
    public function getById($id) {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->db->query($sql, [$id]);
        $result = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;

        if ($result) {
            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->category = $result['category'];
            $this->price = $result['price'];
            $this->stock = $result['stock'];
            $this->image_path = $result['image_path'];
            $this->status = $result['status'];
        }

        return $result;
    }

    // Hapus produk
    public function delete() {
        if (!empty($this->id)) {
            $sql = "DELETE FROM products WHERE id=?";
            return $this->db->query($sql, [$this->id]);
        }
        return false;
    }
}