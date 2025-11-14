
-- remove the comment markers to create the database and tables in local MySQL server phpmyadmin`
CREATE DATABASE IF NOT EXISTS project2_db;
USE project2_db;

--Creating eoi table
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
    -- 16 skill fields for all checkbox options
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


--Creating jobs table
    CREATE TABLE IF NOT EXISTS jobs (
    job_id INT AUTO_INCREMENT PRIMARY KEY,
    job_reference_number VARCHAR(10) NOT NULL UNIQUE,    -- e.g. CLD01, SEC02, FED03
    job_title VARCHAR(100) NOT NULL,                     -- e.g. Cloud Engineer
    reports_to VARCHAR(100),                             -- e.g. Lead Cloud Architect
    salary_range VARCHAR(100),                           -- e.g. $90,000 – $115,000 per annum
    position_description TEXT NOT NULL,                  -- full paragraph describing the job
    key_responsibilities TEXT NOT NULL,                  -- list of responsibilities
    required_qualifications TEXT NOT NULL,               -- general qualification overview
    essential_skills TEXT NOT NULL,                      -- list of essential skills
    preferable_skills TEXT,                              -- list of preferable skills
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserting job listings into jobs table

INSERT INTO jobs (
    job_reference_number, job_title, reports_to, salary_range, position_description,
    key_responsibilities, required_qualifications, essential_skills, preferable_skills
)
VALUES
-- Cloud Engineer
('CLD01', 'Cloud Engineer', 'Lead Cloud Architect', '$90,000 – $115,000 per annum',
 'Designs, deploys, and manages scalable cloud infrastructure using AWS and Azure.',
 'Build and maintain cloud infrastructure; automate deployments; collaborate with developers; ensure compliance with security standards.',
 'Bachelor’s degree in IT, Computer Science, or related discipline; 2+ years’ experience with cloud platforms.',
 'AWS, Azure, Google Cloud, Networking, Virtualization, Linux, CI/CD pipelines.',
 'AWS Solutions Architect certification, Docker, Kubernetes, Python scripting.'),

-- Cybersecurity Analyst
('SEC02', 'Cybersecurity Analyst', 'Security Operations Manager', '$88,000 – $121,000 per year',
 'Monitors and responds to potential threats using SIEM tools and vulnerability assessments.',
 'Monitor system logs; respond to incidents; conduct vulnerability scans; collaborate with IT teams.',
 'Bachelor’s degree in Cybersecurity or IT; strong knowledge of network security and firewalls; 2+ years’ experience.',
 'Network Security, IDS/IPS, SIEM Tools (Splunk, Wireshark, Nessus).',
 'Security+, CEH, or CISSP certifications; experience with cloud security and compliance frameworks.'),

-- Front-End Developer
('FED03', 'Front-End Developer', 'UI/UX Lead Designer', '$80,000 – $105,000 per year',
 'Designs and maintains responsive web interfaces ensuring accessibility and performance.',
 'Develop UI using HTML5, CSS3, JavaScript; ensure accessibility and browser compatibility; collaborate with designers.',
 'Bachelor’s degree in Computer Science or related; strong proficiency in HTML, CSS, JavaScript; experience with responsive design.',
 'HTML, CSS, JavaScript, Responsive Design, REST APIs, Git.',
 'React, Vue.js, Angular, SASS/LESS, Webpack, Accessibility best practices.');

-- Start of hr_users table from hr_users.sql
START TRANSACTION;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

 -- Creating hr_users table
 CREATE TABLE IF NOT EXISTS `hr_users` (
  `hr_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `failed_attempt` int(11) NOT NULL DEFAULT 0
)

-- Dumping data for table `hr_users`
INSERT INTO `hr_users` (`hr_id`, `username`, `password`, `failed_attempt`) VALUES
(1, 'Duy Anh', '$2y$10$Pj68p6Bahfxeo31sIkwxzOP2R4cS3WiLI.Ag/E.38YGYQO2CyuYW2', 0),
(2, 'Phuoc', '$2y$10$aacNGfaUWDw6vRWDj4TVhOszDWhZpvBKH0Q4Kmz4V0VBcu8z8/B02', 0),
(3, 'Khaibatau', '$2y$10$xXPv7ADjjkKMUCvoFnDaNu8atBy/w4//sxz0NR.eh3XzsOpqsBLMC', 0),
(4, 'Quan', '$2y$10$CtXdAqRbXzhuqhVMoVKb/OY/p8WcCAetvmMNRqTTREPiQ37ghy1bG', 0);

-- Indexes for table `hr_users`
ALTER TABLE `hr_users`
  ADD PRIMARY KEY (`hr_id`),
  ADD UNIQUE KEY `username` (`username`);

-- AUTO_INCREMENT for table `hr_users`
ALTER TABLE `hr_users`
  MODIFY `hr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

CREATE TABLE IF NOT EXISTS user (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  userpassword VARCHAR(255) NOT NULL,
  DATETIME last_login, -- Timestamp of last login
  DATETIME data_created DEFAULT CURRENT_TIMESTAMP -- Timestamp of account creation
)