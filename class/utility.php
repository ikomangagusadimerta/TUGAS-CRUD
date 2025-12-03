<?php
// class/Utility.php

class Utility {

    /**
     * Tampilkan navigasi berdasarkan konstanta NAV_PAGES
     */
    public static function renderNavigation() {
        if (defined('NAV_PAGES')) {
            echo '<nav>';
            foreach (NAV_PAGES as $page) {
                echo '<a href="' . BASE_URL . $page['url'] . '">' . $page['title'] . '</a> | ';
            }
            echo '</nav><hr>';
        }
    }

    /**
     * Redirect ke halaman tertentu dengan optional flash message
     */
    public static function redirect($url, $flash = null) {
        if ($flash) {
            $_SESSION['flash'] = $flash;
        }
        header("Location: " . BASE_URL . $url);
        exit;
    }

    /**
     * Set flash message
     */
    public static function setFlash($message, $type = 'success') {
        $_SESSION['flash'] = [
            'message' => $message,
            'type' => $type
        ];
    }

    /**
     * Ambil flash message (sekali pakai)
     */
    public static function getFlash() {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']); // hapus setelah ditampilkan
            return '<div class="flash ' . $flash['type'] . '">' . $flash['message'] . '</div>';
        }
        return '';
    }

    /**
     * Simpan data prefill (misalnya dari $_POST)
     */
    public static function setPrefill($data) {
        $_SESSION['prefill'] = $data;
    }

    /**
     * Ambil data prefill untuk form
     */
    public static function getPrefill($field) {
        return isset($_SESSION['prefill'][$field]) ? htmlspecialchars($_SESSION['prefill'][$field]) : '';
    }

    /**
     * Bersihkan data prefill
     */
    public static function clearPrefill() {
        unset($_SESSION['prefill']);
    }

    /**
     * Sanitasi input teks
     */
    public static function sanitizeInput($input) {
        return htmlspecialchars(strip_tags(trim($input ?? '')));
    }

    /**
     * Validasi file upload (ekstensi: jpg, jpeg, png; size <= 2MB)
     */
    public static function validateFile($file) {
        if (empty($file['name'])) return "File tidak ditemukan.";
        $allowed = ["jpg", "jpeg", "png"];
        $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) return "Format file tidak valid (hanya jpg/jpeg/png).";
        if ($file["size"] > 2 * 1024 * 1024) return "Ukuran file terlalu besar (maksimal 2MB).";
        if (!is_uploaded_file($file["tmp_name"])) return "Upload tidak valid.";
        return true;
    }

    /**
     * Upload file ke folder uploads/
     */
    public static function uploadFile($file) {
        $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $filename = uniqid('img_', true) . "." . $ext;
        $targetAbs = UPLOAD_DIR . $filename;

        if (!is_dir(UPLOAD_DIR)) {
            mkdir(UPLOAD_DIR, 0755, true);
        }

        if (move_uploaded_file($file["tmp_name"], $targetAbs)) {
            return "uploads/" . $filename; // path relatif untuk DB
        }
        return null;
    }
}