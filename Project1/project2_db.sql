CREATE DATABASE project2_db;
USE project2_db;

CREATE TABLE eoi (
    eoi_id INT AUTO_INCREMENT PRIMARY KEY,
    job_reference_number VARCHAR(10) NOT NULL,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    street_address VARCHAR(40) NOT NULL,
    suburb VARCHAR(40) NOT NULL,
    state ENUM('VIC','NSW','QLD','NT','WA','SA','TAS','ACT') NOT NULL,
    postcode CHAR(4) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(12) NOT NULL,
    skill1 BOOLEAN DEFAULT 0,
    skill2 BOOLEAN DEFAULT 0,
    skill3 BOOLEAN DEFAULT 0,
    skill4 BOOLEAN DEFAULT 0,
    skill5 BOOLEAN DEFAULT 0,
    skill6 BOOLEAN DEFAULT 0,
    skill7 BOOLEAN DEFAULT 0,
    skill8 BOOLEAN DEFAULT 0,
    skill9 BOOLEAN DEFAULT 0,
    skill10 BOOLEAN DEFAULT 0,
    skill11 BOOLEAN DEFAULT 0,
    skill12 BOOLEAN DEFAULT 0,
    skill13 BOOLEAN DEFAULT 0,
    skill14 BOOLEAN DEFAULT 0,
    skill15 BOOLEAN DEFAULT 0,
    skill16 BOOLEAN DEFAULT 0,
    other_skills TEXT,
    status ENUM('New','Current','Final') DEFAULT 'New'
);

CREATE TABLE jobs (
    job_id INT AUTO_INCREMENT PRIMARY KEY,
    job_reference_number VARCHAR(10) NOT NULL UNIQUE,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    salary_range VARCHAR(50),
    location VARCHAR(100),
    employment_type ENUM('Full-time','Part-time','Casual','Contract'),
    closing_date DATE
);