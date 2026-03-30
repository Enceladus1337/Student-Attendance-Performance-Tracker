-- CREATE DATABASE
CREATE DATABASE attendance_tracker;
USE attendance_tracker;

-- USERS TABLE
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    email VARCHAR(50),
    password VARCHAR(50),
    role VARCHAR(20)
);

-- SUBJECTS TABLE
CREATE TABLE subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(50)
);

-- MARKS TABLE
CREATE TABLE marks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    subject_id INT,
    marks INT
);

-- ATTENDANCE TABLE
CREATE TABLE attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    subject_id INT,
    date DATE,
    status VARCHAR(10)
);

-- INSERT USERS
INSERT INTO users (name, email, password, role) VALUES
('Adnan', 'adnan@email.com', '1234', 'student'),
('Rahul', 'rahul@email.com', '1234', 'student'),
('Aman', 'aman@email.com', '1234', 'student'),
('Sara', 'sara@email.com', '1234', 'student'),
('Teacher User', 'teacher@email.com', '1234', 'teacher'),
('Admin User', 'admin@email.com', '1234', 'admin');

-- INSERT SUBJECTS
INSERT INTO subjects (subject_name) VALUES
('Math'),
('Science'),
('English'),
('Computer');

-- INSERT MARKS
INSERT INTO marks (student_id, subject_id, marks) VALUES
(1,1,85),
(1,2,78),
(2,1,90),
(3,3,88),
(4,4,92);

-- INSERT ATTENDANCE
INSERT INTO attendance (student_id, subject_id, date, status) VALUES
(1,1,'2026-03-25','Present'),
(1,2,'2026-03-26','Absent'),
(2,1,'2026-03-25','Present'),
(3,3,'2026-03-26','Present'),
(4,4,'2026-03-27','Absent');