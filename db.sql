CREATE DATABASE hostel;
USE hostel;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    course VARCHAR(50),
    room_no VARCHAR(10)
);