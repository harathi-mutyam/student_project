CREATE DATABASE IF NOT EXISTS studentdb;
USE studentdb;

/* STUDENTS TABLE */
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100)
);

/* SUBJECTS (MARKS TABLE) */
CREATE TABLE subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    subject_name VARCHAR(100),
    marks INT,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

/* USERS TABLE (LOGIN SYSTEM) */
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','student') NOT NULL,
    student_id INT NULL,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

/* ATTENDANCE TABLE */
CREATE TABLE attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    attendance_date DATE,
    status ENUM('Present','Absent'),
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

/* ADMIN USER (IMPORTANT FIX: student_id must be NULL) */
INSERT INTO users(email, password, role, student_id)
VALUES (
    'admin@gmail.com',
    '$2y$10$KbQiQhK7Vx9M0LQ6YV4gW.r7B9QnV8Kx3N0X2R5gT5nQ2M8hK0w0S',
    'admin',
    NULL
);
