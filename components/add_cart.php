<?php

if (isset($_POST['add_to_cart'])) {
    if ($user_id != '') {

        $id = unique_id();
        $product_id = $_POST['product_id'];

        $qty = $_POST['qty'];
        $qty = filter_var($qty, FILTER_SANITIZE_STRING);

        $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
        $verify_cart->execute([$user_id, $product_id]);

        $max_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $max_cart_items->execute([$user_id]);


        if ($verify_cart->rowCount() > 0) {
            $warning_msg[] = 'poduct already exist in your cart';
        } else if ($max_cart_items->rowCount() > 3) {
            $warning_msg[] = 'your cart is full';
        } else if ($user_id != '') {
            $select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
            $select_price->execute([$product_id]);
            $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

            $insert_wishlist = $conn->prepare("INSERT INTO `cart` (id, user_id, product_id, price,qty) VALUES(?,?,?,?,?)");
            $insert_wishlist->execute([$id, $user_id, $product_id, $fetch_price['price'],$qty]);

            $success_msg[] = 'product added to your cart successfully';
        }
    } else {
        $warning_msg[] = 'please login first';
    }
}
