<?php
// index.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog Using PHP And MySQL</title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body>

  <div class="top-bar">
    <span id="topBarTitle">Blog | New Post</span>
  </div>

  <div class="writing-section">
    <form action="blog_post_process.php" method="POST" enctype="multipart/form-data">
      <input id="blogTitle" name="blogtitle" type="text" placeholder="Blog Title..." required>
      <br><br>
      <span id="dateLabel">Date: </span>
      <input id="blogDate" name="blogdate" type="date" required>
      <br><br>
      <input type="file" name="uploadimage" accept="image/*">
      <br><br>
      <textarea id="blogPara" name="blogpara" cols="75" rows="10" placeholder="Blog Paragraph..." required></textarea>
      <br><br>
      <button id="saveBtn" type="submit">Save Post</button>
    </form>
    <br>
    <center><a href="all_posts.php" id="saveBtn">Go to All Posts</a></center>
  </div>

</body>
</html>
