<?php

session_start();
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('location:login.php');
}

// Initialize pagination parameters
$from_date = '';
$to_date = '';
$pagination_params = "";

$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page
$start = ($page - 1) * $limit; // Starting row for the query

if (isset($_POST['date_submit'])) {
    // Get the submitted date values
    // $from_date = $_POST['from_date'];
    // $to_date = $_POST['to_date'];
    if (isset($_POST['filterType'])) {
        $filter_type = $_POST['filterType'];
        // Validate and sanitize the dates if needed
        switch ($filter_type) {
            case 'today':
                $from_date = date('Y-m-d');
                $to_date = date('Y-m-d');
                break;
            case 'yesterday':
                $from_date = date('Y-m-d', strtotime('yesterday'));
                $to_date = date('Y-m-d', strtotime('yesterday'));
                break;
            case 'this_week':
                $from_date = date('Y-m-d', strtotime('this week'));
                $to_date = date('Y-m-d');
                break;
            case 'last_week':
                $from_date = date('Y-m-d', strtotime('last week'));
                $to_date = date('Y-m-d', strtotime('this week -1 day'));
                break;
            case 'this_month':
                $from_date = date('Y-m-01');
                $to_date = date('Y-m-d');
                break;
            case 'last_month':
                $from_date = date('Y-m-01', strtotime('last month'));
                $to_date = date('Y-m-d', strtotime('last day of last month'));
                break;
            case 'custom':
                $from_date = $_POST['from_date'];
                $to_date = $_POST['to_date'];
                break;
        }
        // Construct pagination parameters with date filters
        $pagination_params = "&from_date=$from_date&to_date=$to_date";

        // Fetch data with pagination and date filtering
        $select_order = $conn->prepare("SELECT * FROM `orders` WHERE seller_id = ? AND dates BETWEEN ? AND ? LIMIT $start, $limit");
        $select_order->execute([$seller_id, $from_date, $to_date]);
    } else {
        // Fetch data with pagination without date filtering
        $select_order = $conn->prepare("SELECT * FROM `orders` WHERE seller_id = ? LIMIT $start, $limit");
        $select_order->execute([$seller_id]);
    }
} else {
    // Fetch data with pagination without date filtering
    $select_order = $conn->prepare("SELECT * FROM `orders` WHERE seller_id = ? LIMIT $start, $limit");
    $select_order->execute([$seller_id]);
}

