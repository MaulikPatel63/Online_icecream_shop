<?php
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('location:login.php');
}

//update product
if (isset($_POST['update'])) {
    $product_id = $_POST['product_id'];
    $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $description = $_POST['description'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);

    $stock = $_POST['stock'];
    $stock = filter_var($stock, FILTER_SANITIZE_STRING);

    $status = $_POST['status'];
    $status = filter_var($status, FILTER_SANITIZE_STRING);

    $update_product = $conn->prepare("UPDATE `products` SET name = ?, price = ?, product_detail = ?, stock = ?, status = ? WHERE id = ?");
    $update_product->execute([$name, $price, $description, $stock, $status, $product_id]);


    $success_msg[] = 'Product update successfully';

    $old_image = $_POST['old_image'];
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $image;

    $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ? AND seller_id = ?");
    $select_image->execute([$image, $seller_id]);

    if (!empty($image)) {
        if ($image_size > 2000000) {
            $warning_msg[] = 'image size is to large';
        } elseif ($select_image->rowCount() > 0) {
            $warning_msg[] = 'please rename your image';
        } else {
            $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
            $update_image->execute([$image, $product_id]);
            move_upLoaded_fiLe($image_tmp_name, $image_folder);

            if ($old_image != $image & $old_image != '') {
                unlink('../uploaded_files/' . $old_image);
            }
            $success_msg[] = 'image updated!';
        }
    }
}

//delete product image
if (isset($_POST['delete_image'])) {
    $empty_image = '';
    $product_id = $_POST['product_id'];
    $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);

    $delete_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $delete_image->execute([$product_id]);

    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
    if ($fetch_delete_image['image'] != '') {
        unlink('../uploaded_files/' . $fetch_delete_image['image']);
    }

    $upset_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
    $upset_image->execute([$empty_image, $product_id]);
    $success_msg[] = 'Product image deleted successfully!';
}


//delete product
if (isset($_POST['delete_product'])) {

    $product_id = $_POST['product_id'];
    $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);

    $delete_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $delete_image->execute([$product_id]);

    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
    if ($fetch_delete_image['image'] != '') {
        unlink('../uploaded_files/' . $fetch_delete_image['image']);
    }

    $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_product->execute([$product_id]);

    $success_msg[] = 'Product deleted successfully!';

    header('location:view_products.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blue Sky Summer - edit product page</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">

    <!-- font awesome Cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- box icon cdn link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>

    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>

        <section class="post-editor">
            <div class="heading">
                <h1>edit product</h1>
                <img src="../image/separator-img.png">
            </div>

            <div class="box-container">

                <?php

                $product_id = $_GET['id'];
                $select_product = $conn->prepare("SELECT * FROM `products` WHERE id =? AND seller_id = ?");
                $select_product->execute([$product_id, $seller_id]);
                if ($select_product->rowCount() > 0) {
                    while ($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {
                ?>

                        <div class="form-container">
                            <form action="" method="post" enctype="multipart/form-data" class="register">
                                <input type="hidden" name="old_image" value="<?= $fetch_product['image']; ?>">
                                <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">

                                <div class="input-field">
                                    <p>product status <span>*</span></p>
                                    <select name="status" class="box">
                                        <option value="<?= $fetch_product['status']; ?>" selected><?= $fetch_product['status']; ?></option>
                                        <option value="active">active</option>
                                        <option value="deactive">deactive</option>
                                    </select>
                                </div>

                                <div class="input-field">
                                    <p>product name <span>*</span></p>
                                    <input type="text" name="name" value="<?= $fetch_product['name']; ?>" maxlength="100" placeholder="Add product name" class="box">
                                </div>

                                <div class="input-field">
                                    <p>product price <span>*</span></p>
                                    <input type="number" name="price" value="<?= $fetch_product['price']; ?>" maxlength="100" placeholder="Add product price" class="box">
                                </div>

                                <div class="input-field">
                                    <p>product detail <span>*</span></p>
                                    <textarea name="description" maxlength="1000" placeholder="Add product detail" class="box"><?= $fetch_product['product_detail']; ?></textarea>
                                </div>

                                <div class="input-field">
                                    <p>product stock <span>*</span></p>
                                    <input type="number" name="stock" value="<?= $fetch_product['stock']; ?>" maxlength="10" min="0" max="9999999999" placeholder="Add product stock" class="box">
                                </div>

                                <div class="input-field">
                                    <p>product image <span>*</span></p>
                                    <input type="file" name="image" accept="image/*" class="box">

                                    <?php if ($fetch_product['image'] != '') { ?>

                                        <img src="../uploaded_files/<?= $fetch_product['image']; ?>" class="image">

                                        <div class="flex-btn">
                                            <input class="btn" type="submit" name="delete_image" value="delete image">
                                            <a href="view_products.php" class="btn" style="width: 49%; text-align:center; height: 3rem; margin-top: 0.7rem;">go back</a>
                                        </div>

                                    <?php } ?>
                                </div>

                                <!-- <br><br> -->
                                <div class="flex-btn">
                                    <input type="submit" name="update" value="update product" class="btn">
                                    <input type="submit" name="delete_product" value="delete product" class="btn">

                                    <!-- <a href="view_products.php" class="btn">view product</a>
                                    <a href="add_products.php" class="btn">add product</a> -->
                                </div>

                            </form>
                        </div>

                    <?php

                    }
                } else {
                    echo '
                    <div class="empty">
                        <p>no products added yet!</p>
                    </div>';

                    ?>

                    <br><br>
                    <div class="flex-btn">

                        <a href="view_products.php" class="btn">view product</a>
                        <a href="add_products.php" class="btn">add product</a>
                    </div>
                <?php } ?>
            </div>

        </section>
    </div>







    <!-- sweetalert cdn link -->
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js -->
    <script src="../js/admin_script.js"></script>

    <?php include '../components/alert.php'; ?>
</body>

</html>