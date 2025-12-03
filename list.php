<?php
require 'inc/config.php';
$product = new Product();
$items = $product->getAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Item</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Daftar Item</h1>
    </header>

    <?php Utility::showNav(); ?>

    <main>
        <?php Utility::showFlash(); ?>

        <?php if (empty($items)): ?>
            <p>Belum ada data item.</p>
        <?php else: ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $i): ?>
                        <tr>
                            <td><?= htmlspecialchars($i['id']) ?></td>
                            <td><?= htmlspecialchars($i['nama']) ?></td>
                            <td>Rp <?= number_format($i['harga'], 0, ',', '.') ?></td>
                            <td><?= htmlspecialchars($i['kategori']) ?></td>
                            <td><?= htmlspecialchars($i['stok']) ?></td>
                            <td>
                                <a href="edit.php?id=<?= $i['id'] ?>" class="edit">Edit</a> |
                                <a href="delete.php?id=<?= $i['id'] ?>" 
                                   onclick="return confirm('Yakin ingin menghapus item ini?')" 
                                   class="delete">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
