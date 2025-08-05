<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= esc($post['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    <h1><?= esc($post['title']); ?></h1>
    <p class="text-muted"><?= $post['created_at']; ?></p>

    <?php if (!empty($post['image'])): ?>
        <div class="mb-4 text-center">
            <img src="<?= base_url('uploads/' . $post['image']); ?>" alt="Gambar Artikel" class="img-fluid rounded">
        </div>
    <?php endif; ?>

    <hr>
    <p><?= esc($post['content']); ?></p>

    <a href="javascript:history.back()" class="btn btn-primary mt-3">← Kembali</a>

</body>

</html>