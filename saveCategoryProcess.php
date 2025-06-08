<?php
session_start();
include "connection.php";

$conn = new mysqli("localhost","root","Nuwantha1122#","cara","3306");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["name"]) && isset($_POST["email"])) {
    if ($_SESSION["au"]["email"] == $_POST["email"]) {
        $cname = $_POST["name"];
        $umail = $_POST["email"];

        $category_rs = $conn->query("SELECT * FROM `category` WHERE `cat_name` LIKE '%$cname%'");
        $category_num = $category_rs->num_rows;

        if ($category_num == 0) {
            // Add new category to database
            $query = "INSERT INTO `category` (`cat_name`) VALUES ('$cname')";
            $result = $conn->query($query);

            if ($result) {
?>


                <script>
                    window.addEventListener("category-added-successfully", function() {
                        const alertbox1 = document.getElementById("alertbox1");
                        alertbox1.style.display = "block";
                        setTimeout(function() {
                            alertbox1.style.display = "none";
                        }, 6000);
                    });
                </script>
<?php
                echo "Category added successfully!";
            } else {
                echo "Error adding category: " . $conn->error;
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
?>
<div id="alertbox1" class="alertbox">
    <div class="alertbox-header">Success</div>
    <div class="alertbox-message">Category added successfully!</div>
    <button class="alertbox-close" onclick="document.getElementById('alertbox1').style.display='none';">&times;</button>
</div>

<style>
    .alertbox {
        display: none;
        position: fixed;
        z-index: 1;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 350px;
        border: 1px solid #ebebeb;
        border-radius: 10px;
        background-color: #FFFFFF;
        box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.2);
        padding: 15px;
        text-align: center;
    }

    .alertbox-header {
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 10px;
    }

    .alertbox-message {
        font-size: 14px;
        margin-bottom: 20px;
    }

    .alertbox-close {
        font-size: 20px;
        cursor: pointer;
        float: right;
        margin-top: -10px;
        margin-right: -10px;
    }
</style>
<?php
$conn->close();
?>