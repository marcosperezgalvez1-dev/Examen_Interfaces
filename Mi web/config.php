<?php
// config.php
$host = 'localhost';
$dbname = 'daw_portfolio';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Obtener todos los posts
function getPosts($pdo) {
    $stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Obtener un post por ID
function getPostById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Guardar mensaje de contacto
function saveContact($pdo, $name, $email, $message) {
    $stmt = $pdo->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    return $stmt->execute([$name, $email, $message]);
}

// Insertar nuevo post
function addPost($pdo, $title, $content) {
    $stmt = $pdo->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    return $stmt->execute([$title, $content]);
}
?>
