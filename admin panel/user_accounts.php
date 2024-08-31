<?php
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blue Sky Summer - registered users page</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">

    <!-- font awesome Cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- box icon cdn link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>

    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>

        <section class="user-container">
            <div class="heading">
                <h1>registered users</h1>
                <img src="../image/separator-img.png">
            </div>

            <div class="box-container">
                <?php
                $select_users = $conn->prepare("SELECT * FROM `users`");
                $select_users->execute();

                if ($select_users->rowCount() > 0) {
                    while ($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)) {
                        $users_id = $fetch_users['id'];

                ?>

                        <div class="box">
                            <img src="../uploaded_files/<?= $fetch_users['image']; ?>" class="image">
                            <p>user id : <span><?= $users_id; ?></span></p>
                            <p>user name : <span><?= $fetch_users['name']; ?></span></p>
                            <p>user email : <span><?= $fetch_users['email']; ?></span></p>
                        </div>



                <?php

                    }
                } else {
                    echo '
                    <div class="empty">
                        <p>no user placed yet!</p>
                    </div>';
                }
                ?>
            </div>

        </section>
    </div>


    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js -->
    <script src="../js/admin_script.js"></script>

    <?php include '../components/alert.php'; ?>
</body>

</html>