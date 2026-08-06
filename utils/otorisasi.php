<?php
function require_role($allowed_roles, $redirect = '../dashboard/index.php') {
    if (!is_array($allowed_roles)) {
        $allowed_roles = array($allowed_roles);
    }

    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $allowed_roles)) {
        $roles_text = implode(' atau ', $allowed_roles);
        echo "<script>
            alert('Anda harus login sebagai $roles_text untuk mengakses halaman ini.');
            window.location.href = '$redirect';
        </script>";
        exit();
    }
}