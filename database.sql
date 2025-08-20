CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    project_type ENUM('image', 'gradient') NOT NULL,
    image_path VARCHAR(255),
    gradient_start VARCHAR(7),
    gradient_end VARCHAR(7),
    svg_code TEXT,
    live_link VARCHAR(255) NOT NULL,
    has_linkedin BOOLEAN DEFAULT FALSE,
    linkedin_link VARCHAR(255),
    has_github BOOLEAN DEFAULT FALSE,
    github_link VARCHAR(255),
    has_download BOOLEAN DEFAULT FALSE,
    download_link VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
