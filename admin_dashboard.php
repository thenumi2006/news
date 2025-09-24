<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: admin_dashboard.php');
    exit();
}

include 'include/db.php';
include 'include/getNews.php';
$breakingNews = getBreakingNews($conn);
$array = getNews($conn);
$politicNews = getpoliticNews($conn);
$sportsNews = getsportsNews($conn);
$businessNews = getbusinessNews($conn);
$localNews = getlocalNews($conn);

?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - home</title>
    <link rel="stylesheet" href="assets/css/news.css">
    <link rel="stylesheet" href="assets/css/brnews.css">
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
    <?php include 'include/admin_header.php'; ?>
    <div class="breaking-news">
        
        <?php 
        foreach($breakingNews as $brr):
            ?>
        <div class="breaking-news-item">
            <h1>Breaking News</h1>
            <div class="breaking-news-container">
                <div class="breaking-news-header">
                    <h2 class="breaking-news-title"><?php echo $brr['title']; ?></h2>
                </div>
                <div class="breaking-news-body">
                    <img src="<?php echo $brr['image']; ?>" alt="img" class="breaking-news-img">
                    <p class="breaking-news-description"><?php echo $brr['content']; ?></p>
                </div>
                <div class="breaking-news-footer">
                <p class="card-auth"><?php echo $brr['author']; ?></p>
                <p class="card-date"><?php echo $brr['publish']; ?></p>
            </div>
        </div>
        
        </div><?php endforeach; ?>
    </div>
    <br>
    
    <div class="home-news">
        <h1>politic News</h1>
        <?php 
        foreach($politicNews as $pl):
            ?>
        <div class="home-news-item">
            <div class="home-news-container">
                <div class="home-news-header">
                    <h2 class="home-news-title"><?php echo $pl['title']; ?></h2>
                </div>
                <div class="home-news-body">
                    <img src="<?php echo $pl['image']; ?>" alt="img" class="home-news-img">
                    <p class="home-news-description"><?php echo $pl['content']; ?></p>
                </div>
                <div class="home-news-footer">
                <p class="card-auth"><?php echo $pl['author']; ?></p>
                <p class="card-date"><?php echo $pl['publish']; ?></p>
            </div>
        </div>
        
        </div><?php endforeach; ?>
        <h1>sports News</h1>
        <?php 
        foreach($sportsNews as $sn):
            ?>
        <div class="home-news-item">
            <div class="home-news-container">
                <div class="home-news-header">
                    <h2 class="home-news-title"><?php echo $sn['title']; ?></h2>
                </div>
                <div class="home-news-body">
                    <img src="<?php echo $sn['image']; ?>" alt="img" class="home-news-img">
                    <p class="home-news-description"><?php echo $sn['content']; ?></p>
                </div>
                <div class="home-news-footer">
                <p class="card-auth"><?php echo $sn['author']; ?></p>
                <p class="card-date"><?php echo $sn['publish']; ?></p>
            </div>
        </div>
        
        </div><?php endforeach; ?>
    </div>
    <br>
    <div class="home-news">
        <h1>business News</h1>
        <?php 
        foreach($businessNews as $bn):
            ?>
        <div class="home-news-item">
            <div class="home-news-container">
                <div class="home-news-header">
                    <h2 class="home-news-title"><?php echo $bn['title']; ?></h2>
                </div>
                <div class="home-news-body">
                    <img src="<?php echo $bn['image']; ?>" alt="img" class="home-news-img">
                    <p class="home-news-description"><?php echo $bn['content']; ?></p>
                </div>
                <div class="home-news-footer">
                <p class="card-auth"><?php echo $bn['author']; ?></p>
                <p class="card-date"><?php echo $bn['publish']; ?></p>
            </div>
        </div>
        
        </div><?php endforeach; ?>
        <h1>local News</h1>
        <?php 
        foreach($localNews as $ln):
            ?>
        <div class="home-news-item">
            <div class="home-news-container">
                <div class="home-news-header">
                    <h2 class="home-news-title"><?php echo $ln['title']; ?></h2>
                </div>
                <div class="home-news-body">
                    <img src="<?php echo $ln['image']; ?>" alt="img" class="home-news-img">
                    <p class="home-news-description"><?php echo $ln['content']; ?></p>
                </div>
                <div class="home-news-footer">
                <p class="card-auth"><?php echo $ln['author']; ?></p>
                <p class="card-date"><?php echo $ln['publish']; ?></p>
            </div>
        </div>
        
        </div><?php endforeach; ?>
    </div>
    
        
    
    
    <div class="main">
        <h1>Latest News</h1>
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

    <?php include 'include/admin_footer.php'; ?>
    
</body>
</html>