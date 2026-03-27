<?php include 'config.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$post = getPostById($pdo, $id);
if (!$post) {
    header('Location: blog.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post['title']) ?> | Blog</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <main>
        <section class="post-content">
            <div class="container">
                <article class="post-full">
                    <h1><?= htmlspecialchars($post['title']) ?></h1>
                    <div class="post-meta">
                        <i class="far fa-calendar-alt"></i> <?= date('d/m/Y H:i', strtotime($post['created_at'])) ?>
                    </div>
                    <div class="post-body">
                        <?= nl2br(htmlspecialchars($post['content'])) ?>
                    </div>
                    <a href="blog.php" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Volver al blog</a>
                </article>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
