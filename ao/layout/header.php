<?php
session_start();
require_once "../../config/cek_session.php";
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Anda harus login terlebih dahulu!'); window.location.href = '../../auth/login.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?= isset($page_title) ? $page_title . ' - Utomobank' : 'Utomobank' ?></title>
    <link rel="icon" href="../../assets/img/favicon.ico" type="image/x-icon" />
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />

    <!-- Fonts and icons -->
    <script src="../../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["../../assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <style>
      select.readonly-select, input[type="date"].readonly-date {
        pointer-events: none;
        background: #e8e8e8 !important;
        border-color: #e8e8e8 !important;
        opacity: .6 !important;
      }
    </style>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../../assets/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.6/css/buttons.bootstrap5.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.8/css/responsive.bootstrap5.css" />
  </head>
  <body>
    <div class="wrapper">