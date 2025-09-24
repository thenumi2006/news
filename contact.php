<?php
include 'include/db.php';
include 'include/header.php';
include 'contact_info.php';  
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
        color: #333;
    }

    .form-container, .info-container {
        max-width: 600px;
        margin: 30px auto;
        padding: 25px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
    }

    input[type="text"], input[type="email"], textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    input:focus, textarea:focus {
        border-color: #4CAF50;
        outline: none;
        box-shadow: 0 0 5px rgba(76,175,80,0.3);
    }

    textarea { resize: vertical; }

    button {
        display: inline-block;
        padding: 12px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 15px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    button:hover { background-color: #45a049; }

    .success {
        background: #d4edda;
        color: green;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .error {
        background: #f8d7da;
        color: red;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

  
    .info-container p {
        margin-bottom: 8px;
        line-height: 1.5;
    }

    .info-container strong {
        color: #333;
    }

    @media(max-width: 480px) {
        .form-container, .info-container {
            padding: 20px;
            margin: 20px auto;
        }
    }
</style>

<div class="form-container">
    <h2>Contact Us</h2>

    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'success') {
            echo "<div class='success'>Message sent successfully!</div>";
        } elseif ($_GET['status'] == 'error') {
            echo "<div class='error'>There was an error sending your message.</div>";
        }
    }
    ?>

    <form action="submit_contact.php" method="POST">
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label for="message">Message:</label>
            <textarea name="message" id="message" rows="5" required></textarea>
        </div>

        <button type="submit">Send Message</button>
    </form>
</div>


<div class="info-container">
    <p><strong><?= htmlspecialchars($info['company_name']) ?></strong></p>
    <p><?= htmlspecialchars($info['address']) ?></p>
    <p><strong>Web Editor (English):</strong> <?= htmlspecialchars($info['web_editor_en']) ?></p>
    <p><strong>Web Editor (Sinhala):</strong> <?= htmlspecialchars($info['web_editor_si']) ?></p>
    <p><strong>Web Editor (Tamil):</strong> <?= htmlspecialchars($info['web_editor_ta']) ?></p>
    <p><strong>Tel:</strong> <?= htmlspecialchars($info['tel']) ?> | <strong>Fax:</strong> <?= htmlspecialchars($info['fax']) ?></p>
</div>


<?php include 'include/footer.php'; ?>
