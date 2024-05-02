<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $target_dir = "uploadfile/"; // Change this to the desired directory for uploaded files
        $uploadFile = $target_dir . basename($_FILES["file"]["name"]);

        // Check if the file is allowed (you can modify this to allow specific file types)
        $allowed_types = array("jpg", "jpeg", "png", "gif", "pdf");
        $file_info = pathinfo($_FILES["file"]["name"]);
        $file_type = strtolower($file_info["extension"]);

        if (!in_array($file_type, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
        } else {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadFile)) {
                // File upload success, now store information in the database
                $file_name = $_FILES["file"]["name"];
                $file_size = $_FILES["file"]["size"];
                $file_type = $_FILES["file"]["type"];
                $file_date = date("Y-m-d H:i:s"); // Current date and time

                // Database connection
                $db_host = "localhost";
                $db_user = "root";
                $db_pass = "";
                $db_name = "gedproject";

                $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Insert the file information into the database
                $sql = "INSERT INTO file (`user-file`, `size-file`, `date-file`) VALUES ('$file_name', '$file_size', '$file_date')";

                if ($conn->query($sql) === TRUE) {
                    echo "<img src='$uploadFile' />";
                } else {
                    echo "Sorry, there was an error uploading your file and storing information in the database: " . $conn->error;
                }

                $conn->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file was uploaded.";
    }
}

?>

