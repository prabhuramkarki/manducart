<?php
session_start();
include("db_connection.php");

$start = 0;
$per_page = 10;

$sql0 = "SELECT * FROM tbl_customers";
$result0 = mysqli_query($connection, $sql0);
$nr_of_rows = $result0->num_rows;
$pages = ceil($nr_of_rows / $per_page);

$current_page = isset($_GET['page-nr']) ? $_GET['page-nr'] : 1;

if (isset($_GET['page-nr'])) {
    $current_page = $_GET['page-nr'];
    $page = $current_page - 1;
    $start = $page * $per_page;
}

$sql_select = "SELECT * FROM tbl_customers ORDER BY customer_id DESC";
$result_select = mysqli_query($connection, $sql_select);

$i = 1;

$delete_message = isset($_SESSION['delete_message']) ? $_SESSION['delete_message'] : false;

if ($delete_message) {
    echo "<script>alert('Product deleted Sucessfully')</script>";
    unset($_SESSION['delete_message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Customers</title>
    <link rel="stylesheet" href="../../assets/adminpanel.css">
    <link rel="stylesheet" href="../../assets/adminnav.css">
    <link rel="stylesheet" href="../../assets/style.css">
</head>

<body>
    <?php
    include("adminnav.php");
    ?>
    <form action="adminpanel.php" method="post" class="">
        <button type="submit" name="back" id="back_btn"><i class="fa-solid fa-angle-left"></i> Back</button>
    </form>
    <div class="table-wrapper">
        <table id="table">
            <div class="table-head">
                <tr id="table-titles">
                    <td>SN</td>
                    <td>Full Name</td>
                    <td>Email</td>
                    <td>Phone</td>
                    <td>Manage</td>
                </tr>

            </div>
            <?php if ($result_select): ?>
                <tbody>
                    <?php while ($db_data = mysqli_fetch_assoc($result_select)):

                        $customer_id = $db_data['customer_id'];
                        $customer_name = $db_data['fullname'];
                        $email = $db_data['email'];
                        $phone = $db_data['phone'];

                        ?>

                        <tr>
                            <td>
                                <?php echo "$i" ?>
                            </td>
                            <td>
                                <?php echo "$customer_name" ?>
                            </td>
                            <td>
                                <?php echo "$email" ?>
                            </td>
                            <td>
                                <?php echo "$phone" ?>
                            </td>
                            <td>
                                <a id="cust-delete-btn" href="deletecustomer.php?customer_id=<?php echo $customer_id; ?>"
                                    title="Delete"><i class="fa-solid fa-trash" style="margin-left: 25px; color:black;"></i>
                                </a>
                            </td>
                        </tr>
                        <?php $i++; endwhile; ?>
                </tbody>
            </table>

        <?php else: ?>
            <p>Data not found!</p>
        <?php endif; ?>
        <!-- for pagination  -->
        <div class="pagination">
            <?php
            if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {

                ?>
                <a href="?page-nr=<?php echo $_GET['page-nr'] - 1 ?>" class="page-link"><i
                        class="fa-solid fa-angles-left"></i></a>
                <?php
            } else {
                ?>
                <a href="" class="page-link"><i class="fa-solid fa-angles-left"></i></a>
                <?php
            }
            ?>

            <?php
            for ($counter = 1; $counter <= $pages; $counter++) {
                $class = '';
                if ($current_page == $counter) {
                    $class = 'active';
                }
                ?>
                <a href="?page-nr=<?php echo $counter ?> " class="page-link <?php echo $class ?>">
                    <?php echo $counter ?>
                </a>

                <?php
            }

            ?>



            <?php
            if (!isset($_GET['page-nr'])) {
                ?>
                <a href="?page-nr=2" class="page-link"><i class="fa-solid fa-angles-right"></i></a>
                <?php
            } else {
                if ($_GET['page-nr'] >= $pages) {
                    ?>
                    <a class="page-link"><i class="fa-solid fa-angles-right"></i></a>
                    <?php
                } else {
                    ?>
                    <a href="?page-nr=<?php echo $_GET['page-nr'] + 1 ?>" class="page-link"><i
                            class="fa-solid fa-angles-right"></i></a>
                    <?php
                }

            }

            ?>
        </div>
    </div>

</body>

</html>