//delete order
if (isset($_POST['delete'])) {
    $p_id = $_POST['delete']; // Use 'delete' instead of 'orders_id'
    $p_id = filter_var($p_id, FILTER_SANITIZE_STRING);

    $delete_product = $conn->prepare("DELETE FROM `orders` WHERE orders_id = ?");
    $delete_product->execute([$p_id]);

    // Store success message in session variable
    $_SESSION['success_msg'] = 'Order deleted successfully';

    // Redirect to the same page with current page and filter parameters
    $redirect_url = "order_history.php?page=$page$pagination_params";
    header("Location: $redirect_url");
    exit();
}
// Display success message if exists
if (isset($_SESSION['success_msg'])) {
    $success_msg[] = 'Order deleted successfully';
    unset($_SESSION['success_msg']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - user order page</title>
    <link rel="stylesheet" type="text/css" href="../css/order_style.css?=<?php echo time(); ?>">

    <!-- font awesome Cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- box icon cdn link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

    <style>
        @media print {
            .card table {
                border-collapse: collapse;
                width: 100%;
            }

            .card table,
            th,
            td {
                border: 1px solid black;
            }

            .card th,
            td {
                padding: 8px;
                text-align: left;
            }
        }
    </style>
</head>

<body>
    <div class="order-class">
        <div class="main-container">
            <?php include '../components/admin_header.php'; ?>
            <div class="heading">
                <h1>total orders records</h1>
                <img src="../image/separator-img.png">
            </div>
        </div>

        <div class="content">
            <section class="main-header grid">
                <form method="post">
                    <button class="btn" style="margin-left: 5px;" type="button" id="btnPrint">
                        Print
                    </button>
                    <button class="btn" style="margin-left: 5px;" type="button" id="btnScreenshot">
                        Take a Screenshot
                    </button>
                </form>
                <form method="post" id="filterForm">
                    <select id="filterType" name="filterType" onchange="toggleCustomDates();">
                        <option disabled selected value="default">Select Filter Option</option>
                        <option value="today">Today</option>
                        <option value="yesterday">Yesterday</option>
                        <option value="this_week">This Week</option>
                        <option value="last_week">Last Week</option>
                        <option value="this_month">This Month</option>
                        <option value="last_month">Last Month</option>
                        <option value="custom">Custom</option>
                    </select>

                    <div id="customDates">
                        <label for="from_date">From Date:</label>
                        <input type="date" name="from_date" id="from_date">

                        <label for="to_date">To Date:</label>
                        <input type="date" name="to_date" id="to_date">
                    </div>

                    <button class="btn" style="margin-left: 5px;" type="submit" name="date_submit">
                        <span>Apply Filter</span>
                    </button>
                    <a class="btn" style="margin-left: 5px;" href="dashboard.php"><i class="bx bxs-home-smile"></i> Back To Dashboard</a>
                </form>
            </section>
            <?php
            if ($select_order->rowCount() > 0) {
            ?>
                <div id="print-container">
                    <div class="card" id="screenshot-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Product Name</th>
                                    <th>Address</th>
                                    <th>Qty</th>
                                    <th>Order Date</th>
                                    <th>Order status</th>
                                    <th>Pyment status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $rowCount = $start + 1;
                                while ($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)) {
                                    $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                                    $select_product->execute([$fetch_order['product_id']]);
                                    $product = $select_product->fetch(PDO::FETCH_ASSOC);

                                ?>
                                    <tr class="selected">
                                        <td><?= $rowCount++; ?></td>
                                        <td><?= $fetch_order['name']; ?></td>
                                        <td><?= $product['name']; ?></td>
                                        <td><?= $fetch_order['address']; ?></td>
                                        <td><?= $fetch_order['qty']; ?></td>
                                        <td><?= $fetch_order['dates']; ?></td>
                                        <td><?= $fetch_order['status']; ?></td>
                                        <td><?= $fetch_order['method']; ?></td>
                                        <td>
                                            <form method="post" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                                <input type="hidden" name="delete" value="<?= $fetch_order['orders_id']; ?>">
                                                <button type="submit" class="New_btn">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <section class="table-footer grid">
                    <span>Displaying <?php echo $start + 1; ?>-<?php echo $start + $select_order->rowCount(); ?> of <?php echo $limit; ?> items</span>
                    <div class="paging grid">
                        <span>
                            Page <?php echo $page; ?>
                        </span>
                        <?php if ($page > 1) { ?>
                            <a href="?page=<?php echo ($page - 1) . $pagination_params; ?>" class="btn icon">
                                <i class="fa-solid fa-angle-left"></i>
                            </a>
                        <?php } ?>
                        <?php if ($select_order->rowCount() == $limit) { ?>
                            <a href="?page=<?php echo ($page + 1) . $pagination_params; ?>" class="btn icon">
                                <i class="fa-solid fa-angle-right"></i>
                            </a>
                        <?php } ?>
                    </div>
                </section>
            <?php
            } else {
                echo '
                    <div class="card">
                        <table>
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Product Name</th>
                                <th>Address</th>
                                <th>Qty</th>
                                <th>Order Date</th>
                                <th>Order status</th>
                                <th>Pyment status</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="9" style="text-align: center;">No Data Found !</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>';
            }
            ?>
        </div>
    </div>

    <script>
        document.getElementById("btnScreenshot").addEventListener("click", function() {
            html2canvas(document.getElementById("screenshot-container")).then(function(canvas) {
                var link = document.createElement('a');
                link.download = "screenshot.png";
                link.href = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
                link.click();
                location.reload();
            });

        });

        document.getElementById("btnPrint").addEventListener("click", function() {
            var printContents = document.getElementById("print-container").innerHTML;
            var originalContents = document.body.innerHTML;

            // Open a new window and write the content to it for printing
            var printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Print</title></head><body>' + printContents + '</body></html>');
            printWindow.document.close();

            // Wait for the new window to be loaded before calling print
            printWindow.onload = function() {
                printWindow.print();
                printWindow.onafterprint = function() {
                    // Close the window after printing
                    printWindow.close();

                    // Restore the original content to the main window
                    document.body.innerHTML = originalContents;
                    location.reload();
                };
            };

            // Preserve the original content in case the user cancels the print
            printWindow.onbeforeunload = function() {
                document.body.innerHTML = originalContents;
            };

        });

        if (performance.navigation.type === 1 && !document.forms['filterForm'].submitted) {
            window.location.href = 'order_history.php';
        }

        function toggleCustomDates() {
            var customDates = document.getElementById('customDates');
            var filterType = document.getElementById('filterType');

            customDates.style.display = filterType.value === 'custom' ? 'inline-block' : 'none';
        }
    </script>

    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js -->
    <script src="../js/admin_script.js"></script>

    <?php include '../components/alert.php'; ?>
</body>

</html>