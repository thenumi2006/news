<?php
include 'include/db.php';

$info_result = $conn->query("SELECT * FROM contact_info LIMIT 1");
$info = $info_result->fetch_assoc();
?>
