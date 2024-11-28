<?php
function create_thread($subject, $message, $image = null) {
    $thread_id = uniqid();  // Generate a unique ID for the thread
    $thread_data = [
        'subject' => $subject,
        'message' => $message,
        'image' => $image,  // Store image URL if uploaded
        'replies' => [],
        'timestamp' => time()
    ];

    // Save the thread data to a file
    file_put_contents(THREADS_DIR . "/$thread_id.json", json_encode($thread_data));
    return $thread_id;
}

function get_threads() {
    $threads = [];
    foreach (glob(THREADS_DIR . '/*.json') as $file) {
        $thread_data = json_decode(file_get_contents($file), true);
        $thread_data['id'] = basename($file, '.json');
        $threads[] = $thread_data;
    }
    return $threads;
}

function get_thread($thread_id) {
    $file = THREADS_DIR . "/$thread_id.json";
    if (file_exists($file)) {
        return json_decode(file_get_contents($file), true);
    }
    return null;
}

function save_reply($thread_id, $message, $image = null) {
    $thread = get_thread($thread_id);
    if ($thread) {
        $reply_id = uniqid();
        $reply = [
            'message' => $message,
            'image' => $image,
            'timestamp' => time()
        ];
        $thread['replies'][] = $reply;

        // Save the updated thread data back to the file
        file_put_contents(THREADS_DIR . "/$thread_id.json", json_encode($thread));
    }
}

function upload_image($file) {
    $target_dir = UPLOADS_DIR . '/';
    $target_file = $target_dir . basename($file["name"]);
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return BASE_URL . '/uploads/' . basename($file["name"]);
    }
    return null;
}
?>
