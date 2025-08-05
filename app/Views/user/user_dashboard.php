<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Artikel</title>

    <!-- Google Font modern -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }

        h1 {
            text-align: center;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .clickable-card {
            text-decoration: none;
            color: inherit;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .card-title {
            font-weight: 600;
        }

        .card-body {
            position: relative;
        }

        .btn-group-float {
            position: absolute;
            bottom: 15px;
            right: 15px;
        }

        .btn-sm {
            font-size: 0.875rem;
            padding: 0.4rem 0.8rem;
        }
    </style>
</head>

<body class="container py-5">

    <h1>Daftar Artikel</h1>

    <?php foreach ($posts as $post): ?>
        <a href="<?= base_url('post/view/' . $post['slug']); ?>" class="clickable-card">
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title"><?= esc($post['title']); ?></h3>
                    <p class="text-muted mb-2"><?= date('d M Y', strtotime($post['created_at'])); ?></p>

                    <?php if (!empty($post['image'])): ?>
                        <img src="<?= base_url('uploads/' . $post['image']); ?>" class="img-fluid mb-3 rounded" alt="Gambar Artikel">
                    <?php endif; ?>

                    <p><?= substr(strip_tags($post['content']), 0, 150) . '...'; ?></p>

                    <div class="btn-group-float">
                        <a href="<?= base_url('post/view/' . $post['slug']); ?>" class="btn btn-sm btn-primary" onclick="event.stopPropagation()">Lihat</a>
                        <button onclick="event.stopPropagation(); salinLink('<?= base_url('post/view/' . $post['slug']); ?>')" class="btn btn-sm btn-secondary">🔗</button>
                    </div>
                </div>
            </div>
        </a>
    <?php endforeach; ?>

    <script>
        function salinLink(link) {
            navigator.clipboard.writeText(link).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Tautan Disalin!',
                    text: 'Link berhasil disalin ke clipboard.',
                    timer: 2000,
                    showConfirmButton: false
                });
            }).catch(err => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal menyalin tautan.',
                });
            });
        }
    </script>

</body>

</html>