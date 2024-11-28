![](https://files.catbox.moe/882slc.png)

i made mokuIB due to lack of imageboard softwares out there i hope this engine grows and people can contribute to it one day


this imageboard is flat-file so no need for a database it is pretty simple to install


Here’s a simple directory structure:
```
/imageboard/
    /assets/                  // Store static files (CSS, JS, images)
    /threads/                 // Store thread and post data (flat-file storage)
    /uploads/                 // Store uploaded images
    index.php                 // Homepage to list threads
    thread.php                // Display individual thread with replies
    post.php                  // Handle posting new threads/replies
    config.php                // Configuration file
    functions.php             // Helper functions
    .htaccess                 // Rewrite rules for pretty URLs (optional)
```
