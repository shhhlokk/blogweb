<?php
if(!isset($_GET['id'])) {
    die("Post ID not specified.");
}

$postId = intval($_GET['id']);

$conn = new mysqli("database-1.c5k0amm2utg0.ap-south-1.rds.amazonaws.com", "admin", "admin2005", "database-1");
if($conn->connect_error) die("Connection Error: " . $conn->connect_error);

$sql = "SELECT topic_title, topic_date, image_filename, topic_para 
        FROM blog_table 
        WHERE id = $postId";

$result = $conn->query($sql);

if($result->num_rows === 0) {
    die("Post not found.");
}

$post = $result->fetch_assoc();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($post['topic_title']); ?></title>
<link rel="stylesheet" href="styles/style.css">
</head>
<body>

<header class="top-bar">
    <h1><?php echo htmlspecialchars($post['topic_title']); ?></h1>
    <a class="new-post-btn" href="index.php">Home</a>
</header>

<main class="single-post-container">
    <img class="post-image" src="images/<?php echo $post['image_filename']; ?>" alt="Blog Image">
    <p class="post-date"><?php echo date("F j, Y, g:i a", strtotime($post['topic_date'])); ?></p>
    <p class="post-paragraph"><?php echo nl2br(htmlspecialchars($post['topic_para'])); ?></p>
</main>

</body>
</html>

