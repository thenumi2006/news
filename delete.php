<?php
include 'include/db.php';

if (!isset($_GET['id'])) {
    die("<script>alert('Article ID missing.'); window.location.href='admin_article.php';</script>");
}

$id = $_GET['id'];

$result = $conn->query("SELECT image FROM articles WHERE id='$id'");
$article = $result->fetch_assoc();

if ($conn->query("DELETE FROM articles WHERE id='$id'") === TRUE) {

    if($article['image'] && file_exists($article['image'])) {
        unlink($article['image']);
    }
    echo "<script>alert('deleted successfully.'); window.location.href='admin_article.php';</script>";
} else {
    echo "<script>alert('Error deleting!! : " . $conn->error . "'); window.location.href='admin_article.php';</script>";
}
?>
