
CREATE DATABASE IF NOT EXISTS foody;
USE foody;

CREATE TABLE users (

    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('client', 'chef') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);


CREATE TABLE menus (

    id INT AUTO_INCREMENT PRIMARY KEY,
    chef_id INT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (chef_id) REFERENCES users(id) ON DELETE CASCADE

);


CREATE TABLE dishes (

    id INT AUTO_INCREMENT PRIMARY KEY,
    menu_id INT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (menu_id) REFERENCES menus(id) ON DELETE CASCADE

);


CREATE TABLE reservations (

    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    chef_id INT,
    menu_id INT,
    reservation_date DATE NOT NULL,
    reservation_time TIME NOT NULL,
    num_people INT NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (chef_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_id) REFERENCES menus(id) ON DELETE CASCADE

);

CREATE TABLE reservation_history (
    
    id INT AUTO_INCREMENT PRIMARY KEY,
    reservation_id INT,
    status ENUM('pending', 'confirmed', 'cancelled'),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (reservation_id) REFERENCES reservations(id) ON DELETE CASCADE
    
);


CREATE TABLE statistics (

    id INT AUTO_INCREMENT PRIMARY KEY,
    chef_id INT,
    date DATE NOT NULL,
    total_reservations INT DEFAULT 0,
    confirmed_reservations INT DEFAULT 0,
    pending_reservations INT DEFAULT 0,
    cancelled_reservations INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (chef_id) REFERENCES users(id) ON DELETE CASCADE
    
);


CREATE TABLE archived_dishes (

    id INT AUTO_INCREMENT PRIMARY KEY,
    dish_id INT,
    archived_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (dish_id) REFERENCES dishes(id) ON DELETE CASCADE

);

