<?php
require 'config.php';
require 'functions.php';

$thread_id = $_GET['id'];
$thread = get_thread($thread_id);

if (!$thread) {
    echo 'Thread not found!';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($thread['subject']) ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1><?= htmlspecialchars($thread['subject']) ?></h1>
    <p><?= nl2br(htmlspecialchars($thread['message'])) ?></p>
    
    <?php if ($thread['image']): ?>
        <img src="<?= htmlspecialchars($thread['image']) ?>" alt="Image" width="400">
    <?php endif; ?>

    <h2>Replies</h2>
    <ul>
        <?php foreach ($thread['replies'] as $reply): ?>
            <li>
                <p><?= nl2br(htmlspecialchars($reply['message'])) ?></p>
                <?php if ($reply['image']): ?>
                    <img src="<?= htmlspecialchars($reply['image']) ?>" alt="Reply Image" width="200">
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <h3>Post a Reply</h3>
    <form action="post.php" method="post" enctype="multipart/form-data">
        <textarea name="message" required></textarea><br>
        <input type="file" name="image"><br>
        <input type="hidden" name="thread_id" value="<?= htmlspecialchars($thread_id) ?>">
        <input type="submit" value="Post Reply">
    </form>
    
    <a href="index.php">Back to Threads</a>
</body>
</html>
