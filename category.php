<?php
include 'include/db.php';
include 'include/getNews.php';
$array = allNews($conn);

?>


<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>news - category</title>
    <link rel="stylesheet" href="assets/css/news.css">
    <style>

    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: lightblue;
    color: black;
    }


    </style>
</head>
<body>
    <?php include 'include/header.php'; ?>


    <div class="main">

    <?php 
    foreach($array as $arr):
    ?>
    <div class="card-container">
    <div class="card-header">
    <h2 class="card-title"><?php echo $arr['title']; ?></h2>
    </div>
    <div class="card-body">
    <img src="<?php echo $arr['image']; ?>" alt="img" class="card-img">
    <p class="card-description"><?php echo $arr['content']; ?></p>
    </div>
    <div class="card-footer">
    <p class="card-auth"><?php echo $arr['author']; ?></p>
    <p class="card-date"><?php echo $arr['publish']; ?></p>

    </div>
    </div>
    <?php endforeach; ?>

    </div>

    <?php include 'include/footer.php'; ?>

</body>
</html>