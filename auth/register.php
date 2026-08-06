<!doctype html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register Utomobank</title>
<script>
    (() => {
    'use strict';
    const STORAGE_KEY = 'lte-theme';
    let stored = null;
    try {
        stored = localStorage.getItem(STORAGE_KEY);
    } catch {
        // localStorage may be unavailable (private mode, sandboxed iframe).
    }
    const prefersDark = globalThis.matchMedia('(prefers-color-scheme: dark)').matches;
    let resolved = 'light';
    if (stored === 'dark' || stored === 'light') {
        resolved = stored;
    } else if (prefersDark) {
        resolved = 'dark';
    }
    document.documentElement.setAttribute('data-bs-theme', resolved);
    document.documentElement.style.colorScheme = resolved;
    })();
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="all" onload="this.media = 'all'">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0/dist/css/adminlte.min.css" />  <!--begin::Body-->
  <body class="login-page bg-body-secondary">
    <main class="register-box" id="main" tabindex="-1">
      <h1 class="register-logo">
        <a href="../index2.html"><b>Admin</b>LTE</a>
      </h1>
      <!-- /.register-logo -->
      <div class="card">
        <div class="card-body register-card-body">
          <p class="register-box-msg">Register a new membership</p>

          <form id="formRegister">
            <label class="visually-hidden" for="registerName">Username</label>
            <div class="input-group mb-3">
              <input id="registerName" name="username" type="text" class="form-control" placeholder="Username">
              <div class="input-group-text">
                <span class="bi bi-person"></span>
              </div>
            </div>
            <label class="visually-hidden" for="registerPassword">Password</label>
            <div class="input-group mb-3">
              <input id="registerPassword" name="password" type="password" class="form-control" placeholder="Password">
              <div class="input-group-text">
                <span class="bi bi-lock-fill"></span>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
          </form>
        </div>
        <!-- /.register-card-body -->
      </div>
    </main>
    <!-- /.login-box -->
    
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0/dist/js/adminlte.min.js"></script>
    <script src="../assets/js/jquery-3.6.4.min.js"></script>
    <script src="../assets/js/sweetalert2.js"></script>

    <script>
    $(document).ready(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        $('#formRegister').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'proses_register.php',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        }).then(function() {
                            window.location.href = response.redirect;
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: response.message
                        });
                    }
                },
                error: function() {
                    Toast.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan sistem. Coba lagi nanti.'
                    });
                }
            });
        });
    });
    </script>
    </body>
  <!--end::Body-->
</html>
