<?php
include 'include/db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_id = $_POST['category_id'];
    $title = $_POST['title'];
    $sub_title = $_POST['sub_title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $status = $_POST['status'];
    $create_at = date("Y-m-d H:i:s");
    $publish = date("Y-m-d H:i:s");

    
    $image = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "assets/img/"; 
        $file_name = time() . "_" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            
            $image = $target_dir . $file_name;  
        } else {
            $error = "Error.";
        }
    }

    
    if (empty($error)) {
        $sql = "INSERT INTO articles 
                (category_id, title, sub_title, content, update_at, image, create_at, publish, author, status)
                VALUES
                ('$category_id', '$title', '$sub_title', '$content', '$create_at', '$image', '$create_at', '$publish', '$author', '$status')";

        if ($conn->query($sql) === TRUE) {
            $success = "News added successfully!";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}


$cat_result = $conn->query("SELECT id, name FROM category WHERE status='active'");


$news_result = $conn->query("
                            SELECT a.id, a.title, a.sub_title, a.image, a.publish, a.author, c.name as category_name
                            FROM articles a
                            JOIN category c ON a.category_id = c.id
                            ORDER BY a.create_at DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: lightblue;
            color: black;
        }

        form { 
            background: white; 
            padding: 20px; 
            border-radius: 8px; 
            margin-bottom: 30px; 
        }
        input, select, textarea { 
            width: 100%; 
            padding: 8px; 
            margin-bottom: 10px; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            background: white; 
        }
        th, td { 
            padding: 10px; 
            border: 1px solid whitesmoke; 
            text-align: left; 
        }
        img { 
            max-width: 100px; 
        }
        .success { 
            color: green; 
        }
        .error { 
            color: red; 
        }
    </style>
</head>
<body>
       <?php include 'include/admin_header.php'; ?>

<h2>Add News Article</h2>

<?php if(!empty($success)) echo "<p class='success'>$success</p>"; ?>
<?php if(!empty($error)) echo "<p class='error'>$error</p>"; ?>

<form method="POST" enctype="multipart/form-data">
    <label>Category:</label>
    <select name="category_id" required>
        <option value="">Select Category</option>
        <?php while($cat = $cat_result->fetch_assoc()) { ?>
            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
        <?php } ?>
    </select>

    <label>Title:</label>
    <input type="text" name="title" required>

    <label>Sub Title:</label>
    <input type="text" name="sub_title" required>

    <label>Content:</label>
    <textarea name="content" rows="5" required></textarea>

    <label>Image:</label>
    <input type="file" name="image" accept="image/*" required>

    <label>Author:</label>
    <input type="text" name="author" required>

    <label>Status:</label>
    <select name="status">
        <option value="draft">Draft</option>
        <option value="published">Published</option>
    </select>

    <input type="submit" value="Add News">
</form>

<h2>All News Articles</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Category</th>
        <th>Title</th>
        <th>Sub Title</th>
        <th>Image</th>
        <th>Author</th>
        <th>Publish</th>
        <th>Actions</th>
    </tr>
    <?php while($news = $news_result->fetch_assoc()) { ?>
    <tr>
        <td><?= $news['id'] ?></td>
        <td><?= htmlspecialchars($news['category_name']) ?></td>
        <td><?= htmlspecialchars($news['title']) ?></td>
        <td><?= htmlspecialchars($news['sub_title']) ?></td>
        <td>
            <?php if($news['image']) { ?>
                <img src="<?= $news['image'] ?>" alt="">
            <?php } ?>
        </td>
        <td><?= htmlspecialchars($news['author']) ?></td>
        <td><?= $news['publish'] ?></td>
        <td>
            <a href="edit.php?id=<?= $news['id'] ?>">Edit</a> | 
            <a href="delete.php?id=<?= $news['id'] ?>" onclick="return confirm('Do you want to delete this article?');">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

    <?php include 'include/admin_footer.php'; ?>


</body>
</html>
