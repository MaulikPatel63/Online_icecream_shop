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
    <title>Blue Sky Summer - Home page</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css?=<?php echo time(); ?>">

    <!-- font awesome Cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- box icon cdn link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>

    <?php include 'components/user_header.php'; ?>


    <!-- slider section start -->

    <div class="slider-container">
        <div class="slider">
            <div class="slideBox active">
                <div class="textBox">
                    <h1>we pride ourselfs on <br> exceptional flavors</h1>
                    <a class="btn" href="menu.php">shop now</a>
                </div>
                <div class="imgBox">
                    <img src="image/slider.jpg" alt="slider">
                </div>
            </div>
            <div class="slideBox">
                <div class="textBox">
                    <h1>cold treats are my kind <br> of comfort food</h1>
                    <a class="btn" href="menu.php">shop now</a>
                </div>
                <div class="imgBox">
                    <img src="image/slider0.jpg" alt="slider">
                </div>
            </div>
        </div>
        <ul class="controls">
            <li onclick="nextSlider();" class="next"><i class="bx bx-right-arrow-alt"></i></li>
            <li onclick="prevSlider();" class="prev"><i class="bx bx-left-arrow-alt"></i></li>
        </ul>
    </div>

    <!-- slider section end -->

    <div class="service">
        <div class="box-container">
            <!-- service item end -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services.png" class="img1">
                        <img src="image/services (1).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>delivery</h4>
                    <span>100% secure</span>
                </div>
            </div>
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (2).png" class="img1">
                        <img src="image/services (3).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>payment</h4>
                    <span>100% secure</span>
                </div>
            </div>
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (5).png" class="img1">
                        <img src="image/services (6).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>support</h4>
                    <span>24*7 hours</span>
                </div>
            </div>
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (7).png" class="img1">
                        <img src="image/services (8).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>gift service</h4>
                    <span>support gift service</span>
                </div>
            </div>
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/service.png" class="img1">
                        <img src="image/service (1).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>returns</h4>
                    <span>24* 7 free return</span>
                </div>
            </div>
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services.png" class="img1">
                        <img src="image/services (1).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>delivery</h4>
                    <span>100% secure</span>
                </div>
            </div>
            <!-- service item box -->
        </div>
    </div>
    <!-- service section box -->
    <div class="categories">
        <div class="heading">
            <h1>categories features</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/categories.jpg">
                <a href="menu.php" class="btn">coconuts</a>
            </div>
            <div class="box">
                <img src="image/categories0.jpg">
                <a href="menu.php" class="btn">chocolate</a>
            </div>
            <div class="box">
                <img src="image/categories2.jpg">
                <a href="menu.php" class="btn">Strawberry</a>
            </div>
            <div class="box">
                <img src="image/categories1.jpg">
                <a href="menu.php" class="btn">corn</a>
            </div>

        </div>
    </div>

    <!-- categories section box -->
    <img src="image/menu-banner.jpg" alt="menu-banner" class="menu-banner">

    <div class="taste">
        <div class="heading">
            <span>taste</span>
            <h1>buy any ice cream @ get one free</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/taste.webp">
                <div class="detail">
                    <h2>natural sweetness</h2>
                    <h1>vanila</h1>
                </div>
            </div>
            <div class="box">
                <img src="image/taste0.webp">
                <div class="detail">
                    <h2>natural sweetness</h2>
                    <h1>matcha</h1>
                </div>
            </div>
            <div class="box">
                <img src="image/taste1.webp">
                <div class="detail">
                    <h2>natural sweetness</h2>
                    <h1>blueberry</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- taste section box -->
    <div class="ice-container">
        <div class="overlay"></div>
        <div class="detail">
            <h1>ice cream is cheaper than <br> therapy for stress</h1>
            <p>Some things in life are like ice cream: They're only good for a while and then they melt.<br>
             The trick is enjoying it and making the most of it while it's still ice cream.</p>
            <a href="menu.php" class="btn">shop now</a>
        </div>
    </div>

    <!-- container section box -->
    <div class="teste2">
        <div class="t-banner">
            <div class="overlay"></div>
            <div class="detail">
                <h1>find your taste of desserts</h1>
                <p>Treat them to a delicious treat and send them some Luck 'o the Irish too!</p>
                <a href="menu.php" class="btn">shop now</a>
            </div>
        </div>
        <div class="box-container">
            <div class="box">
                <div class="box-overlay">
                </div>
                <img src="image/type0.avif">
                <div class="box-details fadeIn-bottom">
                    <h1>strawberry</h1>
                    <p>find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
            <div class="box">
                <div class="box-overlay">
                </div>
                <img src="image/type.avif">
                <div class="box-details fadeIn-bottom">
                    <h1> dark strawberry</h1>
                    <p>find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
            <div class="box">
                <div class="box-overlay">
                </div>
                <img src="image/type1.png">
                <div class="box-details fadeIn-bottom">
                    <h1>strawberry venila</h1>
                    <p>find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
            <div class="box">
                <div class="box-overlay">
                </div>
                <img src="image/type2.png">
                <div class="box-details fadeIn-bottom">
                    <h1>mix fruits</h1>
                    <p>find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
            <div class="box">
                <div class="box-overlay">
                </div>
                <img src="image/type0.avif">
                <div class="box-details fadeIn-bottom">
                    <h1>strawberry</h1>
                    <p>find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
            <div class="box">
                <div class="box-overlay">
                </div>
                <img src="image/type4.jpg">
                <div class="box-details fadeIn-bottom">
                    <h1> chocolate strawberry</h1>
                    <p>find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
        </div>
    </div>

    <!-- taste2 section box -->
    <div class="flavor">
        <div class="box-container">
            <img src="image/left-banner2.webp">
            <div class="detail">
                <h1>Hot Deal ! Sale Up To <span>20% off</span></h1>
                <p>expired</p>
                <a href="menu.php" class="btn">shop now</a>
            </div>
        </div>
    </div>

    <!-- flavour section box -->
    <div class="usage">
        <div class="heading">
            <h1>how it works</h1>
            <img src="image/separator-img.png">

        </div>
        <div class="row">
            <div class="box-container">
                <div class="box">
                    <img src="image/icon.avif">
                    <div class="detail">
                        <h3>scoop ice-cream</h3>
                        <p>The only thing better than a scoop of ice cream is two scoops of ice cream
                        lots of wonderful flavors to taste but if you don't eat it, it just melts away
                        </p>
                    </div>
                </div>
                <div class="box">
                    <img src="image/icon1.avif">
                    <div class="detail">
                        <h3>stick ice-cream</h3>
                        <p>Don’t let your ice cream melt and drip without getting the chance to eat it. Life is the same, you have to enjoy it before you lose it.</p>
                    </div>
                </div>
                <div class="box">
                    <img src="image/icon2.avif">
                    <div class="detail">
                        <h3>scoop ice-cream</h3>
                        <p>The only thing better than a scoop of ice cream is two scoops of ice cream
                        lots of wonderful flavors to taste but if you don't eat it, it just melts away.</p>
                    </div>
                </div>
            </div>
            <img src="image/sub-banner.png" class="divider">
            <div class="box-container">
                <div class="box">
                    <img src="image/icon2.avif">
                    <div class="detail">
                        <h3>cup ice-cream</h3>
                        <p>the amino acids you take in when eating ice cream, such as tryptophan, are known to increase serotonin production.</p>
                    </div>
                </div>
                <div class="box">
                    <img src="image/icon3.avif">
                    <div class="detail">
                        <h3>stick ice-cream</h3>
                        <p>Don’t let your ice cream melt and drip without getting the chance to eat it. Life is the same, you have to enjoy it before you lose it.</p>
                    </div>
                </div>
                <div class="box">
                    <img src="image/icon4.avif">
                    <div class="detail">
                        <h3>scoop ice-cream</h3>
                        <p>The only thing better than a scoop of ice cream is two scoops of ice cream
                        lots of wonderful flavors to taste but if you don't eat it, it just melts away.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- usage section box -->
    <div class="pride">
        <div class="detail">
            <h1>We Pride Ourselves On <br> Exceptional Flavors.</h1>
            <p>You can't buy happiness, but you can buy ice cream.<br> And that's kind of the same thing.</p>
            <a href="menu.php" class="btn">shop now</a>
        </div>
    </div>

    <!-- pride section box -->



    <?php include 'components/footer.php'; ?>


    <script src=" https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js -->
    <script src="js/user_script.js"></script>

    <?php include 'components/alert.php'; ?>

</body>

</html>