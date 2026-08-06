<?php
session_start();
include "../config/koneksi.php";

$username = mysql_real_escape_string($_POST['username']);
$password = $_POST['password'];
$password_md5 = md5($password);

$query = "SELECT * FROM users WHERE username='$username' AND password='$password_md5'";
$result = mysql_query($query);

if($username == "" || $password == "") {
    $response = array('status' => 'error', 'message' => 'Username dan password tidak boleh kosong!');
} else {
    $response = array('status' => 'error', 'message' => 'Username atau password salah!');
}

if (mysql_num_rows($result) > 0) {
    $user_data = mysql_fetch_assoc($result);
    
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    $_SESSION['role'] = $user_data['role'];

    $redirect_url = "../ao/dashboard/index.php";

    // Mengisi respon sukses
    $response = array(
        'status' => 'success',
        'message' => 'Login berhasil!',
        'redirect' => $redirect_url
    );
}

header('Content-Type: application/json');
echo json_encode($response);
?>
