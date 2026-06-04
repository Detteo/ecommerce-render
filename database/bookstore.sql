CREATE DATABASE IF NOT EXISTS bookstore;
USE bookstore;

CREATE TABLE IF NOT EXISTS libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    genero VARCHAR(50) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    imagen VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    correo VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO libros (titulo, autor, genero, descripcion, precio, imagen) VALUES
-- SUSPENSO (3)
('it', 'Stephen King', 'Suspenso', 'En la ciudad de Derry, un grupo de niños enfrenta un terror que regresa cada 27 años con la forma de un payaso demoníaco llamado Pennywise.', 65000, 'it.jpg'),
('La Chica del Tren', 'Paula Hawkins', 'Suspenso', 'Rachel observa a diario una pareja perfecta desde el tren. Un día la mujer desaparece y Rachel se convierte en testigo clave de un caso oscuro.', 58000, 'chica-tren.jpg'),
('Gone Girl', 'Gillian Flynn', 'Suspenso', 'El día de su quinto aniversario, Amy Dunne desaparece. Su esposo Nick se convierte en el principal sospechoso en un caso lleno de mentiras.', 62000, 'gone-girl.jpg'),
-- FANTASÍA (3)
('Harry Potter y la Piedra Filosofal', 'J.K. Rowling', 'Fantasia', 'Un joven huérfano descubre que es un mago y comienza sus estudios en Hogwarts, la escuela de magia más famosa del mundo.', 75000, 'harry-potter.jpg'),
('El Señor de los Anillos', 'J.R.R. Tolkien', 'Fantasia', 'Frodo Bolsón emprende un épico viaje para destruir el Anillo Único y salvar la Tierra Media del oscuro señor Sauron.', 90000, 'senor-anillos.jpg'),
('El Nombre del Viento', 'Patrick Rothfuss', 'Fantasia', 'Kvothe, el músico y mago más legendario de su época, narra su propia historia desde sus humildes orígenes hasta su prodigiosa ascensión.', 72000, 'nombre-viento.jpg'),
-- ROMANCE (3)
('Orgullo y Prejuicio', 'Jane Austen', 'Romance', 'Elizabeth Bennet y el orgulloso Sr. Darcy chocan en cada encuentro, sin saber que el destino los ha unido de una manera que ninguno podría imaginar.', 55000, 'orgullo-prejuicio.jpg'),
('El Cuaderno', 'Nicholas Sparks', 'Romance', 'Noah y Allie se enamoran un verano, luego la guerra y las diferencias sociales los separan. Años después, su historia de amor vuelve a cobrar vida.', 60000, 'cuaderno.jpg'),
('Crepúsculo', 'Stephenie Meyer', 'Romance', 'Bella Swan se muda a Forks y conoce al misterioso Edward Cullen. Lo que comienza como atracción se convierte en un amor prohibido y peligroso.', 64000, 'crepusculo.jpg'),
-- ACCIÓN Y AVENTURA (3)
('El Código Da Vinci', 'Dan Brown', 'Accion y Aventura', 'El profesor Robert Langdon se ve envuelto en una conspiración centenaria al descubrir un código oculto en las obras de Leonardo Da Vinci.', 68000, 'codigo-davinci.jpg'),
('Jurassic Park', 'Michael Crichton', 'Accion y Aventura', 'Un multimillonario recrea dinosaurios con ADN fósil en una isla. Lo que iba a ser el parque del siglo se convierte en una pesadilla mortal.', 72000, 'jurassic-park.jpg'),
('El Alquimista', 'Paulo Coelho', 'Accion y Aventura', 'Santiago, un joven pastor andaluz, sigue sus sueños en busca de un tesoro escondido en Egipto y descubre que el verdadero tesoro está dentro de sí mismo.', 50000, 'alquimista.jpg'),
-- NOVELA (3)
('Cien Años de Soledad', 'Gabriel García Márquez', 'Novela', 'La saga de la familia Buendía a lo largo de siete generaciones en el mítico pueblo de Macondo, obra cumbre del realismo mágico latinoamericano.', 78000, 'cien-anos.jpg'),
('1984', 'George Orwell', 'Novela', 'En un futuro totalitario, Winston Smith trabaja en el Ministerio de la Verdad reescribiendo la historia. Su rebelión silenciosa lo llevará al límite.', 62000, '1984.jpg'),
('El Gran Gatsby', 'F. Scott Fitzgerald', 'Novela', 'En los años 20 en Nueva York, el misterioso millonario Jay Gatsby organiza fiestas legendarias con la esperanza de recuperar a su amor perdido, Daisy.', 57000, 'gran-gatsby.jpg');
