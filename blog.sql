CREATE DATABASE blog;

USE blog;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    comment TEXT NOT NULL,
    post_id INT,
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO users (email, password) VALUES ('user@example.com', 'password123');

INSERT INTO posts (title, content, user_id) VALUES ('First Post', 'This is the content of the first post.', 1);

INSERT INTO comments (comment, post_id, user_id) VALUES ('This is a comment on the first post.', 1, 1);

SELECT 
    u.id AS user_id,
    u.email AS user_email,
    p.id AS post_id,
    p.title AS post_title,
    p.content AS post_content,
    c.id AS comment_id,
    c.comment AS comment_content
FROM 
    users u
LEFT JOIN 
    posts p ON u.id = p.user_id
LEFT JOIN 
    comments c ON p.id = c.post_id AND u.id = c.user_id;
