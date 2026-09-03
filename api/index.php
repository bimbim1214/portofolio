<?php

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?? ''
);

// If file exists in public folder, let PHP built-in server serve it directly
if ($uri !== '/' && file_exists(__DIR__.'/../public'.$uri)) {
    return false;
}

require __DIR__.'/../public/index.php';
