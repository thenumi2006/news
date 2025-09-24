<?php
include 'include/db.php';

$category = isset($_GET['category']) ? $_GET['category'] : '';

$query = "SELECT title, content, image, author, publish FROM news";
if (!empty($category)) {
    $query .= " WHERE category = '$category'";
}

$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="card-container">
                <div class="card-header">
                    <h2 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h2>
                </div>
                <div class="card-body">
                    <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="img" class="card-img">
                    <p class="card-description"><?php echo htmlspecialchars($row['content']); ?></p>
                </div>
                <div class="card-footer">
                    <p class="card-auth"><?php echo htmlspecialchars($row['author']); ?></p>
                    <p class="card-date"><?php echo htmlspecialchars($row['publish']); ?></p>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p>No news found for this category.</p>";
    }
} else {
    echo "<p>Error: " . mysqli_error($conn) . "</p>";
}

$conn->close();
?>