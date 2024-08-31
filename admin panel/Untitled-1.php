<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
    header('location:login.php');
}



// Check if the print button is clicked
if (isset($_POST['print_button'])) {
    // Replace 'your_url' with the actual URL of your page
    $url = 'http://localhost/icecream_shop/admin%20panel/order_2.php'; // Adjust this URL

    // Replace 'output.png' with the desired output file name and format
    $outputPath = '../uploaded_files/output.png';

    // Replace the path with the correct path to wkhtmltoimage on your local system
    $wkhtmltoimagePath = 'C:/path/to/wkhtmltoimage'; // Adjust this path

    // Command to capture the screenshot
    $command = "$wkhtmltoimagePath $url $outputPath";

    // Execute the command
    exec($command);
}

// Pagination variables
$records_per_page = 10;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $records_per_page;
$sqlCount = "SELECT COUNT(*) FROM `orders` WHERE user_id = ?";
$paramsCount = [$user_id];

// Apply filters if available
$filterDate = isset($_GET['filterDate']) ? $_GET['filterDate'] : null;
$filterMonth = isset($_GET['filterMonth']) ? $_GET['filterMonth'] : null;

if (!empty($filterDate)) {
    $sqlCount .= " AND DATE(order_date) = ?";
    $paramsCount[] = $filterDate;
}

if (!empty($filterMonth)) {
    $sqlCount .= " AND MONTH(order_date) = ?";
    $paramsCount[] = date('n', strtotime($filterMonth));
}

$countStmt = $conn->prepare($sqlCount);
$countStmt->execute($paramsCount);

$total_records = $countStmt->fetchColumn();

// Calculate total pages
$total_pages = ceil($total_records / $records_per_page);

// Fetch data with pagination
$sqlData = "SELECT * FROM `orders` WHERE user_id = ?";

if (!empty($filterDate)) {
    $sqlData .= " AND DATE(order_date) = ?";
    $paramsCount[] = $filterDate;
}

if (!empty($filterMonth)) {
    $sqlData .= " AND MONTH(order_date) = ?";
    $paramsCount[] = date('n', strtotime($filterMonth));
}

$sqlData .= " LIMIT $offset, $records_per_page";

$dataStmt = $conn->prepare($sqlData);
$dataStmt->execute([$user_id]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - user order page</title>
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
            <h1>my order</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br>
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
            <span>
                <a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>my order
            </span>
        </div>
    </div>

    <main>
        <div class="content">
            <section class="main-header grid">
                <button class="button">
                    <i class="fa-solid fa-plus"></i>
                    <span>Print</span>
                </button>
            </section>

            <!-- <section class="table-header grid">
                <form method="GET">
                    <label for="filterDate">Filter by Date:</label>
                    <input type="date" id="filterDate" name="filterDate">

                    <label for="filterMonth">Filter by Month:</label>
                    <input type="month" id="filterMonth" name="filterMonth">

                    <button type="submit" class="button link">
                        <span>Apply Filters</span>
                        <i class="fa-solid fa-angle-down"></i>
                    </button>
                </form>
            </section> -->
            <section class="table-header grid">
                <form method="GET">
                    <label for="filterDate">Filter by Date:</label>
                    <input type="date" id="filterDate" name="filterDate">

                    <label for="filterMonth">Filter by Month:</label>
                    <input type="month" id="filterMonth" name="filterMonth">

                    <button type="submit" class="button link">
                        <span>Apply Filters</span>
                        <i class="fa-solid fa-angle-down"></i>
                    </button>
                </form>
            </section>

            <!-- ?php

            $select_order = $conn->prepare("SELECT * FROM `orders` where user_id = ? limit 10");
            $select_order->execute([$user_id]);

            if ($select_order->rowCount() > 0) {
                while ($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)) {

            ?> -->
            <div class="card">
                <table>
                    <thead>
                        <tr>

                            <th>ID</th>
                            <th>User</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Location</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        while ($fetch_order = $dataStmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr class="selected">
                                <td><?= $fetch_order['order_id']; ?></td>
                                <td><?= $fetch_order['user_id']; ?></td>
                                <td><?= $fetch_order['first_name']; ?></td>
                                <td><?= $fetch_order['last_name']; ?></td>
                                <td><?= $fetch_order['email']; ?></td>
                                <td><?= $fetch_order['phone']; ?></td>
                                <td><?= $fetch_order['location']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>

                </table>
            </div>


            <section class="table-footer grid">
                <span>Displaying <?php echo $offset + 1; ?>-<?php echo min($offset + $records_per_page, $total_records); ?> of <?php echo $total_records; ?> items</span>
                <div class="paging grid">
                    <span>
                        Page
                        <input type="number" name="page" value="<?php echo $current_page; ?>">
                        of <?php echo $total_pages; ?>
                    </span>
                    <div class="button icon" onclick="changePage('prev')">
                        <i class="fa-solid fa-angle-left"></i>
                    </div>
                    <div class="button icon" onclick="changePage('next')">
                        <i class="fa-solid fa-angle-right"></i>
                    </div>
                    <button type="button" onclick="goToPage()">Go</button>
                </div>
            </section>
            <script>
                function changePage(direction) {
                    var currentPageInput = document.querySelector('input[name="page"]');
                    var currentPage = parseInt(currentPageInput.value);

                    if (direction === 'prev' && currentPage > 1) {
                        currentPageInput.value = currentPage - 1;
                    } else if (direction === 'next' && currentPage < <?php echo $total_pages; ?>) {
                        currentPageInput.value = currentPage + 1;
                    }

                    document.querySelector('form').submit();
                }

                function goToPage() {
                    var currentPageInput = document.querySelector('input[name="page"]');
                    var newPage = parseInt(currentPageInput.value);

                    if (newPage >= 1 && newPage <= <?php echo $total_pages; ?>) {
                        window.location.href = '?page=' + newPage;
                    }
                }
            </script>


            <!-- ?php

                }
            } else {
                echo '
                    <div class="empty">
                        <p>no order placed yet!</p>
                    </div>';
            }
            ?> -->
        </div>
    </main>


    <?php include 'components/footer.php'; ?>

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js -->
    <script src="js/user_script.js"></script>

    <?php include 'components/alert.php'; ?>
</body>

</html>