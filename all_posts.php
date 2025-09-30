<?php
$conn = new mysqli("localhost", "root", "", "blog_db");
if($conn->connect_error) die("Connection Error: " . $conn->connect_error);

$sql = "SELECT id, topic_title, topic_date, image_filename, topic_para 
        FROM blog_table 
        ORDER BY topic_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Blog Posts</title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<header class="top-bar">
  <h1>My Blog</h1>
  <a href="index.php" class="new-post-btn">Write a New Post</a>
</header>

<main class="all-posts-container">
  <?php
  if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          echo "<a href='post.php?id=".$row['id']."' class='post-card-link'>";
          echo "<div class='post-card'>";
          if($row['image_filename'] != "NONE") {
              echo "<img class='post-image' src='images/" . $row["image_filename"] . "' alt='Blog Image'>";
          }
          echo "<div class='post-content'>";
          echo "<h2>" . $row["topic_title"] . "</h2>";
          echo "<p class='post-date'>" . date("F j, Y", strtotime($row["topic_date"])) . "</p>";
          echo "<p class='post-paragraph'>" . substr($row["topic_para"], 0, 200) . "...</p>";
          echo "</div></div></a>";
      }
  } else {
      echo "<p class='no-posts'>No Blog Posts Found</p>";
  }
  $conn->close();
  ?>
</main>

</body>
</html>
