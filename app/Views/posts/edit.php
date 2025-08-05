<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <h1>Edit Artikel</h1>

    <!-- Form edit dengan enctype untuk upload gambar -->
    <form method="post" action="<?= base_url('post/update/' . $post['id']) ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" value="<?= esc($post['title']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Isi Artikel</label>
            <textarea name="content" rows="10" class="form-control" required><?= esc($post['content']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Saat Ini</label><br>
            <?php if (!empty($post['image'])): ?>
                <img src="<?= base_url('uploads/' . $post['image']) ?>" alt="Gambar Artikel" style="max-width: 300px;" class="img-fluid mb-2">
            <?php else: ?>
                <p><em>Tidak ada gambar.</em></p>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Ganti Gambar (opsional)</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">💾 Simpan Perubahan</button>
        <a href="<?= base_url('post/view/' . $post['slug']) ?>" class="btn btn-secondary">Batal</a>
    </form>
</body>

</html>