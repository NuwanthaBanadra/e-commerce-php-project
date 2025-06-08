<?php
session_start();
include "connection.php";

// require "SMTP.php";
// require "PHPMailer.php";
// require "Exception.php";

// use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["name"]) && isset($_POST["email"])) {
    if ($_SESSION["au"]["email"] == $_POST["email"]) {
        $cname = $_POST["name"];
        $umail = $_POST["email"];

        $category_rs = Database::search("SELECT * FROM `category` WHERE `cat_name` LIKE '%" . $cname . "%'");
        $category_num = $category_rs->num_rows;

        if ($category_num == 0) {
            // Add new category to database
            $query = "INSERT INTO `category` (`cat_name`) VALUES ('$cname')";
            $result = Database::iud($query);
            echo "Category added successfully!";

            if ($result) {
                
            }
        } else {
            echo "This category already exists.";
        }
    } else {
        echo "Invalid user.";
    }
} else {
    echo "Something is missing.";
}
