<?php
$db_name = 'mysql:host=localhost;dbname=icecream_db';
$user_name = 'root';
$user_password = '';
$conn = new PDO($db_name, $user_name, $user_password);

if (!$conn) {
    echo "Not Connecting to server";
}

if ($conn) {
    $cartTableCheck = $conn->query("SHOW TABLES LIKE 'cart'");
    $messageTableCheck = $conn->query("SHOW TABLES LIKE 'message'");
    $ordersTableCheck = $conn->query("SHOW TABLES LIKE 'orders'");
    $productsTableCheck = $conn->query("SHOW TABLES LIKE 'products'");
    $sellersTableCheck = $conn->query("SHOW TABLES LIKE 'sellers'");
    $usersTableCheck = $conn->query("SHOW TABLES LIKE 'users'");
    $wishlistTableCheck = $conn->query("SHOW TABLES LIKE 'wishlist'");
    if ($cartTableCheck->rowCount() == 0) {
        $cartTablecreate = $conn->exec("
                CREATE TABLE `cart` (
                    `cart_id` INT AUTO_INCREMENT PRIMARY KEY,
                    `id` varchar(20) NOT NULL,
                    `user_id` varchar(20) NOT NULL,
                    `product_id` varchar(20) NOT NULL,
                    `price` int(50) NOT NULL,
                    `qty` varchar(20) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
            ");
        if ($cartTablecreate === false) {
            echo "Error creating table 'cart'.";
        }
    }
    if ($messageTableCheck->rowCount() == 0) {
        $messageTablecreate = $conn->exec("
               CREATE TABLE `message` (
                `message_id` INT AUTO_INCREMENT PRIMARY KEY,
                `id` varchar(20) NOT NULL,
                `user_id` varchar(20) NOT NULL,
                `name` varchar(100) NOT NULL,
                `email` varchar(100) NOT NULL,
                `subject` varchar(100) NOT NULL,
                `message` varchar(1000) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
            ");
        if ($messageTablecreate === false) {
            echo "Error creating table 'message'.";
        }
    }
    if ($ordersTableCheck->rowCount() == 0) {
        $ordersTablecreate = $conn->exec("
               CREATE TABLE `orders` (
                `orders_id` INT AUTO_INCREMENT PRIMARY KEY,
                `id` varchar(20) NOT NULL,
                `user_id` varchar(20) NOT NULL,
                `seller_id` varchar(20) NOT NULL,
                `name` varchar(50) NOT NULL,
                `number` varchar(10) NOT NULL,
                `email` varchar(50) NOT NULL,
                `address` varchar(200) NOT NULL,
                `address_type` varchar(10) NOT NULL,
                `method` varchar(50) NOT NULL,
                `product_id` varchar(20) NOT NULL,
                `price` int(10) NOT NULL,
                `qty` int(2) NOT NULL,
                `dates` date NOT NULL DEFAULT current_timestamp(),
                `status` varchar(50) NOT NULL DEFAULT 'in progress',
                `payment_status` varchar(100) NOT NULL DEFAULT 'pending'
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
            ");
        if ($ordersTablecreate === false) {
            echo "Error creating table 'orders'.";
        }
    }
    if ($productsTableCheck->rowCount() == 0) {
        $productsTablecreate = $conn->exec("    
                CREATE TABLE `products` (
                `products_id` INT AUTO_INCREMENT PRIMARY KEY,
                `id` varchar(20) NOT NULL,
                `seller_id` varchar(20) NOT NULL,
                `name` varchar(100) NOT NULL,
                `price` int(10) NOT NULL,
                `image` varchar(100) NOT NULL,
                `stock` int(100) NOT NULL,
                `product_detail` varchar(1000) NOT NULL,
                `status` varchar(100) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
            ");
        if ($productsTablecreate === false) {
            echo "Error creating table 'products'.";
        }
    }
    if ($sellersTableCheck->rowCount() == 0) {
        $sellersTablecreate = $conn->exec("     
                CREATE TABLE `sellers` (
                `sellers_id` INT AUTO_INCREMENT PRIMARY KEY,
                `id` varchar(20) NOT NULL,
                `name` varchar(50) NOT NULL,
                `email` varchar(50) NOT NULL,
                `password` varchar(50) NOT NULL,
                `image` varchar(100) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
            ");
        if ($sellersTablecreate === false) {
            echo "Error creating table 'sellers'.";
        }
    }
    if ($usersTableCheck->rowCount() == 0) {
        $usersTablecreate = $conn->exec("   
                CREATE TABLE `users` (
                    `users_id` INT AUTO_INCREMENT PRIMARY KEY,
                `id` varchar(20) NOT NULL,
                `name` varchar(50) NOT NULL,
                `email` varchar(50) NOT NULL,
                `password` varchar(50) NOT NULL,
                `image` varchar(100) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
            ");
        if ($usersTablecreate === false) {
            echo "Error creating table 'users'.";
        }
    }
    if ($wishlistTableCheck->rowCount() == 0) {
        $wishlistTablecreate = $conn->exec("   
                CREATE TABLE `wishlist` (
                    `wishlist_id` INT AUTO_INCREMENT PRIMARY KEY,
                `id` varchar(20) NOT NULL,
                `user_id` varchar(20) NOT NULL,
                `product_id` varchar(20) NOT NULL,
                `price` int(100) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
            ");
        if ($wishlistTablecreate === false) {
            echo "Error creating table 'wishlist'.";
        }
    }
}

function unique_id()
{
    $chars = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strlen($chars);
    $randomString = '';

    for ($i = 0; $i < 20; $i++) {
        $randomString .= $chars[mt_rand(0, $charLength - 1)];
    }

    return $randomString;
}
