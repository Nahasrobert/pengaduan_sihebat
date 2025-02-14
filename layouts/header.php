<?php
session_start();

if (!isset($_SESSION['id_admin']) || $_SESSION['role'] !== 'admin') {
    header('Location: access_denied.php');
    exit();
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
    <title><?= isset($title) ? $title : "Judul Halaman"; ?></title>
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
    <!-- <link rel="stylesheet" href="css/responsive.css" /> -->
    <!-- color css -->
    <link rel="stylesheet" href="../css/colors.css" />
    <!-- select bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap-select.css" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="../css/perfect-scrollbar.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="../css/custom.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- jQuery & DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="dashboard dashboard_1">
    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar_blog_1">
                    <div class="sidebar-header">
                        <!-- <div class="logo_section">
                            <a href="index.php"><img class="logo_icon img-responsive" src="images/logo/logo_icon.png"
                                    alt="#" /></a>
                        </div> -->
                    </div>
                    <div class="sidebar_user_info">
                        <div class="icon_setting"></div>
                        <div class="user_profle_side">
                            <div class="user_img"><img class="img-responsive" src="../images/layout_img/user_img.jpg"
                                    alt="#" /></div>
                            <div class="user_info">
                                <h6><?php echo htmlspecialchars($_SESSION['username']); ?></h6>
                                <p><span class="online_animation"></span> Online</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar_blog_2">
                    <h4>General</h4>
                    <ul class="list-unstyled components">

                        <li class="active"><a href="dashboard.php"><i class="fa fa-dashboard yellow_color"></i>
                                <span>Dashboard</span></a>



                        <li><a href="index.php"><i class="fa fa-table purple_color2"></i> <span>Data Admin</span></a>
                        </li>
                        <li><a href="instansi.php"><i class="fa fa-ticket orange_color"></i> <span>Data Instansi</span></a>
                        </li>
                        <li><a href="pegawai.php"><i class="fa fa-ticket orange_color"></i> <span>Data Pegawai</span></a>
                        </li>
                        <li><a href="profil.php"><i class="fa fa-ticket orange_color"></i> <span>Data Profil</span></a>
                        </li>
                        <li><a href="pengaduan.php"><i class="fa fa-ticket orange_color"></i> <span>Data Pengaduan</span></a>
                        </li>
                        <!-- <li>
                            <a href="#apps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                                    class="fa fa-object-group blue2_color"></i> <span>Apps</span></a>
                            <ul class="collapse list-unstyled" id="apps">
                                <li><a href="email.php">> <span>Email</span></a></li>
                                <li><a href="calendar.php">> <span>Calendar</span></a></li>
                                <li><a href="media_gallery.php">> <span>Media Gallery</span></a></li>
                            </ul>
                        </li> -->
                        <!-- <li><a href="price.php"><i class="fa fa-briefcase blue1_color"></i> <span>Pricing
                                    Tables</span></a></li> -->
                        <!-- <li>
                            <a href="contact.php">
                                <i class="fa fa-paper-plane red_color"></i> <span>Contact</span></a>
                        </li> -->
                        <!-- <li class="active">
                            <a href="#additional_page" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle"><i class="fa fa-clone yellow_color"></i> <span>Additional
                                    Pages</span></a>
                            <ul class="collapse list-unstyled" id="additional_page">
                                <li>
                                    <a href="profile.php">> <span>Profile</span></a>
                                </li>
                                <li>
                                    <a href="project.php">> <span>Projects</span></a>
                                </li>
                                <li>
                                    <a href="login.php">> <span>Login</span></a>
                                </li>
                                <li>
                                    <a href="404_error.php">> <span>404 Error</span></a>
                                </li>
                            </ul>
                        </li> -->
                        <!-- <li><a href="map.php"><i class="fa fa-map purple_color2"></i> <span>Map</span></a></li>
                        <li><a href="charts.php"><i class="fa fa-bar-chart-o green_color"></i> <span>Charts</span></a>
                        </li>
                        <li><a href="settings.php"><i class="fa fa-cog yellow_color"></i> <span>Settings</span></a>
                        </li> -->
                    </ul>
                </div>
            </nav>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
                <!-- topbar -->
                <div class="topbar">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="full">
                            <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i
                                    class="fa fa-bars"></i></button>
                            <div class="logo_section">
                                <a href="index.php"><img class="img-responsive" src="../images/logo/logo.png"
                                        alt="#" /></a>
                            </div>
                            <div class="right_topbar">
                                <div class="icon_info">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-question-circle"></i></a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a>
                                        </li>
                                    </ul>
                                    <ul class="user_profile_dd">
                                        <li>
                                            <a class="dropdown-toggle" data-toggle="dropdown"><img
                                                    class="img-responsive rounded-circle"
                                                    src="../images/layout_img/user_img.jpg" alt="#" /><span
                                                    class="name_user"><?php echo htmlspecialchars($_SESSION['username']); ?></span></a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="profile.php">My Profile</a>
                                                <a class="dropdown-item" href="settings.php">Settings</a>
                                                <a class="dropdown-item" href="help.php">Help</a>
                                                <a class="dropdown-item" href="logout.php"><span>Log Out</span> <i
                                                        class="fa fa-sign-out"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                <!-- end topbar -->