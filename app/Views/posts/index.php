<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Blog Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">📘 Blog Saya</h1>
            <a href="<?= base_url('create'); ?>" class="btn btn-success">+ Buat Artikel</a>
        </div>

        <?php if (!empty($posts)) : ?>
            <?php foreach ($posts as $post): ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-2">
                            <a href="<?= base_url('post/view/' . $post['slug']); ?>" class="text-decoration-none text-dark">
                                <?= esc($post['title']); ?>
                            </a>
                        </h3>
                        <p class="text-muted mb-3 small">📅 <?= date('d M Y, H:i', strtotime($post['created_at'])); ?></p>

                        <div class="d-flex gap-2">
                            <a href="<?= base_url('post/view/' . $post['slug']); ?>" class="btn btn-outline-primary btn-sm">👁️ Lihat</a>
                            <a href="<?= base_url('post/edit/' . $post['id']); ?>" class="btn btn-outline-warning btn-sm">✎ Edit</a>
                            <a href="<?= base_url('post/delete/' . $post['id']); ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus artikel ini?');">🗑 Hapus</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info text-center">
                Tidak ada artikel yang tersedia. Silakan buat artikel pertama Anda!
            </div>
        <?php endif; ?>
    </div>
</body>

</html>