<?php

function show_error(int $code, string $message): never {
    http_response_code($code);
    $error_code = $code;
    $error_message = $message;
    include 'templates/errorpage.php';
    exit;
}

?>