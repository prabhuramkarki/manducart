<?php
session_start();
include("db_connection.php");

$start = 0;
$per_page = 10;

$sql0 = "SELECT * FROM tbl_products";
$result0 = mysqli_query($connection, $sql0);
$nr_of_rows = $result0->num_rows;
$pages = ceil($nr_of_rows / $per_page);

$current_page = isset($_GET['page-nr']) ? $_GET['page-nr'] : 1;

if (isset($_GET['page-nr'])) {
    $current_page = $_GET['page-nr'];
    $page = $current_page - 1;
    $start = $page * $per_page;
}

$product_updated = isset($_SESSION['product_updated']) ? $_SESSION['product_updated'] : false;

if ($product_updated) {
    echo '<script>alert("Product Updated Sucessfully")</script>';
    unset($_SESSION['product_updated']);
}

$updated_message = isset($_SESSION['updated_message']) ? $_SESSION['updated_message'] : false;

if ($updated_message) {
    echo "<script>alert('Product updated Sucessfully')</script>";
    unset($_SESSION['updated_message']);
}
$delete_message = isset($_SESSION['delete_message']) ? $_SESSION['delete_message'] : false;
if ($delete_message) {
    echo "<script>alert('Product deleted Sucessfully')</script>";
    unset($_SESSION['delete_message']);
}


$counter = 0;

$sql = "SELECT * FROM tbl_products ORDER BY product_id DESC LIMIT $start, $per_page";
$result = mysqli_query($connection, $sql);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="../../assets/adminpanel.css">
    <link rel="stylesheet" href="../../assets/style.css">
</head>

<body>
    <?php
    include("adminnav.php");
    ?>
    <form action="adminpanel.php" method="post" class="">
        <button type="submit" name="back" id="back_btn"><i class="fa-solid fa-angle-left"></i>Back</button>
    </form>
    <div class="table-wrapper">
        <table id="table">
            <div class="table-head">
                <tr id="table-titles">
                    <td>SN</td>
                    <td>Image</td>
                    <td>Name</td>
                    <td>Category</td>
                    <td>Color</td>
                    <td>Size</td>
                    <td>Details</td>
                    <td>Quantity</td>
                    <td>Price</td>
                    <td>Manage</td>
                </tr>
            </div>
            <?php if ($result): ?>
                <tbody>
                    <?php while ($db_data = mysqli_fetch_assoc($result)): ?>
                        <?php
                        $category_id = $db_data['category_id'];
                        $sql_cat = "SELECT * FROM tbl_categories WHERE category_id=$category_id";
                        $result_cat = mysqli_query($connection, $sql_cat);
                        $db_data_cat = mysqli_fetch_assoc($result_cat)
                            ?>
                        <tr>
                            <td>
                                <?php echo ++$counter; ?>
                            </td>
                            <td> <img src="../../images/<?php echo $db_data['product_image']; ?>" alt=""
                                    style="width:50px; height: 100%; border-radius: 3px;"></td>
                            <td>
                                <?php echo $db_data['product_name']; ?>
                            </td>
                            <td>
                                <?php echo $db_data_cat['product_category']; ?>
                            </td>
                            <td>
                                <?php echo $db_data_cat['product_color']; ?>
                            </td>
                            <td style="text-transform: uppercase;">
                                <?php echo $db_data_cat['product_size']; ?>
                            </td>
                            <td style="text-overflow: ellipsis; height: 10px;">
                                <?php echo $db_data['product_details']; ?>
                            </td>
                            <td>
                                <?php echo $db_data['product_quantity']; ?>
                            </td>
                            <td>
                                <?php echo $db_data['product_price']; ?>
                            </td>

                            <td> <a style="margin-right: 15px;"
                                    href="deleteproduct.php? product_id='<?php echo $db_data['product_id']; ?>'"
                                    title="Delete"><i class="fa-solid fa-trash"></i></a>
                                <a href="editproduct.php? product_id='<?php echo $db_data['product_id']; ?>'&category_id='<?php echo $db_data['category_id']; ?>'"
                                    title="Edit"><i class="fa-solid fa-pen-nib"></i></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
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