<?php
function cors_hook()
{
    // Adjust to your React dev URL (Vite default: 5173; CRA: 3000)
    $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '*';
    $allowed = ['http://localhost:5173','http://localhost:3000'];

    if (in_array($origin, $allowed)) {
        header("Access-Control-Allow-Origin: $origin");
    } else {
        header("Access-Control-Allow-Origin: http://localhost:5173");
    }
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");

    // Handle preflight early
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        header('Content-Length: 0'); header('Content-Type: application/json'); exit;
    }
}
