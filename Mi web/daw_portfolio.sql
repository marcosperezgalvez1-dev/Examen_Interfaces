CREATE DATABASE IF NOT EXISTS daw_portfolio;
USE daw_portfolio;

-- Tabla para las entradas del blog
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla para los mensajes de contacto
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertar algunos posts de ejemplo
INSERT INTO posts (title, content) VALUES
('Primer post: Aprendiendo PHP', 'Este es mi primer artículo. Me encanta programar con PHP y MySQL. ¡El backend es fascinante!'),
('Despliegue de aplicaciones', 'Hoy aprendí a desplegar una web en un servidor Apache. Usé Docker y Nginx como proxy inverso.'),
('Optimización de consultas SQL', 'Las claves índices y las buenas prácticas hacen que las consultas vuelen. ¡No subestimes el poder de EXPLAIN!');
