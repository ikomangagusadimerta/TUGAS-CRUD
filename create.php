<?php
require 'inc/config.php';

// Ambil prefill jika ada
$prefill = Utility::getPrefill(['nama', 'harga', 'kategori', 'stok']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Item</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Tambah Item Baru</h1>
    </header>

    <?php Utility::showNav(); ?>

    <main>
        <?php Utility::showFlash(); ?>

        <form class="form-box" method="POST" action="save.php">
            <div class="form-group">
                <label for="nama">Nama Item:</label>
                <input type="text" id="nama" name="nama" 
                       value="<?= htmlspecialchars($prefill['nama']) ?>" 
                       required maxlength="100">
            </div>

            <div class="form-group">
                <label for="harga">Harga (Rp):</label>
                <input type="number" id="harga" name="harga" step="0.01" min="0"
                       value="<?= htmlspecialchars($prefill['harga']) ?>" 
                       required>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori:</label>
                <select id="kategori" name="kategori" required>
                    <option value="">-- Pilih --</option>
                    <option value="elektronik" <?= $prefill['kategori'] === 'elektronik' ? 'selected' : '' ?>>Elektronik</option>
                    <option value="pakaian" <?= $prefill['kategori'] === 'pakaian' ? 'selected' : '' ?>>Pakaian</option>
                </select>
            </div>

            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="number" id="stok" name="stok" min="0"
                       value="<?= htmlspecialchars($prefill['stok']) ?>" 
                       required>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="list.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </main>
</body>
</html>
