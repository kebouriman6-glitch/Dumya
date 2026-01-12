-- Base de datos
CREATE DATABASE  dumya;
USE dumya;

-- Usuarios
CREATE TABLE  usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    correo VARCHAR(255) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    nombre VARCHAR(255) NOT NULL
);

-- Productos
CREATE TABLE  productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(6,2) NOT NULL,
    imagen VARCHAR(255) NOT NULL
);

INSERT INTO productos (nombre, precio, imagen) VALUES
('Polene Camel', 45.00, '1polenecamel.webp'),
('Polene Marrón', 55.00, '2poleneraiz.webp'),
('Polene Burgundy', 60.00, '3poleneburgundy.webp'),
('Polene Negro', 60.00, '4polenenegro.webp'),
('Polene Beige', 60.00, '5polenebeige.webp'),
('Polene Mokki Marrón', 70.00, '6polene.webp'),
('Polene Mokki Marrón Oscuro', 90.00, '7polene.webp'),
('Polene Mokki Beige', 90.00, '8polene.webp'),
('Polene Mokki Burgundy', 100.00, '9polene.webp'),
('Polene Mokki Gris', 100.00, '10polene.webp');

-- Pedidos
CREATE TABLE  pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    total DECIMAL(8,2) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Detalle de pedidos
CREATE TABLE  pedido_detalle (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio DECIMAL(6,2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);
