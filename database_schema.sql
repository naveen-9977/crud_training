-- Create the database if it doesn't exist yet
CREATE DATABASE IF NOT EXISTS crud_training;
USE crud_training;

-- Create the 'students' table with all required columns
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Auto-generated unique ID
    name VARCHAR(100) NOT NULL,        -- Student name
    email VARCHAR(100) NOT NULL UNIQUE,-- Email must be unique
    mobile VARCHAR(20) NOT NULL,       -- Mobile number
    course VARCHAR(50) NOT NULL,       -- Course name
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Auto-save the date/time
);