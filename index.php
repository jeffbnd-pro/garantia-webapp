<?php
session_start();
include_once './config/db.php';

if (!isset($_SESSION['userId']) && !in_array($_GET["page"] ?? '', ['connexion','login','register'])) {
    header("Location: ?page=connexion");
    exit;
}

$public = [
    'connexion' => __DIR__ . '/public/pages/indexConnexion.php',
    'login'     => __DIR__ . '/public/components/user/login_logout/login.php',
    'register'  => __DIR__ . '/public/components/user/login_logout/register.php',
];

// Pages privées (nécessitent layout)
$private = ['dashboard','alert','comming','user','addWarranty'];

$page = $_GET['page'] ?? 'dashboard';

if (array_key_exists($page, $public)) {
    include_once $public[$page];
    exit;
}

// Si page privée → afficher layout.php
if (in_array($page, $private)) {
    include_once __DIR__ . '/layout.php';
    exit;
}

// Sinon → 404
include_once __DIR__ . '/pages/404.php';