CREATE DATABASE IF NOT EXISTS project2_db;
USE project2_db;

-- eoi table
CREATE TABLE IF NOT EXISTS eoi (
    EOInumber INT AUTO_INCREMENT PRIMARY KEY,
    job_reference VARCHAR(10) NOT NULL,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender VARCHAR(10) NOT NULL,
    street_address VARCHAR(40) NOT NULL,
    suburb_town VARCHAR(40) NOT NULL,
    state VARCHAR(3) NOT NULL,
    postcode CHAR(4) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone_number VARCHAR(12) NOT NULL,
    skill1 VARCHAR(50),
    skill2 VARCHAR(50),
    skill3 VARCHAR(50),
    skill4 VARCHAR(50),
    skill5 VARCHAR(50),
    skill6 VARCHAR(50),
    skill7 VARCHAR(50),
    skill8 VARCHAR(50),
    skill9 VARCHAR(50),
    skill10 VARCHAR(50),
    skill11 VARCHAR(50),
    skill12 VARCHAR(50),
    skill13 VARCHAR(50),
    skill14 VARCHAR(50),
    skill15 VARCHAR(50),
    skill16 VARCHAR(50),
    other_skills TEXT,
    status ENUM('New', 'Current', 'Final') DEFAULT 'New',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- jobs table
CREATE TABLE IF NOT EXISTS jobs (
    job_id INT AUTO_INCREMENT PRIMARY KEY,
    job_reference_number VARCHAR(10) NOT NULL UNIQUE,
    job_title VARCHAR(100) NOT NULL,
    reports_to VARCHAR(100),
    salary_range VARCHAR(100),
    position_description TEXT NOT NULL,
    key_responsibilities TEXT NOT NULL,
    required_qualifications TEXT NOT NULL,
    essential_skills TEXT NOT NULL,
    preferable_skills TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- hr_users table (fixed)
CREATE TABLE IF NOT EXISTS hr_user (
  hr_user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  hrname VARCHAR(100) NOT NULL UNIQUE,
  hrpassword VARCHAR(255) NOT NULL,
  failed_attempts INT NOT NULL DEFAULT 0,
  locked_until DATETIME NULL,
  last_login DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- insert HR data
INSERT INTO hr_user (hrname, hrpassword, failed_attempts) VALUES
('Duy Anh', '$2y$10$Pj68p6Bahfxeo31sIkwxzOP2R4cS3WiLI.Ag/E.38YGYQO2CyuYW2', 0),
('Phuoc', '$2y$10$aacNGfaUWDw6vRWDj4TVhOszDWhZpvBKH0Q4Kmz4V0VBcu8z8/B02', 0),
('Khaibatau', '$2y$10$xXPv7ADjjkKMUCvoFnDaNu8atBy/w4//sxz0NR.eh3XzsOpqsBLMC', 0),
('Quan', '$2y$10$CtXdAqRbXzhuqhVMoVKb/OY/p8WcCAetvmMNRqTTREPiQ37ghy1bG', 0);

-- users table
CREATE TABLE IF NOT EXISTS user (
  user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  userpassword VARCHAR(255) NOT NULL,
  failed_attempts INT NOT NULL DEFAULT 0,
  locked_until DATETIME NULL,
  last_login DATETIME NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
