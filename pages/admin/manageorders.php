<?php
session_start();
include("db_connection.php");

$start = 0;
$per_page = 10;

$sql0 = "SELECT * FROM tbl_order_details";
$result0 = mysqli_query($connection, $sql0);
$nr_of_rows = $result0->num_rows;
$pages = ceil($nr_of_rows / $per_page);

$current_page = isset($_GET['page-nr']) ? $_GET['page-nr'] : 1;

if (isset($_GET['page-nr'])) {
    $current_page = $_GET['page-nr'];
    $page = $current_page - 1;
    $start = $page * $per_page;
}

$counter = 0;

$sql = "SELECT * FROM tbl_order_details ORDER BY order_id DESC";
$result = mysqli_query($connection, $sql);
$admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : header("location: vendorlogin.php");


if (isset($_POST['status_update'])) {
    $status = $_POST['status'];
    $order_id = $_POST['order_id'];
    $product_id = $_POST['product_id'];
    $ordered_quantity = $_POST['order_quantity'];
    $sql_track_orders = "UPDATE tbl_order_details SET status= '$status', updated_by=$admin_id WHERE order_id=$order_id AND product_id=$product_id ";
    $result_track_orders = mysqli_query($connection, $sql_track_orders);

    $sql = "SELECT * FROM tbl_orders WHERE id=$order_id";
    $result = mysqli_query($connection, $sql);
    $db_data_id = mysqli_fetch_assoc($result);
    $customer_id = $db_data_id['customer_id'];

    if ($status === 'Delivered') {
        $sql_history = "INSERT INTO tbl_history (customer_id,product_id,status,ordered_quantity,created_by) VALUES ($customer_id,$product_id,'$status',$ordered_quantity,$admin_id)";
        $result_history = mysqli_query($connection, $sql_history);

        $sql_remove_orders = "DELETE FROM tbl_orders WHERE id=$order_id";
        $result_remove = mysqli_query($connection, $sql_remove_orders);

    }
    header("location:manageorders.php");


}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="../../assets/adminpanel.css">
    <!-- for pagination -->
    <link rel="stylesheet" href="../../assets/style.css">


</head>

<body>
    <?php
    include("adminnav.php");
    ?>
    <form action="adminpanel.php" method="post">
        <button type="submit" name="back" id="back_btn"><i class="fa-solid fa-angle-left"></i> Back</button>
    </form>

    <?php if ($result): ?>
        <div class="table-wrapper">
            <table id="table">
                <div class="table-head">
                    <tr id="table-titles">
                        <td>SN</td>
                        <td>Customer Name</td>
                        <td>Product Image</td>
                        <td>Product Name</td>
                        <td>Quantity</td>
                        <td>Total Price</td>
                        <td>Payment Method</td>
                        <td>Address</td>
                        <td>Manage</td>
                        <td>Status</td>
                        <td>Update Status</td>
                        <td>Ordered at</td>
                    </tr>
                </div>
                <tbody>

                    <?php while ($db_data = mysqli_fetch_assoc($result)):
                        $order_id = $db_data['order_id'];

                        $product_id = $db_data['product_id'];

                        $sql3 = "SELECT * FROM tbl_products WHERE product_id = $product_id";
                        $result3 = mysqli_query($connection, $sql3);
                        $db_data3 = mysqli_fetch_assoc($result3);

                        $sql4 = "SELECT * FROM tbl_shippings WHERE order_id = $order_id";
                        $result4 = mysqli_query($connection, $sql4);
                        $db_data4 = mysqli_fetch_assoc($result4);


                        $total_price = $db_data['order_quantity'] * $db_data3['product_price'];
                        ?>

                        <tr>

                            <td>
                                <?php echo ++$counter; ?>
                            </td>
                            <td>
                                <?php echo $db_data4['customer_name']; ?>
                            </td>
                            <td> <img src="../../images/<?php echo $db_data3['product_image']; ?>" alt=""
                                    style="width:50px; height: 100%;  border-radius: 3px;" ></td>
                            <td>
                                <?php echo $db_data3['product_name']; ?>
                            </td>
                            <td>
                                <?php echo $db_data['order_quantity']; ?>
                            </td>
                            <td>
                                <?php echo $total_price ?>
                            </td>
                            <td>
                                <?php echo $db_data['payment_method']; ?>
                            </td>
                            <td>
                                <?php echo $db_data4['address']; ?>
                            </td>
                            <td> <a href="ordersdelete.php? order_id= <?php echo $order_id; ?>" title="Delete"><i
                                        class="fa-solid fa-trash" style="margin-left: 25px;"></i></a></td>
                            <form action="#" method="post">
                                <td>
                                    <select name="status" id="status">
                                        <option value="<?php echo $db_data['status']; ?>">
                                            <?php echo $db_data['status']; ?>
                                        </option>
                                        <option value="Processing">Processing</option>
                                        <option value="Shipped">Shipped</option>
                                        <option value="Dishpatched">Dishpatched</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>

                                </td>
                                <input type="hidden" name="order_quantity" value="<?php echo $db_data['order_quantity']; ?>">
                                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <td>
                                    <button type="submit" name="status_update" id="status_update_btn"><i
                                            class="fa-solid fa-circle-check"></i></button>
                                </td>
                                <td>
                                    <?php
                                    $databaseDate = $db_data['created_at'];
                                    $formattedDate = date('Y/m/d', strtotime($databaseDate));
                                    echo $formattedDate;
                                    ?>
                                </td>
                            </form>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        <?php else: ?>
            <p>Data not found!</p>
        <?php endif;



    if (isset($_SESSION['order_delete_message'])) {
        session_destroy();
    } ?>

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