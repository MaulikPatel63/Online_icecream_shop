<header class="header">

    <section class="flex">

        <a href="home.php" class="logo"><img src="image/logo.png" width="130px"></a>
        <nav class="navbar">
            <a href="home.php">home</a>
            <a href="about-us.php">about us</a>
            <a href="menu.php">shop</a>
            <a href="order.php">order</a>
            <a href="contact.php">contact us</a>
        </nav>

        <form action="search_product.php" method="post" class="search-form">
            <input type="text" name="search_product" placeholder="search product..." maxlength="100" required>
            <button type="submit" class="bx bx-search-alt-2" id="search_product_btn"></button>
        </form>

        <div class="icons">
            <div class="bx bx-list-plus" id="menu-btn"></div>
            <div class="bx bx-search-alt-2" id="search-btn"></div>

            <?php
            $count_whislist_item = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_whislist_item->execute([$user_id]);
            $total_whislist_items = $count_whislist_item->rowCount();
            ?>

            <a href="wishlist.php"><i class="bx bx-heart"></i><sub><?= $total_whislist_items; ?></sub></a>

            <?php
            $count_cart_item = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_item->execute([$user_id]);
            $total_cart_items = $count_cart_item->rowCount();
            ?>
            <a href="cart.php"><i class="bx bx-cart"></i><sub><?= $total_cart_items; ?></sub></a>
            <div class="bx bxs-user" id="user-btn"></div>

        </div>

        <div class="profile-detail">
            <?php

            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if ($select_profile->rowCount() > 0) {
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC)
            ?>
                <img src="uploaded_files/<?= $fetch_profile['image']; ?>">
                <h3 style="margin-bottom: 1rem;"><?= $fetch_profile['name']; ?></h3>

                <div class="flex-btn">
                    <a href="profile.php" class="btn">view profile</a>
                    <a href="components/user_logout.php" class="btn" onclick="return confirm('logout from this website');">logout</a>
                </div>

            <?php } else { ?>
                <h3 style="margin-bottom: 1rem;">please login or register</h3>
                <div class="flex-btn">
                    <a href="login.php" class="btn">login</a>
                    <a href="register.php" class="btn">register</a>
                </div>
            <?php } ?>

        </div>

    </section>

</header>