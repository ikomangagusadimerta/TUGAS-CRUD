<?php
require_once "config.php";
require_once "class/Database.php";
require_once "class/Product.php";
require_once "class/Utility.php";

$db = new Database();
$product = new Product($db);

// Proses form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    Utility::setPrefill($_POST);

    $product->name     = Utility::sanitizeInput($_POST["name"]);
    $product->category = Utility::sanitizeInput($_POST["category"]);
    $product->price    = $_POST["price"];
    $product->stock    = $_POST["stock"];
    $product->status   = $_POST["status"];

    // Upload file
    if (!empty($_FILES["image"]["name"])) {
        $valid = Utility::validateFile($_FILES["image"]);
        if ($valid === true) {
            $product->image_path = Utility::uploadFile($_FILES["image"]);
        } else {
            Utility::setFlash($valid, "error");
            Utility::redirect("create.php");
        }
    }

    if ($product->save()) {
        Utility::clearPrefill();
        Utility::setFlash("Produk berhasil ditambahkan!", "success");
        Utility::redirect("index.php");
    } else {
        Utility::setFlash("Gagal menambahkan produk!", "error");
        Utility::redirect("create.php");
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h1>Aplikasi CRUD Produk</h1>
    <?php Utility::renderNavigation(); ?>
    <?= Utility::getFlash(); ?>

    <h2>Tambah Produk Baru</h2>
    <form method="post" enctype="multipart/form-data">
        <label>Nama Produk</label>
        <input type="text" name="name" value="<?= Utility::getPrefill('name'); ?>" required>

        <label>Kategori</label>
        <input type="text" name="category" value="<?= Utility::getPrefill('category'); ?>" required>

        <label>Harga</label>
        <input type="number" step="0.01" name="price" value="<?= Utility::getPrefill('price'); ?>" required>

        <label>Stok</label>
        <input type="number" name="stock" value="<?= Utility::getPrefill('stock'); ?>" required>

        <label>Status</label>
        <select name="status">
            <option value="active" <?= Utility::getPrefill('status') === 'active' ? 'selected' : ''; ?>>Active</option>
            <option value="inactive" <?= Utility::getPrefill('status') === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
        </select>

        <label>Gambar Produk</label>
        <input type="file" name="image">

        <button type="submit">Simpan Produk</button>
    </form>
</div>
</body>
</html>