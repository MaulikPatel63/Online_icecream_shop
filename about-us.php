<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
    // header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - about us page</title>
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
            <h1>about us</h1>
            <br>
            <span>
                <a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i> about us
            </span>
        </div>
    </div>
    <div class="chef">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <span>Happy Vaghasiya</span>
                    <h1>Masterchef</h1>
                    <img src="image/separator-img.png">
                </div>
                <p>happy is a Gujarat pastry chef who spent 15 years in his city Rome perfecting his craft and exceptional creations. Vestibulum rhoncus ornare tincidunt. Etiam pretium metus sit amet est aliquet vulputate. Fusce et cursus ligula. Sed accumsan dictum porta. Aliquam rutrum ullamcorper velit hendrerit convallis.</p>
                <div class="flex-btn">
                    <a href="" class="btn">explore our menu </a>
                    <a href="menu.php" class="btn">visit our shop</a>
                </div>
            </div>
            <div class="box">
                <img src="image/ceaf.png" class="img">
            </div>
        </div>
    </div>
    <!-- cheaf section box -->
    <div class="story">
        <div class="heading">
            <h1>our story</h1>
            <img src="image/separator-img.png">
        </div>
        <p>Use quotation marks to enclose the titles of articles, chapters, essays, <br>short stories, poems, songs, and episodes of television series
        </p>
        <a href="menu.php" class="btn">our services</a>
    </div>
    <!-- story section start -->
    <div class="container">
        <div class="box-container">
            <div class="img-box">
                <img src="image/about.png" alt="about">
            </div>
            <div class="box">
                <div class="heading">
                    <h1>Taking Ice Cream To New Heights</h1>
                    <img src="image/separator-img.png">
                </div>
                <p>The customer is very important, the customer will be followed by the customer. It should also be an important element before. But mattis sapien or vestibulum lacinia. The class is suitable for the silent partners who turn to the shores through our marriages, through the Hymenaean projects. Cool off the yeast. There is absolutely nothing, the price is pure or the vehicles are poisoned
                </p>
                <a href="" class="btn">learn more</a>
            </div>
        </div>
    </div>
    <!-- story section end -->
    <div class="team">
        <div class="heading">
            <span>Our Team</span>
            <h1>Quality & passion with our services</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/team-1.jpg" alt="team" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="shape" class="shap">
                    <h2>Dave Arnold</h2>
                    <p>Chef</p>
                </div>
            </div>
            <div class="box">
                <img src="image/team-2.jpg" alt="team" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="shape" class="shap">
                    <h2>Cat Cora</h2>
                    <p>Chef</p>
                </div>
            </div>
            <div class="box">
                <img src="image/team-3.jpg" alt="team" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="shape" class="shap">
                    <h2>Ralph Johnson</h2>
                    <p>Chef</p>
                </div>
            </div>
        </div>
    </div>
    <!-- team section end -->
    <div class="standers">
        <div class="detail">
            <div class="heading">
                <h1>our standerts</h1>
                <img src="image/separator-img.png">
            </div>
            <p>I have measured out my life with ice cream spoons</p>
            <i class="bx bxs-heart"></i>
            <p>Ice cream is the best soulmate you could wish for</p>
            <i class="bx bxs-heart"></i>
            <p>I scream, you scream, we all scream for ice cream!</p>
            <i class="bx bxs-heart"></i>
            <p>Happiness is...eating ice cream on a hot day.</p>
            <i class="bx bxs-heart"></i>
            <p>I love you more than ice cream, and that's saying a lot.</p>
            <i class="bx bxs-heart"></i>
        </div>
    </div>
    <!-- standers section end -->
    <div class="testimonial">
        <div class="heading">
            <h1>testimonial</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="testimonial-container">
            <div class="slide-row" id="slide">
                <div class="slide-col">
                    <div class="user-text">
                        <p>Zen Doan is a business analyst, entrepreneur and media proprietor, and
                            investor. She also known as the best selling book author.</p>
                        <h2>Zen</h2>
                        <p>Author</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (1).jpg" alt="testimonial">
                    </div>
                </div>
                <div class="slide-col">
                    <div class="user-text">
                        <p>Zen Doan is a business analyst, entrepreneur and media proprietor, and
                            investor. She also known as the best selling book author.</p>
                        <h2>Zen</h2>
                        <p>Author</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (2).jpg" alt="testimonial">
                    </div>
                </div>
                <div class="slide-col">
                    <div class="user-text">
                        <p>Zen Doan is a business analyst, entrepreneur and media proprietor, and
                            investor. She also known as the best selling book author.</p>
                        <h2>Zen</h2>
                        <p>Author</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (3).jpg" alt="testimonial">
                    </div>
                </div>
                <div class="slide-col">
                    <div class="user-text">
                        <p>Zen Doan is a business analyst, entrepreneur and media proprietor, and
                            investor. She also known as the best selling book author.</p>
                        <h2>Zen</h2>
                        <p>Author</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (4).jpg" alt="testimonial">
                    </div>
                </div>
            </div>
        </div>
        <div class="indicator">
            <span class="btn1 active"></span>
            <span class="btn1"></span>
            <span class="btn1"></span>
            <span class="btn1"></span>
        </div>
    </div>
    <!-- testimonial section end -->

    <div class="mission">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <h1>our mission</h1>
                    <img src="image/separator-img.png">
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission.webp">
                    </div>
                    <div>
                        <h2>mexicon chocolate</h2>
                        <p>  minimally processed to retain the health benefits and integrity of cacao.<br>
                        which results in a more gritty, rustic texture than European chocolate.
                    </p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission1.webp">
                    </div>
                    <div>
                        <h2>caremal chocolate</h2>
                        <p>Crafted with the finest natural ingredients, Amul Ice creams will simply melt in your mouth leaving a smooth aftertaste</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission0.jpg">
                    </div>
                    <div>
                        <h2>choco chips</h2>
                        <p>My life may not be perfect, but my ice cream scoop sure is.” “I'm a scoop above the rest.</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission2.webp">
                    </div>
                    <div>
                        <h2>Pistachio Ice Cream</h2>
                        <p>Pistachio Ice Cream is a refreshing and unique dessert that offers a delightful balance of sweet and savory</p>
                    </div>
                </div>
            </div>
            <div class="box">
                <img src="image/form.png" alt="form" class="img">
            </div>
        </div>
    </div>

    <!-- mission section end -->




    <?php include 'components/footer.php'; ?>


    <script src=" https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js -->
    <script src="js/user_script.js"></script>

    <?php include 'components/alert.php'; ?>

</body>

</html>