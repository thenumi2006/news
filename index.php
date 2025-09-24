<?php
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
    <title>news - home</title>
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

        header {
    position: sticky;
    top: 0;
    width: 100%;
    z-index:1000;
}

        .breaking-news-wrapper {
    overflow: hidden;
    background-color: #c1bbbbff;
    color: white;
    height: 50px;
    display: flex;
    align-items: center;
    font-weight: bold;
}
.breaking-news-track {
    display: inline-block;
    white-space: nowrap;
    animation: scroll-left 20s linear infinite;
}

.breaking-news-item {
    display: inline-block;
    margin-right: 50px; 
    font-weight: bold;
}

@keyframes scroll-left {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(-100%);
    }
}
@media (max-width: 768px) {
    .breaking-news-item {
        margin-right: 20px;
        font-size: 14px;
    }
}

    </style>
</head>
<body>
    <?php include 'include/header.php'; ?>

    <div class="breaking-news-wrapper">
    <div class="breaking-news-track">
        <?php foreach($breakingNews as $brr): ?>
        <div class="breaking-news-item">
            <h2 class="breaking-news-title"><?php echo $brr['title']; ?></h2>
        </div>
        <?php endforeach; ?>
    </div>
</div>

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

    <?php include 'include/footer.php'; ?>
    
</body>
</html>