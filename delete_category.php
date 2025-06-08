<?php
include "connection.php";

if (isset($_POST['category_id'])) {
    $categoryId = $_POST['category_id'];
    $query = "DELETE FROM `category` WHERE `cat_id` = '$categoryId'";
    $result = Database::search($query);
    if ($result) {
        echo 'Category deleted successfully!';
    } else {
        echo 'Error deleting category!';
    }
}
?>