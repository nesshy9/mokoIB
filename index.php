<?php
require 'config.php';
require 'functions.php';

$threads = get_threads();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Imageboard</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Welcome to the Sleepchan imageboard devel</h1>
    
    <h2>Threads</h2>
    <ul>
        <?php foreach ($threads as $thread): ?>
            <li>
                <a href="thread.php?id=<?= $thread['id'] ?>"><?= htmlspecialchars($thread['subject']) ?></a><br>
                <?= nl2br(htmlspecialchars($thread['message'])) ?>
                <?php if ($thread['image']): ?>
                    <br><img src="<?= htmlspecialchars($thread['image']) ?>" alt="Image" width="200">
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    
    <a href="post.php">Create a new thread</a>
</body>
</html>
