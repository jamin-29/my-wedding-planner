CREATE DATABASE IF NOT EXISTS wedding_planner;
USE wedding_planner;

-- Clients table
CREATE TABLE clients(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    phone VARCHAR(50)
);

-- Appointments table
CREATE TABLE appointments(
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    location VARCHAR(255),
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
);

-- Sample data
INSERT INTO clients(name,email,phone) VALUES('Alice Santos','alice@example.com','09123456789');
INSERT INTO appointments(client_id,date,time,location) VALUES(1,'2025-12-20','10:00:00','Beach');
