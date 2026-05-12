CREATE DATABASE IF NOT EXISTS studentdb;

USE studentdb;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100)
);
CREATE TABLE subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    subject_name VARCHAR(100),
    marks INT,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);
