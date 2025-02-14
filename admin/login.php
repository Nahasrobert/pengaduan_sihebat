<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hash password dengan MD5

    // Query untuk mencari user dengan password MD5
    $stmt = $conn->prepare("SELECT * FROM tbl_admin where username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['id_admin'] = $user['id_admin'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        // Redirect berdasarkan username
        switch ($user['role']) {
            case 'pelapor':
                header('Location: pelapor.php');
                break;
            case 'admin':
                header('Location: dashboard.php');
                break;
            case 'vendor':
                header('Location: vendor.php');
                break;
            default:
                header('Location: access_denied.php');
                break;
        }
        exit();
    } else {
        // Simpan status error di session
        $_SESSION['login_error'] = true;
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Pluto - Responsive Bootstrap Admin Panel Templates</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- site icon -->
    <link rel="icon" href="../images/fevicon.png" type="image/png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <!-- site css -->
    <link rel="stylesheet" href="../style.css" />
    <!-- responsive css -->
    <link rel="stylesheet" href="../css/responsive.css" />
    <!-- color css -->
    <link rel="stylesheet" href="../css/colors.css" />
    <!-- select bootstrap -->
    <link rel="stylesheet" href="css/bootstrap-select.css" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="../css/perfect-scrollbar.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="../css/custom.css" />
    <!-- calendar file css -->
    <link rel="stylesheet" href="../js/semantic.min.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="inner_page login">
    <div class="full_container">
        <div class="container">
            <div class="center verticle_center full_height">
                <div class="login_section">
                    <div class="logo_login">
                        <div style="color: white; font-size: 20px;" class="center">SISTEM INFORMASI PENGADUAN APLIKASI SIHEBAT
                        </div>
                    </div>
                    <div class="login_form">
                        <form method="POST" action="">
                            <fieldset>
                                <div class="field">
                                    <label class="label_field">Username</label>
                                    <input type="text" name="username" placeholder="Masukan Username" required />
                                </div>
                                <div class="field">
                                    <label class="label_field">Password</label>
                                    <input type="password" name="password" placeholder="Masukkan Password" required />
                                </div>
                                <div class="field">
                                    <label class="label_field hidden">hidden label</label>
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"> Remember Me
                                    </label>
                                    <a class="forgot" href="#">Forgotten Password?</a>
                                </div>
                                <div class="field margin_0">
                                    <label class="label_field hidden">hidden label</label>
                                    <button type="submit" class="main_bt">Sign In</button>
                                </div>
                            </fieldset>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- wow animation -->
    <script src="../js/animate.js"></script>
    <!-- select country -->
    <script src="../js/bootstrap-select.js"></script>
    <!-- nice scrollbar -->
    <script src="../js/perfect-scrollbar.min.js"></script>
    <script>
        var ps = new PerfectScrollbar('#sidebar');
    </script>
    <!-- custom js -->
    <script src="../js/custom.js"></script>
    <script>
        // Menampilkan pesan error menggunakan SweetAlert2 jika login gagal
        <?php if (isset($_SESSION['login_error'])) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: 'Nomor HP atau Password salah!',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Coba Lagi'
            });
            <?php unset($_SESSION['login_error']); // Hapus session setelah ditampilkan 
            ?>
        <?php endif; ?>
    </script>
</body>

</html>