<?php
// class/Database.php

class Database {
    public $conn;

    public function __construct() {
        $this->connect();
    }

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("SET NAMES utf8mb4");
        } catch (PDOException $e) {
            die("Koneksi database gagal: " . $e->getMessage());
        }
        return $this->conn;
    }

    public function query($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params) ? $stmt : false;
    }

    public function getConnection() {
        $this->conn = null;
    }
}