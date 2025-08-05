<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tulis Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <h1 class="mb-4">Tulis Artikel Baru</h1>

    <!-- Tambahkan enctype untuk upload file -->
    <form method="post" action="<?= base_url('store') ?>" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Konten</label>
            <textarea name="content" class="form-control" id="content" rows="10" required></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar</label>
            <input type="file" class="form-control" name="image" id="image">
        </div>

        <button type="submit" class="btn btn-success">Kirim</button>
        <a href="<?= base_url('post'); ?>" class="btn btn-secondary">Batal</a>
    </form>
</body>

</html>