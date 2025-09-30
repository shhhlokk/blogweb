<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "blog_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$blogTitle = $_POST["blogtitle"] ?? '';
$blogDate = $_POST["blogdate"] ?? '';
$blogPara = $_POST["blogpara"] ?? '';
$filename = "NONE";

// Handle image upload
if(isset($_FILES['uploadimage']) && $_FILES['uploadimage']['name'] != "") {
    $filename = basename($_FILES['uploadimage']['name']);
    $targetDir = "images/";
    $targetFile = $targetDir . $filename;
    if(!move_uploaded_file($_FILES['uploadimage']['tmp_name'], $targetFile)) {
        $filename = "NONE";
    }
}

// Insert into database
$sql = "INSERT INTO blog_table (topic_title, topic_date, image_filename, topic_para)
        VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $blogTitle, $blogDate, $filename, $blogPara);

if($stmt->execute()) {
    header("Location: post.php?id=" . $conn->insert_id);
    exit();
} else {
    echo "Error saving post: " . $conn->error;
}

$conn->close();
?>
