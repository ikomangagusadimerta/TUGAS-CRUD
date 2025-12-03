<?php
class Utility {
    public static function showNav($pages = NAV_PAGES) {
        echo "<nav><ul>";
        foreach ($pages as $item) {
            $title = htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8');
            $url   = htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8');
            echo "<li><a href=\"{$url}\">{$title}</a></li>";
        }
        echo "</ul></nav>";
    }

    public static function redirect($url, $message = '', $prefill = []) {
        if ($message) $_SESSION['flash'] = $message;
        if (!empty($prefill)) $_SESSION['prefill'] = $prefill;
        header("Location: " . BASE_URL . $url);
        exit;
    }

    public static function showFlash() {
        if (!empty($_SESSION['flash'])) {
            $msg = $_SESSION['flash'];

            // Jika flash berupa array, gabungkan jadi string
            if (is_array($msg)) {
                $msg = implode('<br>', $msg);
            }

            echo "<div class='flash'>" . htmlspecialchars($msg, ENT_QUOTES, 'UTF-8') . "</div>";
            unset($_SESSION['flash']);
        }
    }

    public static function getPrefill($keys = []) {
        $result = [];
        foreach ($keys as $key) {
            $result[$key] = $_SESSION['prefill'][$key] ?? '';
        }
        return $result;
    }

    public static function clearPrefill() {
        unset($_SESSION['prefill']);
    }
}
