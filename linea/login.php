<?php 
 require 'user.php';
 require 'db.php';
require 'parser.php';

session_set_cookie_params([
    'samesite' => 'Lax',
    'httponly' => true,
    'secure' => isset($_SERVER['HTTPS'])
]);
session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

parser::entete_login();
$db = new Database();
if (isset($_POST['csrf_token'], $_POST['password'], $_POST['username']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $user = new User($_POST['username'], $_POST['password']);
        $user->auth_user($db);
}
parser::body_login($db);
$db -> close_cnx();
echo '</html>';
?>
