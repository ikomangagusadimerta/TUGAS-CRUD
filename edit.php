<?php
require 'inc/config.php';

// Ambil ID dari URL
$id = (int)($_GET['id'] ?? 0);
if (!$id) {
    Utility::redirect('list.php', 'ID item tidak valid.');
}

// Load item berdasarkan ID
$product = new Product();
if (!$product->setById($id)) {
    Utility::redirect('list.php', 'Item tidak ditemukan.');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Item #<?= $product->getId() ?></title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Edit Item #<?= $product->getId() ?></h1>
  </header>

  <?php Utility::showNav(); ?>

  <main>
    <?php Utility::showFlash(); ?>

    <form class="form-box" method="POST" action="update.php">
      <input type="hidden" name="id" value="<?= $product->getId() ?>">

      <!-- Nama Item -->
      <div class="form-group">
        <label for="nama">Nama Item</label>
        <input type="text" id="nama" name="nama" 
               value="<?= htmlspecialchars($product->nama) ?>" 
               required maxlength="100">
      </div>

      <!-- Harga -->
      <div class="form-group">
        <label for="harga">Harga (Rp)</label>
        <input type="number" id="harga" name="harga" step="0.01" min="0"
               value="<?= htmlspecialchars($product->harga) ?>" 
               required>
      </div>

      <!-- Kategori -->
      <div class="form-group">
        <label for="kategori">Kategori</label>
        <select id="kategori" name="kategori" required>
          <option value="">-- Pilih --</option>
          <option value="elektronik" <?= $product->kategori === 'elektronik' ? 'selected' : '' ?>>
            Elektronik
          </option>
          <option value="pakaian" <?= $product->kategori === 'pakaian' ? 'selected' : '' ?>>
            Pakaian
          </option>
        </select>
      </div>

      <!-- Stok -->
      <div class="form-group">
        <label for="stok">Stok</label>
        <input type="number" id="stok" name="stok" min="0"
               value="<?= htmlspecialchars($product->stok) ?>" 
               required>
      </div>

      <div class="btn-group">
        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="list.php" class="btn btn-secondary">Batal</a>
      </div>
    </form>
  </main>
</body>
</html>
