<?php
require_once "config.php";
require_once "class/Database.php";
require_once "class/Product.php";
require_once "class/Utility.php";

$db = new Database();
$product = new Product($db);

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    Utility::setFlash("ID produk tidak ditemukan!", "error");
    Utility::redirect("index.php");
}

$id = (int) $_GET['id'];

// Ambil data produk
if (!$product->getById($id)) {
    Utility::setFlash("Produk tidak ditemukan!", "error");
    Utility::redirect("index.php");
}

// Proses form edit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    Utility::setPrefill($_POST);

    $product->name     = Utility::sanitizeInput($_POST["name"]);
    $product->category = Utility::sanitizeInput($_POST["category"]);
    $product->price    = $_POST["price"];
    $product->stock    = $_POST["stock"];
    $product->status   = $_POST["status"];

    // Upload file jika ada
    if (!empty($_FILES["image"]["name"])) {
        $valid = Utility::validateFile($_FILES["image"]);
        if ($valid === true) {
            $product->image_path = Utility::uploadFile($_FILES["image"]);
        } else {
            Utility::setFlash($valid, "error");
            Utility::redirect("edit.php?id=" . $id);
        }
    }

    if ($product->save()) {
        Utility::clearPrefill();
        Utility::setFlash("Produk berhasil diperbarui!", "success");
        Utility::redirect("index.php");
    } else {
        Utility::setFlash("Gagal memperbarui produk!", "error");
        Utility::redirect("edit.php?id=" . $id);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h1>Aplikasi CRUD Produk</h1>
    <?php Utility::renderNavigation(); ?>
    <?= Utility::getFlash(); ?>

    <h2>Edit Produk</h2>
    <form method="post" enctype="multipart/form-data">
        <label>Nama Produk</label>
        <input type="text" name="name" value="<?= Utility::getPrefill('name') ?: htmlspecialchars($product->name); ?>" required>

        <label>Kategori</label>
        <input type="text" name="category" value="<?= Utility::getPrefill('category') ?: htmlspecialchars($product->category); ?>" required>

        <label>Harga</label>
        <input type="number" step="0.01" name="price" value="<?= Utility::getPrefill('price') ?: htmlspecialchars($product->price); ?>" required>

        <label>Stok</label>
        <input type="number" name="stock" value="<?= Utility::getPrefill('stock') ?: htmlspecialchars($product->stock); ?>" required>

        <label>Status</label>
        <select name="status">
            <option value="active" <?= ($product->status === 'active') ? 'selected' : ''; ?>>Active</option>
            <option value="inactive" <?= ($product->status === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
        </select>

        <label>Gambar Produk</label>
        <?php if (!empty($product->image_path)): ?>
            <div>
                <img src="<?= BASE_URL . $product->image_path; ?>" alt="Produk" style="max-width:100px;">
            </div>
        <?php endif; ?>
        <input type="file" name="image">

        <button type="submit">Update Produk</button>
    </form>
</div>
</body>
</html>