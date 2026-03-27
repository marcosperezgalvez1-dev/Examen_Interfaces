<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog | Marcos Pérez</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <main>
        <section class="page-header">
            <div class="container">
                <h1 class="section-title">// blog.php</h1>
                <p>Artículos sobre desarrollo web, bases de datos y despliegue.</p>
                <div style="text-align: right; margin-top: 1rem;">
                    <a href="add_post.php" class="btn btn-outline"><i class="fas fa-plus-circle"></i> Nuevo post</a>
                </div>
            </div>
        </section>

        <section class="all-posts">
            <div class="container">
                <div class="posts-grid">
                    <?php
                    $posts = getPosts($pdo);
                    if (count($posts) == 0):
                    ?>
                        <p>No hay posts todavía. ¡Sé el primero en escribir uno!</p>
                    <?php else: ?>
                        <?php foreach($posts as $post): ?>
                        <article class="post-card">
                            <h3><?= htmlspecialchars($post['title']) ?></h3>
                            <div class="post-meta">
                                <i class="far fa-calendar-alt"></i> <?= date('d/m/Y', strtotime($post['created_at'])) ?>
                            </div>
                            <p><?= substr(htmlspecialchars($post['content']), 0, 150) ?>...</p>
                            <a href="post.php?id=<?= $post['id'] ?>" class="read-more">Leer más →</a>
                        </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
