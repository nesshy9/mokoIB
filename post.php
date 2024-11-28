<?php
require 'config.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $image_url = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_url = upload_image($_FILES['image']);
    }

    if (isset($_POST['thread_id'])) {
        // Reply to a thread
        $thread_id = $_POST['thread_id'];
        save_reply($thread_id, $message, $image_url);
        header("Location: thread.php?id=$thread_id");
        exit;
    } else {
        // Create a new thread
        $subject = $_POST['subject'];
        $thread_id = create_thread($subject, $message, $image_url);
        header("Location: thread.php?id=$thread_id");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Thread</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Create a new Thread</h1>
    <form action="post.php" method="post" enctype="multipart/form-data">
        <label for="subject">Subject</label><br>
        <input type="text" name="subject" required><br>
        <label for="message">Message</label><br>
        <textarea name="message" required></textarea><br>
        <label for="image">Upload an Image (Optional)</label><br>
        <input type="file" name="image"><br>
        <input type="submit" value="Post Thread">
    </form>

    <a href="index.php">Back to Threads</a>
</body>
</html>
