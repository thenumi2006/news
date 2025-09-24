<?php
include 'include/db.php';
include 'include/admin_header.php';

if (!isset($_GET['id'])) {
    die("Article ID missing.");
}

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM articles WHERE id='$id'");
$article = $result->fetch_assoc();

$cat_result = $conn->query("SELECT id, name FROM category WHERE status='active'");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_id = $_POST['category_id'];
    $title = $_POST['title'];
    $sub_title = $_POST['sub_title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $status = $_POST['status'];
    $update_at = date("Y-m-d H:i:s");

    $image = $article['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "assets/img/";
        $file_name = time() . "_" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $file_name;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = $target_dir . $file_name;
        }
    }

    $sql = "UPDATE articles SET 
                category_id='$category_id',
                title='$title',
                sub_title='$sub_title',
                content='$content',
                author='$author',
                status='$status',
                update_at='$update_at',
                image='$image'
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='success'>updated successfully!</div>";
    } else {
        echo "<div class='error'> Error: " . $conn->error . "</div>";
    }
}
?>

<style>
    body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: lightblue;
            color: black;
        }
    .form-container {
        max-width: 700px;
        margin: 30px auto;
        padding: 25px;
        background: white;
    }
    .form-container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: black;
    }
    .form-group {
        margin-bottom: 15px;
    }
    label {
        font-weight: 600;
        display: block;
        margin-bottom: 6px;
        color: black;
    }
    input[type="text"], textarea, select, input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid black;
        font-size: 15px;
        outline: none;
        
    }
    input[type="text"]:focus, textarea:focus, select:focus {
        border-color: blueviolet;
    }
    textarea {
        resize: vertical;
    }
    img {
        display: block;
        margin-top: 10px;
        border: 1px solid white;
    }
    .btn {
        display: inline-block;
        padding: 10px 18px;
        background: blueviolet;
        color: white;
        border: none;
        font-size: 15px;
    }
    
    .success {
        background: #d4edda;
        color: green;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 15px;
    }
    .error {
        background: white;
        color: red;
        padding: 12px;
        margin-bottom: 15px;
    }
</style>

<div class="form-container">
    <h2>Edit Article (ID <?= $id ?>)</h2>
    <form method="POST" enctype="multipart/form-data">
        
        <div class="form-group">
            <label>Category:</label>
            <select name="category_id" required>
                <?php while($cat = $cat_result->fetch_assoc()) { ?>
                    <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $article['category_id'] ? "selected" : "" ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Title:</label>
            <input type="text" name="title" value="<?= htmlspecialchars($article['title']) ?>" required>
        </div>

        <div class="form-group">
            <label>Sub Title:</label>
            <input type="text" name="sub_title" value="<?= htmlspecialchars($article['sub_title']) ?>" required>
        </div>

        <div class="form-group">
            <label>Content:</label>
            <textarea name="content" rows="5" required><?= htmlspecialchars($article['content']) ?></textarea>
        </div>

        <div class="form-group">
            <label>Image:</label>
            <input type="file" name="image">
            <?php if($article['image']) { ?>
                <img src="<?= $article['image'] ?>" alt="Current Image" width="120">
            <?php } ?>
        </div>

        <div class="form-group">
            <label>Author:</label>
            <input type="text" name="author" value="<?= htmlspecialchars($article['author']) ?>" required>
        </div>

        <div class="form-group">
            <label>Status:</label>
            <select name="status">
                <option value="draft" <?= $article['status']=='draft' ? 'selected':'' ?>>Draft</option>
                <option value="published" <?= $article['status']=='published' ? 'selected':'' ?>>Published</option>
            </select>
        </div>

        <button type="submit" class="btn">Update Article</button>
    </form>
</div>

<?php include 'include/admin_footer.php'; ?>
