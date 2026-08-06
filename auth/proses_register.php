<?php
include "../config/koneksi.php";

$username = mysql_real_escape_string($_POST['username']);
$password_input = $_POST['password'];

$password_terenkripsi = md5($password_input);

$query = "INSERT INTO users (username, password) VALUES ('$username', '$password_terenkripsi')";
$result = mysql_query($query);

if ($result) {
    $redirect_url = "logout.php";

    $response = array(
        'status' => 'success',
        'message' => 'Registrasi berhasil!',
        'redirect' => $redirect_url
    );
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Registrasi gagal: ' . mysql_error()
    );
}

header('Content-Type: application/json');
echo json_encode($response);
?>
