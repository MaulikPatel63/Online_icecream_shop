<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
    // header('location:login.php');
}

$id = $_GET['id'];

include 'components/add_wishlist.php';
include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - product detaii page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css?=<?php echo time(); ?>">

    <!-- font awesome Cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- box icon cdn link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>

    <?php include 'components/user_header.php'; ?>


    <div class="banner">
        <div class="detail">
            <h1>product detaii</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br>
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
            <span>
                <a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>product detaii
            </span>
        </div>
    </div>

    <section class="view_page">
        <div class="heading">
            <h1>product detail</h1>
            <img src="image/separator-img.png">
        </div>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_products->execute([$id]);
            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {

        ?>
                    <form action="" method="post" class="box">
                        <div class="img-box">
                            <img src="uploaded_files/<?= $fetch_products['image']; ?>">
                        </div>
                        <div class="detail">
                            <?php if ($fetch_products['stock'] > 9) { ?>
                                <span class="stock" style="color: green;">In stock</span>
                            <?php } elseif ($fetch_products['stock'] == 0) { ?>
                                <span class="stock" style="color: red;">Out Of stock</span>
                            <?php } else { ?>
                                <span class="stock" style="color: red;">Hurry, only <?= $fetch_products['stock']; ?> left</span>
                            <?php } ?>
                            <p class="price">price ₹<?= $fetch_products['price']; ?> /-</p>
                            <div class="name"><?= $fetch_products['name']; ?></div>
                            <p class="product-detail"><?= $fetch_products['product_detail']; ?></p>
                            <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                            <div class="button">
                                <button type="submit" name="add_to_wishlist" class="btn">add to wishlist <i class="bx bx-heart"></i></button>
                                <input type="hidden" name="qty" value="1" min="1" class="quantity">
                                <button type="submit" name="add_to_cart" class="btn">add to cart <i class="bx bx-cart"></i></button>
                            </div>
                        </div>
                    </form>

        <?php
                }
            }
        } else {
            echo '<div class="empty">
                        <p>no products added yet!</p>
                    </div>';
        }
        ?>
    </section>
    <div class="products">
        <div class="heading">
            <h1>similar products</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
            <img src="image/separator-img.png">
        </div>
        <?php include 'components/shop.php'; ?>
    </div>




    <?php include 'components/footer.php'; ?>

    <!-- sweetalert cdn link -->
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">
    </script>

    <!-- custom js -->
    <script src="js/user_script.js"></script>

    <?php include 'components/alert.php'; ?>

</body>

</html>