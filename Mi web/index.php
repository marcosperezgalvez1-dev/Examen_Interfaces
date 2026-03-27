<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcos Pérez | Dev Portfolio</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <main>
        <section class="hero">
            <div class="container">
                <div class="terminal-avatar">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <div class="badge">
                    <i class="fas fa-code"></i> Estudiante DAW · Full Stack en formación
                </div>
                <h1>
                    <span>>_ Hola, soy Marcos Pérez</span><span class="cursor">_</span>
                </h1>
                <p class="tagline">// Desarrollador web con pasión por PHP, JavaScript, SQL y despliegue de aplicaciones.<br>
                Este es mi espacio personal donde comparto código, ideas y proyectos.</p>
                <div class="cta-buttons">
                    <a href="blog.php" class="btn btn-primary"><i class="fas fa-blog"></i> ver_blog()</a>
                    <a href="contact.php" class="btn btn-outline"><i class="fas fa-paper-plane"></i> contactar()</a>
                </div>
            </div>
        </section>

        <section class="recent-posts">
            <div class="container">
                <h2 class="section-title">// Últimas entradas del blog</h2>
                <div class="posts-grid">
                    <?php
                    $posts = getPosts($pdo);
                    $recent = array_slice($posts, 0, 3);
                    foreach($recent as $post):
                    ?>
                    <article class="post-card">
                        <h3><?= htmlspecialchars($post['title']) ?></h3>
                        <div class="post-meta">
                            <i class="far fa-calendar-alt"></i> <?= date('d/m/Y', strtotime($post['created_at'])) ?>
                        </div>
                        <p><?= substr(htmlspecialchars($post['content']), 0, 120) ?>...</p>
                        <a href="post.php?id=<?= $post['id'] ?>" class="read-more">Leer más →</a>
                    </article>
                    <?php endforeach; ?>
                </div>
                <div class="text-center" style="margin-top: 2rem;">
                    <a href="blog.php" class="btn btn-outline">Ver todas las entradas <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
