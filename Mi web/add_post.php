<?php
include 'config.php';

// Autenticación básica (para evitar que cualquiera añada posts)
$valid_user = 'admin';
$valid_pass = 'daw2025';  // Cambia esto por una contraseña segura

if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] != $valid_user || $_SERVER['PHP_AUTH_PW'] != $valid_pass) {
    header('WWW-Authenticate: Basic realm="Acceso restringido"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Acceso denegado.';
    exit;
}

$mensaje = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if (empty($title) || empty($content)) {
        $error = "El título y el contenido son obligatorios.";
    } else {
        if (addPost($pdo, $title, $content)) {
            $mensaje = "Post creado correctamente. <a href='blog.php'>Ver blog</a>";
        } else {
            $error = "Error al guardar el post.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Post | Admin</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <main>
        <section class="page-header">
            <div class="container">
                <h1 class="section-title">// add_post.php</h1>
                <p>Crear una nueva entrada en el blog.</p>
            </div>
        </section>

        <section class="contact-form-section">
            <div class="container">
                <div class="contact-container">
                    <div class="contact-form" style="flex: 1;">
                        <?php if ($mensaje): ?>
                            <div class="alert success"><?= $mensaje ?></div>
                        <?php elseif ($error): ?>
                            <div class="alert error"><?= $error ?></div>
                        <?php endif; ?>
                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="text" name="title" placeholder="Título del post" required>
                            </div>
                            <div class="form-group">
                                <textarea name="content" rows="8" placeholder="Contenido del post (puedes usar saltos de línea)" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar post</button>
                        </form>
                        <div style="margin-top: 1rem;">
                            <a href="blog.php" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Volver al blog</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
