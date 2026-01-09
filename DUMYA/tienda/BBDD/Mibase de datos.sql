
SHOW TABLES;

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,xw
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
