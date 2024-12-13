-- Création de la base de données
CREATE DATABASE IF NOT EXISTS package_manager CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE package_manager;

-- Table authors
CREATE TABLE IF NOT EXISTS authors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    bio TEXT
);

-- Table packages
CREATE TABLE IF NOT EXISTS packages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    author_id INT NOT NULL,
    FOREIGN KEY (author_id) REFERENCES authors(id) ON DELETE CASCADE
);

-- Table versions
CREATE TABLE IF NOT EXISTS versions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    version_number VARCHAR(50) NOT NULL,
    package_id INT NOT NULL,
    FOREIGN KEY (package_id) REFERENCES packages(id) ON DELETE CASCADE
);

-- Insertion de quelques données pour tester
INSERT INTO authors (name, email, bio) VALUES 
('John Doe', 'john@example.com', 'Expert en développement de logiciels'),
('Jane Smith', 'jane@example.com', 'Spécialiste des bases de données');

INSERT INTO packages (name, description, author_id) VALUES 
('Package A', 'Description for Package A', 1),
('Package B', 'Description for Package B', 2);

INSERT INTO versions (version_number, package_id) VALUES 
('1.0.0', 1),
('1.1.0', 1),
('2.0.0', 2);

-- Obtenir les informations des packets
SELECT 
   p.id,
   p.name,
   p.description,
   a.name AS author,
   a.email AS email,
   GROUP_CONCAT(DISTINCT v.version_number ORDER BY v.version_number) AS versions FROM packages p
   LEFT JOIN authors a ON p.author_id = a.id
   LEFT JOIN versions v ON p.id = v.package_id
   GROUP BY p.id, p.name, p.description, a.name