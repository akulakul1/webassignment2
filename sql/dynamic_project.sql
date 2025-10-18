DROP DATABASE IF EXISTS dynamic_project;
CREATE DATABASE dynamic_project CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE dynamic_project;

CREATE TABLE students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  course VARCHAR(100) NOT NULL,
  dob DATE DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO students (name, email, course, dob) VALUES
('Asha Kumar','asha@example.com','Computer Science','2000-05-12'),
('Rohit Menon','rohit@example.com','Electronics','1999-08-21');