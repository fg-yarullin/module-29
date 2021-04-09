<?php

try {
    $pdo = new PDO('mysql:host=localhost;charset=utf8', 'homestead', 'secret');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "CREATE DATABASE IF NOT EXISTS `sfornio_db`
            DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;" ;

    $pdo->exec($query);

    $query = "CREATE TABLE IF NOT EXISTS `sfornio_db`.`joke` (
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `joketext` TEXT,
        `jokedate` DATE NOT NULL,
        `user_id` INT UNSIGNED
        ) ENGINE=INNODB;";
    
    $pdo->exec($query);

    $query = "INSERT INTO `sfornio_db`.`joke` 
    (`joketext`, `jokedate`, `user_id`) VALUES
    ('Why was the empty array stuck outside? It didn\'t have any keys', '2017-04-01', 1),
    ('!false - It\'s funny because it\'s true', '2017-04-01', 2);";

    $pdo->exec($query);

    $query = "CREATE TABLE IF NOT EXISTS `sfornio_db`.`user` (
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255) NOT NULL,
        `email` VARCHAR(255) NOT NULL UNIQUE,
        `password` VARCHAR(255) NOT NULL,
        `hash` VARCHAR(255) NOT NULL DEFAULT '',
        PRIMARY KEY (`id`)
    ) ENGINE=INNODB;";

    $pdo->exec($query);
    $password = 'password';
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO `sfornio_db`.`user` 
            SET
            `name` = 'user',
            `email` = 'user@mail.me',
            `password` = '{$password}'";
    $pdo->query($query);

    $query = "CREATE TABLE IF NOT EXISTS `sfornio_db`.`image` (
        `id` int unsigned NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `path` varchar(255) NOT NULL,
        `user_id` int unsigned NOT NULL,
        PRIMARY KEY (`id`),
        INDEX (`user_id`),
        FOREIGN KEY `user_own_image` (`user_id`) REFERENCES `sfornio_db`.`user`(`id`)
        ON UPDATE CASCADE ON DELETE CASCADE
      ) ENGINE=INNODB;";
    $pdo->query($query);

    $query = "CREATE TABLE IF NOT EXISTS `sfornio_db`.`comment` (
        `id` int unsigned NOT NULL AUTO_INCREMENT,
        `text` text NOT NULL,
        `date` date NOT NULL,
        `user_id` int unsigned NOT NULL,
        `image_id` int unsigned NOT NULL,
        PRIMARY KEY (`id`),
        INDEX (`user_id`, `image_id`),
        FOREIGN KEY `image_owner` (`user_id`) REFERENCES `sfornio_db`.`user`(`id`),
        FOREIGN KEY `comment_for_image` (`image_id`) REFERENCES `sfornio_db`.`image`(`id`)
        ON UPDATE CASCADE ON DELETE CASCADE
      ) ENGINE=INNODB;";
    $pdo->query($query);

    echo "SUCCESS";

} catch(PDOException $e) {
    // echo 'Database error: ' . $e->getMessage() . ' in '
    //     . $e->getFile() . ':' . $e->getLine();
    echo 'Database error: ' . $e->getMessage() . '<br>';
    echo 'Error code: ' . $e->errorInfo[1];
}