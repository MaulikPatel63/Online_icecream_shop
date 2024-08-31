<?php
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('location:login.php');
}

//delete message from database

if (isset($_POST['delete_msg'])) {

    $delete_id = $_POST['delete_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);


    $verify_delete = $conn->prepare("SELECT * FROM `message` WHERE id =?");
    $verify_delete->execute([$delete_id]);

    if ($verify_delete->rowCount() > 0) {
        $delete_msg = $conn->prepare("DELETE FROM `message` WHERE id =?");
        $delete_msg->execute([$delete_id]);

        $success_msg[] = 'message deleted successfully';
    } else {
        $warning_msg[] = 'message already deleted';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blue Sky Summer - message page</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">

    <!-- font awesome Cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- box icon cdn link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>

    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>

        <section class="message-container">
            <div class="heading">
                <h1>unread messages</h1>
                <img src="../image/separator-img.png">
            </div>

            <div class="box-container">
                <?php

                $select_message = $conn->prepare("SELECT * FROM `message`");
                $select_message->execute();
                if ($select_message->rowCount() > 0) {
                    while ($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)) {

                ?>

                        <div class="box">
                            <h3 class="name"><?= $fetch_message['name']; ?></h3>
                            <h4><?= $fetch_message['subject']; ?></h4>
                            <p><?= $fetch_message['message']; ?></p>

                            <form action="" method="post">
                                <input type="hidden" name="delete_id" value="<?= $fetch_message['id']; ?>">
                                <input type="submit" name="delete_msg" value="delete message" class="btn" onclick="return confirm('delete this message');">
                            </form>
                        </div>

                <?php

                    }
                } else {
                    echo '
                    <div class="empty">
                        <p>no unread message yet!</p>
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