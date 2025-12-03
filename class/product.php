<?php
class Product {
    public $nama;
    public $harga;
    public $kategori;
    public $stok;

    protected $id;
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getId() {
        return $this->id;
    }

    public function setById($id) {
        $sql = "SELECT * FROM items WHERE id = :id LIMIT 1";
        $stmt = $this->db->query($sql, ['id' => $id]);
        $data = $stmt->fetch();

        if ($data) {
            $this->id       = $data['id'];
            $this->nama     = $data['nama'];
            $this->harga    = $data['harga'];
            $this->kategori = $data['kategori'];
            $this->stok     = $data['stok'];
            return true;
        }
        return false;
    }

    public function getAll() {
        $sql = "SELECT * FROM items ORDER BY id ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function save() {
        if (isset($this->id)) {
            $sql = "UPDATE items SET nama=:nama, harga=:harga, kategori=:kategori, stok=:stok WHERE id=:id";
            $params = [
                'nama' => $this->nama,
                'harga' => $this->harga,
                'kategori' => $this->kategori,
                'stok' => $this->stok,
                'id' => $this->id
            ];
        } else {
            $sql = "INSERT INTO items (nama, harga, kategori, stok) VALUES (:nama, :harga, :kategori, :stok)";
            $params = [
                'nama' => $this->nama,
                'harga' => $this->harga,
                'kategori' => $this->kategori,
                'stok' => $this->stok
            ];
        }

        $stmt = $this->db->query($sql, $params);
        if ($stmt && !isset($this->id)) {
            $this->id = $this->db->connection->lastInsertId();
        }
        return (bool)$stmt;
    }

    public function remove() {
        if (isset($this->id)) {
            $sql = "DELETE FROM items WHERE id = :id";
            return $this->db->query($sql, ['id' => $this->id]) !== false;
        }
        return false;
    }
}

