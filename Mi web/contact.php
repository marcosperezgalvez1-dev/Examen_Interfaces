<?php include 'config.php';
$mensaje = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        $error = "Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El email no es válido.";
    } else {
        // Guardar en BD
        if (saveContact($pdo, $name, $email, $message)) {
            // Enviar email (sendmail)
            $to = "tuemail@ejemplo.com"; // Cambia por tu email real
            $subject = "Nuevo mensaje de contacto desde tu web";
            $body = "Has recibido un mensaje de:\n\nNombre: $name\nEmail: $email\n\nMensaje:\n$message";
            $headers = "From: $email\r\nReply-To: $email";
            
            if (mail($to, $subject, $body, $headers)) {
                $mensaje = "Mensaje enviado correctamente. Te responderé pronto.";
            } else {
                $mensaje = "Mensaje guardado en BD, pero falló el envío de email. Contacta con el administrador.";
            }
        } else {
            $error = "Error al guardar el mensaje. Intenta de nuevo.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto | Marcos Pérez</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <main>
        <section class="page-header">
            <div class="container">
                <h1 class="section-title">// contact.php</h1>
                <p>¿Tienes alguna pregunta o propuesta? Escríbeme.</p>
            </div>
        </section>

        <section class="contact-form-section">
            <div class="container">
                <div class="contact-container">
                    <div class="contact-info">
                        <h3><i class="fas fa-terminal"></i> $ conecta_conmigo</h3>
                        <p>Puedes contactarme por email o a través de este formulario. También estoy en redes.</p>
                        <div class="contact-details">
                            <p><i class="fas fa-envelope"></i> <code>marcosperezgalvez3@gmail.com</code></p>
                            <p><i class="fab fa-github"></i> <code>https://github.com/marcosperezgalvez1-dev</code></p>
                        </div>
                        <div class="social-links">
                            <a href="https://github.com/marcosperezgalvez1-dev"><i class="fab fa-github"></i></a>
                            <a href="www.linkedin.com/in/marcos-pérez-gálvez-1107583b9"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="contact-form">
                        <?php if ($mensaje): ?>
                            <div class="alert success"><?= $mensaje ?></div>
                        <?php elseif ($error): ?>
                            <div class="alert error"><?= $error ?></div>
                        <?php endif; ?>
                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="text" name="name" placeholder="$ nombre_usuario" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="$ email@dominio.com" required>
                            </div>
                            <div class="form-group">
                                <textarea name="message" rows="5" placeholder="// Escribe tu mensaje..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> enviar_mensaje()</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
