<?php

function getNews($conn){
$sql = "select title, content, image, publish,author from articles order by publish desc limit 6;";
$result = $conn->query($sql); 

$articles = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $articles[] = $row;
    }
}

return $articles;
$conn->close();
}

function getBreakingNews($conn) {

$sql_breaking = "SELECT a.id, a.title, a.sub_title, a.image, a.content, a.publish, a.author
FROM breaking_news bn
JOIN articles a ON bn.article_id = a.id
ORDER BY bn.create_at DESC
LIMIT 2;";
$result_breaking = $conn->query($sql_breaking);

$breaking_news = [];
if ($result_breaking->num_rows > 0) {
    while ($row = $result_breaking->fetch_assoc()) {
        $breaking_news[] = $row;
    }
}
return $breaking_news;
$conn->close();
}

function getpoliticNews($conn) {

$sql_politics = "SELECT a.id, a.title, a.sub_title, a.image, a.content, a.publish, a.author
FROM articles a
JOIN category c ON a.category_id = c.id
WHERE c.id = 1
ORDER BY a.create_at DESC
LIMIT 2;";

$result_politics = $conn->query($sql_politics);

$politics_news = [];
if ($result_politics->num_rows > 0) {
    while ($row = $result_politics->fetch_assoc()) {
        $politics_news[] = $row;
    }
}
return $politics_news;
$conn->close();
}

function getsportsNews($conn) {


$sql_sports = "SELECT a.id, a.title, a.sub_title, a.image, a.content, a.publish, a.author
FROM articles a
JOIN category c ON a.category_id = c.id
WHERE c.id = 2
ORDER BY a.create_at DESC
LIMIT 2;";

$result_sports = $conn->query($sql_sports);

$sports_news = [];
if ($result_sports->num_rows > 0) {
    while ($row = $result_sports->fetch_assoc()) {
        $sports_news[] = $row;
    }
}
return $sports_news;
$conn->close();
}

function getbusinessNews($conn) {


$sql_business = "SELECT a.id, a.title, a.sub_title, a.image, a.content, a.publish, a.author
FROM articles a
JOIN category c ON a.category_id = c.id
WHERE c.id = 3
ORDER BY a.create_at DESC
LIMIT 2;";

$result_business = $conn->query($sql_business);

$business_news = [];
if ($result_business->num_rows > 0) {
    while ($row = $result_business->fetch_assoc()) {
        $business_news[] = $row;
    }
}
return $business_news;
$conn->close();
}

function getlocalNews($conn) {


$sql_local = "SELECT a.id, a.title, a.sub_title, a.image, a.content, a.publish, a.author
FROM articles a
JOIN category c ON a.category_id = c.id
WHERE c.id = 4
ORDER BY a.create_at DESC
LIMIT 2;";

$result_local = $conn->query($sql_local);

$local_news = [];
if ($result_local->num_rows > 0) {
    while ($row = $result_local->fetch_assoc()) {
        $local_news[] = $row;
    }
}
return $local_news;
$conn->close();
}

function allNews($conn){
$sql = "select title, content, image, publish,author from articles;";
$result_all = $conn->query($sql); 

$articles = [];
if ($result_all->num_rows > 0) {
    while ($row = $result_all->fetch_assoc()) {
        $articles[] = $row;
    }
}

return $articles;
$conn->close();
}
?>